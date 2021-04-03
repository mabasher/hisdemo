<?php

namespace App\Http\Controllers\Avatar;

use App\Http\Controllers\Controller;
use App\Model\Prescription\Ehattribexamval;
use App\Model\Prescription\Ehbpwlocation;
use App\Model\Prescription\Ehpatienthpi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class AvaterController extends Controller
{
    public function avatar($avatarType)
    {
        if ($avatarType == 'maleFront') {
            return view('avatar.male-front');
        } elseif ($avatarType == 'maleBack') {
            return view('avatar.male-back');
        } elseif ($avatarType == 'femaleBack') {
            return view('avatar.female-back');
        }
        return view('avatar.female-front');
    }


    public function avatarAtrributes($bodyPartNo, $parentAtrNo, $gender)
    {
        // $avatarAttributes = Ehattribexamval::where('parent_atr_no', '173')->whereNotIn('ehbpwlocation')->get();
        $avatarAttributes = Ehattribexamval::addSelect(['isexist' => Ehbpwlocation::select('location_id')
            ->whereColumn('location_id', 'atr_no')
            ->where('bodypart_no', $bodyPartNo)
            ->where('gender', $gender)
            ->limit(1)
            ])
        ->where('parent_atr_no', $parentAtrNo)
        ->whereNotIn('atr_no', Ehbpwlocation::select('location_id')->where('bodypart_no', '<>',$bodyPartNo)->where('gender',$gender)->get())
        ->get();

        return view('avatar.patient_attributes', compact(['avatarAttributes']));
    }

    public function patientHPIsave(Request $r)
    {
        //return $r->all();
        $atr_no = implode(',', $r->atr_no);

       $validated = $r->validate([
        'atr_no' => 'required',
    ]);

    Ehpatienthpi::insert(
        ['atr_no' => $atr_no,
        'parent_atr_no' => $r->parent_atr_no,
        'body_part_no' => $r->body_part_no,
        'gender' => $r->gender,
        'reg_no' => $r->reg_no,
        'identified_no' => $r->identifyed_no]
    );
       return redirect('prescriptions/'.$r->reg_no);
    }

    public function examAttributesAdd(Request $r)
    {
        // return $r->all();
        $r->request->add(['sl_no' => $this->getAttriSlNo()]);
        $r->request->add(['atr_no' => $this->getAtrtNo()]);
        $r->request->add(['parent_atr_no' => '173']);
        $r->request->add(['created_at' => Carbon::now()]);
        $r->request->add(['created_by' => auth()->user()->id]);
        $r->request->add(['active_status' => 'Y']);

        Ehattribexamval::insert($r->except('_token'));
        return "success";
    }

    public function getAttriSlNo()
  	{
//R 2020 12 14 0000001
  		$mid = DB::table('ehattribexamvals')->max('id')+1;

  		$t = Carbon::now();
  		$m = $t->month;

  		$y = $t->year;

  		$d = $t->day;

  		$id = 'A'.$y;
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
      
      public function getAtrtNo()
  	{
  		$aid = DB::table('ehattribexamvals')->max('id')+1;
  		return $aid;


      }

}
