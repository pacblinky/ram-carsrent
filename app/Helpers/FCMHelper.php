<?php

namespace App\Helpers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use App\Models\User;
use Illuminate\Support\Facades\Log;

function sendPushNotification(User $user, string $title, string $body)
{
    if (!$user->fcm_token) {
        Log::info("User {$user->id} does not have an FCM token. Skipping notification.");
        return;
    }

    $serviceAccountPath = config('services.firebase.credentials.file');

    if (!$serviceAccountPath || !file_exists($serviceAccountPath)) {
        Log::error('Firebase service account file not found. Check config/services.php');
        return;
    }

    try {
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);
        $messaging = $factory->createMessaging();

        $dataPayload = [
            'title' => $title,
            'body'  => $body,
            'icon'  => '/favicon-96x96.png',
        ];
        
        $message = CloudMessage::new()
            ->toToken($user->fcm_token)
            ->withNotification(Notification::create($title, $body))
            ->withData($dataPayload); // <--- THIS IS THE FIX
            
        $messaging->send($message);
        
        Log::info("Notification sent to user {$user->id}: {$title}");

    } catch (NotFound $e) {
        Log::info("FCM Token invalid/not found for user {$user->id}. Removing token from DB.");
        $user->fcm_token = null;
        $user->save();
    } catch (InvalidMessage $e) {
        Log::warning("FCM Token malformed for user {$user->id}. Removing token.");
        $user->fcm_token = null;
        $user->save();
    } catch (\Exception $e) {
        Log::error("Failed to send FCM notification to user {$user->id}: " . $e->getMessage());
    }
}