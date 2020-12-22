    @extends('layouts.app')
    @section('css')
    <style>
        .bg-secondary span {
            color: #fff;
        }
        .time-slot {
            border: 1px solid #55ce63;
            border-radius: 3px;
            text-align: center;
            cursor:pointer;
        }

        .slotScroll {
        height:160px;
        overflow-y: auto;
        }

    </style>
    <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css/imgcss.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-datetimepicker.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
    @endsection
    @section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-xl-12 m-auto">

                <!-- Custom Boostrap Validation -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-info text-center">Patient Appointment</h4>
                        <!-- <a href="patients.html" class="btn btn-primary float-right">View all</a> -->
                        <p class="card-text"><a href="javascript:void(0)" target="_blank"></a></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form class="needs-validation" autocomplete="off" method="POST"
                                    action="{{url('appointmentInsert')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card col-xl-11 m-auto">
                                        <h5 class="card-header text-success">Doctor Information</h5>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Schedule Date</label>
                                                    <input type="text" class="form-control datepicker" name="app_date"
                                                        id="schDate" placeholder="Schedule Date"
                                                        value="{{old('app_date')}}" required="">
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Doctor Specilty</label>
                                                    <select class="custom-select" id="specialty">
                                                        <option value="All">Select Specilty</option>
                                                        @foreach($specialty as $sp)
                                                        <option value="{{$sp->dept_no}}">
                                                            {{$sp->dept_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Doctor Designation</label>
                                                    <select class="custom-select" id="desig">
                                                        <option value="All">Select Doctor Designation</option>
                                                        @foreach($designation as $desig)
                                                        <option value="{{$desig->job_id}}">
                                                            {{$desig->job_desc}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5 ">
                                                    <label for="">Care Giver</label>
                                                    <select class="custom-select" id="doctor" name="doctorinfo_id">
                                                        <option value="all">Select Care Giver</option>
                                                        @foreach($doctors as $doc)
                                                        <option data-doctorNo="{{$doc->doctor_no}}" data-room="{{$doc->doc_chember}}"
                                                             value="{{$doc->id}}">
                                                            {{$doc->designation.' '.$doc->doctor_name.' '.$doc->qualification}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- <div class="col-md-3 ">
                                                    <label for="">Time</label>
                                                    <select class="custom-select" id="multiVisit" name="doctor_no">
                                                        <option value="">Select Time</option>

                                                    </select>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="border border-success slotScroll" id="docVisitTime" style="display:none;">

                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <img  width="50" height="50" id="loading" class="mx-auto" src="{{asset('admin/img/loading.gif')}}" class="rounded-circle" alt="" style="display:none;">
                                                    <!-- <p id="loading" class="text-center" style="display:none;">Loading</p> -->
                                                    <div class="row" id="loadSlot">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card col-xl-11 m-auto">
                                        <h5 class="card-header text-success">Patient Information</h5>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id="pid"
                                                            placeholder="Search PID" value="{{$regNo}}" aria-label="Search Patient Id"
                                                            aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <a href="" id="clearId" class="btn btn-outline-secondary"
                                                                type="button"><i class="fa fa-refresh"
                                                                    aria-hidden="true"></i></a>

                                                                    <a href="" id="srcId" class="btn btn-outline-secondary"
                                                                type="button"><i class="fa fa-search-plus"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input gender" type="radio"
                                                            name="gender" id="gender_male" value="M" checked>
                                                        <label class="form-check-label" for="gender_male">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline gender">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender_female" value="F">
                                                        <label class="form-check-label"
                                                            for="gender_female">Female</label>
                                                    </div>

                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline gender">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender_others" value="O">
                                                        <label class="form-check-label"
                                                            for="gender_female">Others</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <input type="text" class="form-control datepicker" name="dob"
                                                        id="dob" placeholder="DOB" value="{{old('dob')}}" required="">
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <input type="text" class="form-control" id="age" placeholder="Age"
                                                        disabled="">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Title</label>
                                                    <select class="custom-select" id="salutationId"
                                                        name="salutation_Id">
                                                        <option value="">Select Title</option>
                                                        @foreach($salutations as $title)
                                                        <option value="{{$title->id}}">{{$title->salutation_name}}
                                                        </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom04">Patient Name</label>
                                                    <input type="text" name="ful_name" value="{{old('ful_name')}}"
                                                        class="form-control" id="fulName"
                                                        placeholder="Enter Patient Name" required="">
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Mobile No</label>
                                                    <input type="text" id="mobile" name="mobile" class="form-control"
                                                        placeholder="Mobile No" value="">
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Email</label>
                                                    <div class="input-group">
                                                        <input type="text" name="email" class="form-control" id="email"
                                                            placeholder="Email" aria-describedby="inputGroupPrepend2">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Religion</label>
                                                    <select class="custom-select" id="religion" name="religion_no">
                                                        <option value="">Select Religion</option>
                                                        @foreach($religions as $religion)
                                                        <option value="{{$religion->RELIGION_NO}}">
                                                            {{$religion->RELIGION_NAME}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group">
                                                        <label>Emergency Contact No</label>
                                                        <input type="text" id="emContactNo" name="em_contact_no" class="form-control"
                                                            placeholder="Contact No">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group">
                                                        <label>Emergency Contact Name</label>
                                                        <input type="text" id="emContactPerson" name="em_contact_person" class="form-control"
                                                            placeholder="Contact Name">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3 mb-3">
                                                    <label for=" ">NID</label>
                                                    <input type="text" name="national_id" class="form-control"
                                                        id="nid" placeholder="National ID" value="">
                                                </div>
                                                
                                            </div>
                                            <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label>Address:</label>
                                                <textarea rows="1" cols="1" class="form-control"
                                                    placeholder="Enter Address"
                                                    id="preAddress" name="pre_address">
                                                </textarea>
                                            </div>
                                            
                                            <div class="col-md-3 mb-3">
                                                <label
                                                    for="validationCustom03">Division/Province</label>
                                                    <select class="custom-select division disableEnable"
                                                        id="preDivision" name="pre_division">
                                                        @foreach($divisions as $dv)
                                                        <option value="{{$dv->DIVISION_CODE}}">
                                                            {{$dv->DIVISION_NAME}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="">City</label>
                                                <select class="custom-select city disableEnable" id="city"
                                                    name="pre_district">
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="form-group">
                                                    <label>Zip/Postal code</label>
                                                    <input type="text" name="pre_postoffice"
                                                        class="form-control" id="postalCode"
                                                        placeholder="Zip/Postal Code">
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="card col-xl-11 m-auto">
                                        <h5 class="card-header text-success">Appointment Information</h5>
                                        <div class="card-body">


                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label>Chief Complaint:</label>
                                                    <textarea rows="1" cols="1" class="form-control"
                                                        placeholder="Enter Address" name="chief_complaint">
                                                    </textarea>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Arrival Mode</label>
                                                    <select class="custom-select" id="maritalStatus"
                                                        name="arrival_mode">
                                                        <option value="">Select Arrival Mode</option>
                                                        <option value="W">Walkin </option>
                                                        <option value="A">Appointed </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Appoint Type</label>
                                                    <select class="custom-select" id="maritalStatus" name="app_type">
                                                        <option value="">Select Appoint Type</option>
                                                        <option value="S">Primary Consultation </option>
                                                        <option value="F">Followup Consultation</option>
                                                        <option value="V">For Visit</option>
                                                        <option value="V">Patient Counseling</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Appoint No</label>
                                                    <input type="text" name="appoint_no" value="" class="form-control"
                                                        id="validationCustom04" placeholder="Appoint No" disabled="">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Appoint Date</label>
                                                    <input type="text" name="mobile" class="form-control"
                                                        id="validationDefault02" placeholder="Appoint Date" value=""
                                                        disabled="">
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group">
                                                        <label>Appoint Time</label>
                                                        <input type="text" id="appointTime" name="start_time" readonly
                                                            class="form-control" placeholder="Appoint Time">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Serial No</label>
                                                    <div class="input-group">
                                                        <input type="text" id="sl" name="sl_no" class="form-control"
                                                            id="" placeholder="Serial No"
                                                            aria-describedby="inputGroupPrepend2" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Room No</label>
                                                    <div class="input-group">
                                                        <input type="text" name="doc_chember" class="form-control"
                                                            id="docRoom" placeholder="Room No"
                                                            aria-describedby="inputGroupPrepend2" readonly>
                                                    </div>
                                                    <input type="hidden" name="doctor_no" class="form-control"
                                                        id="doctorNo">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col text-center mb-2">
                                            <button class="btn btn-primary" type="submit">Submit form</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Custom Boostrap Validation -->
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('js')
    <!-- <script src="{{asset('js/app.js')}}"></script> -->

    <!-- <script type="text/javascript" src="{{asset('admin/js/bootstrap-datepicker.min.js')}}"></script> -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>


    <script>
$(function() {
    $('#pid').keyup(function(){
        $('#clearId').show();
    });
    var pid = $('#pid').val();
    if(pid != ''){
        getPatient(pid);

    }

    $('#spouseName').attr('disabled', 'disabled');

    $("#imgOpenRegistration").click(function() {
        $('#imgReg').click();
    });

    $("#imgReg").change(function() {
        imageReaderURL(this);
    });

    // $("#schDate").datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#schDate').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        startDate: date,
        inline: true

    });
    $('#schDate').datepicker('setDate', today);

    var maxBirthdayDate = new Date();
    // maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 10 );
    console.log(maxBirthdayDate);
    /* $('#dob').datepicker().on('changeDate', function (ev) {
        alert('dob');
    }); */
    $('#dob').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        endDate: maxBirthdayDate,
        inline: true

    }).on('changeDate', function(ev) {

        var birthDay = $('#dob').val();
        var DOB = new Date(birthDay);
        var today = new Date();
        var age = today.getTime() - DOB.getTime();
        var elapsed = new Date(age);
        var year = elapsed.getYear() - 70;
        var month = elapsed.getMonth();
        var day = elapsed.getDay();
        if (year == '0') {
            year = '';
        } else {
            year += " Y ";
        }
        if (month == '0') {
            month = '';
        } else {
            month += " M ";
        }
        if (day == '0') {
            day = '';
        } else {
            day += " D";
        }
        var ageTotal = year + month + day;

        $('#age').val(ageTotal);
    });
});

function imageReaderURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imgOpenRegistration').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}


$('#maritalStatus').change(function() {
    var mStatus = $('#maritalStatus').val();
    if (mStatus == 'Married') {
        $('#spouseName').removeAttr('disabled');

    } else {
        //$('#dob').removeAttr('disabled');
        $('#spouseName').attr('disabled', 'disabled');
    }
});

$('#specialty').on('change', function() {
    var spDoctor = $(this).val();
    getDoctorSpeciltyWise(spDoctor);
    setTimeout(() => {
        var docid = $('#doctor').val();
        if (docid == null) {
            $('#docVisitTime').show();
            $('#docVisitTime').html('No Schedule');
        } else {
            getVistDays(docid);

        }
    }, 300);

})

function getDoctorSpeciltyWise(deptNo) {
    $.ajax({
        url: "{{url('specialtyWiseDoctor')}}/" + deptNo,
        type: 'get',
        success: function(data) {
            console.log(data);
            $('#doctor').html(data);
        }
    })
}

$('#preDivision').on('change', function() {
    var code = $(this).val();
    getCity(code, 'city');
})

function getCity(diviCode, distId) {
    $.ajax({
        url: "{{url('perDivision')}}/" + diviCode,
        type: 'get',
        success: function(data) {
            //console.log(data);
            $('#' + distId).html(data);
        }
    })
}

$('#srcId').on('click', function(e) {
    e.preventDefault();
    var pid = $('#pid').val();
    if(pid == ''){
        document.location.href="{{url('registrationviews')}}";
    }else{
        getPatient(pid);
    }
    //alert(pid);
})

$('#clearId').click(function(e){
    e.preventDefault();
    clear('pid');
    $(this).hide();
})

function clear(id){
    $('#'+id).val('');
}
function getPatient(regno) {
    $.ajax({
        url: "{{url('patient')}}/" + regno,
        type: 'get',
        success: function(data) {
            $('#salutationId').val(data.salutation_id);
            $('#fulName').val(data.ful_name);
            $('#dob').val(data.dob);
            $("input[name=gender][value='" + data.gender + "']").prop("checked", true);
            $('#mobile').val(data.mobile);
            $('#email').val(data.email);
            $('#emContactNo').val(data.em_contact_no);
            $('#emContactPerson').val(data.em_contact_person);
            $('#nid').val(data.national_id);
            $('#religion').val(data.religion_no);
            $('#preAddress').val(data.pre_address);
            $('#preDivision').val(data.pre_division);
            getCity(data.pre_division, 'city');
            setTimeout(() => {
                $('#city').val(data.pre_district);
            }, 300);
            // $('#city').val(data.pre_district);
            $('#postalCode').val(data.pre_postoffice);

            console.log(data);

        }
    })
}

$('#doctor').on('change', function() {
    var docNo = $(this).val();
    var schDate = $('#schDate').val();
    var doctorRoom = $('#doctor :selected').attr('data-room');
    var doctorNo = $('#doctor :selected').attr('data-doctorNo');
    $('#doctorNo').val(doctorNo);
    $('#docRoom').val(doctorRoom);
    if (docNo == null) {
            $('#docVisitTime').show();
            $('#docVisitTime').html('No Schedule');
        } else {
            getVistDays(docNo);

        }
    var multiVisit;
    getDoctorMultiVisits(docNo, schDate);
    setTimeout(() => {
        multiVisit = $('#multiVisit').val();
        getDoctorSlotLoad(docNo, schDate, multiVisit);

    }, 1000);


    // setTimeout(() => {
    //     if (docNo == null) {
    //         $('#docVisitTime').show();
    //         $('#docVisitTime').html('No Schedule');
    //     } else {
    //         getVistDays(docNo);

    //     }
    // }, 300);

})


$('#multiVisit').on('change', function() {
    var multiVisit = $(this).val();
    var schDate = $('#schDate').val();
    var doctorId = $('#doctor').val();
    getVistDays(docNo);
    //getDoctorMultiVisits(docNo, schDate);
    getDoctorSlotLoad(doctorId, schDate, multiVisit);
})

$(document).on('click', '#timeId', function(e) {
    e.preventDefault();
    var timeid = $(this).attr('data-time');
    var patSl = $(this).attr('data-serial');
    $('#appointTime').val(timeid);
    $('#sl').val(patSl);
    $('.time-slot').removeClass('bg-success');
    $(this).closest('.time-slot').addClass("bg-success");
});

function getDoctorSlotLoad(doctorId, schDate, multiVisit) {
    $.ajax({
        url: "{{url('virtualslots')}}/" + doctorId + '/' + schDate + '/' + multiVisit,
        type: 'get',
        beforeSend :function(){
            $('#loading').show();
        },
        success: function(data) {
            //$('#doctorTimeSlot').show();
            $('#loadSlot').html(data).show();
        },
        complete:function(){
            $('#loading').hide();

        }
    })
}

function getDoctorMultiVisits(doctorId, schDate) {
    $.ajax({
        url: "{{url('multivisits')}}/" + doctorId + '/' + schDate,
        type: 'get',
        success: function(data) {
            // $('#doctorTimeSlot').show();
            $('#multiVisit').html(data);
        }
    })
}

function getVistDays(doctorId) {
    $.ajax({
        url: "{{url('doctorAppointSchedule')}}/" + doctorId,
        type: 'get',
        success: function(data) {
            $('#docVisitTime').show();
            $('#docVisitTime').html(data);
        }
    })
}
// $('#timeId').on('click', function(){
// var timeId = $(this).val();
// $('#appointId').val(); = timeId;
// })
    </script>
    @endsection