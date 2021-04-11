<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Model\Billing\Hpmsservice;
use App\Model\Doctor\Dctestmst;
use Illuminate\Http\Request;

class BillingSetupController extends Controller
{
    public function serviceSetup()
    {
        $service = Hpmsservice::where('active_flag' , 'Y')->get();
        $testinfo = Dctestmst::all();
        return view('admin.billing.service_setup', compact(['service','testinfo']));

    }

    public function serviceRateCenter($servType)
    {
        $rateCenter = Dctestmst::where('service_Type' , $servType)->get();
        return view('admin.billing.setup.service_ratecenter', compact(['rateCenter']));
    }
}
