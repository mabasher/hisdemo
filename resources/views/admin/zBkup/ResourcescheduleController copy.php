<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resourceschedule;
use App\Department;
use App\Jobcode;
use App\Doctorinfo;
use App\Day;
use App\Appdayschedule;

class ResourcescheduleController extends Controller
{
    public function getDoctorTimeSlot($id,$schDate)
    {
        $slot = Resourceschedule::where('doctorinfo_id',$id)->where('sc_date',$schDate)->get();
        // $slot = Resourceschedule::where('doctorinfo_id',$id)->where('sc_date',$schDate)->where('multivisit_no',$multiVisit)->get();
        $appointConfirm = \App\Opappointment::where('doctorinfo_id',$id)->where('app_date',$schDate)->pluck('start_time')->toArray();
        // dd($appointConfirm->count());
        return view('admin.partialPages.doctor_slot', compact(['slot','appointConfirm']));
    }

    public function getDoctorMultiVisit($id,$schDate)
    {
        $visitTime = Resourceschedule::where('doctorinfo_id',$id)->where('sc_date',$schDate)->get();
        return view('admin.partialPages.multivisit', compact('visitTime'));
    }

    public function scheduleRoster()
    {
        // return Day::with('daywiseSchedule')->get();
        $specialty = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $designation = Jobcode::where('jobtype_id',4)->get();
        $doctors = Doctorinfo::all();
        $days = Day::all();
        return view('admin.roster.scheduleRosterPage', compact(['specialty','designation','doctors','days']));
    }

    public function scheduleRosterSave(Request $r)
    {
        
        //  return $r->all();

       $validated = $r->validate([
        'doctorinfo_id' => 'required',
        'avg_duration' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'avg_duration' => 'min:2'
        ]);
        $week =  Day::all();
        foreach($week as $w){
            $start_day = 'start_time'.$w->name;
            $end_day = 'end_time'.$w->name;
            $duration = 'avg_duration'.$w->name;
            if($r->$start_day[0]){
                foreach($r->$start_day as $key=> $day){    
                    \DB::table('appdayschedules')->insert([
                        'doctorinfo_id' => $r->doctorinfo_id,
                        'day_id'        => $w->id,
                        'avg_duration'  => $r->$duration,
                        'start_time'    => $day,
                        'end_time'      => $r->$end_day[$key],
                    ]);
                }
                
                
            }

        }

        return redirect('scheduleRoster');
    }
}
