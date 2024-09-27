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
use App\Models\typeadmission;
use App\Models\natureadmission;
use App\Models\detailhopital;
use App\Models\facture;
use App\Models\produit;
use App\Models\soinshopital;

class ApilistController extends Controller
{
    public function list_chambre()
    {
        $chambre = chambre::orderBy('created_at', 'desc')->get();

        return response()->json(['chambre' => $chambre]);
    }

    public function list_lit()
    {
        $lit = lit::Join('chambres', 'chambres.id', '=', 'lits.chambre_id')
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

    public function list_typeacte()
    {
        $typeacte = typeacte::join('actes', 'actes.id', '=', 'typeactes.acte_id')
                        ->orderBy('typeactes.created_at', 'desc')
                        ->select('typeactes.*', 'actes.nom as acte',)
                        ->get();

        return response()->json(['typeacte' => $typeacte]);
    }

    public function list_medecin()
    {
        $role = role::where('nom', '=', 'MEDECIN')->first();

        if ($role) {
            // Join `users` with `typemedecins` and `typeactes`
            $medecin = user::join('typemedecins', 'typemedecins.user_id', '=', 'users.id')
                            ->join('typeactes', 'typemedecins.typeacte_id', '=', 'typeactes.id')
                            ->where('users.role_id', '=', $role->id)
                            ->orderBy('users.created_at', 'desc')
                            ->select(
                                'users.*', 
                                'typeactes.nom as typeacte', 
                                'typemedecins.typeacte_id as typeacte_id'
                            )
                            ->get();

            return response()->json(['medecin' => $medecin]);
        }
    }

    public function list_cons_day()
    {
        $today = Carbon::today();

        $consultationQuery = detailconsultation::join('consultations', 'consultations.id', '=', 'detailconsultations.consultation_id')
                                    ->leftJoin('users', 'users.id', '=', 'consultations.user_id')
                                    ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                                    ->select(
                                        'detailconsultations.*',
                                        'consultations.code as code', 
                                        'patients.np as name', 
                                        'users.tel as tel', 
                                        'users.tel2 as tel2',
                                        'patients.matricule as matricule'
                                    )
                                    ->whereDate('detailconsultations.created_at', '=', $today)
                                    ->orderBy('detailconsultations.created_at', 'desc');

        $consultation = $consultationQuery->paginate(15);

        return response()->json([
            'consultation' => $consultation->items(), // Paginated data
            'pagination' => [
                'current_page' => $consultation->currentPage(),
                'last_page' => $consultation->lastPage(),
                'per_page' => $consultation->perPage(),
                'total' => $consultation->total(),
            ]
        ]);
    }

    public function list_cons()
    {
        $consultationQuery = detailconsultation::join('consultations', 'consultations.id', '=', 'detailconsultations.consultation_id')
                                    ->leftJoin('users', 'users.id', '=', 'consultations.user_id')
                                    ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                                    ->select(
                                        'detailconsultations.*',
                                        'consultations.code as code', 
                                        'patients.np as name', 
                                        'users.tel as tel', 
                                        'users.tel2 as tel2',
                                        'patients.matricule as matricule'
                                    )
                                    ->orderBy('detailconsultations.created_at', 'desc');

        $consultation = $consultationQuery->paginate(15);

        return response()->json([
            'consultation' => $consultation->items(), // Paginated data
            'pagination' => [
                'current_page' => $consultation->currentPage(),
                'last_page' => $consultation->lastPage(),
                'per_page' => $consultation->perPage(),
                'total' => $consultation->total(),
            ]
        ]);
    }

    public function list_typeadmission()
    {
        $typeadmission = typeadmission::orderBy('created_at', 'desc')->get();
        foreach ($typeadmission as $value) {
            $value->nbre = natureadmission::where('typeadmission_id', '=', $value->id)->count() ?: 0;
        }

        return response()->json(['typeadmission' => $typeadmission]);
    }

    public function list_natureadmission()
    {
        $natureadmission = natureadmission::join('typeadmissions', 'typeadmissions.id', '=', 'natureadmissions.typeadmission_id')->select('natureadmissions.*','typeadmissions.nom as typeadmission')->orderBy('created_at', 'desc')->get();

        foreach ($natureadmission as $value) {
            $value->nbre = detailhopital::where('natureadmission_id', '=', $value->id)->count() ?: 0;
        }

        return response()->json(['natureadmission' => $natureadmission]);
    }

    public function list_hopital($statut)
    {
        $hopitalQuery = detailhopital::join('natureadmissions', 'natureadmissions.id', '=', 'detailhopitals.natureadmission_id')
                                ->join('typeadmissions', 'typeadmissions.id', '=', 'natureadmissions.typeadmission_id')
                                ->join('patients', 'patients.id', '=', 'detailhopitals.patient_id')
                                ->join('users', 'users.id', '=', 'detailhopitals.user_id')
                                ->join('factures', 'factures.id','=','detailhopitals.facture_id')
                                ->select(
                                    'detailhopitals.*',
                                    'factures.statut as statut_fac',
                                    'natureadmissions.nom as nature',
                                    'typeadmissions.nom as type',
                                    'patients.np as patient',
                                    'users.name as medecin',
                                )->orderBy('detailhopitals.created_at', 'desc');

        if ($statut !== 'tous') {
            $hopitalQuery->where('detailhopitals.statut', '=', $statut);
        }

        $hopital = $hopitalQuery->paginate(15);

        return response()->json([
            'hopital' => $hopital->items(), // Paginated data
            'pagination' => [
                'current_page' => $hopital->currentPage(),
                'last_page' => $hopital->lastPage(),
                'per_page' => $hopital->perPage(),
                'total' => $hopital->total(),
            ]
        ]);
    }

    public function detail_hos($id)
    {
        $hopital = detailhopital::find($id);

        $montant = str_replace('.', '', $hopital->part_patient);
        $montant_soins = str_replace('.', '', $hopital->montant_soins);

        // Additionner les montants
        $total = $montant + $montant_soins;

        // Remettre les points pour les milliers
        $total_formatted = number_format($total, 0, '', '.');

        $hopital->total_final = $total_formatted ;

        $facture = facture::find($hopital->facture_id);

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
        ->leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
        ->where('patients.id', '=', $hopital->patient_id)
        ->select('patients.*', 'assurances.nom as assurance', 'tauxes.taux as taux')
        ->first();

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        $natureadmission = natureadmission::find($hopital->natureadmission_id);
        $typeadmission = typeadmission::find($natureadmission->typeadmission_id);

        $lit = lit::find($hopital->lit_id);
        $chambre = chambre::find($lit->chambre_id);

        $user = user::join('typemedecins', 'typemedecins.user_id', '=', 'users.id')
            ->join('typeactes', 'typeactes.id', '=', 'typemedecins.typeacte_id')
            ->where('users.id', '=', $hopital->user_id)
            ->select('users.*', 'typeactes.nom as typeacte')
            ->first();

        $produit = soinshopital::join('produits', 'produits.id', '=', 'soinshopitals.produit_id')
                            ->where('soinshopitals.detailhopital_id', '=', $hopital->id)
                            ->select(
                                'soinshopitals.*',
                                'produits.nom as nom_produit',
                                'produits.prix as prix_produit',
                            )
                            ->orderBy('soinshopitals.created_at', 'desc')
                            ->get();
        
        return response()->json([
            'hopital' => $hopital,
            'facture' => $facture,
            'patient' => $patient,
            'natureadmission' => $natureadmission,
            'typeadmission' => $typeadmission,
            'lit' => $lit,
            'chambre' => $chambre,
            'user' => $user,
            'produit' => $produit,
        ]);

    }

    public function list_produit()
    {
        $produitQuery = produit::orderBy('created_at', 'desc');

        $produit = $produitQuery->paginate(15);

        return response()->json([
            'produit' => $produit->items(), // Paginated data
            'pagination' => [
                'current_page' => $produit->currentPage(),
                'last_page' => $produit->lastPage(),
                'per_page' => $produit->perPage(),
                'total' => $produit->total(),
            ]
        ]);
    }

    public function list_produit_all()
    {
        $produit = produit::orderBy('nom', 'asc')->get();

        return response()->json(['produit' => $produit]);
    }

    public function list_patient_all($statut)
    {
        $patientQuery = patient::leftJoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                       ->leftJoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
                       ->leftJoin('societes', 'societes.id', '=', 'patients.societe_id')
                       ->select(
                            'patients.*', 
                            'assurances.nom as assurance', 
                            'tauxes.taux as taux', 
                            'societes.nom as societe')
                       ->orderBy('created_at', 'desc');

        if ($statut !== 'tous') {
            $patientQuery->where('patients.assurer', '=', $statut);
        }

        $patient = $patientQuery->paginate(15);

        foreach ($patient->items() as $value) {
            $value->age = $value->datenais ? Carbon::parse($value->datenais)->age : 0;

            $value->nbre_hos = detailhopital::where('patient_id', '=', $value->id)->count() ?: 0;
            $value->nbre_cons = consultation::where('patient_id', '=', $value->id)->count() ?: 0;
        }

        return response()->json([
            'patient' => $patient->items(), // Paginated data
            'pagination' => [
                'current_page' => $patient->currentPage(),
                'last_page' => $patient->lastPage(),
                'per_page' => $patient->perPage(),
                'total' => $patient->total(),
            ]
        ]);
    }

    public function list_cons_all()
    {

        $consultationQuery = detailconsultation::join('consultations', 'consultations.id', '=', 'detailconsultations.consultation_id')
                                    ->leftJoin('users', 'users.id', '=', 'consultations.user_id')
                                    ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                                    ->select(
                                        'detailconsultations.*',
                                        'consultations.code as code', 
                                        'patients.np as name', 
                                        'users.tel as tel', 
                                        'users.tel2 as tel2',
                                        'patients.matricule as matricule'
                                    )
                                    ->orderBy('detailconsultations.created_at', 'desc');

        $consultation = $consultationQuery->paginate(15);

        return response()->json([
            'consultation' => $consultation->items(), // Paginated data
            'pagination' => [
                'current_page' => $consultation->currentPage(),
                'last_page' => $consultation->lastPage(),
                'per_page' => $consultation->perPage(),
                'total' => $consultation->total(),
            ]
        ]);
    }

}
