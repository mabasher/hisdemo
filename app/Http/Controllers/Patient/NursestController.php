<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Model\Patient\Opconsultation;
use App\Model\Patient\Oppatmovement;
use App\Model\Patient\Vitalsign;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class NursestController extends Controller
{
    public function nursestation()
    {    
         $date =  Carbon::parse(Carbon::now())->toDateString();
        $nsin = Opconsultation::with(['consultation','patName'])->where('consult_dt', $date)->get();
        //$nsin = Opconsultation::where('consult_dt', $consultDt);
        return view('admin.opd.nurse_station', compact(['nsin']));
    }
    
    public function ns($consultDt = '')
    {
        $date =  Carbon::parse($consultDt)->toDateString();
         $nsin = Opconsultation::with(['consultation','patName'])->where('consult_dt', $date)->get();
         return view('admin.partialPages.nursestation.ns', compact(['nsin']));
    }

    public function nsComp($nsDt = '')
    {
        $date =  Carbon::parse($nsDt)->toDateString();
         $nsin = Opconsultation::with(['consultation','patName'])->where('consult_dt', $date)->get();
         return view('admin.partialPages.nursestation.nsComplate', compact(['nsin']));
    }

    public function vsComplate($vsComDt = '')
    {
        $date =  Carbon::parse($vsComDt)->toDateString();
         $nsin = Opconsultation::with(['consultation','patName'])->where('consult_dt', $date)->get();
         return view('admin.partialPages.nursestation.vsComplate', compact(['nsin']));
    }
    
    public function nsMovement(Request $r)
    {
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['created_by' => auth()->user()->id]);
        Oppatmovement::insert($r->except('_token'));

        return redirect('nurseStation');
        
    }

    public function vitalSignInsert(Request $r)
    {
        //return $r->all();
        //    return Carbon::now();
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['vitalsing_no' => $this->getvitalsId()]);
                  
       $validated = $r->validate([
        'chief_complain' => 'required'
        ]);

        Vitalsign::insert($r->except('_token'));

        DB::table('oppatmovements')->insert([
            'opmovetype_id' => 3,
            'movement_name' => 'Vital Sign Completed',
            'consult_no' => $r->consult_no,
            'opconsultation_id' => $r->opconsultation_id,
            'created_at' => Carbon::now(),
            'created_by' =>auth()->user()->id
        ]);


        return redirect('nurseStation#vitalSign');
    }

    public function getvitalsId()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('vitalsigns')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->year;

        $d = $t->day;

        $id = 'VS' . $y;
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
}
