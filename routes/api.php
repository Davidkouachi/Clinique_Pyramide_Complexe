<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/refresh-csrf', function() {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

Route::get('/taux_select_patient_new', [ApiController::class, 'taux_select_patient_new']);

