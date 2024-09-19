<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'statut',
        'montant_verser',
        'montant_remis',
        'code',
        'date_payer',
    ];
}
