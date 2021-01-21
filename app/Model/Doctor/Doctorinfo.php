<?php

namespace App\Model\Doctor;

use Illuminate\Database\Eloquent\Model;

class Doctorinfo extends Model
{
    protected $gurded = [];

    public function schedules()
    {
        return $this->hasMany('App\Model\Doctor\Appdayschedule');
    }
    public function days()
    {
        return $this->hasMany('App\Model\Doctor\Appdayschedule');
    }

    public function department()
    {
        return $this->hasOne('App\Model\Setup\Department', 'dept_no', 'dept_no');
    }

    public function appoints()
    {
        return $this->hasMany('App\Model\Patient\Opappointment');
    }
}
