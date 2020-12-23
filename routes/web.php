<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('registration','RegistrationController@index');
Route::get('registration','RegistrationController@index')->name('basherReg');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('registrationviews','RegistrationController@registrationViews');
Route::get('registrations','RegistrationController@regPageInfo')->name('basherReg');
Route::post('SaveRegistration','RegistrationController@SaveRegistration');
Route::post('appointmentInsert','OpappointmentController@appointmentInsert');
Route::get('appointments/{regNo?}','OpappointmentController@appointSavePage');
// Route::get('appointments/{regno}','OpappointmentController@appointEditPage');

//doctors 
Route::get('doctors','DoctorinfoController@doctorAllShow');
Route::get('doctormenu','DoctorinfoController@doctorsView');
Route::get('doctors/{deptNo}','DoctorinfoController@departmentDoctors');
Route::get('doctorWeeklySchedule/{id}', 'OpappointmentController@doctorWeeklySchedule');
//designation
Route::post('doctorDesignation','OpappointmentController@doctorDesignation');

// schedule Roser
Route::get('scheduleRoster','ResourcescheduleController@scheduleRoster');


Route::get('doctorSchedule/{id}', 'DoctorinfoController@doctorSchedule');
Route::get('perDivision/{code}','AjaxController@getDivisionPermanent');
Route::get('specialtyWiseDoctor/{depNo?}','OpappointmentController@getSpecialWiseDoctor');
Route::get('desigWiseDoctor/{jobId?}','OpappointmentController@getDesigWiseDoctor');
Route::get('patient/{regno}','OpappointmentController@getPatient');

//setup Form
Route::get('departments','DepartmentController@departmentSetup');
Route::get('departmentAdd','DepartmentController@departmentaddPage');
Route::post('saveDepartment','DepartmentController@saveDepartment');
Route::post('deptDelete/{id}','DepartmentController@departmentDelete');



//display users list
Route::get('simple-qr-code','GenerateQrCodeController@simpleQrCode');
Route::get('color-qr-code','GenerateQrCodeController@colorQrCode');
Route::get('image-qr-code','GenerateQrCodeController@imageQrCode');


//doctor Slot
Route::get('multivisits/{doctorId}/{schDate}','ResourcescheduleController@getDoctorMultiVisit');
Route::get('virtualslots/{doctorId}/{schDate}','ResourcescheduleController@getDoctorTimeSlot');




