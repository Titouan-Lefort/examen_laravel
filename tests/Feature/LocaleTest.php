<?php

use App\Models\User;
use Illuminate\Support\Facades\Session;

test('locale switch updates session', function () {
    $response = $this->get(route('locale.switch', ['locale' => 'en']));

    $response->assertRedirect();
    expect(Session::get('locale'))->toBe('en');

    $response = $this->get(route('locale.switch', ['locale' => 'fr']));
    expect(Session::get('locale'))->toBe('fr');
});

test('locale switch updates authenticated user', function () {
    $user = User::factory()->create(['locale' => 'fr']);
    $this->actingAs($user);

    $response = $this->get(route('locale.switch', ['locale' => 'en']));

    $response->assertRedirect();
    expect($user->fresh()->locale)->toBe('en');
});

test('login loads locale from user', function () {
    $user = User::factory()->create(['locale' => 'en']);

    // Simulate login by acting as user and hitting a route protected by SetLocale middleware
    // We need to ensure session is empty of locale first
    Session::forget('locale');

    $this->actingAs($user)
        ->get(route('index')); // Assuming 'index' uses the middleware

    expect(Session::get('locale'))->toBe('en');
});

test('login does not overwrite session locale if already set', function () {
    $user = User::factory()->create(['locale' => 'en']);

    Session::put('locale', 'fr');

    $this->actingAs($user)
        ->get(route('index'));

    expect(Session::get('locale'))->toBe('fr');
});
