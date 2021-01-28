<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Model\Doctor\Doctorinfo;
use App\Model\Patient\Opconsultation;
use App\Model\Patient\Oppatmovement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function serviceStation()
    {
        $date =  Carbon::parse(Carbon::now())->toDateString();
        App::setLocale('bd');
        $patArrived = Opconsultation::with(['consultation', 'patName'])->where('consult_dt', $date)->get();

        // return $doctor = Doctorinfo::with([
        //     'opconsultations' => function ($query) use ($date) {
        //         $query->select('id', 'doctorinfo_id', 'consult_no');
        //         $query->where('consult_dt', $date);
        //     },
        //     'opconsultations.oppatmovement' => function ($query) {
        //         $query->select('opmovetype_id', 'consult_no');
        //         $query->where('opmovetype_id', 7);
        //     }
        // ])
        //     ->select('id')
        //     ->where('id', 1)->get();

        return view('admin.opd.service_station', compact(['patArrived']));
    }

    public function ssInMovement(Request $r)
    {
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['created_by' => auth()->user()->id]);
        Oppatmovement::insert($r->except('_token'));

        return redirect('serviceStation');
    }


    public function queControlMovement(Request $r)
    {
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['created_by' => auth()->user()->id]);
        Oppatmovement::insert($r->except('_token'));

        return redirect('serviceStation');
    }

    public function missingPatMovement(Request $r)
    {
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['created_by' => auth()->user()->id]);
        Oppatmovement::insert($r->except('_token'));

        return redirect('serviceStation');
    }

    public function recallMovement(Request $r)
    {
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['created_by' => auth()->user()->id]);
        Oppatmovement::insert($r->except('_token'));

        return redirect('serviceStation');
    }

    
    public function roomCheck()
    {
        
    }

    public function doctorIn(Request $r)
    {
        $roomstatus =0;
        if( $r->fourceRoomIn == 0){
            $did = request()->doctorinfo_id;
            $date =  Carbon::parse(Carbon::now())->toDateString();
            $roomstatus = Doctorinfo::find($did)->roomcheck->where('status',1)->where('date',$date)->count();
            if($roomstatus > 0){
                return 'Patient Exist';
            }
            else{
                return 'Empty';
            }
        }
        
        Oppatmovement::insert([
            'consult_no' => $r->consult_no,
            'opconsultation_id'=>$r->opconsultation_id,
            'opmovetype_id'=>$r->opmovetype_id,
            'movement_name'=>$r->movement_name,
            'dept_no'=>$r->dept_no,
            'created_at'=>Carbon::now(),
            'created_by'=>auth()->user()->id
        ]);
        DB::table('roomchecks')->insert([
            'doctorinfo_id' => $r->doctorinfo_id,
            'reg_no' => $r->reg_no,
            'status' => 1,
            'date' => Carbon::now()
        ]);

        return 'Success';

    }

    public function doctorOut(Request $r)
    {
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['created_by' => auth()->user()->id]);
        Oppatmovement::insert($r->except('_token'));

        return redirect('serviceStation');
    }
}
