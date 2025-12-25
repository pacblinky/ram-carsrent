<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        // Fetch all locations to display on the page
        $locations = Location::all();
        
        // Pass locations and the authenticated user (if any) to the view
        return view('contact.index', [
            'locations' => $locations,
            'user' => Auth::user()
        ]);
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Send email to support
        // Using Mail::raw for simplicity. You can create a Mailable class for more complex templates.
        Mail::raw(
            "Name: {$validated['name']}\n" .
            "Email: {$validated['email']}\n\n" .
            "Message:\n{$validated['message']}",
            function ($message) use ($validated) {
                $message->to('support@ramco.com.sa')
                        ->replyTo($validated['email'], $validated['name'])
                        ->subject('Contact Form: ' . $validated['subject']);
            }
        );

        // Redirect back with a success message
        return Redirect::route('contact.index')
            ->with('success_message_key', 'contact.message_sent_details');
    }
}