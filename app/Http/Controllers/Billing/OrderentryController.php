<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Model\Billing\Fninvoicechd;
use App\Model\Billing\Fninvoicemst;
use App\Model\Billing\Fnpatledger;
use App\Model\Doctor\Dctestmst;
use App\Model\Patient\Opconsultation;
use App\Model\Prescription\Ehprescpoe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderentryController extends Controller
{
    public function orderentryView()
    {
        $testshow = Dctestmst::whereIn('service_type', ['P', 'I', 'S'])->get();
        return view('admin.billing.order_entry', compact(['testshow']));
    }

    public function getPatientInfo($regNo)
    {
        //consultation
        //return $test = Ehprescpoe::with('dctestmst')->where('reg_no', $regNo)->where('order_dt','>', Carbon::parse(Carbon::now())->toDateString())->get();
        $date =  Carbon::parse(Carbon::now())->toDateString();
        $billingPat = Opconsultation::with(['patAppinfo:reg_no,salutation_id,ful_name,dob,mobile,gender', 'consultation:id,doctor_name,designation',])->where('reg_no', $regNo)->where('consult_dt', $date)->first();
        $dob = $billingPat->patAppinfo->dob;
        $years = Carbon::parse($dob)->diff(Carbon::now())->format('%y');
        $months = Carbon::parse($dob)->diff(Carbon::now())->format('%m');
        $days = Carbon::parse($dob)->diff(Carbon::now())->format('%d');
        $y = $years != 0 ? $years . 'Y ' : '';
        $m = $months != 0 ? $months . 'M ' : '';
        $d = $days != 0 ? $days . 'D' : '';
        $age = $y . $m . $d;
        return [
            'Billing' => $billingPat,
            'Age' => $age
        ];
    }

    public function patientTest($regNo)
    {
        $test = Ehprescpoe::with('dctestmst.departments')->where('reg_no', $regNo)->where('order_dt', '>', Carbon::parse(Carbon::now())->toDateString())->get();
        $testshow = Dctestmst::whereIn('service_type', ['P', 'I', 'S'])->get();
        return view('admin.billing.prescrip_test', compact(['test', 'testshow']));
    }

    public function testDept($testNo)
    {
        return Dctestmst::with('departments')->where('test_no', $testNo)->first();
    }

    public function investigations($search)
    {
        //  return $search = "ercp";
        //    $inv = Dctestmst::all();
        $inv = Dctestmst::where('test_name', 'LIKE', $search . '%')->get();
        return view('admin.billing.testPertial', compact(['inv']));
    }

    public function testsearchGetVal($testNo)
    {
        $investigation = Dctestmst::where('test_no', $testNo)->first();
        return view('admin.billing.investigation_add', compact(['investigation', 'testNo']));
    }

    public function investigationInvoiceSave(Request $r)
    {
        // return $r->sample_no;
        $discount = $r->disc_amt;
        $totalcost = collect($r->disc_amt)->sum();
        $testNo = $r->test_no;
        $srvType = $r->service_type;
        $sample = $r->sample_no;
        $amount = $r->bill_amt;
        array_push($discount, $totalcost);
        array_push($amount, $r->receivable_amt);
        array_push($testNo, 'PM');
        array_push($srvType, 'A');
        array_push($sample, null);

        
        $validated = $r->validate([
            'reg_no' => 'required'
        ]);
        $invoiceNo = $this->getInvoiceNo();
        $trxNo = $this->getTrxNo();

        Fninvoicemst::insert([
            'invoice_no' => $invoiceNo,
            'reg_no' => $r->reg_no,
            'invoice_type_no' => 'OPD',
            'dept_no' => '1030',
            'consult_by' => $r->consult_by,
            'consult_no' => $r->consult_no,
            'shift_no' => 'Gen',
            'created_by' => auth()->user()->id
        ]);

        foreach ($testNo as $k => $v) {
            Fninvoicechd::insert([
                'trx_item_no' => $trxNo,
                'invoice_no' => $invoiceNo,
                'item_no' => $v,
                'service_type' => $srvType[$k],
                'sample_no'=>$sample[$k],
                'item_qty' => 1,
                'disc_amt' => $discount[$k],
                'bill_amt' => $amount[$k]
            ]);
        }

        foreach ($testNo as $k => $v) {
            Fnpatledger::insert([
                // patlgr_no
                'trx_item_no' => $trxNo,
                'invoice_no' => $invoiceNo,
                'item_no' => $v,
                'service_type' => $srvType[$k],
                'sample_no'=>$sample[$k],
                'item_qty' => 1,
                'disc_amt' => $discount[$k],
                'bill_amt' => $amount[$k]
            ]);
        }
        return redirect('orderentryView');
    }



    
    public function getInvoiceNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('fninvoicemsts')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->year;

        $d = $t->day;

        $id = 'V' . $y;
        if ($m < 10) {
            $id .= '0';
        }
        $id .= $m;

        if ($d < 10) {
            $id .= '0';
        }
        $id .= $d;
        $b = '';
        if ($mid < 10) {
            $b = '00000';
        } elseif ($mid < 100) {
            $b = '0000';
        } elseif ($mid < 1000) {
            $b = '000';
        } elseif ($mid < 10000) {
            $b = '00';
        } elseif ($mid < 100000) {
            $b = '0';
        }
        $id .= $b . $mid;
        return $id;
    }

    public function getLedgerNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('fninvoicemsts')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->year;

        $d = $t->day;

        $id = 'V' . $y;
        if ($m < 10) {
            $id .= '0';
        }
        $id .= $m;

        if ($d < 10) {
            $id .= '0';
        }
        $id .= $d;
        $b = '';
        if ($mid < 10) {
            $b = '00000';
        } elseif ($mid < 100) {
            $b = '0000';
        } elseif ($mid < 1000) {
            $b = '000';
        } elseif ($mid < 10000) {
            $b = '00';
        } elseif ($mid < 100000) {
            $b = '0';
        }
        $id .= $b . $mid;
        return $id;
    }

    public function getTrxNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('fninvoicemsts')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->year;

        $d = $t->day;

        $id = '' . $y;
        if ($m < 10) {
            $id .= '0';
        }
        $id .= $m;

        if ($d < 10) {
            $id .= '0';
        }
        $id .= $d;
        $b = '';
        if ($mid < 10) {
            $b = '00000';
        } elseif ($mid < 100) {
            $b = '0000';
        } elseif ($mid < 1000) {
            $b = '000';
        } elseif ($mid < 10000) {
            $b = '00';
        } elseif ($mid < 100000) {
            $b = '0';
        }
        $id .= $b . $mid;
        return $id;
    }
}
