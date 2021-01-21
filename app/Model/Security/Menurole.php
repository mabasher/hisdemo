<?php

namespace App\Model\Security;

use Illuminate\Database\Eloquent\Model;

class Menurole extends Model
{
    protected $fillable = ['role_id','menu_id'];
    protected $table='menu_role';

}
