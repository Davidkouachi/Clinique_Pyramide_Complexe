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
use App\Models\soinsinfirmier;
use App\Models\typesoins;
use App\Models\soinspatient;
use App\Models\sp_produit;
use App\Models\sp_soins;
use App\Models\examenpatient;
use App\Models\examen;
use App\Models\prelevement;
use App\Models\joursemaine;
use App\Models\rdvpatient;
use App\Models\programmemedecin;
use App\Models\depotfacture;


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
                                    ->join('factures', 'factures.id', '=', 'consultations.facture_id')
                                    ->select(
                                        'detailconsultations.*',
                                        'consultations.code as code', 
                                        'factures.statut as statut_fac', 
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
                                        'users.name as medecin',
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

    public function list_typesoins()
    {
        $typesoins = typesoins::orderBy('created_at', 'desc')->get();

        return response()->json(['typesoins' => $typesoins]);
    }

    public function list_soinsIn()
    {
        $soinsin = soinsinfirmier::Join('typesoins', 'typesoins.id', '=', 'soinsinfirmiers.typesoins_id')
                        ->orderBy('soinsinfirmiers.created_at', 'desc')
                        ->select('soinsinfirmiers.*', 'typesoins.nom as nom_typesoins')
                        ->get();

        return response()->json(['soinsin' => $soinsin]);
    }

    public function list_soinsam_all($statut)
    {
        $spatientQuery = soinspatient::Join('patients', 'patients.id', '=', 'soinspatients.patient_id')
                       ->Join('typesoins', 'typesoins.id', '=', 'soinspatients.typesoins_id')
                       ->select(
                            'soinspatients.*', 
                            'patients.np as patient', 
                            'typesoins.nom as type')
                       ->orderBy('created_at', 'desc');

        if ($statut !== 'tous') {
            $spatientQuery->where('soinspatients.statut', '=', $statut);
        }

        $spatient = $spatientQuery->paginate(15);

        foreach ($spatient->items() as $value) {
            $value->nbre_soins = sp_soins::where('soinspatient_id', '=', $value->id)->count() ?: 0;
            $value->nbre_produit = sp_produit::where('soinspatient_id', '=', $value->id)->count() ?: 0;
        }

        return response()->json([
            'spatient' => $spatient->items(), // Paginated data
            'pagination' => [
                'current_page' => $spatient->currentPage(),
                'last_page' => $spatient->lastPage(),
                'per_page' => $spatient->perPage(),
                'total' => $spatient->total(),
            ]
        ]);
    }

    public function detail_soinam($id)
    {
        $soinspatient = soinspatient::find($id);

        if ($soinspatient) { 
            $produittotal = sp_produit::where('soinspatient_id', '=', $soinspatient->id)
                ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total'))
                ->first();

            $soinspatient->prototal = $produittotal->total ?? 0;

            // Total des soins
            $soinstotal = sp_soins::where('soinspatient_id', '=', $soinspatient->id)
                ->select(DB::raw('COALESCE(SUM(REPLACE(montant, ".", "") + 0), 0) as total'))
                ->first();

            $soinspatient->stotal = $soinstotal->total ?? 0;
        } 

        $facture = facture::find($soinspatient->facture_id);

        $total_amount = intval(str_replace('.', '', $facture->montant_verser));
        $paid_amount = intval(str_replace('.', '', $soinspatient->part_patient));
        $remis_amount = intval(str_replace('.', '', $facture->montant_remis));

        $remaining_amount = $total_amount - ($paid_amount + $remis_amount);

        function formatWithPeriods($number) {
        return number_format($number, 0, '', '.');
        }

        $facture->montant_restant = formatWithPeriods($remaining_amount);

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
        ->leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
        ->where('patients.id', '=', $soinspatient->patient_id)
        ->select('patients.*', 'assurances.nom as assurance', 'tauxes.taux as taux')
        ->first();

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        $typesoins = typesoins::find($soinspatient->typesoins_id);

        $soins = sp_soins::join('soinsinfirmiers', 'soinsinfirmiers.id', '=', 'sp_soins.soinsinfirmier_id')
            ->where('sp_soins.soinspatient_id', '=', $soinspatient->id)
            ->select('sp_soins.*', 'soinsinfirmiers.nom as nom_si', 'soinsinfirmiers.prix as prix_si')
            ->get();


        // Récupération des produits avec les informations associées
        $produit = sp_produit::join('produits', 'produits.id', '=', 'sp_produits.produit_id')
            ->where('sp_produits.soinspatient_id', '=', $soinspatient->id)
            ->select('sp_produits.*', 'produits.nom as nom_pro', 'produits.prix as prix_pro', 'sp_produits.quantite as quantite_pro')
            ->get();

        
        return response()->json([
            'soinspatient' => $soinspatient,
            'facture' => $facture,
            'patient' => $patient,
            'soins' => $soins,
            'produit' => $produit,
            'typesoins' => $typesoins,
        ]);
    }

    public function list_societe_all()
    {
        $societeQuery = societe::orderBy('created_at', 'desc');

        $societe = $societeQuery->paginate(15);

        return response()->json([
            'societe' => $societe->items(), // Paginated data
            'pagination' => [
                'current_page' => $societe->currentPage(),
                'last_page' => $societe->lastPage(),
                'per_page' => $societe->perPage(),
                'total' => $societe->total(),
            ]
        ]);
    }

    public function list_examen_all()
    {
        $examenQuery = typeacte::join('actes', 'actes.id', '=', 'typeactes.acte_id')
                            ->where('actes.nom', '=', 'ANALYSE')
                            ->Orwhere('actes.nom', '=', 'IMAGERIE')
                            ->select(
                                'typeactes.*',
                                'actes.nom as acte',
                            )
                            ->orderBy('created_at', 'desc');

        $examen = $examenQuery->paginate(15);

        return response()->json([
            'examen' => $examen->items(),
            'pagination' => [
                'current_page' => $examen->currentPage(),
                'last_page' => $examen->lastPage(),
                'per_page' => $examen->perPage(),
                'total' => $examen->total(),
            ]
        ]);
    }

    public function list_examend_all()
    {
        $examenQuery = examen::join('patients', 'patients.id', '=', 'examens.patient_id')
                            ->join('actes', 'actes.id', '=', 'examens.acte_id')
                            ->select(
                                'examens.*',
                                'actes.nom as acte',
                                'patients.np as patient',
                            )
                            ->orderBy('created_at', 'desc');

        $examen = $examenQuery->paginate(15);

        foreach ($examen->items() as $value) {
            $nbre = examenpatient::where('examen_id', '=', $value->id)->count();
            $value->nbre =  $nbre ?? 0;
        }

        return response()->json([
            'examen' => $examen->items(),
            'pagination' => [
                'current_page' => $examen->currentPage(),
                'last_page' => $examen->lastPage(),
                'per_page' => $examen->perPage(),
                'total' => $examen->total(),
            ]
        ]);
    }

    public function detail_examen($id)
    {
        $examen = examen::find($id);

        $facture = facture::find($examen->facture_id);

        $total_amount = intval(str_replace('.', '', $facture->montant_verser));
        $paid_amount = intval(str_replace('.', '', $examen->part_patient));
        $remis_amount = intval(str_replace('.', '', $facture->montant_remis));

        $remaining_amount = $total_amount - ($paid_amount + $remis_amount);

        function formatWithPeriods($number) {
        return number_format($number, 0, '', '.');
        }
        $facture->montant_restant = formatWithPeriods($remaining_amount);

        $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
        ->leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
        ->where('patients.id', '=', $examen->patient_id)
        ->select('patients.*', 'assurances.nom as assurance', 'tauxes.taux as taux')
        ->first();

        if ($patient) {
            $patient->age = $patient->datenais ? Carbon::parse($patient->datenais)->age : 0;
        }

        $acte = acte::find($examen->acte_id);

        $examenpatient = examenpatient::join('typeactes', 'typeactes.id', '=', 'examenpatients.typeacte_id')
                            ->where('examenpatients.examen_id', '=', $id)
                            ->select(
                                'examenpatients.*',
                                'typeactes.nom as nom_ex',
                                'typeactes.prix as prix_ex',
                                'typeactes.cotation as cotation_ex',
                                'typeactes.valeur as valeur_ex',
                                'typeactes.montant as montant_ex',
                            )
                            ->orderBy('examenpatients.created_at', 'desc')
                            ->get();

        
        return response()->json([
            'examen' => $examen,
            'facture' => $facture,
            'patient' => $patient,
            'acte' => $acte,
            'examenpatient' => $examenpatient,
        ]);
    }

    public function select_jours()
    {
        $jour = joursemaine::all();
        
        return response()->json([
            'jour' => $jour,
        ]);
    }

    public function list_horaire($medecin, $specialite, $jour, $periode)
    {
        $query = user::join('typemedecins', 'typemedecins.user_id', '=', 'users.id')
                    ->join('typeactes', 'typeactes.id', '=', 'typemedecins.typeacte_id')
                    ->where('users.role', '=', 'MEDECIN');

        // Filtrage par médecin
        if ($medecin !== 'tout') {
            $query->where('users.id', '=', $medecin);
        }

        // Filtrage par spécialité
        if ($specialite !== 'tout') {
            $query->where('typeactes.id', '=', $specialite);
        }

        $medecins = $query->select('users.*', 'typeactes.nom as specialité')->get();

        foreach ($medecins as $value) {
            $horairesQuery = programmemedecin::join('joursemaines', 'joursemaines.id', '=', 'programmemedecins.jour_id')
                                             ->where('programmemedecins.user_id', '=', $value->id)
                                             ->where('programmemedecins.statut', '=', 'oui');

            // Filtrage par jour
            if ($jour !== 'tout') {
                $horairesQuery->where('joursemaines.id', '=', $jour);
            }

            // Filtrage par période (Matin/Soir)
            if ($periode !== 'tout') {
                $horairesQuery->where('programmemedecins.periode', '=', $periode);
            }

            $horaires = $horairesQuery->select('programmemedecins.*', 'joursemaines.jour as jour')->get();
            $value->horaires = $horaires;
        }

        return response()->json([
            'medecins' => $medecins,
        ]);
    }

    public function list_rdv($statut)
    {
        $rdvQuery = rdvpatient::Join('patients', 'patients.id', '=', 'rdvpatients.patient_id')
                        ->Join('users', 'users.id', '=', 'rdvpatients.user_id')
                        ->join('typemedecins', 'typemedecins.user_id', '=', 'users.id')
                        ->join('typeactes', 'typeactes.id', '=', 'typemedecins.typeacte_id')
                        ->select(
                            'rdvpatients.*', 
                            'patients.np as patient', 
                            'users.name as medecin',
                            'typeactes.nom as specialite'
                        )
                        ->orderBy('rdvpatients.created_at', 'desc');

        if ($statut !== 'tous') {
            $rdvQuery->where('rdvpatients.statut', '=', $statut);
        }

        $rdv = $rdvQuery->paginate(15);

        foreach ($rdv->items() as $value) {
            $horaires = programmemedecin::join('joursemaines', 'joursemaines.id', '=', 'programmemedecins.jour_id')
                                    ->where('programmemedecins.user_id', '=', $value->user_id)
                                    ->where('programmemedecins.statut', '=', 'oui')
                                    ->select('programmemedecins.*', 'joursemaines.jour as jour')
                                    ->get();

            $value->horaires = $horaires;
        }

        return response()->json([
            'rdv' => $rdv->items(), // Paginated data
            'pagination' => [
                'current_page' => $rdv->currentPage(),
                'last_page' => $rdv->lastPage(),
                'per_page' => $rdv->perPage(),
                'total' => $rdv->total(),
            ]
        ]);
    }

    public function list_rdv_day()
    {
        $today = Carbon::today();

        $rdvQuery = rdvpatient::Join('patients', 'patients.id', '=', 'rdvpatients.patient_id')
                        ->Join('users', 'users.id', '=', 'rdvpatients.user_id')
                        ->join('typemedecins', 'typemedecins.user_id', '=', 'users.id')
                        ->join('typeactes', 'typeactes.id', '=', 'typemedecins.typeacte_id')
                        ->whereDate('rdvpatients.date', '=', $today)
                        ->select(
                            'rdvpatients.*', 
                            'patients.np as patient', 
                            'users.name as medecin',
                            'typeactes.nom as specialite'
                        )
                        ->orderBy('rdvpatients.created_at', 'desc');

        $rdv = $rdvQuery->paginate(15);

        foreach ($rdv->items() as $value) {
            $horaires = programmemedecin::join('joursemaines', 'joursemaines.id', '=', 'programmemedecins.jour_id')
                                    ->where('programmemedecins.user_id', '=', $value->user_id)
                                    ->where('programmemedecins.statut', '=', 'oui')
                                    ->select('programmemedecins.*', 'joursemaines.jour as jour')
                                    ->get();

            $value->horaires = $horaires;
        }

        return response()->json([
            'rdv' => $rdv->items(), // Paginated data
            'pagination' => [
                'current_page' => $rdv->currentPage(),
                'last_page' => $rdv->lastPage(),
                'per_page' => $rdv->perPage(),
                'total' => $rdv->total(),
            ]
        ]);
    }

    public function list_specialite()
    {
        $typeacte = typeacte::join('actes', 'actes.id', '=', 'typeactes.acte_id')
                        ->where('actes.nom', '=', 'CONSULTATION')
                        ->orderBy('typeactes.created_at', 'desc')
                        ->select('typeactes.*')
                        ->get();

        return response()->json(['typeacte' => $typeacte]);
    }

    private function formatWithPeriods($number) {
        return number_format($number, 0, '', '.');
    }

    public function list_depotfacture($statut)
    {

        $depotQuery = depotfacture::join('assurances', 'assurances.id', '=', 'depotfactures.assurance_id')
        ->select(
            'depotfactures.*',
            'assurances.nom as assurance',
        )
        ->orderBy('depotfactures.created_at', 'desc');

        if ($statut !== 'tous') {
            $depotQuery->where('depotfactures.statut', '=', $statut);
        }

        $depot = $depotQuery->paginate(15);

        $total_patient = 0;
        $total_assurance = 0;
        $total_montant = 0;

        foreach ($depot->items() as $depo) {

            $date1 = Carbon::parse($depo->date1)->startOfDay();
            $date2 = Carbon::parse($depo->date2)->endOfDay();

            $fac_cons = consultation::join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->where('patients.assurer', '=', 'oui')
                ->where('consultations.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(consultations.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $depo->assurance_id)
                ->select(
                    'consultations.num_bon as num_bon',
                    'consultations.created_at as created_at',
                    'patients.np as patient',
                    'detailconsultations.part_assurance as part_assurance',
                    'detailconsultations.part_patient as part_patient',
                    'detailconsultations.remise as remise',
                    'detailconsultations.montant as montant',
                )
                ->get();

            if ($fac_cons) {
                foreach ($fac_cons as $value) {
                    // Parse and ensure that invalid or missing values default to 0
                    $patient = intval(str_replace('.', '', $value->part_patient ?? 0));
                    $remise = intval(str_replace('.', '', $value->remise ?? 0));

                    // Calculate totals and ensure invalid values are counted as 0
                    $total_patient += $patient + $remise;
                    $total_assurance += intval(str_replace('.', '', $value->part_assurance ?? 0));
                    $total_montant += intval(str_replace('.', '', $value->montant ?? 0));
                }
            }else{
                $total_patient += 0;
                $total_assurance += 0;
                $total_montant += 0;
            }
            

            $fac_exam = examen::join('patients', 'patients.id', '=', 'examens.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('examens.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(examens.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $depo->assurance_id)
                ->select(
                    'examens.num_bon as num_bon',
                    'examens.created_at as created_at',
                    'patients.np as patient',
                    'examens.part_assurance as part_assurance',
                    'examens.part_patient as part_patient',
                    'examens.montant as montant',
                )
                ->get();

            if ($fac_exam) {
                foreach ($fac_exam as $value) {
                    $total_patient += intval(str_replace('.', '', $value->part_patient ?? 0));
                    $total_assurance += intval(str_replace('.', '', $value->part_assurance ?? 0));
                    $total_montant += intval(str_replace('.', '', $value->montant ?? 0));
                }
            }else{
                $total_patient += 0;
                $total_assurance += 0;
                $total_montant += 0;
            }

            $fac_soinsam = soinspatient::join('patients', 'patients.id', '=', 'soinspatients.patient_id')
                ->join('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->join('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('soinspatients.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(soinspatients.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $depo->assurance_id)
                ->select(
                    'soinspatients.num_bon as num_bon',
                    'soinspatients.created_at as created_at',
                    'patients.np as patient',
                    'soinspatients.part_assurance as part_assurance',
                    'soinspatients.part_patient as part_patient',
                    'soinspatients.remise as remise',
                    'soinspatients.montant as montant',
                )
                ->get();

            if ($fac_soinsam) {
                foreach ($fac_soinsam as $value) {
                    $patient = intval(str_replace('.', '', $value->part_patient ?? 0));
                    $remise = intval(str_replace('.', '', $value->remise ?? 0));

                    $total_patient += $patient + $remise;
                    $total_assurance += intval(str_replace('.', '', $value->part_assurance ?? 0));
                    $total_montant += intval(str_replace('.', '', $value->montant ?? 0));
                }
            }else{
                $total_patient += 0;
                $total_assurance += 0;
                $total_montant += 0;
            }

            $fac_hopital = detailhopital::join('patients', 'patients.id', '=', 'detailhopitals.patient_id')
                ->leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')
                ->leftjoin('societes', 'societes.id', '=', 'patients.societe_id')
                ->where('patients.assurer', '=', 'oui')
                ->where('detailhopitals.num_bon', '!=', null)
                ->whereBetween(DB::raw('DATE(detailhopitals.created_at)'), [$date1, $date2])
                ->where('assurances.id', '=', $depo->assurance_id)
                ->select(
                    'detailhopitals.num_bon as num_bon',
                    'detailhopitals.created_at as created_at',
                    'patients.np as patient',
                    'detailhopitals.part_assurance as part_assurance',
                    'detailhopitals.part_patient as part_patient',
                    'detailhopitals.remise as remise',
                    'detailhopitals.montant as montant',
                )
                ->get();

            if ($fac_hopital) {
                foreach ($fac_hopital as $value) {
                    $patient = intval(str_replace('.', '', $value->part_patient ?? 0));
                    $remise = intval(str_replace('.', '', $value->remise ?? 0));

                    $total_patient += $patient + $remise;
                    $total_assurance += intval(str_replace('.', '', $value->part_assurance ?? 0));
                    $total_montant += intval(str_replace('.', '', $value->montant ?? 0));
                }
            }else{
                $total_patient += 0;
                $total_assurance += 0;
                $total_montant += 0;
            }

            $depo->part_patient = $this->formatWithPeriods($total_patient);
            $depo->part_assurance = $this->formatWithPeriods($total_assurance);
            $depo->total = $this->formatWithPeriods($total_montant);
            
        }

        return response()->json([
            'depot' => $depot->items(), // Paginated data
            'pagination' => [
                'current_page' => $depot->currentPage(),
                'last_page' => $depot->lastPage(),
                'per_page' => $depot->perPage(),
                'total' => $depot->total(),
            ]
        ]);
    }

}
