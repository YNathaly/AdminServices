<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email','telephone','role','active','started_at','birthdate','position_id','function_id','div_id','subdiv_i','org_uni_id','pers_group_id','area_id','boss_id','manager_id','rfc','employee_number','type_employee','company','workstation','division','subdivision','organizational_unit','curp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
