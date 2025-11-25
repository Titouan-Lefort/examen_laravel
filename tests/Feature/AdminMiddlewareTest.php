<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Silber\Bouncer\BouncerFacade as Bouncer;

test('admin can access admin route', function () {
    $user = User::factory()->create();
    Bouncer::assign('admin')->to($user);

    Route::get('/admin-test', function () {
        return 'OK';
    })->middleware('admin');

    $this->actingAs($user)
        ->get('/admin-test')
        ->assertOk();
});

test('non-admin cannot access admin route', function () {
    $user = User::factory()->create();

    Route::get('/admin-test', function () {
        return 'OK';
    })->middleware('admin');

    $this->actingAs($user)
        ->get('/admin-test')
        ->assertRedirect(route('index'));
});
