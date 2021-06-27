<?php

namespace App\Model\Billing;

use Illuminate\Database\Eloquent\Model;

class Fninvoicemst extends Model
{
    protected $gurded = [];

    public function invoicedetails()
    {
    return $this->hasMany(Fninvoicechd::class,'invoice_no','invoice_no');
    }


    public function consultation()
    {
        return $this->belongsTo('App\Model\Doctor\Doctorinfo','doctorinfo_id');
    }

    public function patientinfo()
    {
        return $this->belongsTo('App\Model\Patient\Registration','reg_no','reg_no');
    }
}

