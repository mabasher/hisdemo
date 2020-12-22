<?php

namespace App\Http\Controllers;
use DB;
use App\Registration;
use App\Salutation;
use App\Religion;
use App\Bloodgroup;
use App\Division;
use App\District;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{

    public function registrationviews()
    {
        $registrations = Registration::all();
        return view('admin.opd.registration-view', compact(['registrations']));
    }
    public function index()
    {
        $salutations = Salutation::all();
        $religions = Religion::all();
        $bloodGroups = Bloodgroup::all();
        $divisions = Division::all();
        return view('opd.registration',compact(['salutations','religions','bloodGroups','divisions']));
    }

    public function regPageInfo()
    {
        $salutations = Salutation::all();
        $religions = Religion::all();
        $bloodGroups = Bloodgroup::all();
        $divisions = Division::all();
        $districts = District::all();
        return view('admin.opd.registration',compact(['salutations','religions','bloodGroups','divisions','districts']));
    }

    public function SaveRegistration(Request $r)    
    {
       // return $r->all();
        $img = '';
          if ($r->hasFile('img_url')) {
            $file = $r->file('img_url');
            $original_name = $file->getClientOriginalName();
            $ext = strtolower(\File::extension($original_name));
            $created_at = Carbon::now('Asia/Dhaka');
            $t = $created_at->timestamp;
            $rr = str_random(10);
            $random_name = $t . '' . $rr . '.' . $ext;
            $path = public_path() . '/images/patient/';
            $filename = "images/patient/" . $random_name;
            $file->move($path, $filename);
            $img=$filename;
        }else{
            if($r->gender == 'M'){
                $img = "images/patient/male.jpg";
            }else{
                $img = "images/patient/female.jpg"; 
            }
        }
            //return $img;
          $r->request->add(['reg_no' => $this->getRegId()]);
          $r->request->add(['reg_date' => Carbon::now()]);
          $r->request->add(['img_url' => $img]);
        //return $this->getRegNo();
       //return $r->all();
       $validated = $r->validate([
        'dob' => 'required',
        'ful_name' => 'min:5',
        'gender' => 'required'
    ]);

        \App\Registration::insert($r->except('_token'));
        
        return redirect('registrations');
    }
    // public function getRegNo()
    // {
    //     $now = Carbon::now();
    //     $m = $now->month;
    //     $d = $now->day;
    //     $y = $now->year;
    //     $h = $now->hour;
    //     $i = $now->minute;
    //     $s = $now->second;
    //     return 'R'.$m.$d.$y.$h.$i.$s;

    // }
    public function getRegId()
  	{
//R 2020 12 14 0000001
  		$mid = DB::table('registrations')->max('id')+1;

  		$t = Carbon::now();
  		$m = $t->month;

  		$y = $t->year;

  		$d = $t->day;

  		$id = 'R'.$y;
  		if($m<10){$id .= '0';}
  		$id.=$m;

  		if($d<10){$id .= '0';}
  		$id.=$d;
  		$b= '';
  		if($mid <10){ $b = '00000';}
  		elseif($mid <100){ $b = '0000';}
  		elseif($mid <1000){ $b = '000';}
  		elseif($mid <10000){ $b = '00';}
  		elseif($mid <100000){ $b = '0';}
  		$id .= $b.$mid;
  		return $id;


  	}
}