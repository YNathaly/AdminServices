<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class Puestos extends Model
{
   protected $table = 'puestos';
   protected $fillable = ['id', 'puesto'];
}