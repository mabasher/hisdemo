<?php

namespace App\Model\Billing;

use Illuminate\Database\Eloquent\Model;

class Fninvoicechd extends Model
{
    protected $gurded = [];

    public function investigations()
    {
        return $this->hasOne('App\Model\Doctor\Dctestmst', 'test_no','item_no');
    }
}
