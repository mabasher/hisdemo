<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Model\Patient\Opconsultation;
use Carbon\Carbon;
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
         return view('admin.partialPages.ns', compact(['nsin']));
    }

    public function nsComp($nsDt = '')
    {
        $date =  Carbon::parse($nsDt)->toDateString();
         $nsin = Opconsultation::with(['consultation','patName'])->where('consult_dt', $date)->get();
         return view('admin.partialPages.nsComplate', compact(['nsin']));
    }
}
