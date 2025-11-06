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

        // --- FILTERS ---
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('pickup_datetime') && $request->filled('dropoff_datetime')) {
            try {
                $start = Carbon::parse($request->pickup_datetime);
                $end = Carbon::parse($request->dropoff_datetime);

                $query->whereDoesntHave('reservations', function ($q) use ($start, $end) {
                    $q->where('status', '!=', 'canceled')
                      ->where(function ($subQ) use ($start, $end) {
                          $subQ->whereBetween('start_datetime', [$start, $end])
                               ->orWhereBetween('end_datetime', [$start, $end])
                               ->orWhere(function ($overlap) use ($start, $end) {
                                   $overlap->where('start_datetime', '<=', $start)
                                           ->where('end_datetime', '>=', $end);
                               });
                      });
                });
            } catch (\Exception $e) { }
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

        // --- SORTING ---
        match ($request->input('sort', 'newest')) {
            'price_asc'  => $query->orderBy('price_per_day', 'asc'),
            'price_desc' => $query->orderBy('price_per_day', 'desc'),
            default      => $query->latest(),
        };

        // --- PAGINATION ---
        $carsPaginator = $query->paginate($request->input('per_page', 10))->withQueryString();

        // Transform items for view
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

        // ✅ AJAX RESPONSE
        if ($request->ajax()) {
            return view('cars.partials.car-list', compact('carsPaginator'))->render();
        }

        // ✅ FULL PAGE RESPONSE
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

    public function show($id)
    {
         // ... (Keep your show method as is) ...
         $car = Car::with(['brand', 'location'])->findOrFail($id);
         // ... rest of show method ...
         // (Included for completeness based on previous prompt, ensure you have the full method here)
          $images = $car->images && is_array($car->images) ? array_map(fn($img) => asset('storage/' . $img), $car->images) : [];
          $thumbnails = $images;
          $specs = [
              ['icon' => 'doors', 'text' => $car->number_of_doors . ' Doors'],
              ['icon' => 'transmission', 'text' => ucfirst($car->transmission)],
              ['icon' => 'seats', 'text' => $car->number_of_seats . ' Seats'],
              ['icon' => 'fuel', 'text' => ucfirst($car->fuel_type)],
          ];
          $timeOptions = [];
          $start = Carbon::parse('00:00');
          for ($i = 0; $i < 48; $i++) { $timeOptions[] = $start->format('H:i'); $start->addMinutes(30); }
          $unavailable = \App\Models\Reservation::where('car_id', $car->id)->where('status', '!=', 'canceled')->where('end_datetime', '>=', now())->get()->map(fn ($r) => ['start' => $r->start_datetime->format('Y-m-d H:i'), 'end' => $r->end_datetime->format('Y-m-d H:i')]);
          $locations = Location::all();
          return view('cars.show', compact('car', 'locations', 'images', 'thumbnails', 'specs', 'timeOptions', 'unavailable'));
    }
}