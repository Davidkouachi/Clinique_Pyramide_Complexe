<?php

namespace Database\Seeders;

use App\Models\user;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $role_patient =role::create(['nom' => 'PATIENT']);
        $role_user =role::create(['nom' => 'UTILISATEUR']);
        $role_medecin =role::create(['nom' => 'MEDECIN']);
        $role_admin =role::create(['nom' => 'ADMINISTRATEUR']);
    }
}
