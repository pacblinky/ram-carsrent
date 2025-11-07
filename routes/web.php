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

Route::get('/', function () {
    $locations = Location::all();
    $recentCars = Car::with(['brand', 'location'])
        ->where('is_available', true)
        ->latest()
        ->take(3)
        ->get();
    
    // Fetch all brands from the database
    $brands = Brand::all();

    return view('home', compact('locations', 'recentCars', 'brands'));
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

    Route::get('/my-reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

Route::get('/cars', [CarsListController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarsListController::class, 'show'])->name('cars.show');
Route::post('/cars/{car}/reserve', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');

require __DIR__.'/auth.php';