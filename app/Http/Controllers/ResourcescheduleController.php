<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resourceschedule;
use App\Department;
use App\Jobcode;
use App\Doctorinfo;

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
        $specialty = Department::where('area_type_no',115)->select('dept_no','dept_name')->get();
        $designation = Jobcode::where('jobtype_id',4)->get();
        $doctors = Doctorinfo::all();
        return view('admin.roster.scheduleRosterPage', compact(['specialty','designation','doctors']));
    }
}
