<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use Illuminate\Database\Eloquent\Collection as EloquentCollection; 

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

        $subscription = $user->updatePushSubscription(
            $request->endpoint,
            $request->input('keys.p256dh'),
            $request->input('keys.auth')
        );

        // 2. Create a new EloquentCollection instead of using collect()
        Notification::route(WebPushChannel::class, new EloquentCollection([$subscription]))
            ->notify(new WelcomeNotification());

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $request->validate(['endpoint' => 'required']);

        Auth::user()->deletePushSubscription($request->endpoint);

        return response()->json(['success' => true]);
    }
}