<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunions extends Model
{
  protected $fillable = [
      'identification',
      'presence',
      'cotisation',
      'nombre_present',
      'montant_obtenu',
      'date',
  ];
}
