<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Model\Doctor\Dctestmst;
use Illuminate\Http\Request;
use App\Model\Patient\Registration;
use App\Model\Patient\Opappointment;
use App\Model\Security\Menu;
use App\Model\Doctor\Doctorinfo;
use App\Model\Doctor\Theragrps;
use App\Model\Pharmacy\Pmgeneric;
use App\Model\Pharmacy\Thrgrpgenericmap;
use Carbon\Carbon;
use DB;

class PrescriptionController extends Controller
{
    public function doctorPatientCare($appDt = '')
    {
        $doctorinfo = auth()->user()->doctorinfo;
        if($doctorinfo){
        if ($appDt) {
            $date =  Carbon::parse($appDt)->toDateString();
            $doctor = auth()->user()->doctorinfo->load(['appoints' => function ($q) use ($date) {
                $q->where('app_date', $date);
            }]);
            return view('Admin.opd.doctorAppList', compact('doctor'));
        }
        
        $doctor = auth()->user()->doctorinfo->load(['appoints' => function ($q){
            $q->where('app_date', Carbon::now()->toDateString());
        }]);
            return view('admin.doctor.patient_care', compact(['doctor']));
        }

            return view('admin.doctor.patient_care_blank');  
    }

    public function doctorprescription($regNo)
    {
        $date =  Carbon::parse(Carbon::now())->toDateString();
        $patientPrescrip = Opappointment::with('appdoctor')->where('reg_no', $regNo)->where('app_date', $date)->first();
        $thrapGrp = Theragrps::all();
        $medicine = Dctestmst::where('service_type', 'M')->get();
        // $generic= Pmgeneric::all();
        $generic = Pmgeneric::with('generic:test_name,generic_no')->get();
        return view('admin.doctor.prescription', compact(['patientPrescrip','thrapGrp','medicine','generic']));
    }

    public function generictherapeutic($therpGrp)
    {
        $genericTherpGrp = Thrgrpgenericmap::with('pmgeneric')->where('thrapgrp_id',$therpGrp)->get();
        return view('admin.prescription.generic_teraputic', compact(['genericTherpGrp']));
    }
    public function genericWiseBrand($genericNo)
    {
         $brands = Dctestmst::where('generic_no',$genericNo)->get();
        return view('admin.prescription.brand', compact(['brands']));
    }
}
