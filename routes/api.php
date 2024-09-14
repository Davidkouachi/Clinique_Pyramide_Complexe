<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiinsertController;
use App\Http\Controllers\ApisearchController;
use App\Http\Controllers\ApilistController;
use App\Http\Controllers\ApiupdateController;
use App\Http\Controllers\ApideleteController;

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
// insert debut

// search debut
Route::get('/rech_patient', [ApisearchController::class, 'rech_patient']);
Route::get('/refresh_num_chambre', [ApisearchController::class, 'refresh_num_chambre']);
// search debut

// liste day debut
Route::get('/list_chambre_day', [ApilistController::class, 'list_chambre_day']);
// liste day debut

// update day debut
Route::get('/update_chambre/{id}', [ApiupdateController::class, 'update_chambre']);
// update day debut

// delete day debut
Route::get('/delete_chambre/{id}', [ApideleteController::class, 'delete_chambre']);
// delete day debut
