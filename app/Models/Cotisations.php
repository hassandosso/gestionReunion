<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisations extends Model
{
    protected $fillable = [
      'nom',
      'montant_fixe',
      'date_limite',
      'status',
    ];
}
