<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\assuranceController;
use App\Http\Controllers\assureurController;
use App\Http\Controllers\produit_assuranceController;
use App\Http\Controllers\societe_assurerController;
use App\Http\Controllers\utilisateurController;
use App\Http\Controllers\authController;
use App\Http\Controllers\chambreController;
use App\Http\Controllers\litController;

Route::get('/', [AccueilController::class, 'index_accueil'])->name('index_accueil');

Route::get('/Login', [authController::class, 'login'])->name('login');
Route::post('/trait_auth', [authController::class, 'trait_auth'])->name('trait_auth');
Route::get('/deconnecter', [authController::class, 'deconnecter'])->name('deconnecter');
Route::get('/Mot de passe oublié', [authController::class, 'mdp_oublie_email'])->name('mdp_oublie_email');

Route::get('/Nouvelle Assurance', [assuranceController::class, 'assurance_new'])->name('assurance_new');
Route::post('/insert assurance', [assuranceController::class, 'insert_assurance'])->name('insert_assurance');
Route::post('/update assurance/{id}', [assuranceController::class, 'update_assurance'])->name('update_assurance');


Route::get('/Nouvel Utilisateur', [utilisateurController::class, 'utilisateur_new'])->name('utilisateur_new');
Route::post('/insert utilisateur', [utilisateurController::class, 'insert_utilisateur'])->name('insert_utilisateur');
Route::post('/update utilisateur/{id}', [utilisateurController::class, 'update_utilisateur'])->name('update_utilisateur');

Route::get('/Nouvel Assureur', [assureurController::class, 'assureur_new'])->name('assureur_new');
Route::post('/insert assureur', [assureurController::class, 'insert_assureur'])->name('insert_assureur');
Route::post('/update assureur/{id}', [assureurController::class, 'update_assureur'])->name('update_assureur');

Route::get('/Nouvel Chambre', [chambreController::class, 'chambre_new'])->name('chambre_new');
Route::post('/insert chambre', [chambreController::class, 'insert_chambre'])->name('insert_chambre');
Route::post('/update chambre/{id}', [chambreController::class, 'update_chambre'])->name('update_chambre');

Route::get('/Nouvel Lit', [litController::class, 'lit_new'])->name('lit_new');
Route::post('/insert lit', [litController::class, 'insert_lit'])->name('insert_lit');
Route::post('/update lit/{id}', [litController::class, 'update_lit'])->name('update_lit');

// Route::middleware(['role:ADMINISTRATEUR'])->group(function () {

// });

// Route::middleware(['auth'])->group(function () {

// });
