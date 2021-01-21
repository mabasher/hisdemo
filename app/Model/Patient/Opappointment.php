<?php

namespace App\Model\Patient;


use Illuminate\Database\Eloquent\Model;

class Opappointment extends Model
{
    protected $gurded = [];

    public function appdoctor()
    {
        return $this->belongsTo('App\Model\Doctor\Doctorinfo','doctorinfo_id');
    }

}
