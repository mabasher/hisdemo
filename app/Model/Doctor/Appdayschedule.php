<?php

namespace App\Model\Doctor;

use Illuminate\Database\Eloquent\Model;

class Appdayschedule extends Model
{
    protected $gurded = [];
    
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    function doctorvisit()
    {
        return $this->belongsTo(Doctorvisit::class,'doctorvisit_id');
    }
}
