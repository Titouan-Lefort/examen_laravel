<?php

use App\Models\User;

test('authenticated user can visit home page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('index'))
        ->assertOk();
});

test('guest is redirected to login', function () {
    $this->get(route('index'))
        ->assertRedirect(route('login'));
});
