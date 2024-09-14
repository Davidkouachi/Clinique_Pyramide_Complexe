<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiinsertController;
use App\Http\Controllers\ApisearchController;

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
// insert debut

// search debut
Route::get('/rech_patient', [ApisearchController::class, 'rech_patient']);
// search debut

