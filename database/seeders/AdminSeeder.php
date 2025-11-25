<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade as Bouncer;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'prenom' => 'User',
                'password' => Hash::make('password'),
            ]
        );

        // Create admin role and ability
        Bouncer::allow('admin')->to('gestion_salle');

        // Assign admin role to user
        Bouncer::assign('admin')->to($admin);
    }
}
