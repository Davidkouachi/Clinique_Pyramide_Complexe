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

use App\Models\user;


class authController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function deconnecter(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

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

    public function trait_login(Request $request)
    {
        $login = $request->input('login'); // L'utilisateur peut entrer soit un email, soit un numéro de téléphone
        $password = $request->input('password'); // Récupérer la valeur du champ "remember"

        // Vérifier si le login est un email ou un numéro de téléphone
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'tel';

        // Rechercher l'utilisateur par email ou téléphone avant l'authentification
        $user = user::where($fieldType, $login)->first();

        // Vérifier si l'utilisateur existe et s'il est bloqué
        if ($user && $user->lock === 'oui') {
            return redirect()->back()->with('error', 'L\'authentification a échoué. Veuillez vérifier vos informations d\'identification et réessayer.');

        }

        // Essayer de se connecter avec l'email ou le numéro de téléphone
        if (Auth::attempt([$fieldType => $login, 'password' => $password])) {

            // Effacer l'URL prévue en session pour éviter des redirections indésirables
            Session::forget('url.intended');

            return redirect()->route('index_reception');
        }

        return redirect()->back()->withInput($request->only('login'))
            ->with('error', 'L\'authentification a échoué. Veuillez vérifier vos informations d\'identification et réessayer.');
    }
}
