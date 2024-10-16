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

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        $user = user::find($consultation->user_id);

        $typeacte = typeacte::find($consultation->typeacte_id);

        return response()->json(['patient' => $patient, 'typeacte' => $typeacte, 'user' => $user, 'consultation' => $consultation]);
    }

    public function facture_inpayer_cons($id)
    {
        $consultation = consultation::join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
        ->join('factures', 'factures.id', '=', 'consultations.facture_id')
        ->where('consultations.id', '=', $id)
        ->select(
            'consultations.*',
            'detailconsultations.typeacte_id as typeacte_id',
            'detailconsultations.part_assurance as part_assurance',
            'detailconsultations.part_patient as part_patient',
            'detailconsultations.remise as remise',
            'factures.code as code_fac',
            'factures.date_payer as date_paye',
            'factures.montant_verser as montant_verser',
            'factures.montant_remis as montant_remis',
            'factures.statut as statut_fac',
            'factures.date_payer as date_payer',
        )
        ->first();

        // Convert string amounts to integers by removing '.' and convert them to numbers
        $total_amount = intval(str_replace('.', '', $consultation->montant_verser));
        $paid_amount = intval(str_replace('.', '', $consultation->part_patient));
        $remis_amount = intval(str_replace('.', '', $consultation->montant_remis));
        // Calculate the remaining amount
        $remaining_amount = $total_amount - ($paid_amount + $remis_amount);
        // Function to format numbers with '.' after every 3 digits
        function formatWithPeriods($number) {
            return number_format($number, 0, '', '.');
        }
        // Format the remaining amount with periods and assign to 'montant_restant'
        $consultation->montant_restant = formatWithPeriods($remaining_amount);

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')->leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
        ->where('patients.id', '=', $consultation->patient_id)
        ->select('patients.*', 'assurances.nom as assurance', 'tauxes.taux as taux')
        ->first();

        if ($patient) {
            $patient->age = Carbon::parse($patient->datenais)->age;
        }

        $user = user::find($consultation->user_id);

        $typeacte = typeacte::find($consultation->typeacte_id);

        return response()->json(['patient' => $patient, 'typeacte' => $typeacte, 'user' => $user, 'consultation' => $consultation]);
    }

    private function formatWithPeriods($number) {
        return number_format($number, 0, '', '.');
    }

    public function imp_fac_assurance(Request $request)
    {

        $date1 = Carbon::createFromFormat('Y-m-d', $request->date1)->startOfDay();
        $date2 = Carbon::createFromFormat('Y-m-d', $request->date2)->endOfDay(); 

        $assurance = assurance::find($request->assurance_id);

        $societes = societe::all();
        $result = [];

        foreach ($societes as $key => $societe) {

            $fac_cons = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->where('patients.assurer', '=', 'oui')
                ->where('consultations.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(consultations.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $request->assurance_id)
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

                $total = $patient + $remise;
                $value->part_patient = $this->formatWithPeriods($total);
                // $value->acte = 'CONSULTATION';
            }

            $fac_exam = examen::join('patients', 'patients.id', '=', 'examens.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('examens.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(examens.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $request->assurance_id)
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

            $fac_soinsam = soinspatient::join('patients', 'patients.id', '=', 'soinspatients.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('soinspatients.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(soinspatients.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $request->assurance_id)
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

                $total = $patient + $remise;

                $value->part_patient = $this->formatWithPeriods($total);
            }

            $fac_hopital = detailhopital::join('patients', 'patients.id', '=', 'detailhopitals.patient_id')
                ->leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->leftjoin('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('detailhopitals.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(detailhopitals.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $request->assurance_id)
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

                $total = $patient + $remise;

                $value->part_patient = $this->formatWithPeriods($total);
            }

            if ($fac_cons->isNotEmpty() || $fac_exam->isNotEmpty() || $fac_soinsam->isNotEmpty() || $fac_hopital->isNotEmpty()) {
                $societe->fac_cons = $fac_cons;
                $societe->fac_exam = $fac_exam;
                $societe->fac_soinsam = $fac_soinsam;
                $societe->fac_hopital = $fac_hopital;
                $result[] = $societe;
            }
        }

        return response()->json([
            'societes' => $result,
            'assurance' => $assurance,
            'date1' => $date1,
            'date2' => $date2,
        ]);
    }

    public function imp_fac_assurance_bordo(Request $request)
    {
        $date1 = Carbon::createFromFormat('Y-m-d', $request->date1)->startOfDay();
        $date2 = Carbon::createFromFormat('Y-m-d', $request->date2)->endOfDay(); 

        $assurance = assurance::find($request->assurance_id);

        $societes = societe::all();
        $result = [];

        // Initialisation des totaux
        $total_patient = 0;
        $total_assurance = 0;
        $total_montant = 0;

        foreach ($societes as $key => $societe) {

            $fac_cons = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->where('patients.assurer', '=', 'oui')
                ->where('consultations.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(consultations.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $request->assurance_id)
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
                ->where('assurances.id', '=', $request->assurance_id)
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
                ->where('assurances.id', '=', $request->assurance_id)
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
                ->where('assurances.id', '=', $request->assurance_id)
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

            // Si la société a des données à afficher, on les ajoute dans le résultat
            if ($fac_cons->isNotEmpty() || $fac_exam->isNotEmpty() || $fac_soinsam->isNotEmpty() || $fac_hopital->isNotEmpty()) {
                
                $societe->fac_cons = $fac_cons;
                $societe->fac_exam = $fac_exam;
                $societe->fac_soinsam = $fac_soinsam;
                $societe->fac_hopital = $fac_hopital;

                // Ajout des totaux dans l'objet société
                $societe->total_patient = $this->formatWithPeriods($total_patient);
                $societe->total_assurance = $this->formatWithPeriods($total_assurance);
                $societe->total_montant = $this->formatWithPeriods($total_montant);

                $result[] = $societe;
            }
        }

        return response()->json([
            'societes' => $result,
            'assurance' => $assurance,
            'date1' => $date1,
            'date2' => $date2,
        ]);
    }

    public function imp_fac_depot($id)
    {
        $fac = depotfacture::find($id);

        $date1 = Carbon::createFromFormat('Y-m-d', $fac->date1)->startOfDay();
        $date2 = Carbon::createFromFormat('Y-m-d', $fac->date2)->endOfDay(); 

        $assurance = assurance::find($fac->assurance_id);

        $societes = societe::all();
        $result = [];

        foreach ($societes as $key => $societe) {

            $fac_cons = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->where('patients.assurer', '=', 'oui')
                ->where('consultations.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(consultations.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance->id)
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

                $total = $patient + $remise;
                $value->part_patient = $this->formatWithPeriods($total);
            }

            $fac_exam = examen::join('patients', 'patients.id', '=', 'examens.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('examens.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(examens.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance->id)
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

            $fac_soinsam = soinspatient::join('patients', 'patients.id', '=', 'soinspatients.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('soinspatients.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(soinspatients.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance->id)
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

                $total = $patient + $remise;

                $value->part_patient = $this->formatWithPeriods($total);
            }

            $fac_hopital = detailhopital::join('patients', 'patients.id', '=', 'detailhopitals.patient_id')
                ->leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->leftjoin('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('detailhopitals.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(detailhopitals.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance->id)
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

                $total = $patient + $remise;

                $value->part_patient = $this->formatWithPeriods($total);
            }

            if ($fac_cons->isNotEmpty() || $fac_exam->isNotEmpty() || $fac_soinsam->isNotEmpty() || $fac_hopital->isNotEmpty()) {
                $societe->fac_cons = $fac_cons;
                $societe->fac_exam = $fac_exam;
                $societe->fac_soinsam = $fac_soinsam;
                $societe->fac_hopital = $fac_hopital;
                $result[] = $societe;
            }
        }

        return response()->json([
            'societes' => $result,
            'assurance' => $assurance,
            'date1' => $date1,
            'date2' => $date2,
        ]);
    }

    public function imp_fac_depot_bordo($id)
    {
        $fac = depotfacture::find($id);

        $date1 = Carbon::createFromFormat('Y-m-d', $fac->date1)->startOfDay();
        $date2 = Carbon::createFromFormat('Y-m-d', $fac->date2)->endOfDay(); 

        $assurance = assurance::find($fac->assurance_id);

        $societes = societe::all();
        $result = [];

        foreach ($societes as $key => $societe) {

            $total_patient = 0;
            $total_assurance = 0;
            $total_montant = 0;

            $fac_cons = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->where('patients.assurer', '=', 'oui')
                ->where('consultations.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(consultations.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $assurance->id)
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
                ->where('assurances.id', '=', $assurance->id)
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
                ->where('assurances.id', '=', $assurance->id)
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
                ->where('assurances.id', '=', $assurance->id)
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

            // Si la société a des données à afficher, on les ajoute dans le résultat
            if ($fac_cons->isNotEmpty() || $fac_exam->isNotEmpty() || $fac_soinsam->isNotEmpty() || $fac_hopital->isNotEmpty()) {
                
                $societe->fac_cons = $fac_cons;
                $societe->fac_exam = $fac_exam;
                $societe->fac_soinsam = $fac_soinsam;
                $societe->fac_hopital = $fac_hopital;

                // Ajout des totaux dans l'objet société
                $societe->total_patient = $this->formatWithPeriods($total_patient);
                $societe->total_assurance = $this->formatWithPeriods($total_assurance);
                $societe->total_montant = $this->formatWithPeriods($total_montant);

                $result[] = $societe;
            }
        }

        return response()->json([
            'societes' => $result,
            'assurance' => $assurance,
            'date1' => $date1,
            'date2' => $date2,
        ]);
    }

    // -------------------------------------------------------------------------

    public function etat_fac_assurance(Request $request)
    {

        // Créer des dates basées sur le type de requête
        $date1 = Carbon::createFromFormat('Y-m-d', $request->date1)->startOfDay();
        $date2 = Carbon::createFromFormat('Y-m-d', $request->date2)->endOfDay();

        $datee1 = null;
        $datee2 = null;

        // Si le type est 'tous', on utilise les dates initiales
        if ($request->type === 'tous') {
            $datee1 = $date1;
            $datee2 = $date2;
        } else {
            $datee1 = $date1;
            $datee2 = $date2;
        }

        // Fonction pour récupérer les dépôts
        function getDepotResults($assurance_id, $type) {

            $query = depotfacture::selectRaw('MIN(DATE(depotfactures.date1)) as min_date, MAX(DATE(depotfactures.date2)) as max_date');

            if ($assurance_id) {
                $query->where('depotfactures.assurance_id', '=', $assurance_id);
            }

            if ($type === 'fac_deposer') {
                $query->where(function($query) {
                    $query->where('statut', '=', 'non')->orWhere('statut', '=', 'oui');
                });
            } else if ($type === 'fac_deposer_regler') {
                $query->where('statut', '=', 'oui'); 
            } else if ($type === 'fac_deposer_non_regler') {
                $query->where('statut', '=', 'non');
            } else if ($type === 'fac_regler_non_regler') {
                $query->where(function($query) {
                    $query->where('statut', '=', 'non')->orWhere('statut', '=', 'oui');
                });
            }

            return $query->first();
        }

        $depotResult = getDepotResults($request->assurance_id, $request->type);

        if ($depotResult) {

            $minDate = $depotResult->min_date;
            $maxDate = $depotResult->max_date;

            if ($minDate === null && $maxDate === null) {
                return response()->json([
                    'facture_non_trouve' => true,
                ]);
            }

            // Vérification des conditions de chevauchement
            $condition1 = ($datee1 >= $minDate && $datee1 <= $maxDate) && ($datee2 >= $maxDate);
            $condition2 = ($datee2 <= $maxDate && $datee2 >= $minDate) && ($datee1 <= $minDate);
            $condition3 = ($datee1 >= $minDate && $datee2 <= $maxDate);

            // Définir les nouvelles dates basées sur les conditions
            if ($condition1) {
                $date1 = $date1; // Reste le même
                $date2 = $maxDate;
            } else if ($condition2) {
                $date1 = $datee2; // Change pour la deuxième date
                $date2 = $minDate;
            } else if ($condition3) {
                $date1 = $date1; // Reste le même
                $date2 = $date2; // Reste le même
            } else{
                return response()->json([
                    'facture_non_trouve' => true,
                ]);
            }
        }else{
           return response()->json([
                'facture_non_trouve' => true,
            ]); 
        }

        $assurance_id = $request->assurance_id ?? null;
        $assurance = assurance::find($request->assurance_id);

        $societes = societe::all();
        $result = [];

        foreach ($societes as $key => $societe) {

            $fac_cons = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->join('factures', 'factures.id', '=', 'consultations.facture_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->where('patients.assurer', '=', 'oui')
                ->where('consultations.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(consultations.created_at)'), [$date1, $date2])
                ->where('societes.id', '=', $societe->id);

                if ($assurance_id) {
                    $fac_cons->where('assurances.id', '=', $assurance_id);
                }

                $fac_cons = $fac_cons->select(
                    'consultations.num_bon as num_bon',
                    'consultations.created_at as created_at',
                    'patients.np as patient',
                    'detailconsultations.part_assurance as part_assurance',
                    'detailconsultations.part_patient as part_patient',
                    'detailconsultations.remise as remise',
                    'detailconsultations.montant as montant',
                    'assurances.nom as assurance',
                )
                ->get();

            foreach ($fac_cons as $value) {

                $patient = intval(str_replace('.', '', $value->part_patient));
                $remise = intval(str_replace('.', '', $value->remise));

                $total = $patient + $remise;
                $value->part_patient = $this->formatWithPeriods($total);
                // $value->acte = 'CONSULTATION';
            }

            $fac_exam = examen::join('patients', 'patients.id', '=', 'examens.patient_id')
                ->join('factures', 'factures.id', '=', 'examens.facture_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('examens.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(examens.created_at)'), [$date1, $date2])
                ->where('societes.id', '=', $societe->id);

                if ($assurance_id) {
                    $fac_exam->where('assurances.id', '=', $assurance_id);
                }

                $fac_exam = $fac_exam->select(
                    'examens.num_bon as num_bon',
                    'examens.created_at as created_at',
                    'patients.np as patient',
                    'examens.part_assurance as part_assurance',
                    'examens.part_patient as part_patient',
                    'examens.montant as montant',
                    'assurances.nom as assurance',
                )
                ->get();

            $fac_soinsam = soinspatient::join('patients', 'patients.id', '=', 'soinspatients.patient_id')
                ->join('factures', 'factures.id', '=', 'soinspatients.facture_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('soinspatients.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(soinspatients.created_at)'), [$date1, $date2])
                ->where('societes.id', '=', $societe->id);

                if ($assurance_id) {
                    $fac_soinsam->where('assurances.id', '=', $assurance_id);
                }

                $fac_soinsam = $fac_soinsam->select(
                    'soinspatients.num_bon as num_bon',
                    'soinspatients.created_at as created_at',
                    'patients.np as patient',
                    'soinspatients.part_assurance as part_assurance',
                    'soinspatients.part_patient as part_patient',
                    'soinspatients.remise as remise',
                    'soinspatients.montant as montant',
                    'assurances.nom as assurance',
                )
                ->get();

            foreach ($fac_soinsam as $value) {

                $patient = intval(str_replace('.', '', $value->part_patient));
                $remise = intval(str_replace('.', '', $value->remise));

                $total = $patient + $remise;

                $value->part_patient = $this->formatWithPeriods($total);
            }

            $fac_hopital = detailhopital::join('patients', 'patients.id', '=', 'detailhopitals.patient_id')
                ->join('factures', 'factures.id', '=', 'detailhopitals.facture_id')
                ->leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->leftjoin('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('detailhopitals.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(detailhopitals.created_at)'), [$date1, $date2])
                ->where('societes.id', '=', $societe->id);

                if ($assurance_id) {
                    $fac_hopital->where('assurances.id', '=', $assurance_id);
                }

                $fac_hopital = $fac_hopital->select(
                    'detailhopitals.num_bon as num_bon',
                    'detailhopitals.created_at as created_at',
                    'patients.np as patient',
                    'detailhopitals.part_assurance as part_assurance',
                    'detailhopitals.part_patient as part_patient',
                    'detailhopitals.remise as remise',
                    'detailhopitals.montant as montant',
                    'assurances.nom as assurance',
                )
                ->get();

            foreach ($fac_hopital as $value) {

                $patient = intval(str_replace('.', '', $value->part_patient));
                $remise = intval(str_replace('.', '', $value->remise));

                $total = $patient + $remise;

                $value->part_patient = $this->formatWithPeriods($total);
            }

            if ($fac_cons->isNotEmpty() || $fac_exam->isNotEmpty() || $fac_soinsam->isNotEmpty() || $fac_hopital->isNotEmpty()) {
                $societe->fac_cons = $fac_cons;
                $societe->fac_exam = $fac_exam;
                $societe->fac_soinsam = $fac_soinsam;
                $societe->fac_hopital = $fac_hopital;
                $result[] = $societe;
            }
        }

        return response()->json([
            'societes' => $result,
            'assurance' => $assurance ?? null,
            'date1' => $date1,
            'date2' => $date2,
            'type' => $request->type,
        ]);
    }

    public function etat_fac_caisse(Request $request)
    {

        $startDate = Carbon::createFromFormat('Y-m-d', $request->date1)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->date2)->endOfDay(); 

        if (!$startDate || !$endDate) {
            return response()->json(['date_invalide' => 'Dates invalides']);
        }

        $consultations = consultation::whereBetween('created_at', [$startDate, $endDate])->count();
        $hospitalisations = detailhopital::whereBetween('created_at',[$startDate, $endDate])->count();
        $examens = examen::whereBetween('created_at', [$startDate, $endDate])->count();
        $soinsAmbulatoires = soinspatient::whereBetween('created_at',[$startDate, $endDate])->count();

        $m_cons = consultation::join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
        ->join('factures', 'factures.id', '=', 'consultations.facture_id')
        ->select(DB::raw('
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(detailconsultations.montant, ".", "") + 0 ELSE 0 END), 0) as total_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(detailconsultations.montant, ".", "") + 0 ELSE 0 END), 0) as total_impayer,
            COALESCE(SUM(REPLACE(detailconsultations.montant, ".", "") + 0), 0) as total_general,
            COALESCE(SUM(REPLACE(detailconsultations.part_assurance, ".", "") + 0), 0) as part_assurance,
            COALESCE(SUM(REPLACE(detailconsultations.part_patient, ".", "") + 0), 0) as part_patient,
            COALESCE(SUM(REPLACE(detailconsultations.remise, ".", "") + 0), 0) as remise,
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(detailconsultations.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(detailconsultations.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_impayer
        '))
        ->whereBetween('detailconsultations.created_at', [$startDate, $endDate])
        ->first();


        $m_hos = detailhopital::join('factures', 'factures.id', '=', 'detailhopitals.facture_id')
        ->select(DB::raw('
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(detailhopitals.montant, ".", "") + 0 ELSE 0 END), 0) as total_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(detailhopitals.montant, ".", "") + 0 ELSE 0 END), 0) as total_impayer,
            COALESCE(SUM(REPLACE(detailhopitals.montant, ".", "") + 0), 0) as total_general,
            COALESCE(SUM(REPLACE(detailhopitals.part_assurance, ".", "") + 0), 0) as part_assurance,
            COALESCE(SUM(REPLACE(detailhopitals.part_patient, ".", "") + 0), 0) as part_patient,
            COALESCE(SUM(REPLACE(detailhopitals.remise, ".", "") + 0), 0) as remise,
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(detailhopitals.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(detailhopitals.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_impayer
        '))
        ->whereBetween('detailhopitals.created_at', [$startDate, $endDate])
        ->first();

        $m_exam = examen::join('factures', 'factures.id', '=', 'examens.facture_id')
        ->select(DB::raw('
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(examens.montant, ".", "") + 0 ELSE 0 END), 0) as total_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(examens.montant, ".", "") + 0 ELSE 0 END), 0) as total_impayer,
            COALESCE(SUM(REPLACE(examens.montant, ".", "") + 0), 0) as total_general,
            COALESCE(SUM(REPLACE(examens.part_assurance, ".", "") + 0), 0) as part_assurance,
            COALESCE(SUM(REPLACE(examens.part_patient, ".", "") + 0), 0) as part_patient,
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(examens.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(examens.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_impayer
        '))
        ->whereBetween('examens.created_at', [$startDate, $endDate])
        ->first();

        $m_soinsam = soinspatient::join('factures', 'factures.id', '=', 'soinspatients.facture_id')
        ->select(DB::raw('
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(soinspatients.montant, ".", "") + 0 ELSE 0 END), 0) as total_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(soinspatients.montant, ".", "") + 0 ELSE 0 END), 0) as total_impayer,
            COALESCE(SUM(REPLACE(soinspatients.montant, ".", "") + 0), 0) as total_general,
            COALESCE(SUM(REPLACE(soinspatients.part_assurance, ".", "") + 0), 0) as part_assurance,
            COALESCE(SUM(REPLACE(soinspatients.part_patient, ".", "") + 0), 0) as part_patient,
            COALESCE(SUM(REPLACE(soinspatients.remise, ".", "") + 0), 0) as remise,
            COALESCE(SUM(CASE WHEN factures.statut = "payer" THEN REPLACE(soinspatients.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_payer,
            COALESCE(SUM(CASE WHEN factures.statut = "impayer" THEN REPLACE(soinspatients.part_patient, ".", "") + 0 ELSE 0 END), 0) as part_patient_impayer
        '))
        ->whereBetween('soinspatients.created_at', [$startDate, $endDate])
        ->first();

        $data = [
            'cons' => $consultations ?? 0,
            'hos' => $hospitalisations ?? 0,
            'exam' => $examens ?? 0,
            'soinsam' => $soinsAmbulatoires ?? 0,
            'm_cons' => $m_cons,
            'm_hos' => $m_hos,
            'm_exam' => $m_exam,
            'm_soinsam' => $m_soinsam,
        ];

        // -------------------------------------------------

        $fac_nbre = facture::whereBetween('created_at', [$startDate, $endDate])->count();

        $fac_total = $m_cons->total_general + $m_hos->total_general + $m_exam->total_general + $m_soinsam->total_general ;

        $fac_remise = $m_cons->remise + $m_hos->remise + $m_soinsam->remise ;

        $fac_impayer = $m_cons->total_impayer + $m_hos->total_impayer + $m_exam->total_impayer + $m_soinsam->total_impayer ;

        $fac_payer = $m_cons->total_payer + $m_hos->total_payer + $m_exam->total_payer + $m_soinsam->total_payer ;

        $fac_assurance = $m_cons->part_assurance + $m_hos->part_assurance + $m_exam->part_assurance + $m_soinsam->part_assurance ;

        $fac_patient = $m_cons->part_patient + $m_hos->part_patient + $m_exam->part_patient + $m_soinsam->part_patient ;

        $fac_patient_payer = $m_cons->part_patient_payer + $m_hos->part_patient_payer + $m_exam->part_patient_payer + $m_soinsam->part_patient_payer ;

        $fac_patient_impayer = $m_cons->part_patient_impayer + $m_hos->part_patient_impayer + $m_exam->part_patient_impayer + $m_soinsam->part_patient_impayer ;

        $fac_patient_total = $fac_patient_impayer + $fac_patient_payer;

        $dataCaisse = [
            'fac_nbre' => $fac_nbre ?? 0,
            'fac_total' => $fac_total ?? 0,
            'fac_impayer' => $fac_impayer ?? 0,
            'fac_payer' => $fac_payer ?? 0,
            'fac_assurance' => $fac_assurance ?? 0,
            'fac_patient' => $fac_patient ?? 0,
            'fac_patient_payer' => $fac_patient_payer ?? 0,
            'fac_patient_impayer' => $fac_patient_impayer ?? 0,
            'fac_patient_total' => $fac_patient_total ?? 0,
            'fac_remise' => $fac_remise ?? 0,
        ];

        if ($fac_total <= 0) {
            return response()->json(['montant_0' => true]);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'dataCaisse' => $dataCaisse,
            'date1' => $startDate,
            'date2' => $endDate,
        ]);
    }

}
