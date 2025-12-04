<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use App\Models\User;
use App\Enums\ReservationStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Filament\Notifications\Notification; // Imported Notification
use Filament\Notifications\Actions\Action; // Imported Action
use function App\Helpers\sendPushNotification;

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
            'with_driver'         => 'nullable|boolean', // Validation
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

        // Create the reservation and capture the instance
        $reservation = Reservation::create([
            'user_id'             => auth()->id(),
            'car_id'              => $car->id,
            'with_driver'         => $request->has('with_driver'), // Store with_driver
            'pickup_location_id'  => $validated['pickup_location_id'],
            'dropoff_location_id' => $validated['dropoff_location_id'],
            'start_datetime'      => $start,
            'end_datetime'        => $end,
            'status'              => 'pending',
        ]);

        $admins = User::where('is_admin', true)->get();

        // 1. Filament Database Notification for Admin Panel
        Notification::make()
            ->title(__('admin.notifications.new_reservation_title'))
            ->body(__('admin.notifications.new_reservation_body', [
                'id' => $reservation->id, 
                'car' => $car->name
            ]))
            ->success()
            ->actions([
                Action::make('view')
                    ->button()
                    ->label(__('admin.notifications.view_reservation'))
                    ->url(fn () => route('filament.admin.resources.reservations.view', $reservation))
            ])
            ->sendToDatabase($admins);

        // 2. Existing Push Notifications (Firebase/OneSignal etc)
        foreach ($admins as $admin) {
            sendPushNotification(
                $admin,
                'New Reservation Created',
                "A new reservation has been made for {$car->name} from {$start->format('Y-m-d H:i')} to {$end->format('Y-m-d H:i')}."
            );
        }

        // Redirect to the new reservations index page with a success message
        return redirect()->route('reservations.index')
            ->with('success', __('reservations.reservation_created_success'));
    }

    // Cancel a reservation
    public function cancel(Request $request, Reservation $reservation)
    {
        if ($request->user()->id !== $reservation->user_id) {
            abort(403, __('reservations.cancel_unauthorized'));
        }

        if ($reservation->start_datetime->isPast()) {
            return back()->with('error', __('reservations.cancel_already_started'));
        }
        
        if (in_array($reservation->status->value, ['completed', 'canceled'])) {
            return back()->with('error', __('reservations.cancel_wrong_status'));
        }

        $reservation->update(['status' => 'canceled']);

        // Filament Database Notification for Cancellation
        $admins = User::where('is_admin', true)->get();
        
        Notification::make()
            ->title(__('admin.notifications.reservation_canceled_title'))
            ->body(__('admin.notifications.reservation_canceled_body', [
                'id' => $reservation->id,
                'car' => $reservation->car->name
            ]))
            ->warning()
            ->actions([
                Action::make('view')
                    ->button()
                    ->label(__('admin.notifications.view_reservation'))
                    ->url(fn () => route('filament.admin.resources.reservations.view', $reservation))
            ])
            ->sendToDatabase($admins);

        return back()->with('success', __('reservations.cancel_success'));
    }
}