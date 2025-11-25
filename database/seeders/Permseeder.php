<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;


class Permseeder extends Seeder
{
    public function run()
    {
        // --- CRÉATION DES RÔLES ---
        $adminRole = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator'
        ]);

        $userRole = Bouncer::role()->firstOrCreate([
            'name' => 'user',
            'title' => 'User'
        ]);

        $gestion_salle = Bouncer::ability()->firstOrCreate(['name' => 'gestion_salle']);

        $gestion_user = Bouncer::ability()->firstOrCreate(['name' => 'gestion_user']);

        Bouncer::allow($adminRole)->to([$gestion_salle]);
        Bouncer::allow($userRole)->to([$gestion_user]);

    }
}



