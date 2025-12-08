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
        
        // NEW: Search by Name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Availability Filter (Implicitly handled by passing datetime if available, but not used as an availability filter here)
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
                    AND reservations.status = ?
                    AND reservations.start_datetime < ?
                    AND reservations.end_datetime > ?
                ) < cars.quantity', [
                    'confirmed', // Check only 'confirmed' status
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

        // NEW FILTERS ADDED (from previous steps)
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }
        if ($request->filled('seats')) {
            $query->where('number_of_seats', $request->seats);
        }
        // NEW FILTER: Number of Doors
        if ($request->filled('doors')) {
            $query->where('number_of_doors', $request->doors);
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
                    'specs'    => [
                        // Updated to use doors
                        ['icon' => 'doors',        'text' => $car->number_of_doors ? __('cars_page.feat_doors', ['count' => $car->number_of_doors]) : 'N/A'],
                        ['icon' => 'transmission', 'text' => __('cars_page.feat_transmission_' . $car->transmission)],
                        ['icon' => 'seats',        'text' => __('cars_page.feat_seats', ['count' => $car->number_of_seats])],
                        ['icon' => 'fuel',         'text' => __('cars_page.feat_fuel_' . $car->fuel_type)],
                    ],
                ];
            })
        );

        if ($request->ajax()) {
            return view('cars.partials.car-list', compact('carsPaginator'))->render();
        }

        // Fetching common variables
        $locations = Location::all();
        $minPriceInDb = Car::min('price_per_day') ?? 0;
        $maxPriceInDb = Car::max('price_per_day') ?? 500;
        
        // Fetch Filter options for Brand and Category
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

        // Fetch filter options for specs (fuel, transmission, seats, doors)
        $fuelTypes = Car::where('is_available', true)
            ->select('fuel_type', DB::raw('count(*) as count'))
            ->groupBy('fuel_type')
            ->get()
            ->map(fn($item) => [
                'name'  => $item->fuel_type,
                'label' => __('cars_page.feat_fuel_' . $item->fuel_type),
                'count' => $item->count
            ]);

        $transmissions = Car::where('is_available', true)
            ->select('transmission', DB::raw('count(*) as count'))
            ->groupBy('transmission')
            ->get()
            ->map(fn($item) => [
                'name'  => $item->transmission,
                'label' => __('cars_page.feat_transmission_' . $item->transmission),
                'count' => $item->count
            ]);
            
        $seats = Car::where('is_available', true)
            ->select('number_of_seats', DB::raw('count(*) as count'))
            ->groupBy('number_of_seats')
            ->orderBy('number_of_seats', 'asc')
            ->get()
            ->map(fn($item) => [
                'name'  => $item->number_of_seats,
                'label' => $item->number_of_seats . ' ' . __('cars_page.seats'),
                'count' => $item->count
            ]);
            
        // NEW: Fetch filter options for Number of Doors
        $doors = Car::where('is_available', true)
            ->select('number_of_doors', DB::raw('count(*) as count'))
            ->groupBy('number_of_doors')
            ->orderBy('number_of_doors', 'asc')
            ->get()
            ->map(fn($item) => [
                'name'  => $item->number_of_doors,
                'label' => $item->number_of_doors . ' ' . __('cars_page.doors'),
                'count' => $item->count
            ]);

        return view('cars.index', compact('carsPaginator', 'brands', 'categories', 'locations', 'minPriceInDb', 'maxPriceInDb', 'fuelTypes', 'transmissions', 'seats', 'doors'));
    }

    /**
     * Display the specified car.
     */
    public function show($id)
    {
        $car = Car::with(['brand', 'location'])->findOrFail($id);

        $images = $car->images && is_array($car->images)
            ? array_map(fn($img) => asset('storage/' . $img), $car->images)
            : [];

        $thumbnails = $images;

        $specs = [
            ['icon' => 'doors', 'text' => __('cars_page.feat_doors', ['count' => $car->number_of_doors])],
            ['icon' => 'transmission', 'text' => __('cars_page.feat_transmission_' . $car->transmission)],
            ['icon' => 'seats', 'text' => __('cars_page.feat_seats', ['count' => $car->number_of_seats])],
            ['icon' => 'fuel', 'text' => __('cars_page.feat_fuel_' . $car->fuel_type)],
        ];

        $timeOptions = [];
        $start = Carbon::parse('00:00');
        for ($i = 0; $i < 48; $i++) {
             $timeOptions[] = $start->format('H:i');
             $start->addMinutes(30);
        }

        // --- NEW UNAVAILABLE LOGIC ---
        // Get all future, confirmed reservations for this car
        $allReservations = \App\Models\Reservation::where('car_id', $car->id)
            ->where('status', 'confirmed') // Check only 'confirmed' status
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