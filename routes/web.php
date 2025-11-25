<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SpectacleController;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        Session::put('locale', $locale);
        if (Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->locale = $locale;
            $user->save();
        }
    }

    return redirect()->back();
})->name('locale.switch');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
});

Route::middleware(['auth', IsUser::class])->group(function () {
    Route::resource('reservation', ReservationController::class);
    Route::get('my-reservations', [ReservationController::class, 'myReservations'])->name('reservation.my');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('salle', SalleController::class);
    Route::resource('spectacle', SpectacleController::class);
});

Route::middleware(['auth', IsUser::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
