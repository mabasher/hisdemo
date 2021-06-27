<?php

namespace App\Model\Billing;

use Illuminate\Database\Eloquent\Model;

class Fntrxcode extends Model
{
    public function trxcodewiseamt()
    {
        return $this->hasMany('App\Model\Billing\Fnpatledger','trx_code_no','trx_code_no');
    }
}
