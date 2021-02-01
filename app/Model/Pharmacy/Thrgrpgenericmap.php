<?php

namespace App\Model\Pharmacy;

use Illuminate\Database\Eloquent\Model;

class Thrgrpgenericmap extends Model
{
    public function pmgeneric()
    {
        return $this->hasOne(Pmgeneric::class, 'generic_no','generic_no');
    }
}
