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
use App\Models\role;

class ApisearchController extends Controller
{
    public function rech_patient(Request $request)
    {
        $patient = patient::leftJoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                       ->leftJoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
                       ->leftJoin('societes', 'societes.id', '=', 'patients.societe_id')
                       ->where('patients.matricule', '=', $request->matricule)
                       ->select(
                            'patients.*', 
                            'assurances.nom as assurance', 
                            'tauxes.taux as taux', 
                            'societes.nom as societe')
                       ->first();

        if ($patient) {
            return response()->json(['success' => true, 'patient' => $patient]);
        }else{
            return response()->json(['existep' => true]);
        }

    }

    public function refresh_num_chambre()
    {
        do {
            // Generate a random 9-digit number
            $code = random_int(100, 999); // Generates a number between 100000000 and 999999999
        } while (chambre::where('code', $code)->exists()); // Ensure uniqueness

        if ($code) {
            return response()->json(['success' => true, 'code' => $code]);
        }else{
            return response()->json(['error' => true]);
        }
        
    }

    public function refresh_num_lit()
    {
        do {
            // Generate a random 9-digit number
            $code = random_int(100, 999); // Generates a number between 100000000 and 999999999
        } while (chambre::where('code', $code)->exists()); // Ensure uniqueness

        if ($code) {
            return response()->json(['success' => true, 'code' => $code]);
        }else{
            return response()->json(['error' => true]);
        }  
    }

    public function list_chambre()
    {
        $list = chambre::all();

        return response()->json(['list' => $list]); 
    }

    public function select_acte()
    {
        $acte = acte::all();

        return response()->json(['acte' => $acte]); 
    }

    public function select_specialite()
    {
        $acte = acte::where('nom', '=', 'CONSULTATION')->first();

        $typeacte = typeacte::where('acte_id', '=', $acte->id )->get();

        return response()->json(['typeacte' => $typeacte]); 
    }

    public function select_typeacte($id)
    {
        $typeacte = typeacte::where('acte_id', '=', $id)->get();

        return response()->json(['typeacte' => $typeacte]); 
    }

}
