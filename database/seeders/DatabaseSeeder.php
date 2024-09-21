<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\role;
use App\Models\taux;
use App\Models\acte;
use App\Models\typeacte;
use App\Models\user;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

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

        // Define the data for each type of "acte"
        $actes = [
            'CONSULTATION' => [
                'typeacte' => ['GENERALISTE', 'PEDIATRE', 'CARDIOLOGUE', 'DENTISTE'],
                'prix' => ['10.000', '2.000', '5.000', '7.000']
            ],
            'RADIO' => [
                'typeacte' => ['X-RAY', 'ULTRASOUND'],
                'prix' => ['20.000', '30.000']
            ],
            'ANALYSE' => [
                'typeacte' => ['BLOOD TEST', 'URINE TEST'],
                'prix' => ['15.000', '10.000']
            ],
            'EXAMEN' => [
                'typeacte' => ['ECG', 'ECHO'],
                'prix' => ['25.000', '35.000']
            ]
        ];

        // Loop through each acte category
        foreach ($actes as $acteName => $typeacteData) {
            // Create or get the acte entry
            $acte = acte::firstOrCreate(['nom' => $acteName]);

            // Create typeacte entries with corresponding prices
            foreach ($typeacteData['typeacte'] as $key => $typeacteName) {
                // Use index to get corresponding price
                $prix = isset($typeacteData['prix'][$key]) ? $typeacteData['prix'][$key] : '0.00';

                // Create typeacte entry
                typeacte::create([
                    'nom' => $typeacteName,
                    'prix' => $prix,
                    'acte_id' => $acte->id
                ]);
            }
        }


        for($i = 5; $i <= 100; $i += 5){
           taux::create(['taux' => $i]); 
        }

        $user = user::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('0000'),
            'matricule' => 'C1223450',
            'tel' => '0757803650',
            'role' => $role_admin->nom,
            'role_id' => $role_admin->id,
            'adresse' => 'adresse',
            'sexe' => 'Mr',
        ]);
        
    }
}
