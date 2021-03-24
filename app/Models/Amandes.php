<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amandes extends Model
{
    protected $fillable = [
      'id_participant',
      'montant',
      'raison',
    ];
}
