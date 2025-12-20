<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Notifications Enabled! 🎉')
            ->body('You will now receive updates about your car rentals directly to your device.')
            ->icon('/favicon-96x96.png') // Ensure this path matches your public icon
            ->action('View Profile', 'view_profile')
            ->data(['url' => route('profile.edit')]); // Action click URL
    }
}