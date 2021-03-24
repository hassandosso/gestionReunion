<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paiement_cotisations extends Model
{
    protected $fillable = [
      'id_cotisation',
      'id_participant',
      'paiement',
      'dates',
    ];
}
