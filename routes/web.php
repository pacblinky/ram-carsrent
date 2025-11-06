<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CarsListController;
use App\Http\Controllers\ReservationController;
use App\Models\Car;
use App\Models\Location;
use App\Models\Brand;

// Named the home route 'home' for easier linking in navbar
Route::get('/', function () {
    // 1. Fetch Locations for the Search Form Dropdown
    $locations = Location::all();

    // 2. Fetch Recent Cars from Database (Top 3 latest)
    // We eager load brand and location to avoid N+1 query issues in the view
    $recentCars = Car::with(['brand', 'location'])
        ->where('is_available', true)
        ->latest()
        ->take(3)
        ->get();

    // 3. (Optional) Fetch real brands if you want to replace the hardcoded logos later
    // For now, we'll just pass the recent cars and locations.

    return view('welcome', compact('locations', 'recentCars'));
})->name('home');

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

Route::get('/cars', [CarsListController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarsListController::class, 'show'])->name('cars.show');
Route::post('/cars/{car}/reserve', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');

require __DIR__.'/auth.php';