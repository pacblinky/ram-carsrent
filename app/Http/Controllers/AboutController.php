<?php

namespace App\Http\Controllers;
use App\Models\Location;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $locations = Location::all();
        return view('about.index', compact('locations'));
    }
}