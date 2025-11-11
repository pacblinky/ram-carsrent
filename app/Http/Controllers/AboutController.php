<?php

namespace App\Http\Controllers;

use App\Models\MapEmbed; // Use the correct model

class AboutController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // This is the line that defines the variable
        $aboutItems = MapEmbed::where('page', 'about')
                            ->orderBy('sort_order', 'asc')
                            ->get();

        // This is line 17 (or close to it)
        // We pass the defined variable to the view
        return view('about.index', [
            'aboutItems' => $aboutItems 
        ]);
    }
}