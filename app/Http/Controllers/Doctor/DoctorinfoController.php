<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Doctor\Doctorinfo;
use App\Model\Setup\Department;
use App\Model\Setup\Jobcode;
use App\Model\Doctor\Specialization;
use App\Model\Patient\Opappointment;
use Carbon\Carbon;
use DB;
use App\User;
use App\Model\Security\Roleuser;

class DoctorinfoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('menupermission');
    // }
    public function doctorAllShow()
    {
        $doctor = Doctorinfo::all();
        return view('admin.doctor', compact(['doctor']));
    }

    public function doctorsView()
    {
        // return \App\Department::with('doctors')->get();
        $doctorMenu     = Doctorinfo::all();
        $designation    = Jobcode::where('jobtype_id',4)->get();
        $departments    = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $specialty      = Specialization::all();
        $qualification  = DB::select('select short_special,special_name from qualifications');
        $room           = DB::select('select room_name,floor_id,building_id from rooms');
        return view('admin.doctor.doctor-view', compact(['doctorMenu','designation','departments','specialty','qualification','room']));
    }

    public function doctorPage()
    {
        $designation = Jobcode::where('jobtype_id',4)->get();
        $departments = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $specialty   = Specialization::all();
        $qualification = DB::select('select short_special,special_name from qualifications');
        $room = DB::select('select room_name,floor_id,building_id from rooms');
        //
        return view('admin.setup.add_doctor',compact(['departments','designation','specialty','qualification','room']));
    }

    public function doctorSchedule($id)
    {
        $doctor = Doctorinfo::with('schedules.day')->find($id);
        //return view('admin.opd.doctor_schedule', compact(['doctor']));
        return view('admin.doctor_schedule', compact(['doctor']));
    }

    public function departmentDoctors($deptNo)   
    {
        $department= Department::where('DEPT_NO', $deptNo)->first();
        //$deptDoctors= Department::where('DEPT_NO', $deptNo)->$department->doctors;
        return view('admin.department_doctors', compact('department'));
        //$department->doctors;
    }

    public function SaveDoctor(Request $r)    
    {
        //return $r->all();
        $pass       = mt_rand(100000, 999999);
        $password   = bcrypt($pass);

        $textToAppend = "";
        foreach($r->qualification as $k=>$q){
            count($r->qualification) == $k+1? $comma='' : $comma=',';
            $textToAppend .= $q . $comma;
        }  
        //return $textToAppend;

        $textToAppend2 = "";
        foreach($r->special_interest as $k=>$q){
            count($r->special_interest) == $k+1? $comma='' : $comma=',';
            $textToAppend2 .= $q . $comma;
        }  

      
        $img = '';
          if ($r->hasFile('doctor_image')) {
            $file = $r->file('doctor_image');
            $original_name = $file->getClientOriginalName();
            $ext = strtolower(\File::extension($original_name));
            $created_at = Carbon::now('Asia/Dhaka');
            $t = $created_at->timestamp;
            $rr = str_random(10);
            $random_name = $t . '' . $rr . '.' . $ext;
            $path = public_path() . '/images/doctor/';
            $filename = "images/doctor/" . $random_name;
            $file->move($path, $filename);
            $img=$filename;
        }else{
            if($r->gender == 'M'){
                $img = "images/patient/male.jpg";
            }else{
                $img = "images/patient/female.jpg"; 
            }
        }


        $user = User::create([
                'name' =>$r->doctor_name,
                'email'=>$r->email,
                'password'=>$password
            ]);

        $ru = New Roleuser();
        $ru->user_id = $user->id;
        $ru->role_id = 5;
        $ru->save();

          $r->request->add(['doctor_no' => $this->getDoctorNo()]);
          $r->request->add(['active_status' => 'Y']);
          $r->request->add(['qualification' => $textToAppend]);
          $r->request->add(['special_interest' => $textToAppend2]);
          $r->request->add(['doctor_image' => $img]);
          $r->request->add(['user_psw' => $pass]);
          $r->request->add(['user_id' => $user->id]);
        //return $this->getRegNo();
       //return $r->all();
       $validated = $r->validate([
        'doctor_name' => 'required',
        'gender' => 'required'
    ]);

        \App\Model\Doctor\Doctorinfo::insert($r->except('_token')); 
        
        return redirect('doctorAdd');
    }

    public function getDoctorNo()
  	{
//R 2020 12 14 0000001
  		$mid = DB::table('doctorinfos')->max('id')+1;

  		$t = Carbon::now();
  		$m = $t->month;

  		$y = $t->year;

  		$d = $t->day;

  		$id = 'D'.$y;
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

      public function doctorEditPage($id)
      {
        $doctorEdit     = Doctorinfo::where('id', $id)->first();
        $designation    = Jobcode::where('jobtype_id',4)->get();
        $departments    = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $specialty      = Specialization::all();
        $qualification  = DB::select('select short_special,special_name from qualifications');
        $room           = DB::select('select room_name,floor_id,building_id from rooms');

        return view('admin.setup.add_doctor',compact(['doctorEdit','designation','departments','specialty','qualification','room']));
      }

      public function setUdateDoctor(Request $r)    
    {
        // return $r->all();
        $textToAppend = "";
        foreach($r->qualification as $k=>$q){
            count($r->qualification) == $k+1? $comma='' : $comma=',';
            $textToAppend .= $q . $comma;
        }  
        //return $textToAppend;

        $textToAppend2 = "";
        if($r->special_interest){
            foreach($r->special_interest as $k=>$q){
                count($r->special_interest) == $k+1? $comma='' : $comma=',';
                $textToAppend2 .= $q . $comma;
            }  
        }
        
       // return $textToAppend2;
      
        $img = '';
          if ($r->hasFile('doctor_image')) {
            $file = $r->file('doctor_image');
            $original_name = $file->getClientOriginalName();
            $ext = strtolower(\File::extension($original_name));
            $created_at = Carbon::now('Asia/Dhaka');
            $t = $created_at->timestamp;
            $rr = str_random(10);
            $random_name = $t . '' . $rr . '.' . $ext;
            $path = public_path() . '/images/doctor/';
            $filename = "images/doctor/" . $random_name;
            $file->move($path, $filename);
            $img=$filename;
        }else{
            if($r->gender == 'M'){
                $img = "images/patient/male.jpg";
            }else{
                $img = "images/patient/female.jpg"; 
            }
        }
            //return $img;
          $r->request->add(['qualification' => $textToAppend]);
          $r->request->add(['special_interest' => $textToAppend2]);
          $r->request->add(['doctor_image' => $img]);
        //return $this->getRegNo();
       //return $r->all();
       $validated = $r->validate([
        'doctor_name' => 'required',
        'gender' => 'required'
    ]);
        \App\Model\Doctor\Doctorinfo::where('id',$r->id)->update($r->except('_token'));
        
        return redirect('doctormenu');
    }
}