<?php

namespace App\services;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
   protected $table = 'users';
   protected $fillable = ['nombre', 'first_name', 'last_name', 'email', 'password', 'remember_token','telephone','role','active','started_at','birthdate','position_id','function_id','div_id','subdiv_id','org_uni_id','pers_group_id','area_id','boss_id','manager_id','rfc'];
}