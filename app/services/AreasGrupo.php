<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class AreasGrupo extends Model
{
   protected $table = 'areas_grupo_areas';
   protected $fillable = ['id', 'id_grupos_areas','id_areas'];
}