<?php

namespace App\Http\Controllers\Setup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setup\Department;
use DB;

class DepartmentController extends Controller
{
    public function departmentSetup()
    {
        $departments = Department::orderby('id','desc')->get();
        return view('admin.setup.department',compact(['departments']));
    }

    public function departmentaddPage()
    {   
        $organogram  = DB::select('select hr_organid,hr_organname from organogramsetups');
        $departments = Department::all();
        return  view('admin.setup.add_department',compact(['departments','organogram']));
    }

    public function saveDepartment(Request $r)    
    {
      $r->request->add(['dept_no' => $this->getDeptNo()]);
                  
       $validated = $r->validate([
        'dept_name' => 'required'
    ]);

        Department::insert($r->except('_token'));
        
        return redirect('departments');
    }
   
    public function getDeptNo()
  	{
  		$mid = DB::table('departments')->max('dept_no')+1;
  		return $mid;


      }
      public function departmentDelete($id)
      {
        Department::where('id',$id)->delete();
        return redirect('departments');
      }
}
