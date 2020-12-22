<?php

namespace App\Http\Controllers;
use DB;
use App\Salutation;
use App\Jobcode;
use App\Religion;
use App\Bloodgroup;
use App\Department;
use App\Doctorinfo;
use App\Division;
use App\District;
use App\Registration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OpappointmentController extends Controller
{
    public function getSpecialWiseDoctor($deptNo)
    {
        if($deptNo == 'All' ){
            $spWidoctors = Doctorinfo::all();
        }else{
            $spWidoctors = Doctorinfo::where('dept_no',$deptNo)->get();
        }
        return view('admin.partialPages.speciltyWiseDoctor',compact('spWidoctors'));
    }

    public function appointSavePage($regNo = '')
    {
        // return $regNo;
        $salutations = Salutation::all();
        $religions = Religion::all();
        $bloodGroups = Bloodgroup::all();
        $divisions = Division::all();
        $districts = District::all();
        $designation = Jobcode::where('jobtype_id',4)->get();
        $specialty = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $doctors = Doctorinfo::all();
        return view('admin.opd.appointmentAdd',compact(['salutations','religions','bloodGroups','specialty','doctors','divisions','districts','regNo','designation']));
                
    }

    public function appointEditPage($regno)
    {
        $salutations = Salutation::all();
        $religions = Religion::all();
        $bloodGroups = Bloodgroup::all();
        $divisions = Division::all();
        $districts = District::all();
        $specialty = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $doctors = Doctorinfo::all();

        $patient = Registration::where('reg_no',$regno)->first();
        return view('admin.opd.appointmentUpdate',compact(['salutations','religions','bloodGroups','specialty','doctors','divisions','districts','patient']));
                
    }

    public function appointmentInsert(Request $r)
    {
        //return $r->all();
        $r->request->add(['appoint_no' => $this->getAppointId()]);
        $r->request->add(['reg_no' => $this->getRegId()]);
        $r->request->add(['start_time'=>date("H:i:s", strtotime(request('start_time')))]);
        $r->request->add(['confirm_flag'=>'Y']);
        \App\Opappointment::insert($r->except('_token'));

        return redirect('appointments');
    }

    public function getAppointId()
  	{
//R 2020 12 14 0000001
  		$mid = DB::table('opappointments')->max('id')+1;

  		$t = Carbon::now();
  		$m = $t->month;

  		$y = $t->year;

  		$d = $t->day;

  		$id = 'A'.$y;
  		if($m<10){$id .= '0';}
  		$id.=$m;

  		if($d<10){$id .= '0';}
  		$id.=$d;
  		$b= '';
  		if($mid <10){ $b = '00000';}
  		elseif($mid <100){ $b = '0000';}
  		elseif($mid <1000){ $b = '000';}
  		elseif($mid <10000){ $b = '00';}
  		elseif($mid <100000){ $b = '0';}
  		$id .= $b.$mid;
  		return $id;
      }
      
      public function getRegId()
  	{
//R 2020 12 14 0000001
  		$mid = DB::table('registrations')->max('id')+1;

  		$t = Carbon::now();
  		$m = $t->month;

  		$y = $t->year;

  		$d = $t->day;

  		$id = 'R'.$y;
  		if($m<10){$id .= '0';}
  		$id.=$m;

  		if($d<10){$id .= '0';}
  		$id.=$d;
  		$b= '';
  		if($mid <10){ $b = '00000';}
  		elseif($mid <100){ $b = '0000';}
  		elseif($mid <1000){ $b = '000';}
  		elseif($mid <10000){ $b = '00';}
  		elseif($mid <100000){ $b = '0';}
  		$id .= $b.$mid;
  		return $id;
  	}

    public function getPatient($regno)
    {
        return Registration::where('reg_no',$regno)->first();
    }

    
    public function doctorAppointSchedule($id)
    {
        $doctor = Doctorinfo::find($id)->load('schedules.day'); 
        return view('admin.opd.doctorAppointSchedule', compact('doctor'));

    }
    
}