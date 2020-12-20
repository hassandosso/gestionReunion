<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participants extends Model
{
  protected $fillable = [
      'nom',
      'prenom',
      'surnom',
      'naissance',
      'adresse',
      'identification',
      'contact',
      'email',
      'situationmatri',
      'pere',
      'photo',
  ];
}
