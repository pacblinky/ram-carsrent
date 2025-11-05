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
                'id' => 1, // Added ID
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
                'id' => 2, // Added ID
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

    public function show($id)
    {
        // In a real app, you would find the car by its ID from the database
        // e.g., $car = Car::findOrFail($id);
        
        // Or find from your dummy array:
        // $allCars = [ ... list of all cars ... ];
        // $car = collect($allCars)->firstWhere('id', $id);
        // if (!$car) { abort(404); }

        // For this example, we'll just return one hardcoded car.
        $car = [
            'id' => $id, // Use the passed-in ID
            'name' => 'Honda Accord Sport 2.0T 2024',
            'location' => '95160 Stewart Walk, Toronto, Ontario, Canada',
            'price_per_day' => 81,
            'images' => [
                'https://images.unsplash.com/photo-1541348263662-e56a7c3931ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                'httpsKE://images.unsplash.com/photo-1517524008697-84bbe3c3ea9f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1964&q=80',
                'https://images.unsplash.com/photo-1616789916743-410c7a5796b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                'https://images.unsplash.com/photo-1556154240-3a5e86d11d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
                'httpsS://images.unsplash.com/photo-1511919884226-c37f60ec1066?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1964&q=80',
            ],
            'thumbnails' => [
                'https://images.unsplash.com/photo-1541348263662-e56a7c3931ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'https://images.unsplash.com/photo-1517524008697-84bbe3c3ea9f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'https://images.unsplash.com/photo-1616789916743-410c7a5796b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'https://images.unsplash.com/photo-1556154240-3a5e86d11d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'httpsKE://images.unsplash.com/photo-1511919884226-c37f60ec1066?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
            ],
            'specs' => [
                ['icon' => 'electric', 'text' => 'Electric'],
                ['icon' => 'manual', 'text' => 'Manual'],
                ['icon' => 'seats', 'text' => '4 Seats'],
                ['icon' => 'coupe', 'text' => 'Coupe'],
                ['icon' => 'doors', 'text' => '5 Doors'],
            ],
            'time_options' => [
                '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00',
                '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
                '16:00', '16:30', '17:00',
            ],
        ];

        return view('cars.show', compact('car'));
    }
}