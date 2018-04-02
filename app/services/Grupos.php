<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
   protected $table = 'grupo_areas';
   protected $fillable = ['id', 'nombre', 'id_empresa'];
}