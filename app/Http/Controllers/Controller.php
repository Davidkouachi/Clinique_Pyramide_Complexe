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
}
