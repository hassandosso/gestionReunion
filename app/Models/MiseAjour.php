<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiseAjour extends Model
{
    protected $fillable = [
      'id_participant',
      'montant',
    ];
}
