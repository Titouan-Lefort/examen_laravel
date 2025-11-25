<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SpectacleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');


    Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->name('reservation.my');
    Route::resource('reservation', ReservationController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('salle', SalleController::class);
        Route::resource('spectacle', SpectacleController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
