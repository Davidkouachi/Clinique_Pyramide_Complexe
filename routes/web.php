<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;

Route::get('/', [AccueilController::class, 'index_accueil'])->name('index_accueil');

// Route::middleware(['role:ADMINISTRATEUR'])->group(function () {

// });

// Route::middleware(['auth'])->group(function () {

// });
