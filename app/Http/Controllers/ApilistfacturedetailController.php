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
use App\Models\role;
use App\Models\typemedecin;
use App\Models\consultation;
use App\Models\detailconsultation;
use App\Models\facture;
use App\Models\soinshopital;
use App\Models\detailhopital;

class ApilistfacturedetailController extends Controller
{
    public function list_facture_inpayer_d($id)
    {
        $factured = detailconsultation::join('consultations as c1', 'c1.id', '=', 'detailconsultations.consultation_id')
                            ->join('typeactes', 'typeactes.id', '=', 'detailconsultations.typeacte_id')
                            ->join('actes', 'actes.id', '=', 'typeactes.acte_id')
                            ->join('patients', 'patients.id', '=', 'c1.patient_id')
                            ->leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
                            ->where('c1.id', '=', $id)
                            ->select(
                                'detailconsultations.*',
                                'c1.code as code',
                                'actes.nom as nom_acte',
                                'typeactes.nom as nom_typeacte',
                                'tauxes.taux as taux',
                            )
                            ->orderBy('detailconsultations.created_at', 'desc')
                            ->get();


        $Total = detailconsultation::where('consultation_id', '=', $id)
            ->select(DB::raw('COALESCE(SUM(REPLACE(part_patient, ".", "") + 0), 0) as total_sum'))
            ->first();

        $ID = consultation::join('factures', 'factures.id', '=', 'consultations.facture_id')
                            ->where('consultations.id', '=', $id)
                            ->select(
                                'factures.code as code_fac',
                                'factures.created_at as date_fac',
                                'factures.statut as statut',
                                'factures.date_payer as date_paye',
                            )
                            ->first();

        return response()->json(['factured' => $factured, 'Total' => $Total, 'ID' => $ID]);
    }

    public function list_facture_hos_d($id)
    {
        $hos = soinshopital::find($id);

        $factured = soinshopital::join('produits', 'produits.id', '=', 'soinshopitals.produit_id')
                            ->where('soinshopitals.detailhopital_id', '=', $id)
                            ->select(
                                'soinshopitals.*',
                                'produits.nom as nom_produit',
                                'produits.prix as prix_produit',
                            )
                            ->orderBy('soinshopitals.created_at', 'desc')
                            ->get();

        return response()->json(['factured' => $factured]);
    }
}