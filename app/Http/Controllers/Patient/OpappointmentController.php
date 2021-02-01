<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use DB;
use App\Model\Patient\Salutation;
use App\Model\Setup\Jobcode;
use App\Model\Doctor\Day;
use App\Model\Patient\Religion;
use App\Model\Setup\Bloodgroup;
use App\Model\Setup\Department;
use App\Model\Doctor\Doctorinfo;
use App\Model\Patient\Opappointment;
use App\Model\Setup\Division;
use App\Model\Setup\District;
use App\Model\Patient\Registration;
use App\Model\Patient\Opconsultation;
use App\Model\Patient\Oppatmovement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PDF;

class OpappointmentController extends Controller
{
    public function getSpecialWiseDoctor($deptNo)
    {
        if ($deptNo == 'All') {
            $spWidoctors = Doctorinfo::all();
        } else {
            $spWidoctors = Doctorinfo::where('dept_no', $deptNo)->get();
        }
        return view('admin.partialPages.speciltyWiseDoctor', compact('spWidoctors'));
    }

    public function getDesigWiseDoctor($jobId)
    {
        if ($jobId == 'All') {
            $desigWidoctors = Doctorinfo::all();
        } else {
            $desigWidoctors = Doctorinfo::where('job_id', $jobId)->get();
        }
        return view('admin.partialPages.desigWiseDoctor', compact('desigWidoctors'));
    }

    public function appointSavePage($regNo = '')
    {
        // return $d = Carbon::now()->next('Monday')->format('Y-m-d');
        // return $regNo;
        $registrations = Registration::orderBy('id', 'DESC')->get();
        $salutations = Salutation::all();
        $religions = Religion::all();
        $bloodGroups = Bloodgroup::all();
        $divisions = Division::all();
        $districts = District::all();
        $designation = Jobcode::where('jobtype_id', 4)->get();
        $specialty = Department::where('area_type_no', 115)->select('dept_no', 'dept_name')->get();
        $doctors = Doctorinfo::all();
        return view('admin.opd.appointmentAdd', compact(['registrations','salutations', 'religions', 'bloodGroups', 'specialty', 'doctors', 'divisions', 'districts', 'regNo', 'designation']));
    }


    public function appointEditPage($regno)
    {
        $salutations = Salutation::all();
        $religions = Religion::all();
        $bloodGroups = Bloodgroup::all();
        $divisions = Division::all();
        $districts = District::all();
        $specialty = Department::where('area_type_no', 115)->select('dept_no', 'dept_name')->get();
        $doctors = Doctorinfo::all();

        $patient = Registration::where('reg_no', $regno)->first();
        return view('admin.opd.appointmentUpdate', compact(['salutations', 'religions', 'bloodGroups', 'specialty', 'doctors', 'divisions', 'districts', 'patient']));
    }

    public function appointmentInsert(Request $r)
    {
        //return $r->all();
        //    return Carbon::now();
        $appid = $this->getAppointId();
        $cid = $this->getConsultation();
        $regno = '';
        if ($r->reg_no == '') {
            $regno = $this->getRegId();
             Registration::insert([
                'reg_no' => $regno,
                'ful_name' => $r->ful_name,
                'gender' => $r->gender,
                'dob' => $r->dob,
                'mobile' => $r->mobile,
                'email' => $r->email,
                'reg_date' => Carbon::now(),
            ]);
        } else {
            $regno = $r->reg_no;
        }
        $r->request->add(['reg_no' => $regno]);
        $r->request->add(['appoint_no' => $appid]);
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['start_time' => date("H:i:s", strtotime(request('start_time')))]);
        $r->request->add(['confirm_flag' => 'Y']);
        $app = Opappointment::insert($r->except('_token'));

        // $customPaper = array(0, 0, 250, 270);
        // $appoint = Opappointment::find($app);
        // PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'debugLayoutPaddingBox' => true]);
        // $pdf = PDF::loadView('admin.pdf.appointPdf', compact(['appoint']))
        //     ->setPaper($customPaper, 'landscape');
        // return $pdf->download('appointCard.pdf');
      
      $consult = DB::table('opconsultations')->insertGetId([
            'consult_no' => $cid,
            'reg_no' => $regno,
            'doctorinfo_id' => $r->doctorinfo_id,
            'appoint_no' => $appid,
            'consulttype_id' => 1,
            'created_at' => Carbon::now(),
            'consult_dt' => Carbon::now(),
            'sl_no' => $r->sl_no,
            'type_code' => $r->app_type,
            'created_by' =>auth()->user()->id
        ]);
        DB::table('oppatmovements')->insert([
            'movement_name' => 'Appointment',
            'consult_no' => $cid,
            'opconsultation_id' => $consult,
            'opmovetype_id' => 1,
            'created_at' => Carbon::now(),
            'created_by' =>auth()->user()->id
        ]);

        return redirect('appointments');
    }

    // public function generatePDF($id)
    // {
    //     $customPaper = array(0, 0, 250, 270);
    //     $appid = Opappointment::find($id);
    //     PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'debugLayoutPaddingBox' => true]);
    //     $pdf = PDF::loadView('admin.pdf.appointPdf', compact(['appid']))
    //         ->setPaper($customPaper, 'landscape');
    //     return $pdf->download('appid.pdf');
    // }

    public function getAppointId()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('opappointments')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->year;

        $d = $t->day;

        $id = 'A' . $y;
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

        $y = $t->year;

        $d = $t->day;

        $id = 'R' . $y;
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

    public function getPatient($regno)
    {
        return Registration::where('reg_no', $regno)->first();
    }


    public function doctorWeeklySchedule($id, $schDate)
    {
        $dayName = \Carbon\Carbon::parse($schDate)->format('l');
        $day = Day::with(['schudules' => function ($q) use ($id) {
            $q->where('doctorinfo_id', $id);
        }, 'schudules.doctorvisit'])->get();
        //  $doctor = Doctorinfo::find($id)->load('schedules.day'); 

        return view('admin.opd.doctorWeeklySchedule', compact('day', 'dayName'));
    }
}
