<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiinsertController;
use App\Http\Controllers\ApisearchController;
use App\Http\Controllers\ApilistController;
use App\Http\Controllers\ApiupdateController;
use App\Http\Controllers\ApideleteController;
use App\Http\Controllers\ApistatController;
use App\Http\Controllers\ApilistfactureController;
use App\Http\Controllers\ApilistfacturedetailController;
use App\Http\Controllers\ApiinsertfactureController;
use App\Http\Controllers\ApipdfController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/refresh-csrf', function() {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

Route::middleware(['statutchambre'])->group(function () {
	// recherche debut
	Route::get('/taux_select_patient_new', [ApiController::class, 'taux_select_patient_new']);
	Route::get('/societe_select_patient_new', [ApiController::class, 'societe_select_patient_new']);
	Route::get('/assurance_select_patient_new', [ApiController::class, 'assurance_select_patient_new']);
	// recherche fin

	// insert debut
	Route::get('/societe_new', [ApiinsertController::class, 'societe_new']);
	Route::get('/assurance_new', [ApiinsertController::class, 'assurance_new']);
	Route::get('/patient_new', [ApiinsertController::class, 'patient_new']);
	Route::get('/chambre_new', [ApiinsertController::class, 'chambre_new']);
	Route::get('/lit_new', [ApiinsertController::class, 'lit_new']);
	Route::get('/motif_cons_new', [ApiinsertController::class, 'motif_cons_new']);
	Route::get('/typeacte_cons_new', [ApiinsertController::class, 'typeacte_cons_new']);
	Route::get('/new_medecin', [ApiinsertController::class, 'new_medecin']);
	Route::get('/new_consultation', [ApiinsertController::class, 'new_consultation']);
	Route::get('/new_typeadmission', [ApiinsertController::class, 'new_typeadmission']);
	Route::get('/new_natureadmission', [ApiinsertController::class, 'new_natureadmission']);
	Route::get('/hosp_new', [ApiinsertController::class, 'hosp_new']);
	Route::get('/new_produit', [ApiinsertController::class, 'new_produit']);
	Route::get('/add_soinshopital/{id}', [ApiinsertController::class, 'add_soinshopital']);
	// insert debut

	// search debut
	Route::get('/rech_patient', [ApisearchController::class, 'rech_patient']);
	Route::get('/rech_patient_hos/{code}', [ApisearchController::class, 'rech_patient_hos']);
	Route::get('/refresh_num_chambre', [ApisearchController::class, 'refresh_num_chambre']);
	Route::get('/refresh_num_lit', [ApisearchController::class, 'refresh_num_lit']);
	Route::get('/list_chambre_select', [ApisearchController::class, 'list_chambre_select']);
	Route::get('/select_specialite', [ApisearchController::class, 'select_specialite']);
	Route::get('/select_typeacte/{id}', [ApisearchController::class, 'select_typeacte']);
	Route::get('/name_patient', [ApisearchController::class, 'name_patient']);
	Route::get('/lit_select/{id}', [ApisearchController::class, 'lit_select']);
	Route::get('/natureadmission_select/{id}', [ApisearchController::class, 'natureadmission_select']);
	// search debut

	// liste day debut
	Route::get('/list_cons_day', [ApilistController::class, 'list_cons_day']);
	Route::get('/list_cons', [ApilistController::class, 'list_cons']);
	// liste day debut

	// update debut
	Route::get('/update_chambre/{id}', [ApiupdateController::class, 'update_chambre']);
	Route::get('/update_lit/{id}', [ApiupdateController::class, 'update_lit']);
	Route::get('/update_acte/{id}', [ApiupdateController::class, 'update_acte']);
	Route::get('/update_typeacte/{id}', [ApiupdateController::class, 'update_typeacte']);
	Route::get('/update_medecin/{id}', [ApiupdateController::class, 'update_medecin']);
	Route::get('/update_typeadmission/{id}', [ApiupdateController::class, 'update_typeadmission']);
	Route::get('/update_natureadmission/{id}', [ApiupdateController::class, 'update_natureadmission']);
	Route::get('/update_produit/{id}', [ApiupdateController::class, 'update_produit']);
	Route::get('/appro_produit/{id}', [ApiupdateController::class, 'appro_produit']);
	// update debut

	// delete debut
	Route::get('/delete_chambre/{id}', [ApideleteController::class, 'delete_chambre']);
	Route::get('/delete_lit/{id}', [ApideleteController::class, 'delete_lit']);
	Route::get('/delete_acte/{id}', [ApideleteController::class, 'delete_acte']);
	Route::get('/delete_typeacte/{id}', [ApideleteController::class, 'delete_typeacte']);
	Route::get('/delete_medecin/{id}', [ApideleteController::class, 'delete_medecin']);
	Route::get('/delete_typeadmission/{id}', [ApideleteController::class, 'delete_typeadmission']);
	Route::get('/delete_natureadmission/{id}', [ApideleteController::class, 'delete_natureadmission']);
	// delete debut

	// liste debut
	Route::get('/list_acte', [ApilistController::class, 'list_acte']);
	Route::get('/list_typeacte', [ApilistController::class, 'list_typeacte']);
	Route::get('/list_user', [ApilistController::class, 'list_user']);
	Route::get('/list_medecin', [ApilistController::class, 'list_medecin']);
	Route::get('/list_chambre', [ApilistController::class, 'list_chambre']);
	Route::get('/list_lit', [ApilistController::class, 'list_lit']);
	Route::get('/list_typeadmission', [ApilistController::class, 'list_typeadmission']);
	Route::get('/list_natureadmission', [ApilistController::class, 'list_natureadmission']);
	Route::get('/list_hopital/{statut}', [ApilistController::class, 'list_hopital']);
	Route::get('/detail_hos/{id}', [ApilistController::class, 'detail_hos']);
	Route::get('/list_produit', [ApilistController::class, 'list_produit']);
	Route::get('/list_produit_all', [ApilistController::class, 'list_produit_all']);
	// liste debut

	// statistique debut
	Route::get('/statistique_reception', [ApistatController::class, 'statistique_reception']);
	Route::get('/statistique_caisse', [ApistatController::class, 'statistique_caisse']);
	Route::get('/statistique_reception_cons', [ApistatController::class, 'statistique_reception_cons']);
	Route::get('/statistique_cons', [ApistatController::class, 'statistique_cons']);
	Route::get('/getWeeklyConsultations', [ApistatController::class, 'getWeeklyConsultations']);
	Route::get('/getConsultationComparison', [ApistatController::class, 'getConsultationComparison']);
	// statistique fin

	// List facture debut
	Route::get('/list_facture_inpayer', [ApilistfactureController::class, 'list_facture_inpayer']);
	Route::get('/list_facture/{statut}', [ApilistfactureController::class, 'list_facture']);
	Route::get('/list_facture_hos', [ApilistfactureController::class, 'list_facture_hos']);
	Route::get('/list_facture_hos_all', [ApilistfactureController::class, 'list_facture_hos_all']);
	// List facture fin

	// List facture detail debut
	Route::get('/list_facture_inpayer_d/{id}', [ApilistfacturedetailController::class, 'list_facture_inpayer_d']);
	Route::get('/list_facture_hos_d/{id}', [ApilistfacturedetailController::class, 'list_facture_hos_d']);
	// List facture fin

	// paiement facture debut
	Route::get('/facture_payer/{code_fac}', [ApiinsertfactureController::class, 'facture_payer']);
	Route::get('/facture_payer_hos/{code_fac}', [ApiinsertfactureController::class, 'facture_payer_hos']);
	// paiement facture fin

	// PDF debut
	Route::get('/fiche_consultation/{code}', [ApipdfController::class, 'fiche_consultation']);
	Route::get('/facture_inpayer_cons/{id}', [ApipdfController::class, 'facture_inpayer_cons']);
	// PDF fin

});