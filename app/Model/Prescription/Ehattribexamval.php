<?php

namespace App\Model\Prescription;

use Illuminate\Database\Eloquent\Model;

class Ehattribexamval extends Model
{
    public function ehbpwlocation()
    {
        return $this->hasMany('App\Model\Prescription\Ehbpwlocation', 'location_id', 'atr_no');
    }
}
