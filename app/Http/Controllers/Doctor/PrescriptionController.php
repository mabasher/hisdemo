<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Patient\Registration;
use App\Model\Patient\Opappointment;
use App\Model\Security\Menu;
use App\Model\Doctor\Doctorinfo;
use Carbon\Carbon;

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
        
        $patientPrescrip = Opappointment::with('appdoctor')->where('reg_no', $regNo)->first();
        
        return view('admin.doctor.prescription', compact(['patientPrescrip']));
    }
}
