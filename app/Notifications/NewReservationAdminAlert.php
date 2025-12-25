<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReservationAdminAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Reservation $reservation) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Booking #' . $this->reservation->id)
            ->greeting('Hello Admin Team,')
            ->line('A new reservation has been placed on the website.')
            
            // CORRECTED VARIABLES HERE:
            ->line('**Customer:** ' . ($this->reservation->user->name ?? 'Guest'))
            ->line('**Email:** ' . ($this->reservation->user->email ?? 'N/A'))
            ->line('**Phone:** ' . ($this->reservation->user->phone_number ?? 'N/A')) // Fixed
            
            ->line('---')
            
            ->line('**Car:** ' . $this->reservation->car->name)
            // Fixed Date Variables
            ->line('**Start:** ' . $this->reservation->start_datetime->format('Y-m-d H:i'))
            ->line('**End:** ' . $this->reservation->end_datetime->format('Y-m-d H:i'))
            ->line('**Total Price:** ' . $this->reservation->total_price)
            ->action('View in Admin Panel', url('/admin/reservations/' . $this->reservation->id));
    }
}