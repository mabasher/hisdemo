<?php

namespace App\Model\Pharmacy;

use App\Model\Doctor\Dctestmst;
use Illuminate\Database\Eloquent\Model;

class Pmgeneric extends Model
{
    public function generic()
    {
        return $this->hasOne(Dctestmst::class, 'generic_no','generic_no');
    }

    public function generictherapgrp()
    {
        return $this->hasOne(Thrgrpgenericmap::class, 'generic_no','generic_no');
    }
}
