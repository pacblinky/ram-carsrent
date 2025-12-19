<?php

namespace App\Helpers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\Messaging\NotFound; // <--- Import this exception
use Kreait\Firebase\Exception\Messaging\InvalidMessage; // <--- Optional: Import for malformed tokens
use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 * Send a push notification to a specific user.
 *
 * @param User $user The user model (must have fcm_token)
 * @param string $title The title of the notification
 * @param string $body The body text of the notification
 */
function sendPushNotification(User $user, string $title, string $body)
{
    // Check for the FCM token
    if (!$user->fcm_token) {
        Log::info("User {$user->id} does not have an FCM token. Skipping notification.");
        return;
    }

    // Get the path to your service account credentials
    $serviceAccountPath = config('services.firebase.credentials.file');

    if (!$serviceAccountPath || !file_exists($serviceAccountPath)) {
        Log::error('Firebase service account file not found. Check config/services.php');
        return;
    }

    try {
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);
        $messaging = $factory->createMessaging();

        $message = CloudMessage::new()->toToken($user->fcm_token)
            ->withNotification(Notification::create($title, $body));
            
        $messaging->send($message);

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