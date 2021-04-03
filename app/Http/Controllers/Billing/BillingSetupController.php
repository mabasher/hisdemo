<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Model\Billing\Hpmsservice;
use Illuminate\Http\Request;

class BillingSetupController extends Controller
{
    public function serviceSetup()
    {
        $service = Hpmsservice::all();
        return view('admin.billing.service_setup', compact(['service']));

    }
}
