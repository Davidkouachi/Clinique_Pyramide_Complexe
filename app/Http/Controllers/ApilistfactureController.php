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
use App\Models\typeadmission;
use App\Models\natureadmission;
use App\Models\detailhopital;
use App\Models\facture;
use App\Models\produit;
use App\Models\soinshopital;
use App\Models\soinsinfirmier;
use App\Models\typesoins;
use App\Models\soinspatient;
use App\Models\sp_produit;
use App\Models\sp_soins;
use App\Models\examenpatient;
use App\Models\examen;
use App\Models\prelevement;

class ApilistfactureController extends Controller
{
    public function list_facture_inpayer()
    {
        $facture = consultation::join('factures', 'factures.id', '=', 'consultations.facture_id')
                            ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                            ->where('factures.statut', '=', 'impayer')
                            ->select(
                                'consultations.*',
                                'factures.code as code_fac',
                                'patients.np as name',
                                'patients.tel as tel',
                            )
                            ->orderBy('factures.created_at', 'desc')
                            ->get();               

        foreach ($facture as $value) {

            $part_patient = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(part_patient, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $part_assurance = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(part_assurance, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $montant = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $remise = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(remise, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $value->part_patient = $part_patient->total_sum ?? 0 ;
            $value->part_assurance = $part_assurance->total_sum ?? 0 ;
            $value->montant = $montant->total_sum ?? 0 ;
            $value->remise = $remise->total_sum ?? 0 ;
        }

        return response()->json([
            'data' => $facture,
        ]);
    }

    public function list_facture($date1, $date2,$statut)
    {
        $date1 = Carbon::parse($date1)->startOfDay();
        $date2 = Carbon::parse($date2)->endOfDay();
        // Fetching consultations and related facture and patient data
        $factureQuery = consultation::join('factures', 'factures.id', '=', 'consultations.facture_id')
                                    ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                                    ->whereBetween('factures.created_at', [$date1, $date2])
                                    ->select(
                                        'consultations.*',
                                        'factures.code as code_fac',
                                        'factures.statut as statut',
                                        'patients.np as name',
                                        'patients.tel as tel'
                                    )
                                    ->orderBy('factures.created_at', 'desc');
        
        // Apply status filter if not 'tous'
        if ($statut !== 'tous') {
            $factureQuery->where('factures.statut', '=', $statut);
        }

        // Apply pagination
        $facture = $factureQuery->paginate(15); // Adjust the number of items per page as needed

        // Adding additional calculations to each facture item
        foreach ($facture as $value) {

            $part_patient = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(part_patient, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $part_assurance = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(part_assurance, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $montant = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $remise = detailconsultation::where('consultation_id', '=', $value->id)
                    ->select(DB::raw('COALESCE(SUM(REPLACE(remise, ".", "") + 0), 0) as total_sum'))
                    ->first();

            $value->part_patient = $part_patient->total_sum ?? 0;
            $value->part_assurance = $part_assurance->total_sum ?? 0;
            $value->montant = $montant->total_sum ?? 0;
            $value->remise = $remise->total_sum ?? 0;
        }

        // Return paginated result with additional metadata
        return response()->json([
            'factures' => $facture->items(), // Paginated data
            'pagination' => [
                'current_page' => $facture->currentPage(),
                'last_page' => $facture->lastPage(),
                'per_page' => $facture->perPage(),
                'total' => $facture->total(),
            ]
        ]);
    }

    public function list_facture_hos()
    {
        $hopital = detailhopital::join('factures', 'factures.id','=','detailhopitals.facture_id')
                                ->where('factures.statut', '=', 'impayer')
                                ->select(
                                    'detailhopitals.*',
                                    'factures.code as code_fac',
                                )->orderBy('detailhopitals.created_at', 'desc')
                                ->get();

        return response()->json([
            'data' => $hopital,
        ]);
    }

    public function list_facture_hos_all($date1, $date2,$statut)
    {
        $date1 = Carbon::parse($date1)->startOfDay();
        $date2 = Carbon::parse($date2)->endOfDay();

        $hopitalQuery = detailhopital::join('factures', 'factures.id','=','detailhopitals.facture_id')
                                ->whereBetween('factures.created_at', [$date1, $date2])
                                ->select(
                                    'detailhopitals.*',
                                    'factures.code as code_fac',
                                    'factures.statut as statut_fac',
                                )->orderBy('detailhopitals.created_at', 'desc');

        if ($statut !== 'tous') {
            $hopitalQuery->where('factures.statut', '=', $statut);
        }

        $hopital = $hopitalQuery->paginate(15);

        return response()->json([
            'hopital' => $hopital->items(), // Paginated data
            'pagination' => [
                'current_page' => $hopital->currentPage(),
                'last_page' => $hopital->lastPage(),
                'per_page' => $hopital->perPage(),
                'total' => $hopital->total(),
            ]
        ]);
    }

    public function list_facture_soinsam()
    {
        $soinspatient = soinspatient::join('factures', 'factures.id','=','soinspatients.facture_id')
                                ->where('factures.statut', '=', 'impayer')
                                ->select(
                                    'soinspatients.*',
                                    'factures.code as code_fac',
                                    'factures.statut as statut_fac',
                                )->orderBy('soinspatients.created_at', 'desc')
                                ->get();

        foreach ($soinspatient as $value) {
            $produittotal = sp_produit::where('soinspatient_id', '=', $value->id)
                ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total'))
                ->first();

            $value->prototal = $produittotal->total ?? 0;

            $soinstotal = sp_soins::where('soinspatient_id', '=', $value->id)
                ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total'))
                ->first();

            $value->stotal = $soinstotal->total ?? 0;
        }

        return response()->json([
            'data' => $soinspatient,
        ]);
    }

    public function list_facture_soinsam_all($date1, $date2,$statut)
    {
        $date1 = Carbon::parse($date1)->startOfDay();
        $date2 = Carbon::parse($date2)->endOfDay();

        $spatientQuery = soinspatient::join('factures', 'factures.id','=','soinspatients.facture_id')
                                ->whereBetween('factures.created_at', [$date1, $date2])
                                ->select(
                                    'soinspatients.*',
                                    'factures.code as code_fac',
                                    'factures.statut as statut_fac',
                                    'factures.montant_verser as montant_verser',
                                    'factures.montant_remis as montant_remis',
                                )->orderBy('soinspatients.created_at', 'desc');
        if ($statut !== 'tous') {
            $spatientQuery->where('factures.statut', '=', $statut);
        }

        $soinspatient = $spatientQuery->paginate(15);

        foreach ($soinspatient->items() as $value) {
            $produittotal = sp_produit::where('soinspatient_id', '=', $value->id)
                ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total'))
                ->first();

            $value->prototal = $produittotal->total ?? 0;

            // Total des soins
            $soinstotal = sp_soins::where('soinspatient_id', '=', $value->id)
                ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total'))
                ->first();

            $value->stotal = $soinstotal->total ?? 0;

        }

        return response()->json([
            'soinspatient' => $soinspatient->items(), // Paginated data
            'pagination' => [
                'current_page' => $soinspatient->currentPage(),
                'last_page' => $soinspatient->lastPage(),
                'per_page' => $soinspatient->perPage(),
                'total' => $soinspatient->total(),
            ]
        ]);
    }

    public function list_facture_examen()
    {
        $examen = examen::join('factures', 'factures.id', '=', 'examens.facture_id')
                            ->join('actes', 'actes.id', '=', 'examens.acte_id')
                            ->where('factures.statut', '=', 'impayer')
                            ->select(
                                'examens.*',
                                'actes.nom as acte',
                                'factures.code as code_fac',
                                'factures.statut as statut_fac',
                            )
                            ->orderBy('created_at', 'desc')
                            ->get();

        foreach ($examen as $value) {
            $nbre = examenpatient::where('examen_id', '=', $value->id)->count();
            $value->nbre =  $nbre ?? 0;

            $partPatient = str_replace('.', '', $value->part_patient);
            $prelevement = str_replace('.', '', $value->prelevement);

            // Conversion en entier
            $partPatient = (int)$partPatient;
            $prelevement = (int)$prelevement;

            $value->total_patient = $partPatient;

            $value->part_patient = $partPatient - $prelevement;
        }

        return response()->json([
            'data' => $examen,
        ]);
    }

    public function list_facture_examen_all($date1, $date2,$statut)
    {
        $date1 = Carbon::parse($date1)->startOfDay();
        $date2 = Carbon::parse($date2)->endOfDay();
        
        $examenQuery = examen::join('factures', 'factures.id', '=', 'examens.facture_id')
                            ->join('actes', 'actes.id', '=', 'examens.acte_id')
                            ->whereBetween('factures.created_at', [$date1, $date2])
                            ->select(
                                'examens.*',
                                'actes.nom as acte',
                                'factures.code as code_fac',
                                'factures.statut as statut_fac',
                            )
                            ->orderBy('factures.created_at', 'desc');

        if ($statut !== 'tous') {
            $examenQuery->where('factures.statut', '=', $statut);
        }

        $examen = $examenQuery->paginate(15);

        foreach ($examen->items() as $value) {
            $nbre = examenpatient::where('examen_id', '=', $value->id)->count();
            $value->nbre =  $nbre ?? 0;

            $partPatient = str_replace('.', '', $value->part_patient);
            $prelevement = str_replace('.', '', $value->prelevement);

            // Conversion en entier
            $partPatient = (int)$partPatient;
            $prelevement = (int)$prelevement;

            // Calcul de la somme
            $value->total_patient = $partPatient + $prelevement;
        }

        return response()->json([
            'examen' => $examen->items(),
            'pagination' => [
                'current_page' => $examen->currentPage(),
                'last_page' => $examen->lastPage(),
                'per_page' => $examen->perPage(),
                'total' => $examen->total(),
            ]
        ]);
    }

}
