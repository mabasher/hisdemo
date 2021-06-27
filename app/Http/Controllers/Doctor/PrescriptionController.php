<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use PDF;
use App\Model\Doctor\Dctestmst;
use Illuminate\Http\Request;
use App\Model\Patient\Registration;
use App\Model\Patient\Opappointment;
use App\Model\Security\Menu;
use App\Model\Doctor\Doctorinfo;
use App\Model\Doctor\Theragrps;
use App\Model\Patient\Opconsultation;
use App\Model\Patient\Vitalsign;
use App\Model\Pharmacy\Mmitem;
use App\Model\Pharmacy\Pmdaydptchange;
use App\Model\Pharmacy\Pmfrequency;
use App\Model\Pharmacy\Pmgeneric;
use App\Model\Pharmacy\Pminstruction;
use App\Model\Pharmacy\Pmpresmedicine;
use App\Model\Pharmacy\Pmroutes;
use App\Model\Pharmacy\Thrgrpgenericmap;
use App\Model\Prescription\Ehattribexamval;
use App\Model\Prescription\Ehbpwlocation;
use App\Model\Prescription\Ehpatientexam;
use App\Model\Prescription\Ehprescpoe;
use Carbon\Carbon;
use DB;

class PrescriptionController extends Controller
{
    public function doctorPatientCare($appDt = '')
    {
        $doctorinfo = auth()->user()->doctorinfo;
        if ($doctorinfo) {
            if ($appDt) {
                $date =  Carbon::parse($appDt)->toDateString();
                $doctor = auth()->user()->doctorinfo->load(['appoints' => function ($q) use ($date) {
                    $q->where('app_date', $date);
                }]);
                return view('Admin.opd.doctorAppList', compact('doctor'));
            }

            $doctor = auth()->user()->doctorinfo->load(['appoints' => function ($q) {
                $q->where('app_date', Carbon::now()->toDateString());
            }]);
            return view('admin.doctor.patient_care', compact(['doctor']));
        }

        return view('admin.doctor.patient_care_blank');
    }

    //with('consultation')->
    public function doctorprescription($regNo)
    {
        $date =  Carbon::parse(Carbon::now())->toDateString();
        // $patientPrescrip = Opappointment::with('appdoctor')->where('reg_no', $regNo)->where('app_date', $date)->first();
        $patientPrescrip = Opconsultation::where('reg_no', $regNo)->where('consult_dt', $date)->first();
        $lastVisit = Opconsultation::with('consultation:id,doctor_name')->where('reg_no', $regNo)->orderBy('consult_no','desc')->skip(1)->first();
        $howTimeVisit = Opconsultation::where('reg_no', $regNo)->orderBy('consult_no','desc')->get();
        $recentVitals = Vitalsign::where('reg_no', $regNo)->orderBy('id','desc')->first();
        $recentCC = Ehpatientexam::where('reg_no', $regNo)->orderBy('id','desc')->first();
       $thrapGrp = Theragrps::all();
        $medicine = Dctestmst::where('service_type', 'M')->get();
        // $generic= Pmgeneric::all();
        $generic = Pmgeneric::with('generic:test_name,generic_no')->get();
        $frequency = Pmfrequency::all();
        $route = Pmroutes::all();
        $instruc = Pminstruction::where('act_status', 'Y')->get();

        $avatarAttributes = Ehattribexamval::addSelect(['isexist' => Ehbpwlocation::select('location_id')
        ->whereColumn('location_id', 'atr_no')
        ->where('bodypart_no', '10')
        ->where('gender', 'M')
        ->limit(1)
        ])
        ->where('parent_atr_no', '173')
        ->whereNotIn('atr_no', Ehbpwlocation::select('location_id')->where('bodypart_no', '<>','10')->where('gender','M')->get())
        ->get();

        $patMedicine =Pmpresmedicine::where('reg_no', $regNo)->where('pres_date','>', $date)->get();
        //->where('order_dt', $date)
        $patTest =Ehprescpoe::with('dctestmst')->where('reg_no', $regNo)->where('order_dt','>', $date)->get();
        return view('admin.doctor.prescription', compact(['patientPrescrip', 'thrapGrp', 'medicine', 'generic', 'frequency', 'route', 'instruc','avatarAttributes','lastVisit','howTimeVisit','recentVitals','recentCC','patMedicine','patTest']));
    }

    public function prescriptionReports($regNo)
    {
        $date =  Carbon::parse(Carbon::now())->toDateString(); 
        $presPrint = Opconsultation::where('reg_no', $regNo)->where('consult_dt', $date)->first();
        //->where('created_at', $date)
        $chiefComplaint = Ehpatientexam::where('reg_no', $regNo)->where('created_at','>', $date)->first();
        // if($chiefComplaint != ''){
        //     $cc = explode(',',$chiefComplaint->findings);
        // }else{
        //     $cc = ''; 
        // }
        $cc = explode(',',$chiefComplaint->findings);
        // ->where('pres_date', $date)
        $patMedicine =Pmpresmedicine::where('reg_no', $regNo)->where('pres_date','>', $date)->get();
        //->where('order_dt', $date)
        $patTest =Ehprescpoe::with('dctestmst')->where('reg_no', $regNo)->where('order_dt','>', $date)->get();

        return view('admin.reports.report_templete', compact(['presPrint','cc','patMedicine','patTest']));
    }
   
  
    public function generictherapeutic($therpGrp)
    {
        $genericTherpGrp = Thrgrpgenericmap::with('pmgeneric')->where('thrapgrp_id', $therpGrp)->get();
        return view('admin.prescription.generic_teraputic', compact(['genericTherpGrp']));
    }
    public function genericWiseBrand($genericNo)
    {
        $brands = Dctestmst::with('mmitems:item_no,item_name,product_type_no')
            ->select('test_no', 'test_name', 'generic_no')
            ->where('generic_no', $genericNo)->get();
        return view('admin.prescription.brand', compact(['brands']));
    }

    public function dispatchForm($testNo)
    {
        // with('producttype:product_type_no,prod_type_name')
        $disform = Mmitem::select('item_no','strength', 'strength_unit_no', 'product_type_no')
                    ->where('item_no', $testNo)->first();
        $dose = '';
        if ($disform->producttype->prod_type_name == 'Syrup' || $disform->producttype->prod_type_name == 'DROP') {
            $dose = 'ml';
        } else {
        }
        return [
            'productname' => $disform->producttype->prod_type_name,
            // 'quantity'=>$disform->strength,
            'quantity'=>1,
            // 'strength'=>$disform->mmuom->uom_code,
            'stock' => $disform->stockQty->sum('qty'),
            'dose' => $dose

        ];
    }

    public function frequencies($id)
    {
       $frequency = Pmfrequency::select('id','frequency_value', 'frequency_dl', 'dose_details')->where('id', $id)->first();
       return ['dptdtl' =>$frequency->dose_details];
    }

    public function prescripMedicineInsert(Request $r)
    { 
        // return $r->all();
        $r->request->add(['rx_no' => $this->getRxNo()]);
        $r->request->add(['med_ahd' => 1 ]);
        $r->request->add(['service_type' => 'M' ]);
        $r->request->add(['pres_type' => 0 ]);
        $r->request->add(['med_type' => 3 ]);
        $r->request->add(['consult_by' => auth()->user()->id ]);
        $r->request->add(['created_by' => auth()->user()->id ]);
                    
         $validated = $r->validate([
          'generic_no' => 'required'
      ]);
  
          Pmpresmedicine::insert($r->except('_token','duration','duration_type','frequency_id','dose_per_take','dpt_details','dpt_entry','purchase_type'));

          $pdpt = New Pmdaydptchange();
          $pdpt->rx_no = $r->rx_no;
          $pdpt->dpt_total = $r->rx_total_dpt;
          $pdpt->taken_time = Carbon::now();
          $pdpt->created_by = auth()->user()->id;
          $pdpt->frequency_id = $r->input("frequency_id");
          $pdpt->duration = $r->input("duration");
          $pdpt->duration_type = $r->input("duration_type");
          $pdpt->dose_per_take = $r->input("dose_per_take");
          $pdpt->dpt_details = $r->input("dpt_details");
          $pdpt->dpt_entry = $r->input("dose_per_take");
          
          $pdpt->save();
                  
        return redirect('prescriptions/'.$r->reg_no);
      }

    public function getRxNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('pmpresmedicines')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->year;

        $d = $t->day;

        $id = '' . $y;
        if ($m < 10) {
            $id .= '0';
        }
        $id .= $m;

        if ($d < 10) {
            $id .= '0';
        }
        $id .= $d;
        $b = '';
        if ($mid < 10) {
            $b = '00000';
        } elseif ($mid < 100) {
            $b = '0000';
        } elseif ($mid < 1000) {
            $b = '000';
        } elseif ($mid < 10000) {
            $b = '00';
        } elseif ($mid < 100000) {
            $b = '0';
        }
        $id .= $b . $mid;
        return $id;
    }


    public function investigations($serviceType)
    {
        $investigation = Dctestmst::where('service_type', $serviceType)->get();
        return view('admin.doctor.investigation', compact(['investigation']));
    }

    public function investigationSave(Request $r)
    {
        // return $r->all();
        // $r->request->add(['dept_no' => $this->getDeptNo()]);
        $r->request->add(['consult_by' => auth()->user()->id]);
        $r->request->add(['created_by' => auth()->user()->id]);
                  
        $validated = $r->validate([
         'test_no' => 'required'
     ]);
 
     Ehprescpoe::insert($r->except('_token'));
         
        //  return redirect('prescriptions/'.$r->reg_no);
      return "success";
    }    
}
