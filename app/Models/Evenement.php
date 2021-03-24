<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $fillable = [
      'nom',
      'lieu',
      'date',
      'budget',
      'cotisation_id',
    ];
}
