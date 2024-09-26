<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soinshopital extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'quantite',
        'produit_id',
        'montant',
    ];

    public function produit()
    {
        return $this->belongsTo(produit::class, 'produit_id');
    }
}
