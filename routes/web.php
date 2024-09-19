<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\assuranceController;
use App\Http\Controllers\assureurController;
use App\Http\Controllers\produitController;
use App\Http\Controllers\societeController;
use App\Http\Controllers\utilisateurController;
use App\Http\Controllers\authController;
use App\Http\Controllers\chambreController;
use App\Http\Controllers\litController;
use App\Http\Controllers\tauxController;
use App\Http\Controllers\typeproduitController;
use App\Http\Controllers\receptionController;

Route::get('/', [AccueilController::class, 'index_accueil'])->name('index_accueil');

Route::get('/Réception', [receptionController::class, 'index_reception'])->name('index_reception');

Route::get('/Login', [authController::class, 'login'])->name('login');
Route::post('/trait_auth', [authController::class, 'trait_auth'])->name('trait_auth');
Route::get('/deconnecter', [authController::class, 'deconnecter'])->name('deconnecter');
Route::get('/Mot de passe oublié', [authController::class, 'mdp_oublie_email'])->name('mdp_oublie_email');

Route::get('/Nouvelle Assurance', [assuranceController::class, 'assurance_new'])->name('assurance_new');
Route::post('/insert assurance', [assuranceController::class, 'insert_assurance'])->name('insert_assurance');
Route::post('/update assurance/{id}', [assuranceController::class, 'update_assurance'])->name('update_assurance');


Route::get('/Nouvel Assureur', [assureurController::class, 'assureur_new'])->name('assureur_new');
Route::post('/insert assureur', [assureurController::class, 'insert_assureur'])->name('insert_assureur');
Route::post('/update assureur/{id}', [assureurController::class, 'update_assureur'])->name('update_assureur');

Route::get('/Nouvel Chambre', [chambreController::class, 'chambre_new'])->name('chambre_new');
Route::post('/insert chambre', [chambreController::class, 'insert_chambre'])->name('insert_chambre');
Route::post('/update chambre/{id}', [chambreController::class, 'update_chambre'])->name('update_chambre');

Route::get('/Nouvel Lit', [litController::class, 'lit_new'])->name('lit_new');
Route::post('/insert lit', [litController::class, 'insert_lit'])->name('insert_lit');
Route::post('/update lit/{id}', [litController::class, 'update_lit'])->name('update_lit');

Route::get('/Nouvel Societe', [societeController::class, 'societe_new'])->name('societe_new');
Route::post('/insert societe', [societeController::class, 'insert_societe'])->name('insert_societe');
Route::post('/update societe/{id}', [societeController::class, 'update_societe'])->name('update_societe');

Route::get('/Nouvel Taux', [tauxController::class, 'taux_new'])->name('taux_new');
Route::post('/insert taux', [tauxController::class, 'insert_taux'])->name('insert_taux');
Route::post('/update taux/{id}', [tauxController::class, 'update_taux'])->name('update_taux');

Route::get('/Nouvel Produit', [produitController::class, 'produit_new'])->name('produit_new');
Route::post('/insert produit', [produitController::class, 'insert_produit'])->name('insert_produit');
Route::post('/update produit/{id}', [produitController::class, 'update_produit'])->name('update_produit');

Route::get('/Nouvel Type Produit', [typeproduitController::class, 'typeproduit_new'])->name('typeproduit_new');
Route::post('/insert typeproduit', [typeproduitController::class, 'insert_typeproduit'])->name('insert_typeproduit');
Route::post('/update typeproduit/{id}', [typeproduitController::class, 'update_typeproduit'])->name('update_typeproduit');

Route::get('/Acte', [Controller::class, 'acte_new'])->name('acte_new');
Route::get('/Type Acte', [Controller::class, 'typeacte_new'])->name('typeacte_new');
Route::get('/Nouvel Medecin', [utilisateurController::class, 'medecin_new'])->name('medecin_new');
Route::get('/Caisse', [Controller::class, 'encaissement'])->name('encaissement');
Route::get('/Caisse Détail/{id}', [Controller::class, 'encaissement_detail'])->name('encaissement_detail');
Route::get('/Liste Caisse', [Controller::class, 'liste_caisse'])->name('liste_caisse');

// Route::middleware(['role:ADMINISTRATEUR'])->group(function () {

// });

// Route::middleware(['auth'])->group(function () {

// });

