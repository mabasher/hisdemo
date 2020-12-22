<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resourceschedule;

class ResourcescheduleController extends Controller
{
    public function getDoctorTimeSlot($id,$schDate,$multiVisit)
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
        return view('admin.opd.scheduleRosterPage');
    }
}
