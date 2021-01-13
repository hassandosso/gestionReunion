<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procesverbals extends Model
{
  protected $fillable = [
      'id_reunion',
      'pv',
      'link',
  ];
}
