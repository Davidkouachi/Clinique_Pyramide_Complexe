<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\assurance;
use App\Models\taux;
use App\Models\societe;
use App\Models\patient;
use App\Models\chambre;
use App\Models\lit;
use App\Models\acte;
use App\Models\typeacte;
use App\Models\user;
use App\Models\role;
use App\Models\typemedecin;
use App\Models\consultation;
use App\Models\detailconsultation;
use App\Models\facture;
use App\Models\typeadmission;
use App\Models\natureadmission;
use App\Models\detailhopital;
use App\Models\produit;
use App\Models\soinshopital;
use App\Models\typesoins;
use App\Models\soinsinfirmier;
use App\Models\soinspatient;
use App\Models\sp_produit;
use App\Models\sp_soins;
use App\Models\examenpatient;
use App\Models\examen;
use App\Models\prelevement;
use App\Models\joursemaine;
use App\Models\rdvpatient;
use App\Models\programmemedecin;
use App\Models\depotfacture;

class ApiinsertController extends Controller
{
    public function societe_new(Request $request)
    {
        $name = $request->societe;

        $verf = societe::where('nom', '=', $request->societe)->exists();

        if ($verf) {
            return response()->json(['warning' => true]);
        }

        $add = new societe();
        $add->nom = $request->societe;

        if ($add->save()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function assurance_new(Request $request)
    {
        $verifications = [
            'tel' => $request->tel,
            'tel2' => $request->tel2 ?? null, // Allow tel2 to be null
            'email' => $request->email,
            'nom' => $request->nom,
            'fax' => $request->fax,
        ];

        $assuranceExist = assurance::where(function($query) use ($verifications) {
            $query->where('tel', $verifications['tel'])
                  ->orWhere(function($query) use ($verifications) {
                      if (!is_null($verifications['tel2'])) {
                          $query->where('tel2', $verifications['tel2']);
                      }
                  })
                  ->orWhere('email', $verifications['email'])
                  ->orWhere('nom', $verifications['nom'])
                  ->orWhere('fax', $verifications['fax']);
        })->first();

        if ($assuranceExist) {
            if ($assuranceExist->tel === $verifications['tel'] || (!is_null($verifications['tel2']) && $assuranceExist->tel2 === $verifications['tel2'])) {
                return response()->json(['tel_existe' => true]);
            } elseif ($assuranceExist->email === $verifications['email']) {
                return response()->json(['email_existe' => true]);
            } elseif ($assuranceExist->nom === $verifications['nom']) {
                return response()->json(['nom_existe' => true]);
            } elseif ($assuranceExist->fax === $verifications['fax']) {
                return response()->json(['fax_existe' => true]);
            }
        }

        $add = new assurance();
        $add->nom = $request->nom;
        $add->email = $request->email;
        $add->tel = $request->tel;
        $add->tel2 = $request->tel2;
        $add->fax = $request->fax;
        $add->adresse = $request->adresse;

        if($add->save()){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['error' => true]);
        }
    }

    public function patient_new(Request $request)
    {
        $verifications = [
            'tel' => $request->tel,
            'tel2' => $request->tel2 ?? null, // Allow tel2 to be null
            'email' => $request->email ?? null,
            'nom' => $request->nom,
        ];

        $patientExist = patient::where(function($query) use ($verifications) {
            $query->where('tel', $verifications['tel'])
                  ->orWhere(function($query) use ($verifications) {
                      if (!is_null($verifications['tel2'])) {
                          $query->where('tel2', $verifications['tel2']);
                      }
                  })
                  ->orWhere(function($query) use ($verifications) {
                      if (!is_null($verifications['email'])) {
                          $query->where('email', $verifications['email']);
                      }
                  })
                  ->orWhere(function($query) use ($verifications) {
                      if (!is_null($verifications['nom'])) {
                          $query->where('np', $verifications['nom']);
                      }
                  });
        })->first();

        if ($patientExist) {
            if ($patientExist->tel === $verifications['tel'] || (!is_null($verifications['tel2']) && $patientExist->tel2 === $verifications['tel2'])) {
                return response()->json(['tel_existe' => true]);
            } elseif ($patientExist->email === $verifications['email']) {
                return response()->json(['email_existe' => true]);
            } elseif ($patientExist->nom === $verifications['nom']) {
                return response()->json(['nom_existe' => true]);
            }
        }

        // Generate a unique matricule
        $matricule = $this->generateUniqueMatricule();
        // Create a new record with the unique matricule
        $add = new patient();
        $add->matricule = $matricule;
        $add->np = $request->nom;
        $add->email = $request->email;
        $add->tel = $request->tel;
        $add->tel2 = $request->tel2;
        $add->assurer = $request->assurer;
        $add->adresse = $request->adresse;
        $add->datenais = $request->datenais;
        $add->sexe = $request->sexe;

        if($request->assurer === 'oui'){
            $add->assurance_id = $request->assurance_id;
            $add->taux_id = $request->taux_id;
            $add->societe_id = $request->societe_id;
            $add->filiation = $request->filiation;
            $add->matricule_assurance = $request->matricule_assurance;
        }

        if($add->save()){
            return response()->json(['success' => true, 'matricule' => $matricule, 'name' => $request->nom]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    private function generateUniqueMatricule()
    {
        do {
            // Generate a random 9-digit number
            $matricule = random_int(100000, 999999); // Generates a number between 100000000 and 999999999
        } while (patient::where('matricule', $matricule)->exists()); // Ensure uniqueness

        // Return matricule with prefix
        return $matricule;
    }

    public function chambre_new(Request $request)
    {
        $verf = chambre::where('code', '=', $request->num_chambre)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $add = new chambre();
        $add->code = $request->num_chambre;
        $add->nbre_lit = $request->nbre_lit;
        $add->prix = $request->prix;
        $add->statut = 'indisponible';

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function lit_new(Request $request)
    {
        $verf = lit::where('code', '=', $request->num_lit)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $nbre = chambre::find($request->chambre_id);
        $count = lit::where('chambre_id', '=', $request->chambre_id)->count();

        if ($nbre->nbre_lit <= $count) {
            return response()->json(['nbre' => true]);
        }
        
        $add = new lit();
        $add->code = $request->num_lit;
        $add->type = $request->type;
        $add->chambre_id = $request->chambre_id;
        $add->statut = 'disponible';

        DB::beginTransaction();

        try {

            if (!$add->save()) {
                return response()->json(['error' => true]);
            }

            $add2 = chambre::find($request->chambre_id);
            $add2->statut = 'disponible';

            if (!$add2->save()) {
                return response()->json(['error' => true]);
            }

            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true]);
        }
    }

    public function motif_cons_new(Request $request)
    {
        $verf = acte::where('nom', '=', $request->nom)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $add = new acte();
        $add->nom = $request->nom;

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function typeacte_cons_new(Request $request)
    {
        $verf = typeacte::where('nom', '=', $request->nom)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $add = new typeacte();
        $add->nom = $request->nom;
        $add->prix = $request->prix;
        $add->acte_id = $request->id;

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function new_medecin(Request $request)
    {
        $verifications = [
            'tel' => $request->tel,
            'tel2' => $request->tel2 ?? null, // Allow tel2 to be null
            'email' => $request->email ?? null,
            'nom' => $request->nom,
        ];

        $role = role::where('nom', '=', 'MEDECIN')->first();

        $Exist = user::where(function($query) use ($verifications) {
            $query->where('tel', $verifications['tel'])
                  ->orWhere(function($query) use ($verifications) {
                      if (!is_null($verifications['tel2'])) {
                          $query->where('tel2', $verifications['tel2']);
                      }
                  })
                  ->orWhere(function($query) use ($verifications) {
                      if (!is_null($verifications['email'])) {
                          $query->where('email', $verifications['email']);
                      }
                  })
                  ->orWhere(function($query) use ($verifications) {
                      if (!is_null($verifications['nom'])) {
                          $query->where('name', $verifications['nom']);
                      }
                  });
        })->first();

        if ($Exist) {
            if ($Exist->tel === $verifications['tel'] || (!is_null($verifications['tel2']) && $Exist->tel2 === $verifications['tel2'])) {
                return response()->json(['tel_existe' => true]);
            } elseif ($Exist->email === $verifications['email']) {
                return response()->json(['email_existe' => true]);
            } elseif ($Exist->nom === $verifications['nom']) {
                return response()->json(['nom_existe' => true]);
            }
        }

        DB::beginTransaction();

        $matricule = $this->generateUniqueMatricule();

        $add = new user();
        $add->name = $request->nom;
        $add->email = $request->email;
        $add->sexe = $request->sexe;
        $add->tel = $request->tel;
        $add->tel2 = $request->tel2;
        $add->password = bcrypt('00000');
        $add->adresse = $request->adresse;
        $add->matricule = $matricule;
        $add->role_id = $role->id;
        $add->role = $role->nom;

        try {

            if (!$add->save()) {
                return response()->json(['error' => true]);
            }

            $type = new typemedecin();
            $type->typeacte_id = $request->typeacte_id;
            $type->user_id = $add->id;

            if (!$type->save()) {
                return response()->json(['error' => true]);
            }

            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true]);
        }

    }

    public function new_consultation(Request $request)
    {
        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
        ->where('matricule', '=', $request->num_patient)
        ->select('patients.*', 'assurances.nom as assurance')
        ->first();

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        if (!$patient) {
            return response()->json(['error' => true]);
        }

        $typeacte = typeacte::find($request->typeacte_id);

        if (!$typeacte) {
            return response()->json(['error' => true]);
        }

        $acte = acte::find($request->acte_id);

        if (!$acte) {
            return response()->json(['error' => true]);
        }

        $user = user::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => true]);
        }

        $code = $this->generateUniqueMatricule();

        $codeFac = $this->generateUniqueFacture();

        $today = Carbon::today();

        DB::beginTransaction();

        try {

            $fac = new facture();
            $fac->code = $codeFac;
            $fac->statut = 'impayer';

            if (!$fac->save()) {
                throw new \Exception('Erreur');
            }

            $add = new consultation();
            $add->patient_id = $patient->id; 
            $add->user_id = $user->id;
            $add->facture_id = $fac->id; 
            $add->matricule_patient = $patient->matricule;
            $add->code = $code;
            $add->num_bon = $request->mumcode;

            if (!$add->save()) {
                throw new \Exception('Erreur');
            }

            $add2 = new detailconsultation();
            $add2->consultation_id = $add->id;
            $add2->typeacte_id = $typeacte->id;
            $add2->part_assurance = $request->montant_assurance;
            $add2->part_patient = $request->montant_patient;
            $add2->remise = $request->taux_remise;
            $add2->motif = $acte->nom;
            $add2->montant = $typeacte->prix;
            $add2->type_motif = $typeacte->nom;
            $add2->libelle = '';
            $add2->periode = $request->periode;
            $add2->appliq_remise = $request->appliq_remise;

            if (!$add2->save()) {
                throw new \Exception('Erreur');
            }

            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true]);
        }

    }

    private function generateUniqueFacture()
    {
        do {
            // Generate a random 9-digit number
            $code = time().'_'.random_int(1000, 9999); // Generates a number between 100000000 and 999999999
        } while (facture::where('code', $code)->exists()); // Ensure uniqueness

        // Return matricule with prefix
        return $code;
    }

    public function new_typeadmission(Request $request)
    {
        $verf = typeadmission::where('nom', '=', $request->nom)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $add = new typeadmission();
        $add->nom = $request->nom;

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function new_natureadmission(Request $request)
    {
        $verf = natureadmission::where('nom', '=', $request->nom)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $add = new natureadmission();
        $add->nom = $request->nom;
        $add->typeadmission_id = $request->id;

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function hosp_new(Request $request)
    {

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
        ->where('patients.matricule', '=', $request->matricule_patient)
        ->select('patients.*', 'assurances.nom as assurance')
        ->first();

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        if (!$patient) {
            return response()->json(['error' => true]);
        }

        $chambre = chambre::find($request->id_chambre);

        if (!$chambre) {
            return response()->json(['error' => true]);
        }

        $lit = lit::find($request->id_lit);

        if (!$lit) {
            return response()->json(['error' => true]);
        }

        $typeadmission = typeadmission::find($request->id_typeadmission);

        if (!$typeadmission) {
            return response()->json(['error' => true]);
        }

        $natureadmission = natureadmission::find($request->id_natureadmission);

        if (!$natureadmission) {
            return response()->json(['error' => true]);
        }
        
        $user = user::join('typemedecins', 'typemedecins.user_id', '=', 'users.id')
            ->join('typeactes', 'typeactes.id', '=', 'typemedecins.typeacte_id')
            ->where('users.id', '=', $request->medecin_id)
            ->select('users.*', 'typeactes.nom as typeacte')
            ->first();

        if (!$user) {
            return response()->json(['error' => true]);
        }

        $codeFac = $this->generateUniqueFacture();

        DB::beginTransaction();

        try {

            $fac = new facture();
            $fac->code = $codeFac;
            $fac->statut = 'impayer';

            if (!$fac->save()) {
                throw new \Exception('Erreur');
            }

            $add = new detailhopital();
            $add->statut = 'Hospitaliser';
            $add->num_bon = $request->numcode;
            $add->part_assurance = $request->montant_assurance;
            $add->part_patient = $request->montant_patient;
            $add->remise = $request->taux_remise;
            $add->montant = $request->montant_total;
            $add->montant_soins = '0';
            $add->montant_chambre = $request->montant_total;
            $add->date_debut = $request->date_entrer;
            $add->date_fin = $request->date_sortie;
            $add->natureadmission_id = $natureadmission->id;
            $add->facture_id = $fac->id;
            $add->patient_id = $patient->id;
            $add->lit_id = $lit->id;
            $add->user_id = $user->id;

            if (!$add->save()) {
                throw new \Exception('Erreur');
            }

            $lit->statut = 'indisponible';
            if (!$lit->save()) {
                throw new \Exception('Erreur');
            }

            $hopital = $add;
            $facture = $fac;

            DB::commit();
            return response()->json(['success' => true, 'patient' => $patient, 'chambre' => $chambre, 'user' => $user, 'hopital' => $hopital, 'lit' => $lit, 'typeadmission' => $typeadmission, 'natureadmission' => $natureadmission, 'facture' => $facture]);
            
        } catch (Exception $e) {

            DB::rollback();
            return response()->json(['error' => true]);
        }
    }

    public function new_produit(Request $request)
    {
        $verf = produit::where('nom', '=', $request->nom)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $add = new produit();
        $add->nom = $request->nom;
        $add->prix = $request->prix;
        $add->quantite = $request->quantite;

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function add_soinshopital(Request $request, $id)
    {

        $selections = $request->input('selections');

        // Vérifier si les sélections sont bien un tableau
        if (!is_array($selections) || empty($selections)) {
            return response()->json(['json' => true]);
        }

        $montantTotal = str_replace('.', '', $request->input('montantTotal'));

        DB::beginTransaction();

        try {

            foreach ($selections as $value) {

                $qu = produit::find($value['id']);
                if ($qu && $qu->quantite >= $value['quantite']) {
                    
                    $qu->quantite -= $value['quantite'];

                    if (!$qu->save()) {
                        throw new \Exception('Erreur lors de la mise à jour de la quantité du produit');
                    }

                }else{
                    throw new \Exception('Quantité insuffisante pour le produit : ' . $qu->nom);
                }

                $add = new soinshopital();
                $add->produit_id = $value['id'];
                $add->quantite = $value['quantite'];
                $add->montant = number_format($value['montant'], 0, ',', '.');
                $add->detailhopital_id = $id;

                if (!$add->save()) {
                    throw new \Exception('Erreur');
                }
            }

            $montantTotal = str_replace('.', '', $request->input('montantTotal'));

            $add2 = detailhopital::find($id);

            $montant_soins_ancien = str_replace('.', '', $add2->montant_soins);

            $montant_soins_nouveau = $montantTotal + $montant_soins_ancien;

            $formattedMontant = number_format($montant_soins_nouveau, 0, '', '.');

            $add2->montant_soins = $formattedMontant;

            $a_soins = str_replace('.', '', $add2->montant_soins);
            $a_chambre = str_replace('.', '', $add2->montant_chambre);

            $n_montant = $a_soins + $a_chambre;

            $add2->montant = number_format($n_montant, 0, '', '.');

            $rech_taux = patient::leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
                            ->where('patients.id', '=', $add2->patient_id)
                            ->select(
                                'patients.*',
                                'tauxes.taux as taux',
                            )->first();

            if ($rech_taux->assurer === 'non') {
                $rech_taux->taux = 0;
            }

            $nMontant = str_replace('.', '', $add2->montant);

            $assurance = ($nMontant * $rech_taux->taux) / 100;

            $patient = $nMontant - $assurance;

            $formattedA = number_format($assurance, 0, '', '.');
            $formattedP = number_format($patient, 0, '', '.');

            $add2->part_assurance = $formattedA;
            $add2->part_patient = $formattedP;

            $remise = str_replace('.', '', $add2->remise);
            $r_patient = str_replace('.', '', $add2->part_patient);

            $nremise = $r_patient - $remise;

            $formattedr = number_format($nremise, 0, '', '.');

            $add2->part_patient = $formattedr;

            if (!$add2->save()) {
                throw new \Exception('Erreur lors de la mise à jour du montant total');
            }

            // Si tout s'est bien passé, on commit les changements
            DB::commit();

            return response()->json(['success' => true]);
            
        } catch (Exception $e) {

            DB::rollback();
            return response()->json(['error' => true]);
        }
    }

    public function new_typesoins(Request $request)
    {
        $verf = typesoins::where('nom', '=', $request->nom)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $add = new typesoins();
        $add->nom = $request->nom;

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function new_soinsIn(Request $request)
    {
        $add = new soinsinfirmier();

        $add->nom = $request->nom_soins;
        $add->prix = $request->prix;
        $add->typesoins_id = $request->typesoins_id;

        if ($add->save()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function new_soinsam(Request $request)
    {
        $selectionsSoins = $request->input('selectionsSoins');
        if (!is_array($selectionsSoins) || empty($selectionsSoins)) {
            return response()->json(['json' => true]);
        }

        $selectionsProduits = $request->input('selectionsProduits');
        if (!is_array($selectionsProduits) || empty($selectionsProduits)) {
            return response()->json(['json' => true]);
        }

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
        ->where('patients.matricule', '=', $request->matricule_patient)
        ->select('patients.*', 'assurances.nom as assurance')
        ->first();

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        if (!$patient) {
            return response()->json(['error' => true]);
        }

        $typesoins = typesoins::find($request->typesoins_id);

        if (!$typesoins) {
            return response()->json(['error' => true]);
        }

        $code = $this->generateUniqueMatricule();

        $codeFac = $this->generateUniqueFacture();

        DB::beginTransaction();

        try {

            $fac = new facture();
            $fac->code = $codeFac;
            $fac->statut = 'impayer';

            if (!$fac->save()) {
                throw new \Exception('Erreur');
            }

            $add = new soinspatient();
            $add->code = $code;
            $add->statut = 'en cours';
            $add->num_bon = $request->numcode;
            $add->part_patient = $request->montantPatient;
            $add->part_assurance = $request->montantAssurance;
            $add->remise = $request->montantRemise;
            $add->montant = $request->montantTotal;
            $add->libelle = '';
            $add->facture_id = $fac->id;
            $add->patient_id = $patient->id;
            $add->typesoins_id = $typesoins->id;

            if (!$add->save()) {
                throw new \Exception('Erreur lors de la creation du soins patient');
            }

            foreach ($selectionsSoins as $value) {

                $adds = new sp_soins();
                $adds->soinsinfirmier_id = $value['id'];
                $adds->montant = number_format($value['montant'], 0, ',', '.');
                $adds->soinspatient_id = $add->id;

                if (!$adds->save()) {
                    throw new \Exception('Erreur');
                }
            }

            foreach ($selectionsProduits as $value) {

                $qu = produit::find($value['id']);
                if ($qu && $qu->quantite >= $value['quantite']) {
                    
                    $qu->quantite -= $value['quantite'];

                    if (!$qu->save()) {
                        throw new \Exception('Erreur lors de la mise à jour de la quantité du produit');
                    }

                }else{
                    throw new \Exception('Quantité insuffisante pour le produit : ' . $qu->nom);
                }

                $addp = new sp_produit();
                $addp->produit_id = $value['id'];
                $addp->quantite = $value['quantite'];
                $addp->montant = number_format($value['montant'], 0, ',', '.');
                $addp->soinspatient_id = $add->id;

                if (!$addp->save()) {
                    throw new \Exception('Erreur');
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (Exception $e) {

            DB::rollback();
            return response()->json(['error' => true]);
        }
    }

    public function examen_new(Request $request)
    {
        // Vérification de l'existence d'un enregistrement avec le même nom et acte_id
        $verf = typeacte::where('nom', '=', $request->nom)
                        ->where('acte_id', '=', $request->id)
                        ->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        // Ajouter un nouvel enregistrement si la combinaison (nom, acte_id) n'existe pas
        $add = new typeacte();
        $add->nom = $request->nom;
        $add->cotation = $request->cotation;
        $add->valeur = $request->valeur;
        $add->prix = $request->prix;
        $add->montant = $request->montant;
        $add->acte_id = $request->id;

        if ($add->save()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function new_examend(Request $request)
    {
        $selections = $request->input('selectionsExamen');
        if (!is_array($selections) || empty($selections)) {
            return response()->json(['json' => true]);
        }

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
        ->where('patients.matricule', '=', $request->matricule)
        ->select('patients.*', 'assurances.nom as assurance')
        ->first();

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        if (!$patient) {
            return response()->json(['error' => true]);
        }

        $acte = acte::find($request->acte_id);

        if (!$acte) {
            return response()->json(['error' => true]);
        }

        $code = $this->generateUniqueMatricule();

        $codeFac = $this->generateUniqueFacture();

        DB::beginTransaction();

        try {

            $fac = new facture();
            $fac->code = $codeFac;
            $fac->statut = 'impayer';

            if (!$fac->save()) {
                throw new \Exception('Erreur');
            }

            $verf = examen::where('num_bon', '=', $request->numcode)->exists();

            if ($verf) {
                return response()->json(['existe' => true]);
            }

            $add = new examen();
            $add->code = $code;
            $add->statut = 'en cours';
            $add->num_bon = $request->numcode;
            $add->part_patient = $request->montantP;
            $add->part_assurance = $request->montantA;
            $add->montant = $request->montantT;
            $add->libelle = '';
            $add->facture_id = $fac->id;
            $add->patient_id = $patient->id;
            $add->acte_id = $acte->id;
            $add->medecin = $request->medecin;
            $add->prelevement = $request->montant_pre;

            if (!$add->save()) {
                throw new \Exception('Erreur');
            }

            foreach ($selections as $value) {

                $adds = new examenpatient();
                $adds->typeacte_id = $value['id'];
                $adds->accepte = $value['accepte'];
                $adds->examen_id = $add->id;

                if (!$adds->save()) {
                    throw new \Exception('Erreur');
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (Exception $e) {

            DB::rollback();
            return response()->json(['error' => true]);
        }
    }

    public function new_horaire(Request $request)
    {
        $selections = $request->input('selections');
        if (!is_array($selections) || empty($selections)) {
            return response()->json(['json' => true]);
        }

        $user = user::find($request->medecin_id);

        if (!$user) {
            return response()->json(['error' => true]);
        }

        DB::beginTransaction();

        try {

            foreach ($selections as $value) {

                $adds = new programmemedecin();
                $adds->periode = $value['periode'];
                $adds->statut = 'oui';
                $adds->heure_debut = $value['heure_debut'];
                $adds->heure_fin = $value['heure_fin'];
                $adds->jour_id = $value['jour_id'];
                $adds->user_id = $user->id;

                if (!$adds->save()) {
                    throw new \Exception('Erreur');
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (Exception $e) {

            DB::rollback();
            return response()->json(['error' => true]);
        }
    }

    public function new_rdv(Request $request)
    {
        $user = user::find($request->medecin_id);
        if (!$user) {
            return response()->json(['error' => true]);
        }

        $patient = patient::find($request->patient_id);
        if (!$patient) {
            return response()->json(['error' => true]);
        }

        $add = new rdvpatient();
        $add->user_id = $user->id;
        $add->patient_id = $patient->id;
        $add->date = $request->date;
        $add->motif = $request->motif;
        $add->statut = 'en cours';

        if ($add->save()) {
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function specialite_new(Request $request)
    {
        $verf = typeacte::where('nom', '=', $request->nom)->exists();

        if ($verf) {
            return response()->json(['existe' => true]);
        }

        $acte = acte::where('nom', '=', 'CONSULTATION')->first();

        $add = new typeacte();
        $add->nom = $request->nom;
        $add->prix = $request->prix;
        $add->acte_id = $acte->id;

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    private function formatWithPeriods($number) {
        return number_format($number, 0, '', '.');
    }

    public function new_depot_fac(Request $request)
    {
        $date1 = Carbon::createFromFormat('Y-m-d', $request->date1)->startOfDay();
        $date2 = Carbon::createFromFormat('Y-m-d', $request->date2)->endOfDay();

        $date_depot = $request->date_depot;
        $assurance_id = $request->assurance_id;

        $verf = depotfacture::join('assurances', 'assurances.id', 'depotfactures.assurance_id')
                ->where('depotfactures.assurance_id', '=', $assurance_id)
                ->where(function($query) use ($date1, $date2) {
                    $query->whereBetween(DB::raw('DATE(depotfactures.date1)'), [$date1, $date2])
                          ->orWhereBetween(DB::raw('DATE(depotfactures.date2)'), [$date1, $date2]);
                })
                ->exists();

        if ($verf)
        {
            return response()->json(['existe' => true]);
        }

        $societes = societe::all();

        $total_patient = 0;
        $total_assurance = 0;
        $total_montant = 0;

        foreach ($societes as $societe) {

            $fac_cons = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->where('patients.assurer', '=', 'oui')
                ->where('consultations.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(detailconsultations.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance_id)
                ->where('societes.id', '=', $societe->id)
                ->select(
                    'consultations.num_bon as num_bon',
                    'consultations.created_at as created_at',
                    'patients.np as patient',
                    'detailconsultations.part_assurance as part_assurance',
                    'detailconsultations.part_patient as part_patient',
                    'detailconsultations.remise as remise',
                    'detailconsultations.montant as montant',
                )
                ->get();

            foreach ($fac_cons as $value) {
                $patient = intval(str_replace('.', '', $value->part_patient));
                $remise = intval(str_replace('.', '', $value->remise));

                $total_patient += $patient + $remise;
                $total_assurance += intval(str_replace('.', '', $value->part_assurance));
                $total_montant += intval(str_replace('.', '', $value->montant));

                $value->part_patient = $this->formatWithPeriods($patient + $remise);
            }

            $fac_exam = examen::join('patients', 'patients.id', '=', 'examens.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('examens.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(examens.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance_id)
                ->where('societes.id', '=', $societe->id)
                ->select(
                    'examens.num_bon as num_bon',
                    'examens.created_at as created_at',
                    'patients.np as patient',
                    'examens.part_assurance as part_assurance',
                    'examens.part_patient as part_patient',
                    'examens.montant as montant',
                )
                ->get();

            foreach ($fac_exam as $value) {
                $total_patient += intval(str_replace('.', '', $value->part_patient));
                $total_assurance += intval(str_replace('.', '', $value->part_assurance));
                $total_montant += intval(str_replace('.', '', $value->montant));
            }

            $fac_soinsam = soinspatient::join('patients', 'patients.id', '=', 'soinspatients.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('soinspatients.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(soinspatients.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance_id)
                ->where('societes.id', '=', $societe->id)
                ->select(
                    'soinspatients.num_bon as num_bon',
                    'soinspatients.created_at as created_at',
                    'patients.np as patient',
                    'soinspatients.part_assurance as part_assurance',
                    'soinspatients.part_patient as part_patient',
                    'soinspatients.remise as remise',
                    'soinspatients.montant as montant',
                )
                ->get();

            foreach ($fac_soinsam as $value) {
                $patient = intval(str_replace('.', '', $value->part_patient));
                $remise = intval(str_replace('.', '', $value->remise));

                $total_patient += $patient + $remise;
                $total_assurance += intval(str_replace('.', '', $value->part_assurance));
                $total_montant += intval(str_replace('.', '', $value->montant));
            }

            $fac_hopital = detailhopital::join('patients', 'patients.id', '=', 'detailhopitals.patient_id')
                ->leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->leftjoin('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('detailhopitals.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(detailhopitals.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance_id)
                ->where('societes.id', '=', $societe->id)
                ->select(
                    'detailhopitals.num_bon as num_bon',
                    'detailhopitals.created_at as created_at',
                    'patients.np as patient',
                    'detailhopitals.part_assurance as part_assurance',
                    'detailhopitals.part_patient as part_patient',
                    'detailhopitals.remise as remise',
                    'detailhopitals.montant as montant',
                )
                ->get();

            foreach ($fac_hopital as $value) {
                $patient = intval(str_replace('.', '', $value->part_patient));
                $remise = intval(str_replace('.', '', $value->remise));

                $total_patient += $patient + $remise;
                $total_assurance += intval(str_replace('.', '', $value->part_assurance));
                $total_montant += intval(str_replace('.', '', $value->montant));
            }
            
        }

        if ($total_montant <= 0) {
            return response()->json(['montant_inferieur' => true]);
        }

        $add = new depotfacture();
        $add->assurance_id = $assurance_id;
        $add->date1 = $request->date1;
        $add->date2 = $request->date2;
        $add->date_depot = $date_depot;
        $add->statut = 'non';

        if ($add->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function paiement_depot_fac(Request $request, $id)
    {
        $add = depotfacture::find($id);

        if (!$add) {
            return response()->json(['non_touve' => true]);
        }

        $add->date_payer = $request->date;
        $add->type_paiement = $request->type;
        $add->num_cheque = $request->cheque;
        $add->statut = 'oui';

        if ($add->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

}
