<?php

namespace App\Notifications;

use App\Models\Reservation;
use App\Enums\ReservationStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class ReservationStatusUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Reservation $reservation,
        public string $actorRole = 'system'
    ) {}

    public function via(object $notifiable): array
    {
        $channels = ['mail'];
        
        $isCancelledByUser = $this->reservation->status === ReservationStatus::Canceled 
            && $this->actorRole === 'user';

        if (! $isCancelledByUser) {
            $channels[] = WebPushChannel::class;
        }

        return $channels;
    }

    public function toMail(object $notifiable): MailMessage
    {
        $statusLabel = ucfirst($this->reservation->status->name ?? $this->reservation->status->value);

        $message = (new MailMessage)
            ->subject("Update: Reservation #{$this->reservation->id} is {$statusLabel}")
            ->greeting("Hello {$notifiable->name},");

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
            ->line('**Dates:** ' . $this->reservation->start_datetime->format('Y-m-d') . ' to ' . $this->reservation->end_datetime->format('Y-m-d'))
            ->action('View Details', url('/reservations'));
    }

    public function toWebPush($notifiable, $notification)
    {
        $statusLabel = ucfirst($this->reservation->status->name ?? $this->reservation->status->value);
        
        $body = "Your reservation #{$this->reservation->id} status has been updated to {$statusLabel}.";

        if ($this->reservation->status === ReservationStatus::Canceled) {
            if ($this->actorRole === 'admin') {
                $body = "Your reservation #{$this->reservation->id} was cancelled by the administrator.";
            }
            // No need for 'else' case here since push is suppressed for user cancellation
        } elseif ($this->reservation->status === ReservationStatus::Confirmed) {
            $body = "Great news! Your reservation #{$this->reservation->id} is confirmed.";
        }

        return (new WebPushMessage)
            ->title('Reservation Update')
            ->icon('/images/logo.png')
            ->body($body)
            ->action('View Details', 'view_details')
            ->data(['url' => url('/reservations')]);
    }
}