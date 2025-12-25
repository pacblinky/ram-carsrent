<?php

namespace App\Notifications;

use App\Models\Reservation;
use App\Enums\ReservationStatus; // Import Enum
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationStatusUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Reservation $reservation,
        public string $actorRole = 'system'
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        // Get string value from Enum if necessary, or just capitalize the name
        $statusLabel = ucfirst($this->reservation->status->name ?? $this->reservation->status->value);

        $message = (new MailMessage)
            ->subject("Update: Reservation #{$this->reservation->id} is {$statusLabel}")
            ->greeting("Hello {$notifiable->name},");

        // ENUM COMPARISON
        if ($this->reservation->status === ReservationStatus::Canceled) {
            $message->error();
            if ($this->actorRole === 'admin') {
                $message->line('Your reservation was cancelled by the administrator.');
            } else {
                $message->line('You have successfully cancelled your reservation.');
            }
        } elseif ($this->reservation->status === ReservationStatus::Confirmed) {
            $message->success();
            $message->line('Great news! Your reservation is confirmed.');
        }

        return $message
            ->line('**Car:** ' . $this->reservation->car->name)
            // Fixed Date Variables
            ->line('**Dates:** ' . $this->reservation->start_datetime->format('Y-m-d') . ' to ' . $this->reservation->end_datetime->format('Y-m-d'))
            ->action('View Details', url('/reservations'));
    }
}