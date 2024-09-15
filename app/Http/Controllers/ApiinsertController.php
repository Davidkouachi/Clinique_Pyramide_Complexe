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

use App\Models\assurance;
use App\Models\taux;
use App\Models\societe;
use App\Models\patient;
use App\Models\chambre;
use App\Models\lit;
use App\Models\acte;
use App\Models\typeacte;

class ApiinsertController extends Controller
{
    public function societe_new(Request $request)
    {
        $name = $request->societe;

        $verf = societe::where('nom', '=', $request->societe)->first();

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

        if($request->assurer === 'oui'){
            $add->assurance_id = $request->assurance_id;
            $add->taux_id = $request->taux_id;
            $add->societe_id = $request->societe_id;
        }

        if($add->save()){
            return response()->json(['success' => true, 'matricule' => $matricule]);
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
        $add = new lit();

        $add->code = $request->num_lit;
        $add->type = $request->type;
        $add->chambre_id = $request->chambre_id;
        $add->statut = 'disponible';

        if($add->save()){
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function motif_cons_new(Request $request)
    {
        $verf = acte::where('nom', '=', $request->nom)->first();

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
        $verf = typeacte::where('nom', '=', $request->nom)->first();

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

}
