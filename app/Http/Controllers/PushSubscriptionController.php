<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WelcomeNotification;

class PushSubscriptionController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'endpoint' => 'required',
            'keys.auth' => 'required',
            'keys.p256dh' => 'required',
        ]);

        $user = Auth::user();

        $user->updatePushSubscription(
            $request->endpoint,
            $request->input('keys.p256dh'),
            $request->input('keys.auth')
        );

        // Send the welcome notification
        $user->notify(new WelcomeNotification()); //

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $request->validate(['endpoint' => 'required']);

        Auth::user()->deletePushSubscription($request->endpoint);

        return response()->json(['success' => true]);
    }
}