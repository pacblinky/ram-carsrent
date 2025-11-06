<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarsListController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with(['brand', 'location'])->where('is_available', true);

        // --- 1. FILTERS ---
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Date/Quantity Availability Filter
        if ($request->filled('pickup_datetime') && $request->filled('dropoff_datetime')) {
            try {
                $reqStart = Carbon::parse($request->pickup_datetime);
                $reqEnd   = Carbon::parse($request->dropoff_datetime);

                // Use the same standard overlap formula in SQL:
                // existing_start < req_end AND existing_end > req_start
                $query->whereRaw('(
                    SELECT COUNT(*)
                    FROM reservations
                    WHERE reservations.car_id = cars.id
                    AND reservations.status != ?
                    AND reservations.start_datetime < ?
                    AND reservations.end_datetime > ?
                ) < cars.quantity', [
                    'canceled',
                    $reqEnd,   // Existing Start MUST BE LESS THAN Requested End
                    $reqStart  // Existing End MUST BE GREATER THAN Requested Start
                ]);

            } catch (\Exception $e) {
                // Ignore invalid dates
            }
        }

        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // --- 2. SORTING ---
        match ($request->input('sort', 'newest')) {
            'price_asc'  => $query->orderBy('price_per_day', 'asc'),
            'price_desc' => $query->orderBy('price_per_day', 'desc'),
            default      => $query->latest(),
        };

        // --- 3. PAGINATION ---
        $carsPaginator = $query->paginate($request->input('per_page', 10))->withQueryString();

        $carsPaginator->setCollection(
            $carsPaginator->getCollection()->map(function ($car) {
                return [
                    'id'        => $car->id,
                    'name'      => $car->name,
                    'image'     => $car->images && count($car->images) > 0 ? asset('storage/' . $car->images[0]) : asset('images/logo.png'),
                    'price'     => $car->price_per_day,
                    'location'  => $car->location?->name ?? 'Not specified',
                    'specs'     => [
                        ['icon' => 'mileage',      'text' => ($car->mileage ?? 'N/A')],
                        ['icon' => 'transmission', 'text' => ucfirst($car->transmission)],
                        ['icon' => 'seats',        'text' => $car->number_of_seats . ' Seats'],
                        ['icon' => 'fuel',         'text' => ucfirst($car->fuel_type)],
                    ],
                ];
            })
        );

        if ($request->ajax()) {
            return view('cars.partials.car-list', compact('carsPaginator'))->render();
        }

        $brands = Brand::withCount(['cars' => fn($q) => $q->where('is_available', true)])->get();
        $categories = Car::where('is_available', true)
            ->select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->get()
            ->map(fn($item) => [
                'name'  => $item->category,
                'label' => ucfirst(str_replace('_', ' ', $item->category)),
                'count' => $item->count
            ]);
        $locations = Location::all();
        $minPriceInDb = Car::min('price_per_day') ?? 0;
        $maxPriceInDb = Car::max('price_per_day') ?? 500;

        return view('cars.index', compact('carsPaginator', 'brands', 'categories', 'locations', 'minPriceInDb', 'maxPriceInDb'));
    }

    /**
     * Display the specified car.
     */
    public function show($id)
    {
        $car = Car::with(['brand', 'location'])->findOrFail($id);

        // Fixed syntax error here: removed extra quote and slash
        $images = $car->images && is_array($car->images)
            ? array_map(fn($img) => asset('storage/' . $img), $car->images)
            : [];

        $thumbnails = $images;

        $specs = [
            ['icon' => 'doors',        'text' => $car->number_of_doors . ' Doors'],
            ['icon' => 'transmission', 'text' => ucfirst($car->transmission)],
            ['icon' => 'seats',        'text' => $car->number_of_seats . ' Seats'],
            ['icon' => 'fuel',         'text' => ucfirst($car->fuel_type)],
        ];

        $timeOptions = [];
        $start = Carbon::parse('00:00');
        for ($i = 0; $i < 48; $i++) {
             $timeOptions[] = $start->format('H:i');
             $start->addMinutes(30);
        }

        // --- NEW UNAVAILABLE LOGIC ---
        // Get all future, non-canceled reservations for this car
        $allReservations = \App\Models\Reservation::where('car_id', $car->id)
            ->where('status', '!=', 'canceled')
            ->where('end_datetime', '>=', now())
            ->orderBy('start_datetime')
            ->get();

        $fullyBookedSlots = [];

        // Get all "event" points (starts and ends)
        $events = [];
        foreach ($allReservations as $res) {
            // We use timestamps for easy sorting
            $events[] = ['time' => $res->start_datetime->timestamp, 'type' => 'start'];
            $events[] = ['time' => $res->end_datetime->timestamp, 'type' => 'end'];
        }

        // Sort events chronologically
        usort($events, fn($a, $b) => $a['time'] - $b['time']);

        $concurrentBookings = 0;
        $fullyBookedStart = null;
        $carQuantity = (int)$car->quantity;

        foreach ($events as $event) {
            $eventTime = $event['time'];

            if ($event['type'] == 'start') {
                $concurrentBookings++;
                // If we JUST hit the car's limit, start an "unavailable" block
                if ($concurrentBookings === $carQuantity && $fullyBookedStart === null) {
                    $fullyBookedStart = $eventTime;
                }
            } else { // 'end' event
                // If we were fully booked, and now a car is returned (dropping us below the limit)
                if ($concurrentBookings === $carQuantity && $fullyBookedStart !== null) {
                    // End the unavailable block, ensuring start is not same as end
                    if($fullyBookedStart < $eventTime) {
                         $fullyBookedSlots[] = [
                            'start' => Carbon::createFromTimestamp($fullyBookedStart)->format('Y-m-d H:i'),
                            'end'   => Carbon::createFromTimestamp($eventTime)->format('Y-m-d H:i'),
                        ];
                    }
                    $fullyBookedStart = null;
                }
                $concurrentBookings--;
            }
        }

        // If the loop ends while still fully booked (e.g., reservations extend past our loop)
        if ($fullyBookedStart !== null) {
             $fullyBookedSlots[] = [
                 'start' => Carbon::createFromTimestamp($fullyBookedStart)->format('Y-m-d H:i'),
                 // Block for a reasonable future (e.g., 1 year)
                 'end'   => Carbon::now()->addYear()->format('Y-m-d H:i'),
             ];
        }

        // This now only contains time ranges where ALL cars of this model are busy.
        $unavailable = $fullyBookedSlots;

        $locations = Location::all();

        return view('cars.show', compact('car', 'locations', 'images', 'thumbnails', 'specs', 'timeOptions', 'unavailable'));
    }
}