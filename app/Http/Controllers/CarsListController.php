<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarsListController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index()
    {
        // Dummy data for the car list
        $cars = [
            [
                'name' => 'Smart EQ fortwo Prime 2024',
                'image' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80', // Placeholder
                'rating' => 5,
                'reviews' => 1,
                'location' => '1373 Birch Plaza Suite 354, Rome, Lazio, Italy',
                'specs' => [
                    ['icon' => 'mileage', 'text' => '10,509 miles'],
                    ['icon' => 'transmission', 'text' => 'Automatic'],
                    ['icon' => 'seats', 'text' => '5 seats'],
                    ['icon' => 'brand', 'text' => 'Honda'], // Example spec
                ],
                'price' => 91,
            ],
            [
                'name' => 'Range Rover Sport HSE Dynamic 2024',
                'image' => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80', // Placeholder
                'rating' => 4.5,
                'reviews' => 2,
                'location' => '60044 Long Place Suite 745, Miami, Florida, United States',
                'specs' => [
                    ['icon' => 'mileage', 'text' => '3,115 miles'],
                    ['icon' => 'transmission', 'text' => 'Automatic'],
                    ['icon' => 'seats', 'text' => '4 seats'],
                    ['icon' => 'brand', 'text' => 'Honda'], // Example spec
                ],
                'price' => 69,
            ],
        ];

        // Dummy data for filters
        $brands = [
            ['name' => 'Opel', 'count' => 11],
            ['name' => 'Honda', 'count' => 10],
            ['name' => 'Toyota', 'count' => 10],
            ['name' => 'Mercedes', 'count' => 9],
            ['name' => 'Jaguar', 'count' => 8],
        ];

        $categories = [
            ['name' => 'New', 'count' => 24],
            ['name' => 'Sport', 'count' => 22],
            ['name' => 'Maserati', 'count' => 21],
            ['name' => 'Ferrari', 'count' => 17],
        ];

        return view('cars.index', compact('cars', 'brands', 'categories'));
    }
}