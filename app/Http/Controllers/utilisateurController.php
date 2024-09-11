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

use App\Models\User;

class utilisateurController extends Controller
{
    public function utilisateur_new()
    {
        $today = Carbon::today();
        $users = user::whereDate('created_at', $today)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('utilisateur.nouveau.utilisateur',['users' => $users]);
    }

    public function utilisateur_new(Request $request)
    {

    }

    public function utilisateur_new(Request $request, $id)
    {

    }
}
