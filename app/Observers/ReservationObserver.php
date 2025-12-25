<?php

namespace App\Observers;

use App\Models\Reservation;
use App\Enums\ReservationStatus; // Import your Enum
use App\Notifications\NewReservationAdminAlert;
use App\Notifications\ReservationStatusUpdate;
use App\Notifications\ReservationCancelledAdminAlert;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class ReservationObserver
{
    public $afterCommit = true;

    public function created(Reservation $reservation): void
    {
        Notification::route('mail', 'reservations@ramco.com.sa')
            ->notify(new NewReservationAdminAlert($reservation));
    }

    public function updated(Reservation $reservation): void
    {
        // 1. Check if status changed
        if ($reservation->wasChanged('status')) {
            
            // 2. Handle Enum Comparisons
            // We check if the status is Confirmed or Cancelled
            // Assuming your Enum cases are named 'Confirmed' and 'Cancelled'
            $isConfirmed = $reservation->status === ReservationStatus::Confirmed;
            $isCancelled = $reservation->status === ReservationStatus::Canceled;

            if ($isConfirmed || $isCancelled) {
                
                // --- Determine Actor ---
                $actor = 'system';
                $currentUser = Auth::user();

                if ($currentUser) {
                    if ($currentUser->id === $reservation->user_id) {
                        $actor = 'user';
                    } elseif ($currentUser->is_admin) { // Used 'is_admin' from your User model
                        $actor = 'admin';
                    }
                }

                // --- A. Notify Customer ---
                if ($reservation->user) {
                    $reservation->user->notify(
                        new ReservationStatusUpdate($reservation, $actor)
                    );
                }

                // --- B. Notify Admin (If User Cancelled) ---
                if ($isCancelled && $actor === 'user') {
                    Notification::route('mail', 'reservations@ramco.com.sa')
                        ->notify(new ReservationCancelledAdminAlert($reservation));
                }
            }
        }
    }
}