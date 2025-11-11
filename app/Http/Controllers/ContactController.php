<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MapEmbed; // <-- 1. CHANGE THIS (was Setting)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        // This one variable has all the data we need
        $contactItems = MapEmbed::where('page', 'contact')
                                ->orderBy('sort_order', 'asc')
                                ->get();
        
        // Pass the new variable to the view
        return view('contact.index', [
            'user' => Auth::user(),
            'contactItems' => $contactItems // <-- This is the new variable
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

        // ---
        // In a real application, you would send an email here.
        // Example:
        // Mail::to('admin@example.com')->send(new ContactFormMail($validated));
        // ---

        // For this example, we'll just redirect back with a success message.
        return Redirect::route('contact.index')
            ->with('success_message_key', 'contact.message_sent_details');
    }
}