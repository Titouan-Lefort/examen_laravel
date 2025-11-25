<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Salle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spectacle>
 */
class SpectacleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salle_id' => Salle::factory(),
            'nom_spectacle' => $this->faker->sentence(3),
            'date_spectacle' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'heure_spectacle' => $this->faker->time(),
            'prix' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
