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
use App\Models\typeadmission;
use App\Models\natureadmission;
use App\Models\detailhopital;
use App\Models\facture;
use App\Models\soinsinfirmier;
use App\Models\typesoins;
use App\Models\examenpatient;
use App\Models\examen;
use App\Models\prelevement;

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

    public function rech_patient_hos($code)
    {
        $patient = patient::leftJoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                       ->leftJoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
                       ->leftJoin('societes', 'societes.id', '=', 'patients.societe_id')
                       ->where('patients.matricule', '=', $code)
                       ->select(
                            'patients.*', 
                            'assurances.nom as assurance', 
                            'tauxes.taux as taux', 
                            'societes.nom as societe')
                       ->first();

        if ($patient) {

            $verf = patient::join('detailhopitals', 'detailhopitals.patient_id', '=', 'patients.id')
                                ->join('factures', 'factures.id', '=', 'detailhopitals.facture_id')
                                ->where('patients.matricule', '=', $code)
                                ->select('patients.*','factures.statut as statut')
                                ->first();

            if ($verf && $verf->statut == 'impayer') {
                return response()->json(['existe' => true]);
            }

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

    public function list_chambre_select()
    {
        $list = chambre::all(); // Fetch all chambres
        $availableList = [];    // Array to hold filtered chambres

        foreach ($list as $value) {
            $nbre = lit::where('chambre_id', '=', $value->id)->count(); // Count the number of lits 
            
            if ($nbre < $value->nbre_lit) {
                $availableList[] = $value;
            }
        }

        // Return either the filtered list or all chambres if none were available
        return response()->json(['list' => $availableList]);
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

    public function name_patient()
    {
        $name = patient::leftJoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                       ->leftJoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
                       ->leftJoin('societes', 'societes.id', '=', 'patients.societe_id')
                       ->select(
                            'patients.*', 
                            'assurances.nom as assurance', 
                            'tauxes.taux as taux', 
                            'societes.nom as societe')
                       ->get();
                       
        return response()->json(['name' => $name]);
    }

    public function lit_select($id)
    {
        $lit = lit::join('chambres', 'chambres.id', '=', 'lits.chambre_id')->where('lits.chambre_id', '=', $id)->where('lits.statut', '=', 'disponible')->select('lits.*', 'chambres.prix as prix')->get();

        return response()->json(['lit' => $lit]); 
    }

    public function natureadmission_select($id)
    {
        $natureadmission = natureadmission::where('typeadmission_id', '=', $id)->get();

        return response()->json(['natureadmission' => $natureadmission]); 
    }

    public function select_soinsIn($id)
    {
        $soinsin = soinsinfirmier::where('typesoins_id', '=', $id)->get();

        return response()->json(['soinsin' => $soinsin]); 
    }

    public function list_acte_ex()
    {
        $acte = acte::where('nom', '=', 'ANALYSE')->Orwhere('nom', '=', 'IMAGERIE')->get();

        return response()->json(['acte' => $acte]); 
    }

    public function montant_prelevement()
    {
        $prelevement = prelevement::where('code', '=', '1')->first();

        return response()->json(['prelevement' => $prelevement]); 
    }

    public function select_examen($id)
    {
        $examen = Typeacte::where('acte_id', '=', $id)->get();

        return response()->json(['examen' => $examen]); 
    }

}
