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
use App\Models\typemedecin;
use App\Models\user;
use App\Models\role;
use App\Models\consultation;
use App\Models\detailconsultation;

class ApilistController extends Controller
{
    public function list_chambre_day()
    {
        $today = Carbon::today();
        $chambre = chambre::whereDate('created_at', $today)->orderBy('created_at', 'desc')->get();

        return response()->json(['chambre' => $chambre]);
    }

    public function list_lit_day()
    {
        $today = Carbon::today();
        $lit = lit::leftJoin('chambres', 'chambres.id', '=', 'lits.chambre_id')
                        ->whereDate('lits.created_at', $today)
                        ->orderBy('lits.created_at', 'desc')
                        ->select('lits.*', 'chambres.prix as prix', 'chambres.code as code_ch')
                        ->get();

        return response()->json(['lit' => $lit]);
    }

    public function list_acte()
    {
        $acte = acte::all();

        return response()->json(['acte' => $acte]);
    }

    public function list_typeacte()
    {
        $typeacte = typeacte::join('actes', 'actes.id', '=', 'typeactes.acte_id')
                        ->orderBy('typeactes.created_at', 'desc')
                        ->select('typeactes.*', 'actes.nom as acte',)
                        ->get();

        return response()->json(['typeacte' => $typeacte]);
    }

    public function list_medecin()
    {
        $role = role::where('nom', '=', 'MEDECIN')->first();

        if ($role) {
            // Join `users` with `typemedecins` and `typeactes`
            $medecin = user::join('typemedecins', 'typemedecins.user_id', '=', 'users.id')
                            ->join('typeactes', 'typemedecins.typeacte_id', '=', 'typeactes.id')
                            ->where('users.role_id', '=', $role->id)
                            ->orderBy('users.created_at', 'desc')
                            ->select(
                                'users.*', 
                                'typeactes.nom as typeacte', 
                                'typemedecins.typeacte_id as typeacte_id'
                            )
                            ->get();

            return response()->json(['medecin' => $medecin]);
        }
    }

    public function list_cons_day()
    {
        $today = Carbon::today();

        $consultation = detailconsultation::join('consultations', 'consultations.id', '=', 'detailconsultations.consultation_id')
                                    ->leftJoin('users', 'users.id', '=', 'consultations.user_id')
                                    ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                                    ->select(
                                        'detailconsultations.*',
                                        'consultations.code as code', 
                                        'patients.np as name', 
                                        'users.tel as tel', 
                                        'users.tel2 as tel2',
                                        'patients.matricule as matricule'
                                    )
                                    ->whereDate('detailconsultations.created_at', '=', $today)
                                    ->orderBy('detailconsultations.created_at', 'desc')
                                    ->get();
        
        return response()->json(['consultation' => $consultation]);
    }

}
