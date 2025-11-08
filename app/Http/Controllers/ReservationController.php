<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use App\Enums\ReservationStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // Show all reservations for the current user
    public function index(Request $request)
    {
        $reservations = Reservation::with(['car.brand', 'pickup', 'dropoff'])
            ->where('user_id', $request->user()->id)
            ->latest('created_at') // Show newest bookings first
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    // Store a new reservation
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

        $start = Carbon::parse("{$validated['start_date']} {$validated['start_time']}");
        $end   = Carbon::parse("{$validated['end_date']} {$validated['end_time']}");

        if ($start->gte($end)) {
             return back()->withErrors(['end_time' => 'End time must be after start time.'])->withInput();
        }

        if (!$car->is_available) {
             return back()->withErrors(['unavailable' => 'This vehicle is currently unavailable.'])->withInput();
        }

        // Check for overlaps
        $conflictingReservations = Reservation::where('car_id', $car->id)
            ->where('status', '!=', 'canceled')
            ->where(function ($query) use ($start, $end) {
                $query->where('start_datetime', '<', $end)
                      ->where('end_datetime', '>', $start);
            })
            ->count();

        if ($conflictingReservations >= (int)$car->quantity) {
            return back()->withErrors([
                'unavailable' => "Sorry, this car is fully booked for the selected dates."
            ])->withInput();
        }

        Reservation::create([
            'user_id'             => auth()->id(),
            'car_id'              => $car->id,
            'pickup_location_id'  => $validated['pickup_location_id'],
            'dropoff_location_id' => $validated['dropoff_location_id'],
            'start_datetime'      => $start,
            'end_datetime'        => $end,
            'status'              => 'pending',
        ]);

        // Redirect to the new reservations index page with a success message
        return redirect()->route('reservations.index')
            ->with('success', __('reservations.reservation_created_success'));
    }

    // Cancel a reservation
    public function cancel(Request $request, Reservation $reservation)
    {
        // Ensure the user owns this reservation
        if ($request->user()->id !== $reservation->user_id) {
            abort(403);
        }

        // Only allow cancellation if it hasn't started yet and isn't already completed/cancelled
        if ($reservation->start_datetime->isPast()) {
            return back()->with('error', 'Cannot cancel a reservation that has already started.');
        }
        
        if (in_array($reservation->status->value, ['completed', 'canceled'])) {
             return back()->with('error', 'This reservation cannot be canceled.');
        }

        $reservation->update(['status' => 'canceled']);

        return back()->with('success', 'Reservation canceled successfully.');
    }
}