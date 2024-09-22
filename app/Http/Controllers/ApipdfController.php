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
use App\Models\user;
use App\Models\role;
use App\Models\typemedecin;
use App\Models\consultation;
use App\Models\detailconsultation;
use App\Models\facture;

class ApipdfController extends Controller
{
    public function fiche_consultation($code)
    {
        $consultation = consultation::join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
        ->join('factures', 'factures.id', '=', 'consultations.facture_id')
        ->where('consultations.code', '=', $code)
        ->select(
            'consultations.*',
            'detailconsultations.typeacte_id as typeacte_id',
            'detailconsultations.part_assurance as part_assurance',
            'detailconsultations.part_patient as part_patient',
            'detailconsultations.remise as remise',
            'factures.code as code_fac',
        )
        ->first();

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')->leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
        ->where('patients.id', '=', $consultation->patient_id)
        ->select('patients.*', 'assurances.nom as assurance', 'tauxes.taux as taux')
        ->first();

        if ($patient && $patient->datenais) {
            $patient->age = Carbon::parse($patient->datenais)->age;
        }

        $user = user::find($consultation->user_id);

        $typeacte = typeacte::find($consultation->typeacte_id);

        return response()->json(['patient' => $patient, 'typeacte' => $typeacte, 'user' => $user, 'consultation' => $consultation]);
    }
}
