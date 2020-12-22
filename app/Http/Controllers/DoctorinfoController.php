<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Doctorinfo;
use App\Department;


class DoctorinfoController extends Controller
{
    public function doctorAllShow()
    {
        // return \App\Department::with('doctors')->get();
        $doctor = Doctorinfo::all();
        return view('admin.doctor', compact(['doctor']));
    }
    public function doctorSchedule($id)
    {
        $doctor = Doctorinfo::with('schedules.day')->find($id);
        //return view('admin.opd.doctor_schedule', compact(['doctor']));
        return view('admin.doctor_schedule', compact(['doctor']));
    }

    public function departmentDoctors($deptNo)   
    {
    
        return $department= Department::where('DEPT_NO', $deptNo)->first();
        //$deptDoctors= Department::where('DEPT_NO', $deptNo)->$department->doctors;
        return view('admin.department_doctors', compact('department'));
        
        //$department->doctors;
    }
}
