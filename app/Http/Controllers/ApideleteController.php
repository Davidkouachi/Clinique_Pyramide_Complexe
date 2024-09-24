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
use App\Models\typemedecin;
use App\Models\role;
use App\Models\typeadmission;
use App\Models\natureadmission;
use App\Models\detailhopital;


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

    public function delete_lit($id)
    {
        $put = lit::find($id);

        if ($put) {
            if ($put->delete()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }
        }

        return response()->json(['error' => true]);

    }

    public function delete_acte($id)
    {
        $put = acte::find($id);

        if ($put) {
            if ($put->delete()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }
        }

        return response()->json(['error' => true]);
    }

    public function delete_typeacte($id)
    {
        $put = typeacte::find($id);

        if ($put) {
            if ($put->delete()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }
        }

        return response()->json(['error' => true]);
    }

    public function delete_medecin($id)
    {
        $put1 = user::find($id);
        $put2 = typemedecin::where('user_id', '=', $id)->first();

        if ($put1 && $put2) {
            // Perform deletion
            $put2->delete(); // Delete related typemedecin entry
            $put1->delete(); // Delete user entry

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => true]);
    }

    public function delete_typeadmission($id)
    {
        $put = typeadmission::find($id);

        if ($put) {
            if ($put->delete()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }
        }

        return response()->json(['error' => true]);

    }

    public function delete_natureadmission($id)
    {
        $put = natureadmission::find($id);

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
