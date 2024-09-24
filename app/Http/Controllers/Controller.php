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

    public function encaissement()
    {
        return view('finance.encaissement');
    }

    public function encaissement_detail($id)
    {
        return view('finance.encaissement_detail');
    }

    public function liste_caisse()
    {
        return view('finance.liste_caisse');
    }

    // --------------------------------------------------------

    public function consultation_liste()
    {
        return view('grille.consultation');
    }

    public function hospitalisation()
    {
        return view('soins_medicaux.hospitalisation.index');
    }

    public function analyse()
    {
        return view('soins_medicaux.analyse');
    }

    public function imagerie()
    {
        return view('soins_medicaux.imagerie');
    }

    public function typeadmission_new()
    {
        return view('soins_medicaux.hospitalisation.typeadmission');
    }

    public function natureadmission_new()
    {
        return view('soins_medicaux.hospitalisation.natureadmission');
    }
}
