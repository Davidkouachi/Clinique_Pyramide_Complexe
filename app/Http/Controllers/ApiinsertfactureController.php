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

class ApiinsertfactureController extends Controller
{
    public function facture_payer(Request $request,$code_fac)
    {
        DB::beginTransaction();

        $fac = facture::where('code', '=', $code_fac)->first();

        try {

            if ($fac) {

               $fac->montant_verser = $request->montant_verser;
               $fac->montant_remis = $request->montant_remis;
               $fac->statut = 'payer';
               $fac->date_payer = Carbon::now();

               if (!$fac->save()) {
                    throw new \Exception('Erreur');
                }

                $consultation = consultation::join('detailconsultations', 'detailconsultations.consultation_id', '=', 'consultations.id')
                ->join('factures', 'factures.id', '=', 'consultations.facture_id')
                ->where('factures.code', '=', $code_fac)
                ->select(
                    'consultations.*',
                    'detailconsultations.typeacte_id as typeacte_id',
                    'detailconsultations.part_assurance as part_assurance',
                    'detailconsultations.part_patient as part_patient',
                    'detailconsultations.remise as remise',
                    'factures.code as code_fac',
                    'factures.date_payer as date_paye',
                    'factures.montant_verser as montant_verser',
                    'factures.montant_remis as montant_remis',
                    'factures.statut as statut_fac',
                    'factures.date_payer as date_payer',
                )
                ->first();

                $patient = patient::leftjoin('assurances', 'assurances.id', '=', 'patients.assurance_id')->leftjoin('tauxes', 'tauxes.id', '=', 'patients.taux_id')
                ->where('patients.id', '=', $consultation->patient_id)
                ->select('patients.*', 'assurances.nom as assurance', 'tauxes.taux as taux')
                ->first();

                if ($patient && $patient->datenais) {
                    $patient->age = Carbon::parse($patient->datenais)->age;
                }

                $user = user::find($consultation->user_id);

                $typeacte = typeacte::find($consultation->typeacte_id);

                DB::commit();
                return response()->json(['success' => true, 'patient' => $patient, 'typeacte' => $typeacte, 'user' => $user, 'consultation' => $consultation]);

            }else{
                throw new \Exception('Erreur');
            }
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true]);
        }

    }

    public function facture_payer_hos(Request $request,$code_fac)
    {
        DB::beginTransaction();

        $fac = facture::where('code', '=', $code_fac)->first();

        try {

            if ($fac) {

               $fac->montant_verser = $request->montant_verser;
               $fac->montant_remis = $request->montant_remis;
               $fac->statut = 'payer';
               $fac->date_payer = Carbon::now();

                if (!$fac->save()) {
                    throw new \Exception('Erreur');
                }

                $hos = detailhopital::join('factures', 'factures.id', '=', 'detailhopitals.facture_id')
                ->where('factures.code', '=', $code_fac)
                ->select(
                    'detailhopitals.*',
                )
                ->first();
                $hos->statut = 'Liberé';
                if (!$hos->save()) {
                    throw new \Exception('Erreur');
                }

                $litm = lit::find($hos->lit_id);
                $litm->statut = 'disponible';
                if (!$litm->save()) {
                    throw new \Exception('Erreur');
                }



                // ------------------------------------------------------------

                $hopital = detailhopital::find($hos->id);

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

                // ------------------------------------------------------------

                DB::commit();
                return response()->json([
                    'success' => true,
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

            }else{
                throw new \Exception('Erreur');
            }
            
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['error' => true]);
        }

    }
}
