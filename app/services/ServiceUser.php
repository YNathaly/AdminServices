<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{ 
   protected $table = 'list_users_services';
   protected $fillable = ['id_solicitante', 'fecha_termino', 'seguimiento', 'id_servicio', 'descripcion', 'cant', 'empresa_resp', 'rel_responsable', 'responsable','prioridad','id_evento','fecha_evento','descripcion_evento','comentarios_evento','solicito_evento','comentarios'];

}