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
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/refresh-csrf', function() {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

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
// insert debut

// search debut
Route::get('/rech_patient', [ApisearchController::class, 'rech_patient']);
Route::get('/refresh_num_chambre', [ApisearchController::class, 'refresh_num_chambre']);
Route::get('/refresh_num_lit', [ApisearchController::class, 'refresh_num_lit']);
Route::get('/list_chambre', [ApisearchController::class, 'list_chambre']);
Route::get('/select_specialite', [ApisearchController::class, 'select_specialite']);
Route::get('/select_typeacte/{id}', [ApisearchController::class, 'select_typeacte']);
// search debut

// liste day debut
Route::get('/list_chambre_day', [ApilistController::class, 'list_chambre_day']);
Route::get('/list_lit_day', [ApilistController::class, 'list_lit_day']);
Route::get('/list_cons_day', [ApilistController::class, 'list_cons_day']);
// liste day debut

// update debut
Route::get('/update_chambre/{id}', [ApiupdateController::class, 'update_chambre']);
Route::get('/update_lit/{id}', [ApiupdateController::class, 'update_lit']);
Route::get('/update_acte/{id}', [ApiupdateController::class, 'update_acte']);
Route::get('/update_typeacte/{id}', [ApiupdateController::class, 'update_typeacte']);
Route::get('/update_medecin/{id}', [ApiupdateController::class, 'update_medecin']);
// update debut

// delete debut
Route::get('/delete_chambre/{id}', [ApideleteController::class, 'delete_chambre']);
Route::get('/delete_lit/{id}', [ApideleteController::class, 'delete_lit']);
Route::get('/delete_acte/{id}', [ApideleteController::class, 'delete_acte']);
Route::get('/delete_typeacte/{id}', [ApideleteController::class, 'delete_typeacte']);
Route::get('/delete_medecin/{id}', [ApideleteController::class, 'delete_medecin']);
// delete debut

// liste debut
Route::get('/list_acte', [ApilistController::class, 'list_acte']);
Route::get('/list_typeacte', [ApilistController::class, 'list_typeacte']);
Route::get('/list_user', [ApilistController::class, 'list_user']);
Route::get('/list_medecin', [ApilistController::class, 'list_medecin']);
// liste debut

// statistique debut
Route::get('/statistique_reception', [ApistatController::class, 'statistique_reception']);
// statistique fin