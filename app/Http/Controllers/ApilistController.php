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

}
