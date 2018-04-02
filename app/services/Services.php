<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
   protected $table = 'services';
   protected $fillable = ['tipo', 'subtipo','descripcion', 'comentarios', 'cantidad'];

}
