<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

function sendPushNotification($user, $title, $body)
{
    if (!$user->fcm_token) return;

    $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials.file'));
    $messaging = $factory->createMessaging();

    $message = CloudMessage::new()->toToken($user->fcm_token)->withNotification(Notification::create($title, $body));

    try {
            $messaging->send($message);
        } 
        catch (\Exception $e) {
            ;
        }
}
