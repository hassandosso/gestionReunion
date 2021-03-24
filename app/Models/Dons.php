<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dons extends Model
{
    protected $fillable = [
      'donateur',
      'montant',
      'details',
      'id_evenement',
      'id_cotisation',
    ];
}
