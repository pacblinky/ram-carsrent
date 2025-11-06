<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function store(Request $request, $carId)
    {
        $car = Car::findOrFail($carId);

        // ✅ Validate user input
        $validated = $request->validate([
            'pickup_location_id'  => 'required|exists:locations,id',
            'dropoff_location_id' => 'required|exists:locations,id',
            'start_date'          => 'required|date',
            'start_time'          => 'required',
            'end_date'            => 'required|date|after_or_equal:start_date',
            'end_time'            => 'required',
        ]);

        // ✅ Convert to Carbon datetime
        $start = Carbon::parse("{$validated['start_date']} {$validated['start_time']}");
        $end   = Carbon::parse("{$validated['end_date']} {$validated['end_time']}");

        // ✅ Validate availability
        /*
        $hasConflict = Reservation::where('car_id', $car->id)
            ->where('status', '!=', 'canceled')
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_datetime', [$start, $end])
                  ->orWhereBetween('end_datetime', [$start, $end])
                  ->orWhere(function ($q2) use ($start, $end) {
                      $q2->where('start_datetime', '<=', $start)
                         ->where('end_datetime', '>=', $end);
                  });
            })
            ->exists();

        if ($hasConflict) {
            return back()->withErrors([
                'unavailable' => 'This car is not available for the selected time range.'
            ])->withInput();
        }
        */

        // ✅ Create reservation
        Reservation::create([
            'user_id'             => auth()->id(),
            'car_id'              => $car->id,
            'pickup_location_id'  => $validated['pickup_location_id'],
            'dropoff_location_id' => $validated['dropoff_location_id'],
            'start_datetime'      => $start,
            'end_datetime'        => $end,
            'status'              => 'pending',
        ]);

        return redirect()->route('cars.show', $carId)
            ->with('success', 'Reservation created successfully!');
    }
}