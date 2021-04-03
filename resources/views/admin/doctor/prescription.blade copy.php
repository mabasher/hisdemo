@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<style>

</style>


@endsection

@section('content')
<div class="content">
    <div class="row">
        <aside class="col-md-10 m-auto">
            <div class="widget category-widget">
                <div class="row text-success">
                    <div class="col-md-3">
                        <h4>PID : {{$patientPrescrip->reg_no}}</h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Name : {{$patientPrescrip->patAppinfo->salutation_id.' '.$patientPrescrip->patAppinfo->ful_name}}</h4>
                    </div>
                    <div class="col-md-2">
                        <h4>Age :<span id="age"></span></h4>
                    </div>
                    <div class="col-md-2">
                        <h4>Gender : {{$patientPrescrip->patAppinfo->gender == 'M'?'Male':'Female'}}</h4>
                    </div>
                </div>
                <div class="row text-success">
                    <div class="col-md-3">
                        <h4>CN : {{$patientPrescrip->consult_no}}</h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Appoint Type : @switch($patientPrescrip->patAppinfo->app_type)
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

                            @endswitch
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Doctor : {{$patientPrescrip->consultation->designation.' '.$patientPrescrip->consultation->doctor_name}}</h4>
                    </div>
                    <div class="col-md-1">
                        <a href="{{url('patientCare')}}" class="btn btn-success">Back</a>
                    </div>
                </div>

            </div>
        </aside>
        <div class="col-md-10 m-auto">
            <div class="card-box">
                <!-- <h6 class="card-title">Bottom line justified</h6> -->
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1" data-toggle="tab">Medication</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2" data-toggle="tab">Investigation</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab3" data-toggle="tab">Chief Complaint</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="bottom-justified-tab1">
                        <div class="card">
                            <div class="card-body">
                                <form autocomplete="off" method="POST" action="{{url('savePresMedicine')}}">
                                    @csrf

                                    <input type="hidden" name="reg_no" value="{{$patientPrescrip->reg_no}}" class="form-control">
                                    <input type="hidden" name="identifyed_no" value="{{$patientPrescrip->consult_no}}" class="form-control">
                                    <input type="hidden" name="end_date" placeholder="End At" id="endDt" class="form-control">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Therapeutic Group</label>
                                                <select class="custom-select" name="" id="theraputic">
                                                    <option value="">Select Therapeutic Group</option>
                                                    @foreach($thrapGrp as $trgrp)
                                                    <option value="{{$trgrp->thrapgrp_id}}">{{$trgrp->thrapgrp_name}}</option>
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
                                                    <option value="{{$g->generic_no}}">{{$g->generic_name.' '.$g->test_name}}</option>
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
                                                <input type="text" id="disform" placeholder="Dispense Form" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="text" id="stockQty" placeholder="Stock" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1 mb-3">
                                            <div class="form-group">
                                                <label>Dose/Take</label>
                                                <input type="text" id="dosetake" name="dose_per_take" placeholder="Dose/Take" class="form-control text-center">
                                            </div>
                                        </div>
                                        <div class="col-md-1 mb-3">
                                            <div class="form-group">
                                                <label>.</label>
                                                <input type="text" id="uom" class="form-control text-center" disabled>
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
                                            <input type="text" id="duration" name="duration" placeholder="" class="form-control">
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
                                                <input type="text" name="dpt_details" id="dptdetail" placeholder="DPT. Details" class="form-control">
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
                                            <input type="text" name="start_date" placeholder="Start At" id="toDate" class="form-control">
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
                                            <input type="text" name="rx_total_dpt" placeholder="Prescribed Qty" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-auto">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input gender" type="radio" id="gender_male" name="purchase_type" value="L">
                                            <label class="form-check-label" for="gender_male">Self Purchase</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input gender" type="radio" id="gender_female" name="purchase_type" value="P">
                                            <label class="form-check-label" for="gender_female">Local Purchase</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input gender" type="hidden" id="gender_others" name="purchase_type" value="O" checked>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab2">
                        <div class="col-md-8 m-auto">
                            <div class="form-row text-info mb-3">
                                <div class="col-md-5">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="service_type" id="pathology" value="P" checked>
                                        <h4 class="form-check-label" for="gender_male">Pathology & Diagnostics</h4>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="service_type" id="service" value="S">
                                        <h4 class="form-check-label" for="gender_female">Services</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="service_type" id="radiology" value="R">
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
                                        <select class="custom-select" name="investigation">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label>Service Type</label>
                                        <input type="text" class="form-control" name="contact_no" placeholder="Service Type">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Status</label>
                                    <select class="custom-select" name="frequency">
                                        <option value=""></option>
                                        <option value="">Routine</option>
                                        <option value="">Urgent</option>
                                        <option value="">Stat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label>Lab Instruction</label>
                                    <textarea rows="2" cols="2" class="form-control disableEnable" placeholder="Lab Instruction" id="labInstrc" name="per_address"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Additional Instruction</label>
                                    <textarea rows="2" cols="2" class="form-control disableEnable" placeholder="Additional Instruction" id="additInstrc" name="per_address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab3">
                        <div class="col-md-12 col-sm-12" id="srcHistoryIllness" style="display: block;">
                            <div class="text-center">
                                <div class="form-group" style="margin: 5px 0px 0px 50px;">
                                    <div data-toggle="buttons">
                                        <label class="btn btn-default btn-circle btn-lg active " title="Male"><input type="radio" name="q1" value="M" class="genderbutton" data-position="maleFront" checked><i class="fa fa-male "></i></label>
                                        <label class="btn btn-default btn-circle btn-lg" title="Female"> <input type="radio" name="q1" value="F" class="genderbutton" data-position="femaleFront"><i class="fa fa-female"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div id="maleRadio" style="overflow: auto;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td id="loadAvatar" style="width: 250px;vertical-align: top;">
                                            @include('avatar.male-front');
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <!-- <div id="femaleRadio" style="overflow: auto;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 250px;">
                                            
                                            
                                        </td>
                                        <td id="hpiLocationInfoDiv" style="vertical-align: top;">
                                        </td>
                                    </tr>

                                </table>
                            </div> -->
                        </div>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script>
    $(function() {
        $('#femaleRadio').hide();
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

    function getPatient(regno) {
        $.ajax({
            url: "{{url('prescriptions')}}/" + regno,
            type: 'get',
            success: function(data) {
                $('#salutationId').val(data.salutation_id);
                $('#fulName').val(data.ful_name);
                // $('#dob').val(data.dob);
                // $("input[name=gender][value='" + data.gender + "']").prop("checked", true);
                // $('#mobile').val(data.mobile);
                // $('#email').val(data.email);
                // $('#emContactNo').val(data.em_contact_no);
                // $('#emContactPerson').val(data.em_contact_person);
                // $('#nid').val(data.national_id);
                // $('#religion').val(data.religion_no);
                // $('#preAddress').val(data.pre_address);
                // $('#preDivision').val(data.pre_division);
                // getCity(data.pre_division, 'city');
                // setTimeout(() => {
                //     $('#city').val(data.pre_district);
                // }, 300);
                // $('#postalCode').val(data.pre_postoffice);

                console.log(data);

            }
        })
    }

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
                // showHPIPortionDetails(value[0].trim(), value[1].trim(), value[2].trim(), this);
                $jq('.selected').data('maphilight', {
                    alwaysOn: false
                }).trigger('alwaysOn.maphilight');
                $jq('.tabs area').removeClass('selected');
                $jq(this).addClass('selected');
            }
        });

    }


    function showFrontPart(frontSide, backSide) {
        onLoadJQ();
        $("#" + frontSide).css("display", "block");
        $("#" + backSide).css("display", "none");

    }

    function showBackPart(frontSide, backSide) {
        onLoadJQ();
        $("#" + frontSide).css("display", "none");
        $("#" + backSide).css("display", "block");

    }




    // 08022021 tomorrow Start
    function showHPIPortionDetails(body_part_no, parent_atr_no, gender, part_name) {
        var datakey = $(part_name).attr("data-key");
        var ajaxURL = "patHPILocationOnlAc.do?bodyPartNo=" + body_part_no + "&parentAttributeNo=" + parent_atr_no + "&gender=" + gender;
        $.ajax({
            url: ajaxURL,
            success: function(result) {
                $("#hpiLocationInfoDiv").html(result);
                $("#hpiLocationInfoDiv2").html(result);
            },
            complete: function() {
                $('#bodyPortionNameDiv').html('Location of ' + datakey);
            }
        });
    }


    // ajax of avater
    $(document).on('click', '.avaterShow', function() {
        var position = $(this).data('position');
        $.ajax({
            url: "{{url('avatar')}}/" + position,
            type: 'Get',
            success: function(data) {
                onLoadJQ();
                $('#loadAvatar').html(data);
            }
        })
    })

    $('.genderbutton').on('change', function() {
        var genderVal = $(this).val();
        var position = $(this).data('position');
        if (genderVal == 'M') {
            onLoadJQ();
            $.ajax({
                url: "{{url('avatar')}}/" + position,
                type: 'Get',
                success: function(data) {
                    onLoadJQ();
                    $('#loadAvatar').html(data);
                }
            })
        } else {
            onLoadJQ();
            $.ajax({
                url: "{{url('avatar')}}/" + position,
                type: 'Get',
                success: function(data) {
                    onLoadJQ();
                    $('#loadAvatar').html(data);
                }
            })
        }

    })
</script>
@endsection