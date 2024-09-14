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

class ApideleteController extends Controller
{
    public function delete_chambre($id)
    {
        $put = chambre::find($id);

        if ($put) {
            if ($put->delete()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }
        }

        return response()->json(['error' => true]);

    }
}
