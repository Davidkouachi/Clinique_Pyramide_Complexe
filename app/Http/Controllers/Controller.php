<?php

namespace App\Http\Controllers;

class Controller
{
    public function acte_new()
    {
        return view('grille.acte');
    }

    public function typeacte_new()
    {
        return view('grille.typeacte');
    }

    public function encaissement_cons()
    {
        return view('finance.consultation.encaissement');
    }

    public function liste_caisse_cons()
    {
        return view('finance.consultation.liste_caisse');
    }

    public function encaissement_hos()
    {
        return view('finance.hospitalisation.encaissement');
    }

    public function liste_caisse_hos()
    {
        return view('finance.hospitalisation.liste_caisse');
    }

    // --------------------------------------------------------

    public function patient_liste()
    {
        return view('accueil.reception.patient');
    }

    public function consultation_liste()
    {
        return view('accueil.reception.consultation');
    }

    public function hospitalisation()
    {
        return view('soins_medicaux.hospitalisation.index');
    }

    public function societe_liste()
    {
        return view('accueil.reception.societe');
    }

    public function typeadmission_new()
    {
        return view('soins_medicaux.hospitalisation.typeadmission');
    }

    public function natureadmission_new()
    {
        return view('soins_medicaux.hospitalisation.natureadmission');
    }

    // --------------------------------------------------------

    public function produit_new()
    {
        return view('infirmerie.nouveau.produit_pharmacie');
    }

    // --------------------------------------------------------

    public function soinsam()
    {
        return view('soins_medicaux.soinsam.index');
    }

    public function encaissement_soinsam()
    {
        return view('finance.soinsam.encaissement');
    }

    public function liste_caisse_soinsam()
    {
        return view('finance.soinsam.liste_caisse');
    }

    public function typesoins_new()
    {
        return view('soins_medicaux.soinsam.typesoins');
    }

    public function soinsinfirmier_new()
    {
        return view('soins_medicaux.soinsam.soinsinfirmier');
    }

    // -----------------------------------------------------

    public function examen()
    {
        return view('soins_medicaux.examen.index');
    }
}
