<?php

namespace App\Model\Prescription;

use Illuminate\Database\Eloquent\Model;

class Ehprescpoe extends Model
{
    public function dctestmst()
    {
        return $this->hasOne('App\Model\Doctor\Dctestmst', 'test_no','test_no');
    }
}
