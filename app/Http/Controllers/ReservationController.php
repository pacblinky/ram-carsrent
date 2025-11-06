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

        $validated = $request->validate([
            'pickup_location_id'  => 'required|exists:locations,id',
            'dropoff_location_id' => 'required|exists:locations,id',
            'start_date'          => 'required|date|after_or_equal:today',
            'start_time'          => 'required',
            'end_date'            => 'required|date|after_or_equal:start_date',
            'end_time'            => 'required',
        ]);

        $requestedStart = Carbon::parse("{$validated['start_date']} {$validated['start_time']}");
        $requestedEnd   = Carbon::parse("{$validated['end_date']} {$validated['end_time']}");

        if ($requestedStart->gte($requestedEnd)) {
             return back()->withErrors(['end_time' => 'End time must be after start time.'])->withInput();
        }

        if (!$car->is_available) {
             return back()->withErrors([
                 'unavailable' => 'This vehicle model is currently unavailable.'
             ])->withInput();
        }

        // 🛑 QUANTITY & OVERLAP CHECK 🛑
        // We count how many VALID reservations overlap with the requested time.
        // Standard Overlap Formula: (StartA < EndB) AND (EndA > StartB)
        $conflictingReservations = Reservation::where('car_id', $car->id)
            ->where('status', '!=', 'canceled')
            ->where(function ($query) use ($requestedStart, $requestedEnd) {
                $query->where('start_datetime', '<', $requestedEnd)
                      ->where('end_datetime', '>', $requestedStart);
            })
            ->count();

        // Debugging: If you still have issues, uncomment the line below and check your laravel.log file
        // \Illuminate\Support\Facades\Log::info("Car {$car->id} | Qty: {$car->quantity} | Conflicts: {$conflictingReservations} | Req: {$requestedStart} to {$requestedEnd}");

        if ($conflictingReservations >= (int)$car->quantity) {
            return back()->withErrors([
                'unavailable' => "Sorry, all {$car->quantity} cars of this model are fully booked for these dates."
            ])->withInput();
        }

        // ✅ Create reservation
        Reservation::create([
            'user_id'             => auth()->id(),
            'car_id'              => $car->id,
            'pickup_location_id'  => $validated['pickup_location_id'],
            'dropoff_location_id' => $validated['dropoff_location_id'],
            'start_datetime'      => $requestedStart,
            'end_datetime'        => $requestedEnd,
            'status'              => 'pending',
        ]);

        return redirect()->route('cars.show', $carId)
            ->with('success', 'Reservation created successfully!');
    }
}