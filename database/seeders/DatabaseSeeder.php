<?php

namespace Database\Seeders;

use App\Models\user;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\role;
use App\Models\taux;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $role_patient = role::create(['nom' => 'PATIENT']);
        $role_medecin = role::create(['nom' => 'MEDECIN']);
        $role_admin = role::create(['nom' => 'ADMINISTRATEUR']);
        $role_receptionist = role::create(['nom' => 'RECEPTIONNISTE']);
        $role_lab_technician = role::create(['nom' => 'LABORANTIN']);
        $role_cashier = role::create(['nom' => 'CAISSIER']);
        $role_pharmacist = role::create(['nom' => 'PHARMACIEN']);
        $role_nurse = role::create(['nom' => 'INFIRMIER']);
        $role_medical_director = role::create(['nom' => 'DIRECTEUR MEDICAL']);
        $role_accountant = role::create(['nom' => 'COMPTABLE']);
        $role_archivist = role::create(['nom' => 'ARCHIVISTE']);


        for($i = 5; $i <= 100; $i += 5){
           taux::create(['taux' => $i]); 
        }
        
    }
}
