<?php

namespace Database\Seeders;

use App\Models\Salle;
use App\Models\Spectacle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalleSpectacleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Salle::factory()
            ->count(2)
            ->has(Spectacle::factory()->count(1))
            ->create();
    }
}
