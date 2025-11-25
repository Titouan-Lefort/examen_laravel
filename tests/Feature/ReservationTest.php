<?php

use App\Models\Reservation;
use App\Models\Salle;
use App\Models\Spectacle;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->salle = Salle::create([
        'nom_salle' => 'Salle Reservation',
        'capacite' => 50,
        'adresse' => 'Address',
    ]);

    $this->spectacle = Spectacle::create([
        'salle_id' => $this->salle->id,
        'date_spectacle' => now()->addDays(5),
        'heure_spectacle' => '20:00',
        'prix' => 20,
    ]);
});

test('user can view available spectacles', function () {
    $this->actingAs($this->user)
        ->get(route('reservation.index'))
        ->assertOk();
});

test('user can view reservation form for a spectacle', function () {
    $this->actingAs($this->user)
        ->get(route('reservation.show', $this->spectacle->id))
        ->assertOk();
});

test('user can make a reservation', function () {
    $this->actingAs($this->user)
        ->post(route('reservation.store'), [
            'spectacle_id' => $this->spectacle->id,
            'nombre_personnes' => 2,
        ])
        ->assertRedirect(route('reservation.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('reservation', [
        'spectacle_id' => $this->spectacle->id,
        'user_id' => $this->user->id,
        'nombre_personnes' => 2,
    ]);
});

test('user cannot reserve more seats than capacity', function () {
    $this->actingAs($this->user)
        ->post(route('reservation.store'), [
            'spectacle_id' => $this->spectacle->id,
            'nombre_personnes' => 60, // Capacity is 50
        ])
        ->assertSessionHasErrors('nombre_personnes');
});

test('user can view their reservations', function () {
    Reservation::create([
        'numero_reservation' => 'RES-TEST',
        'spectacle_id' => $this->spectacle->id,
        'user_id' => $this->user->id,
        'nombre_personnes' => 2,
    ]);

    $this->actingAs($this->user)
        ->get(route('reservation.my'))
        ->assertOk()
        ->assertSee('Salle Reservation');
});

test('user can edit their reservation', function () {
    $reservation = Reservation::create([
        'numero_reservation' => 'RES-EDIT',
        'spectacle_id' => $this->spectacle->id,
        'user_id' => $this->user->id,
        'nombre_personnes' => 2,
    ]);

    $this->actingAs($this->user)
        ->get(route('reservation.edit', $reservation->id))
        ->assertOk();

    $this->actingAs($this->user)
        ->put(route('reservation.update', $reservation->id), [
            'nombre_personnes' => 3,
        ])
        ->assertRedirect(route('reservation.my'));

    $this->assertDatabaseHas('reservation', [
        'id' => $reservation->id,
        'nombre_personnes' => 3,
    ]);
});

test('user can cancel their reservation', function () {
    $reservation = Reservation::create([
        'numero_reservation' => 'RES-DEL',
        'spectacle_id' => $this->spectacle->id,
        'user_id' => $this->user->id,
        'nombre_personnes' => 2,
    ]);

    $this->actingAs($this->user)
        ->delete(route('reservation.destroy', $reservation->id))
        ->assertRedirect(route('reservation.my'));

    $this->assertDatabaseMissing('reservation', [
        'id' => $reservation->id,
    ]);
});
