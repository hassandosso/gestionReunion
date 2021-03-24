<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depenses extends Model
{
    protected $fillable = [
      'montant',
      'details',
      'id_evenement',
    ];
}
