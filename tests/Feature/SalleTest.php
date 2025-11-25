<?php

use App\Models\Salle;
use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;

beforeEach(function () {
    $this->admin = User::factory()->create();
    Bouncer::assign('admin')->to($this->admin);

    $this->user = User::factory()->create();
});

test('admin can view salles list', function () {
    Salle::create([
        'nom_salle' => 'Salle Test',
        'capacite' => 100,
        'adresse' => '123 Rue Test',
    ]);

    $this->actingAs($this->admin)
        ->get(route('salle.index'))
        ->assertOk()
        ->assertSee('Salle Test');
});

test('non-admin cannot view salles list', function () {
    $this->actingAs($this->user)
        ->get(route('salle.index'))
        ->assertRedirect(route('index'));
});

test('admin can view create salle form', function () {
    $this->actingAs($this->admin)
        ->get(route('salle.create'))
        ->assertOk();
});

test('admin can create salle and spectacle', function () {
    $salleData = [
        'nom_salle' => 'New Salle',
        'capacite' => 200,
        'adresse' => '456 Rue New',
        'date_spectacle' => now()->addDays(10)->toDateString(),
        'heure_spectacle' => '20:00',
        'prix' => 50,
    ];

    $this->actingAs($this->admin)
        ->post(route('salle.store'), $salleData)
        ->assertRedirect(route('salle.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('salle', [
        'nom_salle' => 'New Salle',
    ]);

    $this->assertDatabaseHas('spectacles', [
        'prix' => 50,
    ]);
});

test('admin can view salle details', function () {
    $salle = Salle::create([
        'nom_salle' => 'Salle Show',
        'capacite' => 100,
        'adresse' => 'Address',
    ]);

    $this->actingAs($this->admin)
        ->get(route('salle.show', $salle))
        ->assertOk()
        ->assertSee('Salle Show');
});

test('admin can view edit salle form', function () {
    $salle = Salle::create([
        'nom_salle' => 'Salle Edit',
        'capacite' => 100,
        'adresse' => 'Address',
    ]);

    $this->actingAs($this->admin)
        ->get(route('salle.edit', $salle))
        ->assertOk()
        ->assertSee('Salle Edit');
});

test('admin can update salle', function () {
    $salle = Salle::create([
        'nom_salle' => 'Salle Update',
        'capacite' => 100,
        'adresse' => 'Address',
    ]);

    $this->actingAs($this->admin)
        ->put(route('salle.update', $salle), [
            'nom_salle' => 'Salle Updated',
            'capacite' => 150,
            'adresse' => 'New Address',
        ])
        ->assertRedirect(route('salle.index'));

    $this->assertDatabaseHas('salle', [
        'id' => $salle->id,
        'nom_salle' => 'Salle Updated',
    ]);
});

test('admin can delete salle', function () {
    $salle = Salle::create([
        'nom_salle' => 'Salle Delete',
        'capacite' => 100,
        'adresse' => 'Address',
    ]);

    $this->actingAs($this->admin)
        ->delete(route('salle.destroy', $salle))
        ->assertRedirect(route('salle.index'));

    $this->assertDatabaseMissing('salle', [
        'id' => $salle->id,
    ]);
});
