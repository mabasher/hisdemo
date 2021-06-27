@extends('layouts.app')
@section('css')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.3/tailwind.min.css" integrity="sha512-wl80ucxCRpLkfaCnbM88y4AxnutbGk327762eM9E/rRTvY/ZGAHWMZrYUq66VQBYMIYDFpDdJAOGSLyIPHZ2IQ==" crossorigin="anonymous" /> -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<style>
.custom-radio-button div {
    display: inline-block;
}

.custom-radio-button input[type="radio"] {
    display: none;
}

.custom-radio-button input[type="radio"]+label {
    color: #333;
    font-family: Arial, sans-serif;
    font-size: 14px;
}

.custom-radio-button input[type="radio"]+label span {
    display: inline-block;
    width: 40px;
    height: 40px;
    margin: -1px 4px 0 0;
    vertical-align: middle;
    cursor: pointer;
    border-radius: 50%;
    border: 2px solid #ffffff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
    background-repeat: no-repeat;
    background-position: center;
    text-align: center;
    line-height: 44px;
}

.custom-radio-button input[type="radio"]+label span img {
    opacity: 0;
    transition: all 0.3s ease;
}

.custom-radio-button input[type="radio"]#female+label span {
    background-color: orange;
}

.custom-radio-button input[type="radio"]#male+label span {
    background-color: #34cfeb;
}

.custom-radio-button input[type="radio"]:checked+label span {
    opacity: 1;
    background: url("https://www.positronx.io/wp-content/uploads/2019/06/tick-icon-4657-01.png") center center no-repeat;
    width: 40px;
    height: 40px;
    display: inline-block;
}

.tabscroll {
    height: 385px;
    overflow-y: auto;
    width: 300px;
}

/* .table-fixed thead,
    .table-fixed tbody,
    .table-fixed tr,
    .table-fixed td,
    .table-fixed th {
        display: block;
    }

    .table-fixed tbody td,
    .table-fixed tbody th,
    .table-fixed thead>tr>th {
        float: left;
        position: relative;
    } */

body {
    background: #74ebd5;
    background: -webkit-linear-gradient(to right, #74ebd5, #ACB6E5);
    background: linear-gradient(to right, #74ebd5, #ACB6E5);
    min-height: 100vh;

}
</style>


@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="container-fluid pr-0">
            <fieldset class="col-md-11 m-auto">
                <!-- <legend>
                        <h3>Nag</h3>
                    </legend> -->
                <div class="widget category-widget">
                    <div class="row form-group mb-0">
                        <div class="col-md-5 text-success">
                            <h4>PID :&nbsp;<span>{{$patientPrescrip->reg_no}}</span> </h4>
                            <h4>CN :&nbsp;<span>{{$patientPrescrip->consult_no}}</span> </h4>
                            <h4>App Type :&nbsp;<span>@switch($patientPrescrip->patAppinfo->app_type)
                                    @case('P')
                                    Primary Consultation
                                    @break

                                    @case('F')
                                    Followup Consultation
                                    @break
                                    @case('V')
                                    For Visit
                                    @break
                                    @case('C')
                                    Patient Counseling
                                    @break
                                    @default

                                    @endswitch</span>
                            </h4>
                            <h4 class="text-secondary">
                                {{$lastVisit? 'Last Visited: '. $lastVisit->consultation->designation.' '.$lastVisit->consultation->doctor_name:''}}
                            </h4>
                        </div>
                        <div class="col-md-5 text-success">
                            <h4>PID
                                :&nbsp;<span>{{$patientPrescrip->patAppinfo->salutation_id.' '.$patientPrescrip->patAppinfo->ful_name}}</span>
                            </h4>
                            <h4>Age : &nbsp;<span
                                    id="age"></span>,&nbsp;{{$patientPrescrip->patAppinfo->gender == 'M'?'Male':'Female'}}
                            </h4>
                            <h4>Care Giver :&nbsp;<span
                                    class="enq-parent-email">{{$patientPrescrip->consultation->designation.' '.$patientPrescrip->consultation->doctor_name}}</span>
                            </h4>
                            <h4 class="text-secondary">@switch(count($howTimeVisit))
                                @case(1)
                                1st Time Visit
                                @break
                                @case(2)
                                2nd Time Visit
                                @break
                                @case(3)
                                3rd Time Visit
                                @break
                                @default
                                {{count($howTimeVisit)}}th Time Visit
                                @endswitch
                                <!-- <button>Recent Chief Complaint</button> -->
                            </h4>
                        </div>
                        <div class="col-md-2">
                            <div class="widget category-widget text-center" style="padding: 10px;">
                                <a href="{{url('patientCare')}}" class="btn btn-sm btn-success mb-1"><i
                                        class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                <a id="chiefCompleint" class="btn btn-sm btn-info mb-1"><i class="fa fa-cc text-white"
                                        aria-hidden="true"></i></a>
                                <a type="button" class="btn btn-info btn-sm mb-1" data-toggle="modal"
                                    data-target="#vitalSign"><i class="fa fa-stethoscope text-white"
                                        aria-hidden="true"></i></a>
                                <a href="{{url('prescriptionReports/'.$patientPrescrip->reg_no)}}"
                                    class="btn btn-sm btn-success mb-1"><i class="fa fa-print"
                                        aria-hidden="true"></i></a>
                                <a type="button" class="btn btn-info btn-sm mb-1 text-white" data-toggle="modal"
                                    data-target="#recentVitalSign">Recent Vitals</a>
                                <a type="button" class="btn btn-info btn-sm mb-1 text-white" data-toggle="modal"
                                    data-target="#recentCC">Recent C.C.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="col-md-11 m-auto">
                <div class="card-box">
                    <!-- <h6 class="card-title">Bottom line justified</h6> -->
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1"
                                data-toggle="tab">Medication</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2"
                                data-toggle="tab">Investigation</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab3" data-toggle="tab">Chief Complaint</a></li> -->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="bottom-justified-tab1">
                            <div class="card">
                                <div class="card-body">
                                    <form autocomplete="off" method="POST" action="{{url('savePresMedicine')}}">
                                        @csrf

                                        <input type="hidden" id="regNo" name="reg_no"
                                            value="{{$patientPrescrip->reg_no}}" class="form-control">
                                        <input type="hidden" id="CN" name="identifyed_no"
                                            value="{{$patientPrescrip->consult_no}}" class="form-control">
                                        <input type="hidden" name="end_date" placeholder="End At" id="endDt"
                                            class="form-control">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Therapeutic Group</label>
                                                    <select class="custom-select" name="" id="theraputic">
                                                        <option value="">Select Therapeutic Group</option>
                                                        @foreach($thrapGrp as $trgrp)
                                                        <option value="{{$trgrp->thrapgrp_id}}">
                                                            {{$trgrp->thrapgrp_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <input type="text" class="form-control" name="contact_no" placeholder="Therapeutic Group"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Generic Name</label>
                                                    <select class="custom-select" name="generic_no" id="generic">
                                                        <option value="">Select Generic Name</option>
                                                        @foreach($generic as $g)
                                                        <option value="{{$g->generic_no}}">
                                                            {{$g->generic_name.' '.$g->test_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>Brand Name</label>
                                                <select class="custom-select" name="item_no" id="brand">
                                                    <!-- <option value="">Select Brand Name</option> -->

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-2 mb-3">
                                                <div class="form-group">
                                                    <label>Dis. Form</label>
                                                    <input type="text" id="disform" placeholder="Dispense Form"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-group">
                                                    <label>Stock</label>
                                                    <input type="text" id="stockQty" placeholder="Stock"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <div class="form-group">
                                                    <label>Dose/Take</label>
                                                    <input type="text" id="dosetake" name="dose_per_take"
                                                        placeholder="Dose/Take" class="form-control text-center">
                                                </div>
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <div class="form-group">
                                                    <label>.</label>
                                                    <input type="text" id="uom" class="form-control text-center"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Frequency</label>
                                                <select class="custom-select" name="frequency_id" id="frequency">
                                                    <option value="">Frequency</option>
                                                    @foreach($frequency as $fq)
                                                    <option value="{{$fq->id}}">{{$fq->abbreviation}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Duration</label>
                                                <input type="text" id="duration" name="duration" placeholder=""
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Type</label>
                                                <select class="custom-select" id="durationType" name="duration_type">
                                                    <option value="H">Hour's</option>
                                                    <option value="D">Days</option>
                                                    <option value="W">Week(s)</option>
                                                    <option value="M">Month(s)</option>
                                                    <option value="Y">Year(s)</option>
                                                    <option value="C">Continuing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-2 mb-3">
                                                <div class="form-group">
                                                    <label>DPT. Details</label>
                                                    <input type="text" name="dpt_details" id="dptdetail"
                                                        placeholder="DPT. Details" class="form-control">
                                                </div>
                                            </div>



                                            <div class="col-md-2 mb-3">
                                                <div class="form-group">
                                                    <label>Route</label>
                                                    <select class="custom-select" name="route_id">
                                                        @foreach($route as $rt)
                                                        <option value="{{$rt->id}}">{{$rt->abbreviation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Instruction</label>
                                                <select class="custom-select" name="instruction_id">
                                                    <option value="">Instruction</option>
                                                    @foreach($instruc as $ins)
                                                    <option value="{{$ins->id}}">{{$ins->abbreviation}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Start At</label>
                                                <input type="text" name="start_date" placeholder="Start At" id="toDate"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Priority</label>
                                                <select class="custom-select" name="med_status">
                                                    <option value=""></option>
                                                    <option value="R">Routine</option>
                                                    <option value="U">Urgent</option>
                                                    <option value="S">Stat</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label>Prescribed Qty</label>
                                                <input type="text" name="rx_total_dpt" placeholder="Prescribed Qty"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 m-auto">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input gender" type="radio" id="gender_male"
                                                    name="purchase_type" value="L">
                                                <label class="form-check-label" for="gender_male">Self Purchase</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input gender" type="radio" id="gender_female"
                                                    name="purchase_type" value="P">
                                                <label class="form-check-label" for="gender_female">Local
                                                    Purchase</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input gender" type="hidden" id="gender_others"
                                                    name="purchase_type" value="O" checked>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8 m-auto">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Medicine</th>
                                            <th scope="col">Does</th>
                                            <th scope="col" class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($patMedicine as $pm)
                                        <tr>
                                            <th scope="row">{{$loop->iteration }}</th>
                                            <td>{{$pm->presMedicine[0]->test_name}}</td>
                                            <td>{{$pm->getDose->dpt_details}}</td>
                                            <td class="text-right"><a type="button" href="#"
                                                    class="btn btn-outline-danger"><i class="fa fa-trash-o"
                                                        aria-hidden="true"></i>
                                                </a></td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane" id="bottom-justified-tab2">

                            <!-- <form autocomplete="off" method="POST" action="{{url('investigationSave')}}"> -->
                            <!-- @csrf -->
                            <div class="col-md-8 m-auto">
                                <div class="form-row text-info mb-3">
                                    <input type="hidden" name="reg_no" value="{{$patientPrescrip->reg_no}}"
                                        class="form-control">
                                    <input type="hidden" name="identifyed_no" value="{{$patientPrescrip->consult_no}}"
                                        class="form-control">
                                    <div class="col-md-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input investivation" type="radio"
                                                name="service_type" id="pathology" value="P" checked>
                                            <h4 class="form-check-label" for="gender_male">Pathology & Diagnostics</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input investivation" type="radio"
                                                name="service_type" id="service" value="S">
                                            <h4 class="form-check-label" for="gender_female">Services</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input investivation" type="radio"
                                                name="service_type" id="radiology" value="I">
                                            <h4 class="form-check-label" for="gender_female">Radiology & Imaging</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 m-auto">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label>Investigation</label>
                                            <select class="custom-select" name="test_no" id="investigation">
                                                <option value="">Select Investigation</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label>Service Type</label>
                                            <input type="text" class="form-control" id="srvtype"
                                                placeholder="Service Type">
                                            <input type="hidden" class="form-control" id="srvtypeId"
                                                placeholder="Service Type">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label>Status</label>
                                        <select class="custom-select" id="invStatus" name="inv_status">
                                            <option value="R">Routine</option>
                                            <option value="U">Urgent</option>
                                            <option value="S">Stat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label>Lab Instruction</label>
                                        <textarea rows="2" cols="2" class="form-control disableEnable"
                                            placeholder="Lab Instruction" id="labInstrc"
                                            name="lab_instruction"></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Additional Instruction</label>
                                        <textarea rows="2" cols="2" class="form-control disableEnable"
                                            placeholder="Additional Instruction" id="additInstrc"
                                            name="additional_instruction"></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary" id="invSaveData" type="button" title="Save">Save
                                        <!-- <svg  width="15px" id="loadId"  aria-hidden="true" focusable="false" data-prefix="fas" data-icon="spinner" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-spinner fa-w-16 fa-spin fa-lg d-none"><path fill="currentColor" d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z" class=""></path></svg> -->
                                    </button>
                                </div>
                            </div>
                            <!-- </form> -->
                            <br>
                            <div class="col-md-8 m-auto">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Investigation</th>
                                            <th scope="col" class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($patTest as $pt)
                                        <tr>
                                            <th scope="row">{{$loop->iteration }}</th>
                                            <td>{{$pt->dctestmst->test_name}}</td>
                                            <td class="text-right"><a type="button" href="#"
                                                    class="btn btn-outline-danger"><i class="fa fa-trash-o"
                                                        aria-hidden="true"></i>
                                                </a></td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="tab-pane" id="bottom-justified-tab3">
                        
                    </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chiefCompModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-success" id="exampleModalCenterTitle">Chief Complaint</h3>
                <button type="button" class="close" onclick="window.location.reload()" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="m-auto">
                    <div id="srcHistoryIllness" style="display: block;">
                        <div class="text-center">
                            <div class="custom-radio-button">
                                <div class="form-row">
                                    <input type="radio" id="male" name="q1" value="M" class="genderbutton"
                                        data-position="maleFront" checked>
                                    <label for="male" title="Male">
                                        <span>
                                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                                        </span>
                                    </label>
                                    <input type="radio" id="female" name="q1" value="F" class="genderbutton"
                                        data-position="femaleFront">
                                    <label for="female" title="Female"><span><i class="fa fa-female fa-2x"
                                                aria-hidden="true"></i>
                                        </span></label>&nbsp;&nbsp;
                                    <a title="Add Attributes" id="add"><i class="fa fa-plus text-success"
                                            aria-hidden="true"></i></a>
                                    <a title="Add Attributes" id="remove"><i class="fa fa-minus text-danger"
                                            aria-hidden="true"></i></a>
                                    &nbsp;&nbsp;
                                    <div id="newAttrib">
                                        <input type="text" id="attrName" width="50px" placeholder="Add Attributes"
                                            class="form-control">
                                    </div>
                                    <div id="saveAttrib">
                                        <button type="button" title="Save" id="saveData"
                                            class="btn btn-outline-success"><i class="fa fa-save"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div id="maleRadio" style="overflow: auto;">

                            <table style="width: 100%;">
                                <tr>
                                    <td id="loadAvatar" style="width: 250px;vertical-align: top;">
                                        @include('avatar.male-front')
                                        @include('avatar.female-front')
                                        @include('avatar.male-back')
                                        @include('avatar.female-back')
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <form method="POST" action="{{url('patientHPIsave')}}">
                            @csrf
                            <input type="hidden" name="reg_no" value="{{$patientPrescrip->reg_no}}"
                                class="form-control">
                            <input type="hidden" name="identifyed_no" value="{{$patientPrescrip->consult_no}}"
                                class="form-control">
                            <input type="hidden" id="bodyPartno" name="body_part_no" class="form-control">
                            <input type="hidden" id="parentAtrNo" name="parent_atr_no" class="form-control">
                            <input type="hidden" id="genderhpi" name="gender" class="form-control">

                            <div id="patientAttrib" class="mt-3" display="none">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="vitalSign" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-success" id="exampleModalCenterTitle">Patient Vital Sign</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="col-lg-12 m-auto">
                    <div class="card-body">
                        <form autocomplete="off" id="nsFormId" method="POST" action="{{url('vitalSignInsert')}}">
                            @csrf
                            <div class="form-row">
                                <input type="hidden" class="form-control" id="consultId" name="opconsultation_id">
                                <input type="hidden" class="form-control" id="consultNo" name="consult_no">
                                <input type="hidden" class="form-control" id="regNo" name="reg_no">
                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <label>Chief Complaint</label>
                                        <div class="form-row">
                                            <textarea rows="1" cols="1" class="form-control disableEnable"
                                                placeholder="Chief Complaint" id="chiefComplain"
                                                name="chief_complain"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label>Temp °F</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="tempF" name="temp_f"
                                                    placeholder="°F Fahrenheit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Temp °C</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="tempC" name="temp_c"
                                                    placeholder="°C Celsius">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Taken Position</label>
                                    <select class="custom-select" name="temp_remark">
                                        <option value="Oral">Oral</option>
                                        <option value="Ear">Ear</option>
                                        <option value="Rectal">Rectal</option>
                                        <option value="Axillary">Axillary</option>
                                        <option value="Temporal">Temporal</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Pulse (min)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="pulse" name="pulse"
                                                    placeholder="Pulse (min)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Taken Position</label>
                                    <select class="custom-select" name="pulse_taken_side">
                                        <option value="Left arm">Left Arm</option>
                                        <option value="Right arm">Right Arm</option>
                                        <option value="left leg">Left Leg</option>
                                        <option value="Right leg">Right Leg</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label>Respiration Rate(min)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="respiratory_rate"
                                                    placeholder="Respiratory Rate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Taken Position</label>
                                    <select class="custom-select" name="rr_location">
                                        <option value="Laying">Laying</option>
                                        <option value="Standing">Standing</option>
                                        <option value="Sitting">Sitting</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>BP Systolic</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="systolic" name="bp_higher"
                                                    placeholder="Systolic">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>BP Diastolic</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="diastolic" name="bp_lower"
                                                    placeholder="Diastolic mmHg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Taken Position</label>
                                    <select class="custom-select" name="bp_taken_mode">
                                        <option value="Laying">Laying</option>
                                        <option value="Standing">Standing</option>
                                        <option value="Sitting">Sitting</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Taken From</label>
                                    <select class="custom-select" name="bp_taken_side">
                                        <option value="Left arm">Left Arm</option>
                                        <option value="Right arm">Right Arm</option>
                                        <option value="left leg">Left Leg</option>
                                        <option value="Right leg">Right Leg</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label>Heart Rate</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="heart_rate"
                                                    placeholder="Heart Rate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>LMP (dd/mm/yyyy)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="lmp" placeholder="LMP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>OFC</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ofc" placeholder="OFC">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Weight (KG)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="weight_kg"
                                                    placeholder="Weight (KG)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Weight (LB)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="weight_lb"
                                                    placeholder="Weight (LB)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Height (cm)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="height_cm"
                                                    placeholder="Height (cm)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label>BMI (kg/m<sup>2</sub>)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="bmi" placeholder="BMI">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>BSA (m<sup>2</sub>)</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="bsa" placeholder="BSA">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Pain Location</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="pain_location"
                                                    placeholder="Pain Location">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>Severity Level</label>
                                    <select class="custom-select" name="severity_level">
                                        <option value="MI">Mild</option>
                                        <option value="MD">Moderate</option>
                                        <option value="HI">High</option>
                                        <option value="VH">Very High</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Remarks</label>
                                    <div class="form-row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="comments"
                                                    placeholder="Remarks">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recentVitalSign" tabindex="-1" role="dialog" aria-labelledby="recentVs" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-success" id="recentVs">Most Recent Vital Sign</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="col-lg-12 m-auto">
                    <div class="card-body">
                        <table class="table">
                            @if($recentVitals != null)
                            <tr class="text-center text-success">
                                <td colspan="2">
                                    <h4>{{$recentVitals->created_at? 'Taken Time'.': '.$recentVitals->created_at:'Taken Time:'}}
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td>{{$recentVitals->temp_f? 'Temp(deg F)'.': '.$recentVitals->temp_f:'Temp(deg F):'}}
                                </td>
                                <td>{{$recentVitals->temp_c? 'Temp(deg C)'.': '.$recentVitals->temp_c:'Temp(deg C):'}}
                                </td>
                            </tr>
                            <tr>
                                <td>{{$recentVitals->pulse? 'Pulse/min'.': '.$recentVitals->pulse:'Pulse/min:'}}</td>
                                <td>{{$recentVitals->respiratory_rate? 'RR/min'.': '.$recentVitals->respiratory_rate:'RR/min:'}}
                                </td>
                            </tr>
                            <tr>
                                <td>{{$recentVitals->bp_higher? 'Systolic'.': '.$recentVitals->bp_higher:'Systolic:'}}
                                </td>
                                <td>{{$recentVitals->bp_lower? 'Diastolic'.': '.$recentVitals->bp_lower:'Diastolic:'}}
                                </td>
                            </tr>
                            <tr>
                                <td>{{$recentVitals->weight_kg? 'Weight(kg)'.': '.$recentVitals->weight_kg:'Weight(kg):'}}
                                </td>
                                <td>{{$recentVitals->height_cm? 'Height(cm)'.': '.$recentVitals->height_cm:'Height(cm):'}}
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recentCC" tabindex="-1" role="dialog" aria-labelledby="chiefComp" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-success" id="chiefComp">Most Recent Chief Complaint</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="col-lg-12 m-auto">
                    <div class="card-body">
                        @if($recentCC != null)
                        <div class="text-center">
                            <h4><span class="text-success">Chief Complaint: </span>{{$recentCC->findings}}</h4>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('admin/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/js/jquery.maphilight.js')}}"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script>
$(function() {
    var invstigat = $('.investivation').val();
    var srvType = '';
    var srvTypeId = '';
    if (invstigat == 'P') {
        srvType = 'Pathology';
        srvTypeId = 'P';

    } else if (invstigat == 'S') {
        srvType = 'Services';
        srvTypeId = 'S';
    } else if (invstigat == 'I') {
        srvType = 'Radiology';
        srvTypeId = 'R';
    }
    getInvestigations(invstigat);
    $('#srvtype').val(srvType);
    $('#srvtypeId').val(srvTypeId);


    $('#remove').hide();
    $('#add').show();
    $('#newAttrib').hide();
    $("#saveAttrib").hide();
    $('.avatars').hide();
    $('#mf').show();
    onLoadJQ();
    var dob = '{{$patientPrescrip->patAppinfo->dob}}';
    var age = ageCalculator(dob);
    $('#age').html(age);

    var date = new Date();
    var fstday = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 4);
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());


    $('#toDate').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        startDate: fstday,
        endDate: date,
        inline: true,
    });
    $('#toDate').datepicker('setDate', today);

});

// function getPatient(regno) {
//     $.ajax({
//         url: "{{url('prescriptions')}}/" + regno,
//         type: 'get',
//         success: function(data) {
//             $('#salutationId').val(data.salutation_id);
//             $('#fulName').val(data.ful_name);
//             $('#dob').val(data.dob);
//             $("input[name=gender][value='" + data.gender + "']").prop("checked", true);
//             $('#mobile').val(data.mobile);
//             $('#email').val(data.email);
//             $('#emContactNo').val(data.em_contact_no);
//             $('#emContactPerson').val(data.em_contact_person);
//             $('#nid').val(data.national_id);
//             $('#religion').val(data.religion_no);
//             $('#preAddress').val(data.pre_address);
//             $('#preDivision').val(data.pre_division);
//             getCity(data.pre_division, 'city');
//             setTimeout(() => {
//                 $('#city').val(data.pre_district);
//             }, 300);
//             $('#postalCode').val(data.pre_postoffice);

//             console.log(data);

//         }
//     })
// }

$('#generic').on('change', function() {
    var itemNo = '';
    var generic = $(this).val();
    gerBrand(generic);
    setTimeout(function() {
        itemNo = $('#brand :selected').val();
        getDispatchForm(itemNo);
    }, 500);


})

function gerBrand(genericNo) {
    $.ajax({
        url: "{{url('genericBrand')}}/" + genericNo,
        type: 'get',
        success: function(data) {
            console.log(data);
            $('#brand').html(data);
        }
    })
}

$('#theraputic').on('change', function() {
    var theraputic = $(this).val();
    gerGeneric(theraputic);

})

function gerGeneric(theraputic) {
    $.ajax({
        url: "{{url('generic')}}/" + theraputic,
        type: 'get',
        success: function(data) {
            console.log(data);
            $('#generic').html(data);
        }
    })
}

$('#brand').on('change', function() {
    var disfrom = $(this).val();
    getDispatchForm(disfrom);

})

function getDispatchForm(dispFrom) {
    $.ajax({
        url: "{{url('dispFrom')}}/" + dispFrom,
        type: 'get',
        success: function(data) {
            $('#disform').val(data.productname);
            $('#stockQty').val(data.stock);
            $('#dosetake').val(data.quantity);
            $('#uom').val(data.dose);
            // alert(data.stock);
        }
    })
}

$('#frequency').on('change', function() {
    var frequency = $(this).val();
    getfrequencyDose(frequency);

})

function getfrequencyDose(id) {
    $.ajax({
        url: "{{url('frequncy')}}/" + id,
        type: 'get',
        success: function(data) {
            $('#dptdetail').val(data.dptdtl);
        }
    })
}

$('#durationType').on('change', function() {
    var duraType = $(this).val();
    var duration = $('#duration').val();
    var stDt = $('#toDate').val();
    // var enddt= new Date(stDt.getDate()+duration);
    if (duraType == 'D') {
        //alert(stDt);
    } else {}
})

// Vital Sign Start
$('#tempF').on("change", function() {
    var vTempT = $(this).val();
    var vTempC;
    if (vTempT < 85 || vTempT > 108) {
        if (confirm('out of normal range (85 - 108)')) {
            vTempC = ((vTempT - 32) * 5) / 9;
            var n = vTempC.toFixed(2);
            $('#tempC').val(n);
        } else {
            $(this).val('');
            $('#tempC').val('');
        }

    } else {
        vTempC = ((vTempT - 32) * 5) / 9;
        var n = vTempC.toFixed(2);
        $('#tempC').val(n);
    }

});

$('#pulse').on("change", function() {
    var pulse = $(this).val();
    if (pulse < 30 || pulse > 110) {
        if (confirm('out of normal range (30 - 110)')) {
            $('#pulse').val(pulse);
        } else {
            $(this).val('');
        }

    } else {
        $('#pulse').val(pulse);
    }

});

$('#systolic').on("change", function() {
    var systolic = $(this).val();
    var diastolic = $('#diastolic').val();
    if (systolic < diastolic) {
        alert('BP higer must be greter than BP lower.')
        $(this).val('');
    } else {
        systolic = $(this).val();
    }

});

$('#diastolic').on("change", function() {
    var diastolic = $(this).val();
    var systolic = $('#systolic').val();
    if (diastolic > systolic) {
        alert('BP lower must be less than BP higer.')
        $(this).val('');
    } else {
        // diastolic = $(this).val();
    }

});
//Vital Sign End


//Avatar Start
var $jq = jQuery.noConflict();
$jq(function() {
    onLoadJQ();
});

function onLoadJQ() {
    $jq('.map').maphilight({
        strokeOpacity: "0",
        fade: true
    });
    $jq('.map').css("background-size", "204px 383px");
    /* $jq('area[data-key="head"]').data('maphilight', { 
                  alwaysOn: true 
            	}).trigger('alwaysOn.maphilight'); */

    $jq(document).on('click', ".tabs area", function() {
        $jq(this).data('maphilight', {
            alwaysOn: true
        }).trigger('alwaysOn.maphilight');

        if (!$(this).hasClass('selected')) {
            var onclick = $(this).attr('data-onclick');
            var value = onclick.trim().split(',');
            showAvatarArribDetail(value[0].trim(), value[1].trim(), value[2].trim(), this);

            $('#bodyPartno').val(value[0].trim());
            $('#parentAtrNo').val(value[1].trim());
            $('#genderhpi').val(value[2].trim());

            $jq('.selected').data('maphilight', {
                alwaysOn: false
            }).trigger('alwaysOn.maphilight');
            $jq('.tabs area').removeClass('selected');
            $jq(this).addClass('selected');
        }
    });

}



function showAvatarArribDetail(bodyPartNo, parentAtrNo, gender, part_name) {
    var datakey = $(part_name).attr("data-key");
    $.ajax({
        url: "{{url('avatarAtrributes')}}/" + bodyPartNo + '/' + parentAtrNo + '/' + gender,
        type: 'get',
        success: function(data) {
            $('#patientAttrib').show();
            $('#patientAttrib').html(data);
            $('#bodyPartName').html('Location of ' + datakey);

        }
    })

}

// ajax of avater
$('.avaterShow').on('click', function() {
    $('.avatars').hide();
    var position = $(this).data('position');
    $('#' + position).show();
})

$('.genderbutton').on('change', function() {
    $('.avatars').hide();
    var genderVal = $(this).val();
    var position = $(this).data('position');
    if (genderVal == 'M') {
        $('#mf').show();
        $('#patientAttrib').hide();
    } else {
        $('#ff').show();
        $('#patientAttrib').hide();
    }

})

$('#chiefCompleint').on('click', function(e) {
    e.preventDefault();
    $('#chiefCompModal').modal('show');
    $('#patientAttrib').hide();

})


$("#add").click(function() {
    $("#newAttrib").show();
    $("#attrName").val('');
    $("#saveAttrib").show();
    $('#remove').show();
    $('#add').hide();
});

$("#remove").click(function() {
    $("#newAttrib").hide();
    $("#saveAttrib").hide();
    $('#remove').hide();
    $('#add').show();
});

$("#saveData").click(function() {
    examvalAttrib();
    $("#newAttrib").hide();
    $("#saveAttrib").hide();
    $('#remove').hide();
    $('#add').show();
});

function examvalAttrib() {
    var attrName = $('#attrName').val();
    $.ajax({
        url: "{{url('examAttributesAdd')}}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            'atr_name': attrName
        },
        success: function(data) {

        }
    })
}

$("#invSaveData").click(function() {
    investigationDataSave();
});

function investigationDataSave() {
    var regNo = $('#regNo').val();
    var cn = $('#CN').val();
    var testNo = $('#investigation').val();
    var srvType = $('#srvTypeId').val();
    var invStatus = $('#invStatus').val();
    var labInstarction = $('#labInstrc').val();
    var additionalIns = $('#additInstrc').val();
    $.ajax({
        url: "{{url('investigationSave')}}",
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            'reg_no': regNo,
            'identifyed_no': cn,
            'test_no': testNo,
            'service_type': srvType,
            'inv_status': invStatus,
            'lab_instruction': labInstarction,
            'additional_instruction': additionalIns
        },
        beforeSend: function() {
            // $('$loadId').removeClass('d-none');
        },
        success: function(data) {
            // console.log('success')
            // alert('Data Save Successfully');

        },
        complete: function() {
            alert("Data save successfully");
            $('#investigation').val('');
            $('#labInstrc').val('');
            $('#additInstrc').val('');
        }

    })
}


$('.investivation').on('change', function() {
    var invstigat = $(this).val();
    var srvType = '';
    var srvTypeId = '';
    if (invstigat == 'P') {
        srvType = 'Pathology';
        srvTypeId = 'P';
    } else if (invstigat == 'S') {
        srvType = 'Services';
        srvTypeId = 'S';
    } else if (invstigat == 'I') {
        srvType = 'Radiology';
        srvTypeId = 'R';
    }
    getInvestigations(invstigat);
    $('#srvtype').val(srvType);
    $('#srvtypeId').val(srvTypeId);

});

function getInvestigations(srvType) {
    $.ajax({
        url: "{{url('investigations')}}/" + srvType,
        type: "GET",
        success: function(data) {
            $('#investigation').html(data);
        }
    })
}
</script>
@endsection