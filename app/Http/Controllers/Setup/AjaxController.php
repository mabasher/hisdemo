<?php

namespace App\Http\Controllers\Setup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setup\District;

class AjaxController extends Controller
{
    public function getDivisionPermanent($code)
    {   
        $district = District::where('division_code',$code)->select('district_code','district_name')->get();
        return view('admin.partialPages.district',compact('district'));
    }
}
