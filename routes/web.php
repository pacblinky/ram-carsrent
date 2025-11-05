<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    $featuredVehicles = [
        [
            'name' => 'Mercedes-Benz E-Class',
            'price' => 60.00,
            'image' => 'https://via.placeholder.com/600x400.png/E0E0E0/333333?text=Mercedes',
            'rating' => 4
        ],
        [
            'name' => 'Tesla Model S',
            'price' => 80.00,
            'image' => 'https://via.placeholder.com/600x400.png/E0E0E0/333333?text=Tesla',
            'rating' => 5
        ],
        [
            'name' => 'Range Rover Velar',
            'price' => 90.00,
            'image' => 'https://via.placeholder.com/600x400.png/E0E0E0/333333?text=Range+Rover',
            'rating' => 5
        ],
    ];

    // NEW: Data for Most Viewed Vehicles
    $mostViewedVehicles = [
        [
            'name' => 'Mercedes-Benz C300 4MATIC 2024',
            'image' => 'https://images.unsplash.com/photo-1616421312328-9b8e243d465d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
            'rating' => 2.5,
            'reviews' => 2,
            'specs' => [
                ['icon' => 'mileage', 'text' => '5,569 miles'],
                ['icon' => 'transmission', 'text' => 'Manual'],
                ['icon' => 'fuel', 'text' => 'Electric'],
                ['icon' => 'seats', 'text' => '5 seats'],
            ],
            'price' => 55,
        ],
        [
            'name' => 'BMW 330i xDrive M Sport 2024',
            'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'rating' => 5.0,
            'reviews' => 10,
            'specs' => [
                ['icon' => 'mileage', 'text' => '8,667 miles'],
                ['icon' => 'transmission', 'text' => 'Automatic'],
                ['icon' => 'fuel', 'text' => 'Electric'],
                ['icon' => 'seats', 'text' => '5 seats'],
            ],
            'price' => 34,
        ],
        [
            'name' => 'Lexus ES 350 F Sport 2024',
            'image' => 'https://images.unsplash.com/photo-1604131650379-055f6b2c80c1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
            'rating' => 4.0,
            'reviews' => 2,
            'specs' => [
                ['icon' => 'mileage', 'text' => '18,140 miles'],
                ['icon' => 'transmission', 'text' => 'Automatic'],
                ['icon' => 'fuel', 'text' => 'Gasoline'],
                ['icon' => 'seats', 'text' => '5 seats'],
            ],
            'price' => 93,
        ],
    ];
    return view('welcome', compact('featuredVehicles', 'mostViewedVehicles'));
});

Route::get('/locale/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        $locale = 'en';
    }
    Session::put('locale', $locale);
    App::setLocale($locale);
    return Redirect::back();
})->name('locale.switch');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
