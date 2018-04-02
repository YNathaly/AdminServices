<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
   protected $table = 'areas';
   protected $fillable = ['id', 'nombre'];
}