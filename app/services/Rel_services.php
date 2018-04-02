<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class Rel_services extends Model
{
   protected $table = 'rel_services_resp';
   protected $fillable = ['id_service','empresa_resp', 'tipo_rel_resp', 'responsable','empresa_sol', 'tipo_rel_sol', 'solicitante'];
}