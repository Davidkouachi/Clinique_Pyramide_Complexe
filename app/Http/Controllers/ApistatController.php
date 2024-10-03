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

class ApistatController extends Controller
{
    public function statistique_reception()
    {
        $today = Carbon::today();

        $nbre_patient_day = consultation::whereDate('created_at', '=', $today)->count();

        $nbre_patient_assurer_day = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')->whereDate('consultations.created_at', '=', $today)->where('patients.assurer', '=', 'oui')->count();

        $nbre_patient_nassurer_day = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')->whereDate('consultations.created_at', '=', $today)->where('patients.assurer', '=', 'non')->count();

        // Get the total sum, ensuring it defaults to 0 if nothing is found
        $prix_cons_day = detailconsultation::whereDate('created_at', '=', $today)
            ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total_sum'))
            ->first();

        // If no result or null, default the sum to 0
        $total_sum = $prix_cons_day->total_sum ?? 0;

        return response()->json([
            'nbre_patient_day' => $nbre_patient_day,
            'nbre_patient_assurer_day' => $nbre_patient_assurer_day,
            'nbre_patient_nassurer_day' => $nbre_patient_nassurer_day,
            'prix_cons_day' => $total_sum
        ]);

    }

    public function statistique_caisse()
    {
        // Combine the queries into a single query to improve performance
        $stats = detailconsultation::select(DB::raw('
            COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as part_total,
            COALESCE(SUM(REPLACE(part_patient, ".", "") + 0), 0) as part_patient,
            COALESCE(SUM(REPLACE(part_assurance, ".", "") + 0), 0) as part_assurance
        '))->first();

        $payer = facture::where('statut', '=', 'payer')->count();
        $impayer = facture::where('statut', '=', 'impayer')->count();

        // Return the results as JSON
        return response()->json([
            'part_total' => $stats->part_total ?? 0,
            'part_patient' => $stats->part_patient ?? 0,
            'part_assurance' => $stats->part_assurance ?? 0,
            'payer' => $payer ?? 0,
            'impayer' => $impayer ?? 0,
        ]);
    }

    public function statistique_reception_cons()
    {
        $today = Carbon::today();

        $typeacte = typeacte::join('actes', 'actes.id', '=', 'typeactes.acte_id')
                            ->where('actes.nom', '=', 'CONSULTATION')
                            ->select('typeactes.*')
                            ->get();

        foreach ($typeacte as $value) {
            $stats = detailconsultation::where('typeacte_id', '=', $value->id)
                        ->whereDate('created_at', '=', $today)
                        ->select(DB::raw('
                            COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as part_total,
                            COALESCE(SUM(REPLACE(part_patient, ".", "") + 0), 0) as part_patient,
                            COALESCE(SUM(REPLACE(part_assurance, ".", "") + 0), 0) as part_assurance
                        '))
                        ->first();

            $nbre = detailconsultation::where('typeacte_id', '=', $value->id)->whereDate('created_at', '=', $today)->count();

            $value->part_patient = $stats->part_patient;
            $value->part_assurance = $stats->part_assurance;
            $value->total = $stats->part_total;
            $value->nbre = $nbre;

        }

        return response()->json(['typeacte' => $typeacte]);
    }

    public function statistique_cons()
    {
        $typeacte = typeacte::join('actes', 'actes.id', '=', 'typeactes.acte_id')
                            ->where('actes.nom', '=', 'CONSULTATION')
                            ->select('typeactes.*')
                            ->get();

        foreach ($typeacte as $value) {
            $stats = detailconsultation::where('typeacte_id', '=', $value->id)
                        ->select(DB::raw('
                            COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as part_total,
                            COALESCE(SUM(REPLACE(part_patient, ".", "") + 0), 0) as part_patient,
                            COALESCE(SUM(REPLACE(part_assurance, ".", "") + 0), 0) as part_assurance
                        '))
                        ->first();

            $nbre = detailconsultation::where('typeacte_id', '=', $value->id)->count();

            $value->part_patient = $stats->part_patient;
            $value->part_assurance = $stats->part_assurance;
            $value->total = $stats->part_total;
            $value->nbre = $nbre;

        }

        return response()->json(['typeacte' => $typeacte]);
    }

    public function getWeeklyConsultations()
    {
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Start of the week (Monday) and end of the week (Sunday)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        // Create an array to hold consultation counts for each day
        $weeklyConsultations = [];

        foreach ($daysOfWeek as $day) {
            // Get the number of consultations for the current day
            $count = consultation::whereDate('created_at', Carbon::parse($startOfWeek)->addDays(array_search($day, $daysOfWeek)))
                ->count();
            // Add the count to the array, defaulting to 0 if nothing is found
            $weeklyConsultations[] = $count ?? 0;
        }

        return response()->json($weeklyConsultations);
    }

    public function getConsultationComparison()
    {
        $currentWeekCount = $this->getWeeklyConsultations()->getData(); // Assurez-vous que cette méthode retourne le bon format
        $lastWeekCount = consultation::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();

        // Calculer le pourcentage
        $totalCurrentWeek = array_sum($currentWeekCount);
        $percentageIncrease = $totalCurrentWeek > 0 ? (($totalCurrentWeek - $lastWeekCount) / $lastWeekCount) * 100 : 0;

        return response()->json([
            'currentWeek' => $totalCurrentWeek,
            'lastWeek' => $lastWeekCount,
            'percentage' => round($percentageIncrease, 2),
        ]);
    }

    public function statistique_hos()
    {
        $today = Carbon::today();
        // Combine the queries into a single query to improve performance
        $stat_hos_day = detailhopital::whereDate('created_at', '=', $today)->count();

        // Return the results as JSON
        return response()->json([
            'stat_hos_day' => $stat_hos_day ?? 0,
        ]);
    }

    public function statistique_soinsam()
    {
        $today = Carbon::today();
        // Combine the queries into a single query to improve performance
        $stat_soinsam_day = soinspatient::whereDate('created_at', '=', $today)->count();

        // Return the results as JSON
        return response()->json([
            'stat_soinsam_day' => $stat_soinsam_day ?? 0,
        ]);
    }

    public function statistique_examen()
    {
        $today = Carbon::today();
        $ida = acte::where('nom', '=', 'ANALYSE')->first();
        $idi = acte::where('nom', '=', 'IMAGERIE')->first();

        $imagerie_day = examen::where('acte_id', '=', $idi->id)
                            ->whereDate('created_at', '=', $today)
                            ->count();

        $analyse_day = examen::where('acte_id', '=', $ida->id)
                            ->whereDate('created_at', '=', $today)
                            ->count();

        // Return the results as JSON
        return response()->json([
            'nbre_analyse_day' => $analyse_day ?? 0,
            'nbre_imagerie_day' => $imagerie_day ?? 0,
        ]);
    }

}
