<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use function App\Helpers\sendPushNotification; 

class FCMController extends Controller
{
    /**
     * Saves the FCM token and sends a welcome notification ONLY if the token is new or changed.
     */
    public function saveTokenAndSendWelcome(Request $request)
    {
        // 1. Validate the request (token is mandatory)
        $request->validate([
            'token' => 'required|string',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $newToken = $request->token;
        $currentToken = $user->fcm_token;

        // Check if the received token is different from the one currently stored.
        // This handles both:
        // 1. New registration ($currentToken is null)
        // 2. Token refresh ($currentToken is different from $newToken)
        if ($currentToken !== $newToken) {
            
            // 2. Save the new token to the user model
            $user->fcm_token = $newToken;
            $user->save();

            // 3. Send the welcome notification only after saving the new token
            // We use this check to ensure the notification is NOT sent on every page load
            if (empty($currentToken)) {
                sendPushNotification(
                    $user, 
                    __('Notification Enabled!'), 
                    __('You will now receive important updates from Ram Car Rental.')
                );
            }
            // If the token was just refreshed (not empty, but changed), we typically skip 
            // the welcome message to avoid spamming the user.
        }

        return response()->json(['message' => 'FCM token checked and saved successfully.'], 200);
    }
}