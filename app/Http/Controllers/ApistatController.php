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

class ApistatController extends Controller
{
    public function statistique_reception()
    {
        $today = Carbon::today();

        $nbre_patient_day = consultation::whereDate('created_at', '=', $today)->count();
        $nbre_patient_assurer_day = consultation::where('assurer', '=', 'oui')->whereDate('created_at', '=', $today)->count();
        $nbre_patient_nassurer_day = consultation::where('assurer', '=', 'non')->whereDate('created_at', '=', $today)->count();

        // Get the total sum, ensuring it defaults to 0 if nothing is found
        $prix_cons_day = consultation::whereDate('created_at', '=', $today)
            ->select(DB::raw('COALESCE(SUM(REPLACE(total, ".", "") + 0), 0) as total_sum'))
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
}
