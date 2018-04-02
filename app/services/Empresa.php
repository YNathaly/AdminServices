<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
   protected $table = 'company_records';
   protected $fillable = ['id', 'custom_id', 'name', 'record_type'];
}
