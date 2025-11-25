<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User',
                'prenom' => 'User',
                'password' => Hash::make('password'),
            ]
        );

        // Create admin role and ability
        Bouncer::allow('user')->to('gestion_user');

        // Assign admin role to user
        Bouncer::assign('user')->to($user);
    }

}
