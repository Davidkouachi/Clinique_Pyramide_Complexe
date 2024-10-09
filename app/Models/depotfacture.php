<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class depotfacture extends Model
{
    use HasFactory;

    protected $fillable =[
        'assurance_id',
        'date1',
        'date2',
        'date_depot',
        'num_cheque',
        'date_payer',
        'statut',
    ];

    public function assurance()
    {
        return $this->belongsTo(assurance::class, 'assurance_id');
    }
}
