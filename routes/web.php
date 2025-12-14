<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CarsListController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController; // <-- ADD THIS
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FCMController;
use App\Models\Car;
use App\Models\Location;
use App\Models\Brand;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $locations = Location::all();
    $recentCars = Car::with(['brand', 'location'])
        ->where('is_available', true)
        ->latest()
        ->take(3)
        ->get();
    
    // Fetch all brands from the database
    $brands = Brand::all();

    $videos = Video::where('is_active', true) // Or 'is_active' based on your VideoResource
        ->orderBy('order', 'asc')
        ->get();

    return view('home', compact('locations', 'recentCars', 'brands', 'videos'));
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
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    
    Route::get('/my-reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

Route::get('/cars', [CarsListController::class, 'index'])->name('cars.index');
Route::get('/cars/{id}', [CarsListController::class, 'show'])->name('cars.show');
Route::post('/cars/{car}/reserve', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');

// --- ADD THESE NEW CONTACT ROUTES ---
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// ------------------------------------

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::view('/terms', 'terms.index')->name('terms');
Route::view('/privacy', 'privacy.index')->name('privacy');

Route::post('/save-fcm-token', [FCMController::class, 'saveTokenAndSendWelcome'])->middleware('auth');

Route::get('/sitemap.xml', function () {
    $cars = \App\Models\Car::all(); 
    
    return Response::view('sitemap', compact('cars'))
        ->header('Content-Type', 'text/xml');
});

Route::fallback(function () {
    return redirect()->route('home');
});

require __DIR__.'/auth.php';