<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; // Future: You can use this to send emails
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

        // ---
        // In a real application, you would send an email here.
        // Example:
        // Mail::to('admin@example.com')->send(new ContactFormMail($validated));
        // ---

        // For this example, we'll just redirect back with a success message.
        return Redirect::route('contact.index')
            ->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}