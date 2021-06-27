<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use App\Model\Doctor\Appdayschedule;
use App\Model\Doctor\Day;
use App\Model\Doctor\Doctorinfo;
use App\Model\Patient\Opappointment;
use App\Model\Patient\Registration;
use App\Model\Prescription\Ehattribexamval;
use App\Model\Prescription\Ehbpwlocation;
use App\Model\Setup\Department;
use App\Pharmarcy\Ehsymptom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Patient\Salutation;
use DB;
use Session;
use PDF;

class FrontpageController extends Controller
{
    public function welcomepage()
    {
        // return $specialty = Department::all();
        $specialty = Department::where('area_type_no', 115)->select('dept_no', 'dept_name')->get();
        $doctors = Doctorinfo::all();
        $salutations = Salutation::all();
        return view('welcome', compact(['specialty', 'doctors','salutations']));
    }
  
    public function onLineSpecialtyWiseDoctor($deptNo)
    {
        $deptcareGiver = Doctorinfo::where('dept_no', $deptNo)->get();
        $salutations = Salutation::all();
        return view('frontpage.specialwise_doctorModal', compact(['deptcareGiver']));
    }

    public function onlineSpWiseDoctor($deptNo)
    {
        $deptdoctors = Doctorinfo::where('dept_no', $deptNo)->get();
        return view('frontpage.specialwise_doctorajax', compact(['deptdoctors']));
    }
    
    public function doctordept()
    {
        $dept = Department::where('area_type_no', 115)->select('dept_no', 'dept_name')->get();
        return view('frontpage.department', compact(['dept']));
    }

    public function deptWiseDoctor($deptNo)
    {
        $deptWiseDoctor = Doctorinfo::where('dept_no',$deptNo)->get();
        return view('frontpage.dept_doctor', compact(['deptWiseDoctor']));
    }

    public function doctors()
    {
        $doctors = Doctorinfo::all();
        return view('frontpage.doctors', compact(['doctors']));
    }

    public function doctorSearch($keyword)
    {
        if ($keyword === 'No-Doctor') {
            $doctors = Doctorinfo::get();
            return view('frontpage.partial.doctors', compact(['doctors']));
        }
        $doctors = Doctorinfo::where('doctor_name', 'LIKE', "{$keyword}%")->get();
        if (count($doctors) === 0) {
            return "No-Data";
        }
        return view('frontpage.partial.doctors', compact(['doctors']));
    }

    public function services()
    {
        return view('frontpage.services');
    }

    public function about()
    {
        return view('frontpage.about');
    }

    public function contact()
    {
        return view('frontpage.contact');
    }

    public function patientAdd(Request $r)
    {
        // return $r->all();
        // return Carbon::parse($r->dob)->format('Y-M-d');
        
        Session::flash('name', $r->name);
        Session::flash('mobile', $r->mobile);
        Session::flash('gender', $r->gender);
        Session::flash('dob', $r->dob);
        Session::flash('age', $r->age);

        $doctor = Doctorinfo::where('id', $r->doctor)->first();
        $doctorDept = $doctor->department->doctors->except($r->doctor);
        $chiefComplaint = Ehsymptom::all();
        $salutations = Salutation::all();

        return view('frontpage.appointment.doctor_patientapp', compact(['doctor', 'doctorDept', 'chiefComplaint','salutations']));
    }

    public function doctorpatientapp($doctorId)
    {
    
        $doctor = Doctorinfo::where('id', $doctorId)->first();
        $doctorDept = $doctor->department->doctors->except($doctorId);
        $chiefComplaint = Ehsymptom::orderBy('symptom_id', 'Asc')->get();
        $salutations = Salutation::all();
        return view('frontpage.appointment.doctor_patientapp', compact(['doctor', 'doctorDept', 'chiefComplaint','salutations']));
    }

    public function doctorpatientajax($doctorId)
    {
        $doctor = Doctorinfo::where('id', $doctorId)->first();
        $doctorDept = $doctor->department->doctors->except($doctorId);
        return view('frontpage.appointment.doctor_patientajax', compact(['doctor', 'doctorDept']));
    }

    /// Doctor Weekly Schedule
    public function getDocWeeklySchedule($id, $schDate)
    {
        $dayName = Carbon::parse($schDate)->format('l');
        $day = Day::with(['schudules' => function ($q) use ($id) {
            $q->where('doctorinfo_id', $id);
        }, 'schudules.doctorvisit'])->get();
        return view('frontpage.appointment.doctor_weekly_schedule', compact('day', 'dayName'));
    }

    /// Doctor Daily Time Slot

    public function getDocDailyTimeSlots($id, $day)
    {
        $dayName = '';
        $schDate = '';
        if (!preg_match('([0-9]|[0-9])', $day)) {
            $dayName = $day;
            //    $schDate= Carbon::now()->next($schDate)->format('Y-m-d');
            if (Carbon::now()->format('l') == $day) {
                $schDate = Carbon::now()->format('Y-m-d');
            } else {

                $schDate = Carbon::now()->next($day)->format('Y-m-d');
            }
            //Appdayschedule
        } else {
            $dayName = Carbon::parse($day)->format('l');
            $schDate = $day;
        }

        $dayId = Day::where('name', $dayName)->first();
        $slot = Appdayschedule::where('doctorinfo_id', $id)->where('day_id', $dayId->id)->get();
        $appointConfirm = Opappointment::where('doctorinfo_id', $id)->where('app_date', $schDate)->pluck('start_time')->toArray();
        return view('frontpage.appointment.doctor_daily_timeslot', compact(['slot', 'appointConfirm', 'schDate','day']));
    }

    public function getExPatientOnline($regno)
    {
        $patients = '';
        $patientFind =  Registration::where('reg_no', 'LIKE', "%{$regno}")->get();
        if ($patientFind->count() === 1){
            $patients =  Registration::where('reg_no', 'LIKE', "%{$regno}")->first();
            return [
                'count'=>count($patientFind),
                'patient'=>$patients,
            ] ;
        }else{
            $patients =  Registration::where('reg_no', 'LIKE', "%{$regno}")->get();
            return [
                'count'=>count($patientFind),
                'patient'=>$patients,
            ] ;
        }
        
    }

    public function getMulticoloumnSearch($regno,$keyword)
    {
        if(is_numeric($keyword)){
           return $patientsearch =  Registration::where('reg_no', 'LIKE', "%{$regno}")->where('mobile', 'LIKE', "%{$keyword}")->get();
        }
        else{
          return  $patientsearch =  Registration::where('reg_no', 'LIKE', "%{$regno}")->where('ful_name', 'LIKE', "{$keyword}%")->get();
        }
    }

    public function appointmentInsertOnline(Request $r)
    {
        // return $r->all();

        $symptomNameEn = "";
        if($r->symptom_name_en !=''){
            foreach ($r->symptom_name_en as $k => $q) {
                count($r->symptom_name_en) == $k + 1 ? $comma = '' : $comma = ',';
                $symptomNameEn .= $q . $comma;  
        }
        }

        $symptomNameBn = "";
        if($r->symptom_name_bn !=''){
            foreach ($r->symptom_name_bn as $k => $q) {
                count($r->symptom_name_bn) == $k + 1 ? $comma = '' : $comma = ',';
                $symptomNameBn .= $q . $comma;  
        }
        }
        
        $appid = $this->getAppointId();
        $cid = $this->getConsultation();
        $regno = '';
        if($r->start_time){
        if ($r->reg_no == '') {
            $regno = $this->getRegId();
            Registration::insert([
                'reg_no' => $regno,
                'ful_name' => $r->ful_name,
                'gender' => $r->gender,
                'dob' => Carbon::createFromFormat('d/m/Y', $r->dob)->format('Y-m-d'),
                'mobile' => $r->mobile,
                'email' => $r->email,
                'reg_date' => Carbon::now(),
            ]);
        } else {
            $regno = $r->reg_no;
        }
        $r->request->add(['reg_no' => $regno]);
        $r->request->add(['dob' => Carbon::createFromFormat('d/m/Y', $r->dob)->format('Y-m-d')]);
        $r->request->add(['appoint_no' => $appid]);
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['start_time' => date("H:i:s", strtotime(request('start_time')))]);
        $r->request->add(['symptom_name_en' => $symptomNameEn]);
        $r->request->add(['symptom_name_bn' => $symptomNameBn]);
        $r->request->add(['confirm_flag' => 'Y']);
        $r->request->add(['appoint_from' => 'Online']);
        $app = Opappointment::insert($r->except('_token'));

        if($r->mobile){
            // return $r->doctorinfo_id->doctorName;
        $doctor = Doctorinfo::find($r->doctorinfo_id);
        // return 'Your Appointment is Successfully Completed.'.' Appoint No:'.$r->appoint_no.', Appoint date:'.Carbon::parse($r->app_date)->format('d/m/Y').' Appoint Time:'.date("h:i A", strtotime(request('start_time'))).', Sl No:'.$r->sl_no.', Care Giver:'.$doctor->doctor_name.' '.$doctor->designation.', Room No:'.$r->doc_chember.',  2nd Floor, Main Building.';
        $this->sendSms($r->mobile,'Your Appointment is Successfully Completed.'.' Appoint No:'.$r->appoint_no.', Appoint date:'.Carbon::parse($r->app_date)->format('d/m/Y').' Appoint Time:'.date("h:i A", strtotime(request('start_time'))).', Sl No:'.$r->sl_no.', Care Giver:'.$doctor->doctor_name.' '.$doctor->designation.', Room No:'.$r->doc_chember.',  2nd Floor, Main Building.');
        }
        if($r->email){
            $this->sendMail($r->email,$appid);    
        } 

        $consult = DB::table('opconsultations')->insertGetId([
            'consult_no' => $cid,
            'reg_no' => $regno,
            'doctorinfo_id' => $r->doctorinfo_id,
            'appoint_no' => $appid,
            'consulttype_id' => 1,
            'created_at' => Carbon::now(),
            'consult_dt' => Carbon::now(),
            'sl_no' => $r->sl_no,
            'type_code' => $r->app_type
        ]);

        DB::table('oppatmovements')->insert([
            'movement_name' => 'Appointment',
            'consult_no' => $cid,
            'opconsultation_id' => $consult,
            'opmovetype_id' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('ehpatientexams')->insert([
            'reg_no' => $regno,
            'consult_no' => $cid,
            'findings' => $symptomNameEn
        ]);

        return redirect('appointmentCard/' . $appid);
    }else{
        Session::flash('startTime', 'Please Choose Appointment Time.');
        return redirect()->back();
    }

    }

    // Appoint Card Generate
    public function appointmentCardGenerate($appid)
    {
        $appointCard = Opappointment::where('appoint_no', $appid)->first();
        $name ='Patient Name :'.$appointCard->salutation_id.' '.$appointCard->ful_name;
        $appNo ='Appoint No :'.$appointCard->appoint_no;
        $appDate ='Appoint Date :'.Carbon::parse($appointCard->app_date)->format('d-m-Y');
        $appTime ='Appoint Time :'.Carbon::parse($appointCard->start_time)->format('h:i A');
        $doctor ='Care Giver :'.$appointCard->appdoctor->doctor_name.', '.$appointCard->appdoctor->designation;
        $docChember = 'Chember :'.$appointCard->appdoctor->doc_chember.', '.'2nd Floor, Main Building';
        $QrGenerate =$name.'<br>'.$appNo.'<br>'.$appDate.'<br>'.$appTime.'<br>'.$doctor.'<br>'.$docChember;
        return view('frontpage.appointment.appointment_card', compact(['appointCard','QrGenerate']));
    }

    public function CardGenerate()
    {
        return view('frontpage.appointment.appointcard_duplicate');
    }
    
    public function appointmentCardduplicate(Request $r)
    {
         $appointed = Opappointment::where('appoint_no', $r->pidorappno)->orWhere('reg_no', $r->pidorappno)->orWhere('reg_no', $r->pidorappno)->orWhere('mobile', $r->mobile);
        //  return $appointed->get();
        $appDateTime = $appointed->first()->app_date . $appointed->first()->start_time;
        $today = Carbon::parse(now())->timestamp;
        $appDate = Carbon::parse($appDateTime)->timestamp;
       

        if ($today < $appDate) {
            if ($appointed->count()) {
                    $appointCard = $appointed->first();
                    $name ='Patient Name :'.$appointCard->salutation_id.' '.$appointCard->ful_name;
                    $appNo ='Appoint No :'.$appointCard->appoint_no;
                    $appDate ='Appoint Date :'.Carbon::parse($appointCard->app_date)->format('d-m-Y');
                    $appTime ='Appoint Time :'.Carbon::parse($appointCard->start_time)->format('h:i A');
                    $doctor ='Care Giver :'.$appointCard->appdoctor->doctor_name.', '.$appointCard->appdoctor->designation;
                    $docChember = 'Chember :'.$appointCard->appdoctor->doc_chember.', '.'2nd Floor, Main Building';
                    $QrGenerate =$name.'<br>'.$appNo.'<br>'.$appDate.'<br>'.$appTime.'<br>'.$doctor.'<br>'.$docChember;
                    return view('frontpage.appointment.appointment_card', compact(['appointCard','QrGenerate']));
                
            } else {
                Session::flash('status', 'Please Enter Correct PID Or Appoint No');
                return redirect()->back();
            }
        }

                
        // if ($today < $appDate) {
        //     if ($appointed->count()) {
        //         $mobile = $appointed->where('mobile', $r->mobile)->count();
        //         if ($mobile) {
        //             $appointCard = $appointed->first();
        //             $name ='Patient Name :'.$appointCard->salutation_id.' '.$appointCard->ful_name;
        //             $appNo ='Appoint No :'.$appointCard->appoint_no;
        //             $appDate ='Appoint Date :'.Carbon::parse($appointCard->app_date)->format('d-m-Y');
        //             $appTime ='Appoint Time :'.Carbon::parse($appointCard->start_time)->format('h:i A');
        //             $doctor ='Care Giver :'.$appointCard->appdoctor->doctor_name.', '.$appointCard->appdoctor->designation;
        //             $docChember = 'Chember :'.$appointCard->appdoctor->doc_chember.', '.'2nd Flood, Main Building';
        //             $QrGenerate =$name.'<br>'.$appNo.'<br>'.$appDate.'<br>'.$appTime.'<br>'.$doctor.'<br>'.$docChember;
        //             return view('frontpage.appointment.appointment_card', compact(['appointCard','QrGenerate']));
        //         } else {
        //             Session::flash('status', 'Please Enter Correct Mobile No');
        //             return redirect()->back();
        //         }
        //     } else {
        //         Session::flash('status', 'Please Enter Correct Appoint No');
        //         return redirect()->back();
        //     }
        // }
        Session::flash('status', 'Appointment Time Over');
        return redirect()->back();
    }

    public function appointCardPdfGenerate($id)
        {
            $customPaper = array(0, 0, 310, 270);
            $appoint = Opappointment::where('id',$id)->orWhere('reg_no',$id)->first();
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'debugLayoutPaddingBox' => true]);
            $pdf = PDF::loadView('admin.pdf.appointPdfOnline', compact(['appoint']))
                ->setPaper($customPaper, 'landscape');
            return $pdf->download($appoint->appoint_no.'.pdf');
        }

    public function pidCardPdfGenerate($id)
        {
            $customPaper = array(0, 0, 310, 270);
            $pid = Registration::where('reg_no',$id)->first();
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'debugLayoutPaddingBox' => true]);
            $pdf = PDF::loadView('admin.pdf.pid_card_online', compact(['pid']))
                ->setPaper($customPaper, 'landscape');
            return $pdf->download($pid->reg_no.'.pdf');
        }

        


    public function doctorprofileview($doctorId)
    {
        $docProfile = Doctorinfo::where('id', $doctorId)->first();
        $day = Day::with(['schudules' => function ($q) use ($doctorId) {
            $q->where('doctorinfo_id', $doctorId);
        }, 'schudules.doctorvisit'])->get();
        return view('frontpage.appointment.doctor_profileview', compact(['docProfile','day']));
    }

    // End Appoint Card Generate

    //Online Chief Complaint
    public function OnlineCheifComplaint($gender)
    {
        if ($gender == 'maleFront') {
            return view('frontpage.avatar.male-front');
        } elseif ($gender == 'maleBack') {
            return view('frontpage.avatar.male-back');
        } elseif ($gender == 'femaleBack') {
            return view('frontpage.avatar.female-back');
        }
        return view('frontpage.avatar.female-front');
    }

    public function avatarAtrributes($bodyPartNo, $parentAtrNo, $gender)
    {
        // $avatarAttributes = Ehattribexamval::where('parent_atr_no', '173')->whereNotIn('ehbpwlocation')->get();
         $avatarAttributes = Ehattribexamval::addSelect(['isexist' => Ehbpwlocation::select('location_id')
            ->whereColumn('location_id', 'atr_no')
            ->where('bodypart_no', $bodyPartNo)
            ->where('gender', $gender)
            ->limit(1)
            ])
        ->where('parent_atr_no', $parentAtrNo)
        ->whereNotIn('atr_no', Ehbpwlocation::select('location_id')->where('bodypart_no', '<>',$bodyPartNo)->where('gender',$gender)->get())
        ->get();

        return view('frontpage.avatar.patient_attributes', compact(['avatarAttributes']));
    }

    
    //End Online Chief Complaint

    public function getAppointId()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('opappointments')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->format('y');
        // substr($t->year,-2)

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

    public function getRegId()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('registrations')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->format('y');

        $d = $t->day;

        $id = 'PID' . $y;
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

    public function getConsultation()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('opconsultations')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->year;

        $d = $t->day;

        $id = 'C' . $y;
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

    public function sendSms($mobile,$msg)
    {
        // return $msg;
        $uncode = urlencode($msg);
        $client = new \GuzzleHttp\Client();
        $url = 'http://esms.dianahost.com/smsapi?api_key=C2003554606c679e819312.75330124&type=text&contacts=' . $mobile . '&senderid=8801847169884&msg=' . $uncode;
        $response = $client->request('POST', $url);

        return $response->getStatusCode(); // 200
    }


    public function sendMail($email,$appointNo)
    {
        $appInfo = Opappointment::where('appoint_no', $appointNo)->first();
        $details = [

            'title' => 'Appointment Confirmtion',
            'name'=>$appInfo

        ];
        \Mail::to($email)->send(new \App\Mail\MyTestMail($details));



        return "200";
    }
}