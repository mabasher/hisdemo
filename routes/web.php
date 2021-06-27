<?php

use App\Http\Controllers\Frontpage\FrontpageController;
use App\Http\Controllers\Patient\OpappointmentController;
use App\Mail\Welcome;
use App\Model\Patient\Opappointment;
use App\Model\Patient\Opconsultation;
use App\Model\Patient\Registration;
use App\Model\Billing\Fninvoicemst;
use App\Model\Pharmacy\Pmpresmedicine;
use App\Model\Prescription\Ehpatientexam;
use App\Model\Prescription\Ehprescpoe;
use App\Model\Doctor\Doctorinfo;
use App\Model\Doctor\Day;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Model\Billing\Fnpatledger;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('mrtest', function () {
    // return  $mrNo = explode('M',Fnpatledger::all()->last()->mr_no)[1]+1;
    // return Doctorinfo::with('schedules.doctorvisit','schedules.day')->where('id',1)->first();
    $customPaper = array(0, 0, 500, 500);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'debugLayoutPaddingBox' => true]);
        $registration = Registration::where('reg_no', 'PID210605000127')->first();
        return $invoice = Fninvoicemst::with(['invoicedetails.investigations', 'invoicedetails'=>function($q){
            $q->where('item_no' != 'PM');
        }])
         ->where('invoice_no','V210617000029')->first();
        $pdf = PDF::loadView('admin.billing.invoice_pdf_generate', compact(['registration','invoice']))
        ->setPaper($customPaper, 'landscape');
        return $pdf->download('invoice.pdf');
});

// , 'invoicedetails'=>function($q){
//     $q->where('item_no' != 'PM');
// }

Route::get('testAppCard', function () {
    $appInfo = Opappointment::where('appoint_no', 'A20210502000124')->first();
        $details = [

            'title' => 'Appointment Confirmtion',
            'appId'=>'A20210502000124',
            'name'=>$appInfo

        ];
        \Mail::to('abul.basher863@gmail.com')->send(new \App\Mail\MyTestMail($details));
});

Route::get('presPdf/{renNo}', function ($regNo) {
        $date =  Carbon::parse(Carbon::now())->toDateString(); 
        $presPrint = Opconsultation::where('reg_no', $regNo)->where('consult_dt', $date)->first();
        $presPrint->consultation->designation;
        $chiefComplaint = Ehpatientexam::where('reg_no', $regNo)->first();
        $cc = explode(',',$chiefComplaint->findings);
         $patMedicine =Pmpresmedicine::where('reg_no', $regNo)->get();
        //  return $patMedicine[0]->presMedicine[0];
        // $mdose = Pmdaydptchange::where('rx_no', $patMedicine->rx_no)->get();
        $patTest =Ehprescpoe::where('reg_no', $regNo)->get();
        return view('admin.reports.prescriptionPdf', compact(['presPrint','cc','patMedicine','patTest']));
    });



// Route::get('/', function () {
//     return view('welcome');
// });
//email

//welcome Page
Route::get('/',[FrontpageController::class,'welcomepage']);
Route::get('docDept',[FrontpageController::class,'doctordept']);
Route::get('deptWiseDoctor/{deptNo}',[FrontpageController::class,'deptWiseDoctor']);
Route::get('doctorpage',[FrontpageController::class,'doctors']);
Route::get('services',[FrontpageController::class,'services']);
Route::get('about',[FrontpageController::class,'about']);
Route::get('contact',[FrontpageController::class,'contact']);

Route::get('onLineSpecialtyWiseDoctor/{deptNo}',[FrontpageController::class,'onLineSpecialtyWiseDoctor']);
Route::get('onlineSpWiseDoctor/{deptNo}',[FrontpageController::class,'onlineSpWiseDoctor']);


// Online Appointment
Route::get('doctorSearch/{keyword}',[FrontpageController::class,'doctorSearch']);
Route::post('patientAdd',[FrontpageController::class,'patientAdd']);
Route::get('patientExOnline/{regno}',[FrontpageController::class,'getExPatientOnline']);
Route::get('patientMultipleSearch/{regno}/{keyword}',[FrontpageController::class,'getMulticoloumnSearch']);
Route::get('doctorpatientapp/{doctorId}',[FrontpageController::class,'doctorpatientapp']);
Route::get('doctorpatientajax/{doctorId}',[FrontpageController::class,'doctorpatientajax']);
Route::get('getDocWeeklySchedule/{id}/{schDate}', [FrontpageController::class,'getDocWeeklySchedule']);
Route::get('virtualDocslots/{doctorId}/{dayName}',[FrontpageController::class,'getDocDailyTimeSlots']);
Route::post('appointmentInsertOnline',[FrontpageController::class,'appointmentInsertOnline']);
Route::get('appointmentCard/{aid}',[FrontpageController::class,'appointmentCardGenerate']); 
Route::post('appointmentCardduplicate',[FrontpageController::class,'appointmentCardduplicate']);
Route::get('appointmentCardduplicate',[FrontpageController::class,'CardGenerate']);

//Online Avatar Cheif Complaint
Route::get('OnlineCheifComplaint/{gender}',[FrontpageController::class,'OnlineCheifComplaint']);
Route::get('OnlineAvatarAtrributes/{bodyPartNo}/{parentAtrNo}/{gender}',[FrontpageController::class,'avatarAtrributes']);
Route::get('OnlineAttributeCollection',[FrontpageController::class,'OnlineAttributeCollection']);

//doctor Profile
Route::get('doctorprofile/{id}',[FrontpageController::class,'doctorprofileview']);

//Appointment Card PDF Generate

Route::get('appointCardPdf/{id}',[FrontpageController::class,'appointCardPdfGenerate']);
Route::get('pidCardPdf/{id}',[FrontpageController::class,'pidCardPdfGenerate']);

// end Welcome page
Route::get('table','TestController@table');


//Route::get('registration','Patient\RegistrationController@index');
Route::get('registration','Patient\RegistrationController@index')->name('basherReg');

Auth::routes();

Route::get('/home', 'Admin\HomeController@index')->name('home');

//Security
Route::middleware(['previlage'])->group(function(){
    Route::get('menusView','Security\MenusController@menusView');
    
});
Route::get('menusDelete/{id}','Security\MenusController@menusDelete');

Route::get('menus','Security\MenusController@sideMenus');
Route::get('submenusPage','Security\MenusController@submenusPage');
Route::post('saveSubMenu','Security\MenusController@saveSubMenu');
Route::get('subsubmenusPage','Security\MenusController@subsubmenusPage');
Route::post('saveSubsubMenu','Security\MenusController@saveSubsubMenu');

Route::get('menusModWise/{parentId?}','Security\MenusController@menusModWise');
Route::post('saveMenu','Security\MenusController@saveMenu');
Route::post('updateMenu','Security\MenusController@updateMenu');





//Role 
Route::get('roleView','Security\RoleController@roleView');
Route::get('rolePage','Security\RoleController@rolePage');
Route::post('saveRole','Security\RoleController@saveRole');
Route::get('roleUserPage','Security\RoleController@roleUserPage');
Route::post('saveRoleUser','Security\RoleController@saveRoleUser');
Route::get('rolemenus','Security\RoleController@rolemenus');
Route::post('saveRoleMenus','Security\RoleController@saveRoleMenus');
Route::get('getmenus/{id}','Security\RoleController@getmenus');


//Registration
Route::get('registrationviews','Patient\RegistrationController@registrationViews');
Route::get('registrations','Patient\RegistrationController@regPageInfo')->name('basherReg');
Route::post('SaveRegistration','Patient\RegistrationController@SaveRegistration');
//Appointment
// Route::middleware(['previlage'])->group(function(){
//     Route::post('appointmentInsert',[OpappointmentController::class,'appointmentInsert']);
//     Route::get('appointments/{regNo?}','Patient\OpappointmentController@appointSavePage');
    
// });
Route::post('appointmentInsert',[OpappointmentController::class,'appointmentInsert']);
Route::get('appointments/{regNo?}','Patient\OpappointmentController@appointSavePage');
Route::get('appointments2/{regNo?}','Patient\OpappointmentController@appointSavePage');
Route::get('patient/{regno}','Patient\OpappointmentController@getPatient');
Route::get('multiSms','Patient\OpappointmentController@sendSmsTodayPatient');
Route::get('patientSearch/{keyword}','Patient\OpappointmentController@getSearchingPatient');

// Route::get('appointments/{regno}','Patient\OpappointmentController@appointEditPage');

//Nurse Station
Route::get('nurseStation','Patient\NursestController@nursestation');
Route::get('ns/{consultDt?}','Patient\NursestController@ns');
Route::get('nsComp/{nsDt?}','Patient\NursestController@nsComp');
Route::post('nsMovement','Patient\NursestController@nsMovement');
Route::post('vitalSignInsert','Patient\NursestController@vitalSignInsert');
Route::get('vsComplate/{vsDt?}','Patient\NursestController@vsComplate');

//Service Station 
Route::get('serviceStation','Patient\ServiceController@serviceStation');
Route::post('ssInMovement','Patient\ServiceController@ssInMovement');
Route::post('queControlMovement','Patient\ServiceController@queControlMovement');
Route::post('missingPatMovement','Patient\ServiceController@missingPatMovement');
Route::post('recallMovement','Patient\ServiceController@recallMovement');
Route::post('doctorIn','Patient\ServiceController@doctorIn');
Route::post('doctorOut','Patient\ServiceController@doctorOut');
Route::post('roomCheck','Patient\ServiceController@roomCheck');


//doctors 
Route::get('doctors','Doctor\DoctorinfoController@doctorAllShow');
// ->middleware('previlage');
Route::get('doctormenu','Doctor\DoctorinfoController@doctorsView');
Route::get('doctorAdd','Doctor\DoctorinfoController@doctorPage');
Route::post('SaveDoctor','Doctor\DoctorinfoController@SaveDoctor');
Route::post('updateDoctor','Doctor\DoctorinfoController@setUdateDoctor');
Route::get('doctorEdit/{id}','Doctor\DoctorinfoController@doctorEditPage');
Route::get('doctors/{deptNo}','Doctor\DoctorinfoController@departmentDoctors');
Route::get('doctorWeeklySchedule/{id}/{schDate}', 'Patient\OpappointmentController@doctorWeeklySchedule');


//doctor Slot
Route::get('virtualslots/{doctorId}/{dayName}','Doctor\ResourcescheduleController@getDoctorTimeSlot');

//prescription Medicine
Route::get('patientCare/{appDt?}','Doctor\PrescriptionController@doctorPatientCare');
Route::get('prescriptions/{regNo}','Doctor\PrescriptionController@doctorprescription');
Route::get('generic/{therapeutic}','Doctor\PrescriptionController@generictherapeutic');
Route::get('genericBrand/{genericNo}','Doctor\PrescriptionController@genericWiseBrand');
Route::get('dispFrom/{testNo}','Doctor\PrescriptionController@dispatchForm');
Route::get('frequncy/{id}','Doctor\PrescriptionController@frequencies');
Route::post('savePresMedicine','Doctor\PrescriptionController@prescripMedicineInsert');


//Avatar ehattribexamval
Route::get('avatar/{avatarType}','Avatar\AvaterController@avatar');
Route::get('avatarAtrributes/{bodyPartNo}/{parentAtrNo}/{gender}','Avatar\AvaterController@avatarAtrributes');
Route::post('examAttributesAdd','Avatar\AvaterController@examAttributesAdd');
Route::post('patientHPIsave','Avatar\AvaterController@patientHPIsave');

//prescription Investigation
// Route::get('investigations/{serviceType}','Doctor\PrescriptionController@investigations')->middleware('previlage');
Route::get('investigations/{serviceType}','Doctor\PrescriptionController@investigations');
Route::post('investigationSave','Doctor\PrescriptionController@investigationSave');
Route::get('prescriptionReports/{regNo}','Doctor\PrescriptionController@prescriptionReports');
Route::get('prescriptionPdf/{regNo}','Doctor\PrescriptionController@prescriptionPdf');


//designation
Route::post('doctorDesignation','Patient\OpappointmentController@doctorDesignation');

// schedule Roser
Route::get('scheduleRoster','Doctor\ResourcescheduleController@scheduleRoster');
Route::post('scheduleRoster','Doctor\ResourcescheduleController@scheduleRosterSave');
Route::get('doctorSchedule/{id}', 'Doctor\DoctorinfoController@doctorSchedule');
Route::get('showDoctorSchedule/{id}', 'Doctor\ResourcescheduleController@showDoctorSchedule');


//setup Form
Route::get('departments','Setup\DepartmentController@departmentSetup');
Route::get('departmentAdd','Setup\DepartmentController@departmentaddPage');
Route::post('saveDepartment','Setup\DepartmentController@saveDepartment');
Route::post('deptDelete/{id}','Setup\DepartmentController@departmentDelete');
Route::get('perDivision/{code}','Setup\AjaxController@getDivisionPermanent');
Route::get('specialtyWiseDoctor/{depNo?}','Patient\OpappointmentController@getSpecialWiseDoctor');
Route::get('desigWiseDoctor/{jobId?}','Patient\OpappointmentController@getDesigWiseDoctor');


//display Qr code
//R20201214000003
//Route::get('generate-pdf','GenerateQrCodeController@generatePDF');
Route::get('pidtest/{pid}','Setup\GenerateQrCodeController@generatePDF');
Route::get('pid/{pid}','Setup\GenerateQrCodeController@registratinPdf');
Route::get('simple-qr-code/{pid}','Setup\GenerateQrCodeController@simpleQrCode');
Route::get('appointCardOnline/{appointNo}','Setup\GenerateQrCodeController@appointCardOnline');
Route::get('color-qr-code','Setup\GenerateQrCodeController@colorQrCode');
Route::get('image-qr-code','Setup\GenerateQrCodeController@imageQrCode');

// Billing

//setup
Route::get('serviceSetup','Billing\BillingSetupController@serviceSetup');
Route::get('rateCenter/{servType}','Billing\BillingSetupController@serviceRateCenter');

// order Entry
Route::get('orderentryView','Billing\OrderentryController@orderentryView');
Route::get('patientBilling/{regno}','Billing\OrderentryController@getPatientInfo');
Route::get('patientTest/{regno}','Billing\OrderentryController@patientTest');
Route::get('testDept/{testNo}','Billing\OrderentryController@testDept');
Route::get('investigationsearch/{search}','Billing\OrderentryController@investigations');
Route::get('testsearchGetVal/{testNo}','Billing\OrderentryController@testsearchGetVal');
Route::post('investigationInvoiceSave','Billing\OrderentryController@investigationInvoiceSave');
// Billing Report Generate V20210609000022
Route::get('invoiceReport/{pid}/{invoiceNo}','Billing\OrderentryController@invoiceReportGenerate');

//Due Collection
Route::get('dueCollection','Billing\OrderentryController@dueCollectionViewPage');
Route::get('duecollectionHistory/{invoiceNo}','Billing\OrderentryController@getDueCollectionData');
Route::get('dueServices/{invoiceNo}','Billing\OrderentryController@getdueServicesData');
Route::post('dueCollectionSave','Billing\OrderentryController@dueCollectionSave');

//Order Cencel Refund 
Route::get('orderCancel','Billing\OrderentryController@orderCancel');
Route::get('cancelServices/{invoiceNo}','Billing\OrderentryController@cancelServices');

// Route::get('sendMail',function(){
//     \Mail::to('abul.basher863@gmail.com')->send(new Welcome());
//     return 'success';

// });









