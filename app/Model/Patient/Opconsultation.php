<?php

namespace App\Model\Patient;

use Illuminate\Database\Eloquent\Model;

class Opconsultation extends Model
{
    public function consultation()
    {
        return $this->belongsTo('App\Model\Doctor\Doctorinfo','doctorinfo_id');
    }

    public function patName()
    {
        return $this->belongsTo('App\Model\Patient\Registration','reg_no','reg_no');
    }
}
