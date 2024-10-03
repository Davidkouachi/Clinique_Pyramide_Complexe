<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\role;
use App\Models\taux;
use App\Models\acte;
use App\Models\typeacte;
use App\Models\user;
use App\Models\typeadmission;
use App\Models\natureadmission;
use App\Models\detailhopital;
use App\Models\societe;
use App\Models\assurance;
use App\Models\produit;
use App\Models\typesoins;
use App\Models\soinsinfirmier;
use App\Models\prelevement;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        prelevement::create(['prix' => '1.500','code' => '1']);

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
            'ANALYSE' => [
                'typeacte' => ['BLOOD TEST', 'URINE TEST'],
                'prix' => ['100', '300'],
                'cotation' => ['B', 'Z'],
                'valeur' => ['300', '500'],
                'montant' => ['30.000', '150.000'],
            ],
            'IMAGERIE' => [
                'typeacte' => ['ECG', 'ECHO','X-RAY', 'ULTRASOUND'],
                'prix' => ['100', '300','200','200'],
                'cotation' => ['B', 'Z','C','A'],
                'valeur' => ['300', '500','400','400'],
                'montant' => ['30.000', '150.000','80.000','80.000'],
            ]
        ];

        foreach ($actes as $acteName => $typeacteData) {
            // Create or get the acte entry
            $acte = acte::firstOrCreate(['nom' => $acteName]);

            // Loop through typeacte entries
            foreach ($typeacteData['typeacte'] as $key => $typeacteName) {
                // Use index to get corresponding price
                $prix = isset($typeacteData['prix'][$key]) ? $typeacteData['prix'][$key] : '0.00';

                // Prepare additional fields if they exist
                $cotation = isset($typeacteData['cotation'][$key]) ? $typeacteData['cotation'][$key] : null;
                $valeur = isset($typeacteData['valeur'][$key]) ? $typeacteData['valeur'][$key] : null;
                $montant = isset($typeacteData['montant'][$key]) ? $typeacteData['montant'][$key] : null;

                // Create the typeacte entry with additional fields
                typeacte::create([
                    'nom' => $typeacteName,
                    'prix' => $prix,
                    'acte_id' => $acte->id,
                    'cotation' => $cotation,
                    'valeur' => $valeur,
                    'montant' => $montant
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

        $typeadmission = [
            'HOSPITALISATION' => [
                'nature' => ['DIALYSE', 'CHIMIOTHÉRAPIE', 'INTERVENTION CHIRURGICALE', 'SOINS INTENSIFS', 'RÉADAPTATION'],
            ],
            'MISE EN OBSERVATION' => [
                'nature' => ['CHIRURGIE AMBULATOIRE', 'SURVEILLANCE POST-OPÉRATOIRE', 'OBSERVATION POUR TRAUMATISME LÉGER', 'SURVEILLANCE CARDIAQUE']
            ]
        ];

        foreach ($typeadmission as $acteName => $typeacteData) {
            // Crée ou récupère l'entrée du type d'admission
            $add = typeadmission::firstOrCreate(['nom' => $acteName]);

            foreach ($typeacteData['nature'] as $typeacteName) {
                // Crée l'entrée de la nature d'admission
                natureadmission::create([
                    'nom' => $typeacteName,
                    'typeadmission_id' => $add->id
                ]);
            }
        }

        $societe = ['MOOV CI', 'ORANGE CI', 'MTN CI', 'SGBCI'];
        foreach ($societe as $value) {
            societe::create(['nom' => $value]); 
        }
        
        assurance::create(['nom' => 'SOGEMAD','email' => 'sogemad@gmail.com','tel' => '0757671653','fax' => '659625532', 'adresse' => 'COCODY RIVERA']);

        // Liste de produits pharmaceutiques avec leurs prix
        $produitsPharmaceutiques = [
            ['nom' => 'PARACÉTAMOL 500MG', 'prix' => '1.500', 'quantite' => '20'],
            ['nom' => 'IBUPROFÈNE 400MG', 'prix' => '1.800', 'quantite' => '20'],
            ['nom' => 'AMOXICILLINE 500MG', 'prix' => '1.000', 'quantite' => '20'],
            ['nom' => 'VITAMINE C 1000MG', 'prix' => '1.500', 'quantite' => '20'],
            ['nom' => 'ANTIBIOTIQUE Z', 'prix' => '1.200', 'quantite' => '20'],
            ['nom' => 'CÉTIRIZINE 10MG', 'prix' => '1.600', 'quantite' => '20'],
            ['nom' => 'LORATADINE 10MG', 'prix' => '1.750', 'quantite' => '20'],
            ['nom' => 'POMMADE ANTISEPTIQUE', 'prix' => '1.300', 'quantite' => '20'],
            ['nom' => 'SOLUTION SALINE', 'prix' => '1.450', 'quantite' => '20'],
            ['nom' => 'GEL DÉSINFECTANT', 'prix' => '1.350', 'quantite' => '20'],
            ['nom' => 'ASPIRINE 100MG', 'prix' => '1.100', 'quantite' => '20'],
            ['nom' => 'ANTIDOULEUR B', 'prix' => '1.800', 'quantite' => '20'],
            ['nom' => 'PENICILLINE G 600MG', 'prix' => '1.250', 'quantite' => '20'],
            ['nom' => 'DOLIPRANE 1000MG', 'prix' => '1.500', 'quantite' => '20'],
            ['nom' => 'ANTI-INFLAMMATOIRE Q', 'prix' => '1.950', 'quantite' => '20'],
            ['nom' => 'CREME ANTIFONGIQUE', 'prix' => '1.700', 'quantite' => '20'],
            ['nom' => 'ANTIHISTAMINIQUE V', 'prix' => '1.600', 'quantite' => '20'],
            ['nom' => 'COLLYRE ANTIALLERGIQUE', 'prix' => '1.400', 'quantite' => '20'],
            ['nom' => 'CRÈME ANTIBIOTIQUE', 'prix' => '1.850', 'quantite' => '20'],
            ['nom' => 'VACCIN ANTI-TÉTANIQUE', 'prix' => '1.900', 'quantite' => '20'],
            ['nom' => 'TUBES DE TEST', 'prix' => '1.300', 'quantite' => '20'],
            ['nom' => 'BANDAGE ÉLASTIQUE', 'prix' => '1.250', 'quantite' => '20'],
            ['nom' => 'DÉSINFECTANT POUR LES MAINS', 'prix' => '1.350', 'quantite' => '20'],
            ['nom' => 'SOLUTION D\'HYDRATATION ORALE', 'prix' => '1.450', 'quantite' => '20'],
            ['nom' => 'SYRINGES STÉRILES', 'prix' => '1.600', 'quantite' => '20'],
            ['nom' => 'THERMOMÈTRE DIGITAL', 'prix' => '1.550', 'quantite' => '20'],
            ['nom' => 'GANTS EN LATEX', 'prix' => '1.450', 'quantite' => '20'],
            ['nom' => 'CATAPLASME FROID', 'prix' => '1.350', 'quantite' => '20'],
            ['nom' => 'COMPRESSES STÉRILES', 'prix' => '1.250', 'quantite' => '20'],
            ['nom' => 'PILULE CONTRACEPTIVE', 'prix' => '1.200', 'quantite' => '20'],
            ['nom' => 'MASQUE CHIRURGICAL', 'prix' => '1.100', 'quantite' => '20'],
            ['nom' => 'ANTIBIOTIQUE Y', 'prix' => '1.900', 'quantite' => '20'],
            ['nom' => 'VACCIN ANTI-GRIPPE', 'prix' => '1.850', 'quantite' => '20'],
            ['nom' => 'PANSEMENTS ADHÉSIFS', 'prix' => '1.250', 'quantite' => '20'],
            ['nom' => 'BÉQUILLES MÉDICALES', 'prix' => '1.500', 'quantite' => '20'],
            ['nom' => 'SUPPOSITOIRE ANTI-DOULEUR', 'prix' => '1.300', 'quantite' => '20'],
            ['nom' => 'INHALATEUR POUR ASTHME', 'prix' => '1.800', 'quantite' => '20'],
            ['nom' => 'COLLIER CERVICAL', 'prix' => '1.550', 'quantite' => '20'],
            ['nom' => 'SERUM PHYSIOLOGIQUE', 'prix' => '1.300', 'quantite' => '20'],
            ['nom' => 'OXYGÈNE MÉDICAL', 'prix' => '1.700', 'quantite' => '20'],
            ['nom' => 'ELECTRODES POUR ECG', 'prix' => '1.600', 'quantite' => '20'],
            ['nom' => 'SIROP POUR TOUX', 'prix' => '1.250', 'quantite' => '20'],
            ['nom' => 'COMPRESSES DE GAZE', 'prix' => '1.150', 'quantite' => '20'],
            ['nom' => 'SOLUTION DE RINCAGE OCULAIRE', 'prix' => '1.450', 'quantite' => '20'],
            ['nom' => 'ALCOOL MÉDICAL', 'prix' => '1.300', 'quantite' => '20'],
            ['nom' => 'CREME POUR BRÛLURES', 'prix' => '1.900', 'quantite' => '20'],
            ['nom' => 'ANALGÉSIQUE FORTE', 'prix' => '1.800', 'quantite' => '20'],
            ['nom' => 'ANTIBIOTIQUE A', 'prix' => '1.500', 'quantite' => '20'],
            ['nom' => 'BANDES DE SUTURE', 'prix' => '1.350', 'quantite' => '20'],
        ];

        // Enregistrer les produits dans la table produit
        foreach ($produitsPharmaceutiques as $produitData) {
            produit::create([
                'nom' => $produitData['nom'],
                'prix' => $produitData['prix'],
                'quantite' => $produitData['quantite'],
            ]);
        }

        $soins = [
            'SOINS CURATIFS' => [
                'typesoin' => ['TRAITEMENT INFECTION', 'SOINS POST-OPERATOIRES'],
                'prix' => ['12.000', '15.000']
            ],
            'SOINS PREVENTIFS' => [
                'typesoin' => ['VACCINATION', 'DEPISTAGE'],
                'prix' => ['8.000', '10.000']
            ],
            'SOINS PALLIATIFS' => [
                'typesoin' => ['GESTION DOULEUR', 'SOINS TERMINAUX'],
                'prix' => ['20.000', '25.000']
            ],
            'SOINS DE REEDUCATION' => [
                'typesoin' => ['KINESITHERAPIE', 'MOBILISATION'],
                'prix' => ['30.000', '35.000']
            ]
        ];

        // Boucle à travers chaque catégorie de soin
        foreach ($soins as $soinName => $typesoinData) {
            // Créer ou récupérer l'entrée de soin
            $soin = typesoins::firstOrCreate(['nom' => $soinName]);

            // Créer les entrées types de soin avec les prix correspondants
            foreach ($typesoinData['typesoin'] as $key => $typesoinName) {
                // Utiliser l'index pour obtenir le prix correspondant
                $prix = isset($typesoinData['prix'][$key]) ? $typesoinData['prix'][$key] : '0.00';

                // Créer l'entrée types de soin
                soinsinfirmier::create([
                    'nom' => $typesoinName,
                    'prix' => $prix,
                    'typesoins_id' => $soin->id
                ]);
            }
        }
    }
}
