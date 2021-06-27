<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Model\Billing\Fninvoicechd;
use App\Model\Billing\Fninvoicemst;
use App\Model\Billing\Fnpaidmodeamt;
use App\Model\Billing\Fnpaymentdetail;
use App\Model\Billing\Fnpatledger;
use App\Model\Doctor\Dctestmst;
use App\Model\Patient\Opconsultation;
use App\Model\Patient\Registration;
use App\Model\Prescription\Ehprescpoe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Billing\Fntrxcode;
use PDF;

class OrderentryController extends Controller
{
    public function orderentryView()
    {
        $totalInvoice = Fninvoicemst::where('created_by', auth()->user()->id)->whereDate('invoice_dt', Carbon::today())->get();
        $totalAmount = Fnpatledger::where('created_by', auth()->user()->id)->where('trx_code_no', 'PM')->whereDate('ledger_dt', Carbon::today())->get();
        $testshow = Dctestmst::whereIn('service_type', ['P', 'I', 'S'])->get();
        return view('admin.billing.order_entry', compact(['testshow','totalInvoice','totalAmount']));
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
        $demo = [];
        $trxcodeNo = $r->trx_code_no;
        $discount = $r->disc_amt;
        $totalcost = collect($r->disc_amt)->sum();
        $testNo = $r->test_no;
         $srvType = $r->service_type;
        $sample = $r->sample_no;
        $amount = $r->bill_amt;
       
        array_push($discount, $totalcost);
        array_push($amount, $r->receive_amt);
        array_push($testNo, 'PM');
        array_push($srvType, 'A');
        array_push($sample, null);
        
        //   return  $amount;
        $validated = $r->validate([
            'reg_no' => 'required'
        ]);
        $invoiceNo = $this->getInvoiceNo();
        $trxNo = $this->getTrxNo();
        $ledgerNo = $this->getPatlgrNo();
        $mrNo = $this->getMrNo();
        $trainNo = $this->getTrainNo();

        Fninvoicemst::insert([
            'invoice_no' => $invoiceNo,
            'reg_no' => $r->reg_no,
            'invoice_type_no' => 'OPD',
            'dept_no' => '1030',
            'doctorinfo_id' => $r->doctorinfo_id,
            'consult_no' => $r->consult_no,
            'shift_no' => 'Gen',
            'created_by' => auth()->user()->id
        ]);

        foreach ($testNo as $k => $v) {
            Fninvoicechd::insert([
                'trx_item_no' => $trxNo+$k,
                'invoice_no' => $invoiceNo,
                'item_no' => $v,
                'service_type' => $srvType[$k],
                'sample_no'=>$sample[$k],
                'item_qty' => 1,
                'disc_amt' => $discount[$k],
                'bill_amt' => $amount[$k]
            ]);
        }

        if($r->receive_amt){
            array_push($trxcodeNo, 'PM');
        }
        if($r->overfix_discount || $r->overPercent_discount){
            array_push($trxcodeNo, 'DC');
            if($r->overfix_discount){
                array_push($amount,$r->overfix_discount);

            }else{

                array_push($amount,  $r->overPercent_discount);
            }
        }
      
        // return  [$amount,$trxcodeNo];
        foreach ($trxcodeNo as $k => $v) {
            Fnpatledger::insert([
                'patlgr_no' => $ledgerNo.$k,
                'trx_item_no' => $trxNo+$k,
                'trx_code_no' =>$v,
                'invoice_no' => $invoiceNo,
                'created_by' => auth()->user()->id,
                'mr_no' => $v == 'GS'?'':'M'.$mrNo,
                'cr_amt' =>$v == 'GS'? $amount[$k]:0,
                'dr_amt' =>$v == 'GS'?0:$amount[$k]
            ]);
        }

        Fnpaidmodeamt::insert([
            'tran_no' => $trainNo,
            'mr_no' => $mrNo,
            'payment_type' => 'CS',
            'paymentmode_type' => 'PM',
            'payment_amt' => $r->receive_amt,
            'voucher_no' => $invoiceNo
        ]);

        Fnpaymentdetail::insert([
            'mr_no' => $mrNo,
            'collected_by' => auth()->user()->id,
            'created_by' => auth()->user()->id,
            'mr_amt' => $r->receive_amt
        ]);
        // return redirect('orderentryView');
        return redirect('invoiceReport/' . $r->reg_no.'/'.$invoiceNo);
    }



    
    public function getInvoiceNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('fninvoicemsts')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->format('y');;

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
        $mid = DB::table('fninvoicechds')->max('id') + 1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->format('y');;

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

    public function getPatlgrNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('fnpatledgers')->max('id') + 1;
        // $mid = explode('L',Fnpatledger::all()->last()->mr_no)[1]+1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->format('y');

        $d = $t->day;

        $id = 'L' . $y;
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

    public function getMrNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('fnpatledgers')->max('id') + 1;
        // $mid = explode('M',Fnpatledger::all()->last()->mr_no)[1]+1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->format('y');

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

    public function getTrainNo()
    {
        //R 2020 12 14 0000001
        $mid = DB::table('fnpaidmodeamts')->max('id') + 1;
        // $mid = explode('L',Fnpatledger::all()->last()->mr_no)[1]+1;

        $t = Carbon::now();
        $m = $t->month;

        $y = $t->format('y');

        $d = $t->day;

        $id = 'T' . $y;
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


    public function invoiceReportGenerate($pid,$invoiceNo)
    {
        $customPaper = array(0, 0, 500, 500);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'debugLayoutPaddingBox' => true]);
        $registration = Registration::where('reg_no', $pid)->first();
        $invoice = Fninvoicemst::with(['invoicedetails.investigations', 'invoicedetails'=>function($q) {
            $q->where('item_no','!=', 'PM');
        }])
        ->where('invoice_no',$invoiceNo)->first();       
          $discount = Fnpatledger::where('invoice_no', $invoiceNo)->where('trx_code_no', '=', 'DC')->first();
         
        //   $netAmt = Fnpatledger::where('invoice_no', $invoiceNo)->where('trx_code_no', '=', 'PM')->first();
         $trxWiseAmount = Fnpatledger::where('invoice_no',$invoiceNo)->whereDate('ledger_dt', Carbon::today())
        ->selectRaw("SUM(cr_amt) as cramt,trx_code_no")
        ->selectRaw("SUM(dr_amt) as dramt,trx_code_no")
        ->orderBy('trx_code_no','desc')
        ->groupBy('trx_code_no')->get();
        $calculateAmount = $this->billingCalculate($trxWiseAmount);
        $pdf = PDF::loadView('admin.billing.invoice_pdf_generate', compact(['registration','invoice','discount','trxWiseAmount','calculateAmount']))
        ->setPaper($customPaper, 'landscape');
        return $pdf->download('invoice.pdf');
    }

    public function billingCalculate($trxWiseAmount)
    {
        $amount=array();
        foreach($trxWiseAmount as $trxAmt){
            if($trxAmt->trx_code_no=='GS'){
                $amount['GS']=$trxAmt->cramt;
            }
            if($trxAmt->trx_code_no=='DC'){
                $amount['DC']=$trxAmt->dramt;
            }
            if($trxAmt->trx_code_no=='PM'){
                $amount['PM']=$trxAmt->dramt;
            }
            
        }
        return $amount;
    }


    public function dueCollectionViewPage()
    {
         $totalInvoice = Fninvoicemst::where('created_by', auth()->user()->id)->whereDate('invoice_dt', Carbon::today())->get();
         $totalAmount = Fnpatledger::where('created_by', auth()->user()->id)->where('trx_code_no', 'PM')->whereDate('ledger_dt', Carbon::today())->get();
            // return $totalAmount->sum('dr_amt');
        return view('admin.billing.duecollection.duecollection_orderentry', compact(['totalInvoice','totalAmount']));
    }

    public function getDueCollectionData($invoiceNo)
    {
     
        //  $date =  Carbon::parse(Carbon::now())->toDateString();
        $patientInfo = Fninvoicemst::with(['patientinfo:reg_no,salutation_id,ful_name,dob,mobile,gender','consultation:id,doctor_name,designation'])->where('invoice_no', $invoiceNo)->whereDate('invoice_dt', Carbon::today())->first();
        // return $trxcode = Fntrxcode::with(['trxcodewiseamt'=> function($q) use($invoiceNo){
        //     $q->where('invoice_no',$invoiceNo)->whereDate('ledger_dt', Carbon::today());
        // }])->where('trx_code_no','GS')->get();
         $collectedAmt = Fnpatledger::where('invoice_no',$invoiceNo)->whereDate('ledger_dt', Carbon::today())
        ->selectRaw("SUM(cr_amt) as cramt,trx_code_no")
        ->selectRaw("SUM(dr_amt) as dramt,trx_code_no")
        ->groupBy('trx_code_no')->get();
        $dob = $patientInfo->patientinfo->dob;
        $years = Carbon::parse($dob)->diff(Carbon::now())->format('%y');
        $months = Carbon::parse($dob)->diff(Carbon::now())->format('%m');
        $days = Carbon::parse($dob)->diff(Carbon::now())->format('%d');
        $y = $years != 0 ? $years . 'Y ' : '';
        $m = $months != 0 ? $months . 'M ' : '';
        $d = $days != 0 ? $days . 'D' : '';
        $age = $y . $m . $d;
        return [
            'patientDemgraphy' =>$patientInfo,
            'Age' => $age,
            'prvCollectAmt'  =>$collectedAmt
        ];
    }

    public function getdueServicesData($invoiceNo)
    {
        $services = Fninvoicechd::with('investigations:test_no,test_name,rate')->where('invoice_no', $invoiceNo)->whereIn('service_type', ['P', 'I', 'S'])->get();
        return view('admin.billing.duecollection.duecollected_services', compact(['services']));
    }

    public function dueCollectionSave(Request $r)
    {
        $trxNo = $this->getTrxNo();
        $ledgerNo = $this->getPatlgrNo();
        $mrNo = $this->getMrNo();

        Fninvoicechd::insert([
            'trx_item_no' => $this->getTrxNo(),
            'invoice_no' => $r->invoice_no,
            'item_no' => 'PM',
            'item_qty' => 1,
            'service_type' => 'A',
            'bill_amt' => $r->payment
        ]);
              
        Fnpatledger::insert([
            'patlgr_no' => $ledgerNo,
            'trx_item_no' => $trxNo,
            'trx_code_no' =>'PM',
            'invoice_no' => $r->invoice_no,
            'created_by' => auth()->user()->id,
            'mr_no' => 'M'.$mrNo,
            'dr_amt' =>$r->payment
        ]);

        return redirect('invoiceReport/' . $r->reg_no.'/'.$r->invoice_no);

    }

    public function orderCancel()
    {
        $totalInvoice = Fninvoicemst::where('created_by', auth()->user()->id)->whereDate('invoice_dt', Carbon::today())->get();
         $totalAmount = Fnpatledger::where('created_by', auth()->user()->id)->where('trx_code_no', 'PM')->whereDate('ledger_dt', Carbon::today())->get();
        return view('admin.billing.ordercancelrefund.order_cancel', compact(['totalInvoice','totalAmount']));
    }

    public function cancelServices($invoiceNo)
    {
        $services = Fninvoicechd::with('investigations:test_no,test_name,rate')->where('invoice_no', $invoiceNo)->whereIn('service_type', ['P', 'I', 'S'])->get();
        return view('admin.billing.ordercancelrefund.cancel_order_items', compact(['services']));
    }
}
