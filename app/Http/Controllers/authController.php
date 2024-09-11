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

class authController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function deconnecter()
    {
        return redirect()->route('login');
    }

    public function trait_auth(Request $request)
    {
        return redirect()->route('index_accueil');
    }

    public function mdp_oublie_email()
    {
        return view('auth.mdp_email');
    }
}
