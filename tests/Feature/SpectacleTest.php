<?php

use App\Models\Salle;
use App\Models\Spectacle;
use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;

beforeEach(function () {
    $this->admin = User::factory()->create();
    Bouncer::assign('admin')->to($this->admin);

    $this->salle = Salle::create([
        'nom_salle' => 'Salle Spectacle',
        'capacite' => 100,
        'adresse' => 'Address',
    ]);
});

test('admin can view spectacles list', function () {
    Spectacle::create([
        'salle_id' => $this->salle->id,
        'nom_spectacle' => 'Spectacle Test', // Assuming this field exists or is not required? Wait, Spectacle model fillable has 'nom_spectacle' but migration?
        // Let's check Spectacle model again.
        'date_spectacle' => now()->addDays(1),
        'heure_spectacle' => '20:00',
        'prix' => 20,
    ]);

    $this->actingAs($this->admin)
        ->get(route('spectacle.index'))
        ->assertOk();
});

test('admin can view create spectacle form', function () {
    $this->actingAs($this->admin)
        ->get(route('spectacle.create'))
        ->assertOk();
});

test('admin can create spectacle', function () {
    $spectacleData = [
        'salle_id' => $this->salle->id,
        'date_spectacle' => now()->addDays(5)->toDateString(),
        'heure_spectacle' => '19:00',
        'prix' => 30,
        // 'nom_spectacle' => 'New Spectacle', // Check if this is needed
    ];

    $this->actingAs($this->admin)
        ->post(route('spectacle.store'), $spectacleData)
        ->assertRedirect(route('spectacle.index'));

    $this->assertDatabaseHas('spectacles', [
        'salle_id' => $this->salle->id,
        'prix' => 30,
    ]);
});

test('admin can view edit spectacle form', function () {
    $spectacle = Spectacle::create([
        'salle_id' => $this->salle->id,
        'date_spectacle' => now()->addDays(1),
        'heure_spectacle' => '20:00',
        'prix' => 20,
    ]);

    $this->actingAs($this->admin)
        ->get(route('spectacle.edit', $spectacle))
        ->assertOk();
});

test('admin can update spectacle', function () {
    $spectacle = Spectacle::create([
        'salle_id' => $this->salle->id,
        'date_spectacle' => now()->addDays(1),
        'heure_spectacle' => '20:00',
        'prix' => 20,
    ]);

    $this->actingAs($this->admin)
        ->put(route('spectacle.update', $spectacle), [
            'salle_id' => $this->salle->id,
            'date_spectacle' => now()->addDays(2)->toDateString(),
            'heure_spectacle' => '21:00',
            'prix' => 25,
        ])
        ->assertRedirect(route('salle.show', $this->salle->id));

    $this->assertDatabaseHas('spectacles', [
        'id' => $spectacle->id,
        'prix' => 25,
    ]);
});

test('admin can delete spectacle', function () {
    $spectacle = Spectacle::create([
        'salle_id' => $this->salle->id,
        'date_spectacle' => now()->addDays(1),
        'heure_spectacle' => '20:00',
        'prix' => 20,
    ]);

    $this->actingAs($this->admin)
        ->delete(route('spectacle.destroy', $spectacle))
        ->assertRedirect(route('spectacle.index'));

    $this->assertDatabaseMissing('spectacles', [
        'id' => $spectacle->id,
    ]);
});
