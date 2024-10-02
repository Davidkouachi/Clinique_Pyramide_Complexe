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
use App\Models\produit;
use App\Models\soinsinfirmier;
use App\Models\typesoins;

class ApiupdateController extends Controller
{
    public function update_chambre(Request $request, $id)
    {
        $put = chambre::find($id);

        if ($put) {
            $put->nbre_lit = $request->nbre_lit;
            $put->prix = $request->prix;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

    public function update_lit(Request $request, $id)
    {
        $put = lit::find($id);

        if ($put) {
            $put->type = $request->typeLit;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

    public function update_acte(Request $request, $id)
    {
        $put = acte::find($id);

        if ($put) {
            $put->nom = $request->nom;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

    public function update_typeacte(Request $request, $id)
    {
        $put = typeacte::find($id);

        if ($put) {
            $put->nom = $request->type;
            $put->prix = $request->prix;
            $put->acte_id = $request->acte_id;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

    public function update_medecin(Request $request, $id)
    {
        $verifications = [
            'tel' => $request->tel,
            'tel2' => $request->tel2 ?? null, // Allow tel2 to be null
            'email' => $request->email ?? null,
            'nom' => $request->nom,
        ];

        // Check if the user exists except for the current user being updated
        $Exist = user::where(function($query) use ($verifications) {
                $query->where('tel', $verifications['tel'])
                      ->orWhere(function($query) use ($verifications) {
                          if (!is_null($verifications['tel2'])) {
                              $query->where('tel2', $verifications['tel2']);
                          }
                      })
                      ->orWhere(function($query) use ($verifications) {
                          if (!is_null($verifications['email'])) {
                              $query->where('email', $verifications['email']);
                          }
                      })
                      ->orWhere(function($query) use ($verifications) {
                          if (!is_null($verifications['nom'])) {
                              $query->where('name', $verifications['nom']);
                          }
                      });
            })->where('id', '!=', $id)->first();

        // Return appropriate response based on existing data
        if ($Exist) {
            if ($Exist->tel === $verifications['tel'] || (!is_null($verifications['tel2']) && $Exist->tel2 === $verifications['tel2'])) {
                return response()->json(['tel_existe' => true]);
            } elseif ($Exist->email === $verifications['email']) {
                return response()->json(['email_existe' => true]);
            } elseif ($Exist->name === $verifications['nom']) {
                return response()->json(['nom_existe' => true]);
            }
        }

        DB::beginTransaction();

        try {
            // Update the user
            $user = user::find($id);
            $user->name = $request->nom;
            $user->email = $request->email;
            $user->sexe = $request->sexe;
            $user->tel = $request->tel;
            $user->tel2 = $request->tel2;
            $user->adresse = $request->adresse;

            if (!$user->save()) {
                throw new \Exception('Erreur lors de la mise à jour de l\'utilisateur.');
            }

            // Update the typeacte for the medecin
            $type = typemedecin::where('user_id', '=', $id)->first();
            $type->typeacte_id = $request->typeacte_id;

            if (!$type->save()) {
                throw new \Exception('Erreur lors de la mise à jour du typeacte.');
            }

            DB::commit();
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    public function update_typeadmission(Request $request, $id)
    {
        $put = typeadmission::find($id);

        if ($put) {
            $put->nom = $request->nom;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

    public function update_natureadmission(Request $request, $id)
    {
        $put = natureadmission::find($id);

        if ($put) {
            $put->nom = $request->nomModif;
            $put->typeadmission_id = $request->type_id;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

    public function update_produit(Request $request, $id)
    {
        $put = produit::find($id);

        if ($put) {
            $put->nom = $request->nom;
            $put->prix = $request->prix;
            $put->quantite = $request->quantite;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['success' => true]);
    }

    public function update_typesoins(Request $request, $id)
    {
        $put = typesoins::find($id);

        if ($put) {
            $put->nom = $request->nom;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['success' => true]);
    }

    public function update_soinIn(Request $request, $id)
    {
        $put = soinsinfirmier::find($id);

        if ($put) {
            $put->nom = $request->nomModif;
            $put->prix = $request->prix;
            $put->typesoins_id = $request->typesoins_id;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

    public function update_societe(Request $request, $id)
    {
        $put = societe::find($id);

        if ($put) {
            $put->nom = $request->nom;

            if ($put->save()) {
                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }

        }

        return response()->json(['error' => true]);
    }

}
