<?php

namespace App\Http\Controllers\Setup;
use App\Http\Controllers\Controller;
use App\Model\Patient\Registration;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use PDF;

class GenerateQrCodeController extends Controller
{
    public function simpleQrCode($pid) 
    {
      return \QrCode::size(300)->generate($pid);
    }    

    public function registratinPdf($id)
    {
      $pid = Registration::find($id);
      return view('admin.pdf.patient_pdf',compact('pid'));
    }
    public function generatePDF($id)
    {
       $customPaper = array(0,0,250,270);
       $pid = Registration::find($id);
       PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif','debugLayoutPaddingBox'=>true]);
        $pdf = PDF::loadView('admin.pdf.regPdf', compact(['pid']))
        ->setPaper($customPaper, 'landscape');
        return $pdf->download('pid.pdf');
    }

 
    // public function generatePDF()

    // {
    //     $data = [
    //       'title' => 'Welcome to ItSolutionStuff.com'
        
    //   ];

    //     $pdf = PDF::loadView('admin.pdf.myPDF', $data);
    //     return $pdf->download('itsolutionstuff.pdf');

    // }

   }