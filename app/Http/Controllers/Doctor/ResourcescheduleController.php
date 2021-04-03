<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Doctor\Resourceschedule;
use App\Model\Setup\Department;
use App\Model\Setup\Jobcode;
use App\Model\Doctor\Doctorinfo;
use App\Model\Doctor\Day;
use App\Model\Doctor\Appdayschedule;
use App\Model\Doctor\Doctorvisit;
use App\Model\Patient\Opappointment;
use Carbon\Carbon;

class ResourcescheduleController extends Controller
{
    public function getDoctorTimeSlot($id,$day)
    {
        $dayName = '';
        $schDate = '';
        if(! preg_match('([0-9]|[0-9])', $day) ) {
            $dayName = $day;
        //    $schDate= Carbon::now()->next($schDate)->format('Y-m-d');
             if(Carbon::now()->format('l')==$day){
                $schDate = Carbon::now()->format('Y-m-d');
            }
            else{
    
                $schDate= Carbon::now()->next($day)->format('Y-m-d');
            }
            //Appdayschedule
        }
        else{
            $dayName = Carbon::parse($day)->format('l');
           $schDate = $day;
        }
        
        $dayId = Day::where('name',$dayName)->first();
        //$slot = Resourceschedule::where('doctorinfo_id',$id)->where('sc_date',$schDate)->get();
        $slot = Appdayschedule::where('doctorinfo_id',$id)->where('day_id',$dayId->id)->get();
        // $slot = Resourceschedule::where('doctorinfo_id',$id)->where('sc_date',$schDate)->where('multivisit_no',$multiVisit)->get();
        $appointConfirm = Opappointment::where('doctorinfo_id',$id)->where('app_date',$schDate)->pluck('start_time')->toArray();
        // dd($appointConfirm->count());
        return view('admin.partialPages.doctor_slot', compact(['slot','appointConfirm','schDate']));
    }


    public function scheduleRoster()
    {
        // return Day::with('daywiseSchedule')->get();
        $specialty = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $designation = Jobcode::where('jobtype_id',4)->get();
        $doctors = Doctorinfo::all();
        $days = Day::all();
        $visits = Doctorvisit::all();
        return view('admin.roster.scheduleRosterPage', compact(['specialty','designation','doctors','days','visits']));
    }

    public function scheduleRosterSave(Request $r)
    {
        //return $r->all();
   
        $week =  Day::all();
        
        foreach($week as $w){
            $start_day = 'start_time'.$w->name;
            $end_day = 'end_time'.$w->name;
            $duration = 'avg_duration'.$w->name;
            $docvisit = 'doctorvisit_id'.$w->name;
            if($r->$start_day[0]){
                foreach($r->$start_day as $key=> $day){ 
                    $startTime = Carbon::parse($day);
                    $endTime = Carbon::parse($r->$end_day[$key]); 
                    $totalDuration = $endTime->diffInMinutes($startTime);
                    $blockLoad = $totalDuration/$r->$duration;  

                    DB::table('appdayschedules')->insert([
                        'doctorinfo_id'     => $r->doctorinfo_id,
                        'day_id'            => $w->id,
                        'avg_duration'      => $r->$duration,
                        'doctorvisit_id'    => $r->$docvisit[$key],
                        'start_time'        => $day,
                        'end_time'          => $r->$end_day[$key],
                        'block_load'        => $blockLoad,
                        'created_at'        => Carbon::now()
                    ]);
                }
            }

        }
        return redirect('scheduleRoster');
    }
}