<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Models\Destination;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/ajax/popular-destinations', [HomeController::class, 'popularDestinations'])
    ->name('ajax.popular-destinations');

Route::get('/ajax/experience-destinations', [HomeController::class, 'experienceDestinations'])
    ->name('ajax.experience-destinations');

use App\Http\Controllers\DestinationController;

Route::get('/destinations', [DestinationController::class, 'index'])
    ->name('destinations.index');

Route::get('/ajax/destinations', [DestinationController::class, 'ajax'])
    ->name('ajax.destinations');

Route::get('/destinations/{slug}', [DestinationController::class, 'show'])
    ->name('destinations.show');

Route::get('/booking/{slug?}', [BookingController::class, 'create'])
    ->name('booking.create');

Route::post('/bookings', [BookingController::class, 'store'])
    ->name('bookings.store');

Route::get('/bookings', function () {
    return redirect('/booking');
});