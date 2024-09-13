<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiinsertController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/refresh-csrf', function() {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

// recherche debut
Route::get('/taux_select_patient_new', [ApiController::class, 'taux_select_patient_new']);
Route::get('/societe_select_patient_new', [ApiController::class, 'societe_select_patient_new']);
// recherche fin


// insert debut
Route::get('/societe_new', [ApiinsertController::class, 'societe_new']);
// insert debut

