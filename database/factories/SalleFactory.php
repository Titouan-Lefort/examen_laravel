<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salle>
 */
class SalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_salle' => fake('fr_FR')->company(),
            'capacite' => fake('fr_FR')->numberBetween(50, 500),
            'adresse' => fake('fr_FR')->address(),
        ];
    }
}
