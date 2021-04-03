<?php

namespace App\Model\Pharmacy;

use Illuminate\Database\Eloquent\Model;

class Pmpresmedicine extends Model
{
    public function presMedicine()
    {
        return $this->hasMany('App\Model\Doctor\Dctestmst', 'test_no','item_no');
    }

    public function getDose()
    {
        return $this->hasOne('App\Model\Pharmacy\Pmdaydptchange', 'rx_no','rx_no');
    }
    
    
}
