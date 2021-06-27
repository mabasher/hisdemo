<!DOCTYPE html>
<html lang="en">

<head>
    <title>DTL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('template/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('template/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('template/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/jquery.timepicker.css')}}">

    <link rel="stylesheet" href="{{asset('template/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <style>
    .modal-lg,
    .modal-xl {
        max-width: 800px !important;
    }

    .tabscroll {
        height: 352px;
        overflow-y: auto;
        width: 300px;
        line-height: 1rem;
    }

    .main-body {
        padding: 15px;
    }

    .mousepointer {
        cursor: pointer;
    }

    .slotScroll {
        height: 190px;
        overflow-y: auto;
    }

    .docWeeklyScroll {
        height: 150px;
        overflow-y: auto;
    }

    .btn {
        padding: 7px 5px;
    }

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
    </style>
</head>

<body>
    @include('frontpage.includes.navbar')

    <div class="container-fluid">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3" id="doctor">
                    @include('frontpage.appointment.doctor_patientajax')
                </div>
                <!-- autocomplete="off" -->
                <div class="col-md-8">
                    @if(Session::has('startTime'))
                    <div class="col-md-6 text-center">
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                            {{ Session::get('startTime') }}</p>
                    </div>
                    @endif
                    <form method="POST" action="{{url('appointmentInsertOnline')}}">
                        @csrf
                        <div class="row gutters-sm">
                            <div class="col-sm-8 mb-3">
                                <h4 class="title text-center text-success">Patient Appointment</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">PID (if Exist PID)</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="pid" placeholder="Search PID"
                                                aria-label="Search PID" aria-describedby="basic-addon2">
                                            <input type="hidden" class="form-control" id="regNo" name="reg_no">
                                            <div class="input-group-append">

                                                <a href="" id="clearId" class="btn btn-outline-secondary"
                                                    type="button"><i class="fa fa-refresh" aria-hidden="true"></i>
                                                </a>

                                                <a href="" id="srcId" class="btn btn-outline-secondary" type="button"
                                                    data-backdrop="static" data-keyboard="false" data-toggle="modal"><i
                                                        class="fa fa-search-plus" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="">Title</label>
                                        <select class="custom-select" id="salutationId" name="salutation_Id">
                                            <option value="">Select Title</option>
                                            @foreach($salutations as $title)
                                            <option value="{{$title->salutation_name}}">{{$title->salutation_name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputEmail4">Patient Name</label>
                                        @if(Session::has('name'))
                                        <input type="text" name="ful_name" id="fulName"
                                            value="{{ Session::get('name') }}" class="form-control" id="inputEmail4"
                                            placeholder="Patient Name">
                                        @else
                                        <input type="text" id="fulName" name="ful_name" class="form-control"
                                            id="inputEmail4" placeholder="Patient Name" required>
                                        @endif
                                        <input type="hidden" id="attadd" name="chief_complaint" class="form-control">
                                        <input type="hidden" id="sl" name="sl_no" class="form-control">
                                        <input id="doctorinfoId" name="doctorinfo_id" type="hidden"
                                            value="{{$doctor->id}}">
                                        <input id="docNo" name="doctor_no" type="hidden" value="{{$doctor->doctor_no}}">
                                        <input id="docRoom" name="doc_chember" type="hidden"
                                            value="{{$doctor->doc_chember}}">
                                        <input id="strtTime" name="start_time" type="hidden" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Gender</label><br>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input gender" id="gender_male"
                                                    checked value="M" name="gender">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input gender" id="gender_female"
                                                    value="F" name="gender">Female
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input gender" id="gender_others"
                                                    value="O" name="gender">Others
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">DOB</label>
                                        @if(Session::has('dob'))
                                        <input type="text" class="form-control datepicker dtobt" id="dob" name="dob"
                                            value="{{ Session::get('dob') }}" placeholder="DOB">
                                        @else
                                        <input type="text" class="form-control datepicker dtobt" id="dob" name="dob"
                                            placeholder="dd/mm/yyyy">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Age</label>

                                        <input type="text" class="form-control age" id="age"
                                            value="{{ Session::has('age')?Session::get('age'):'' }}" placeholder="Age">

                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Mobile No</label>
                                        @if(Session::has('mobile'))
                                        <input type="text" name="mobile" value="{{ Session::get('mobile') }}"
                                            class="form-control" id="mobile" placeholder="Mobile No">
                                        @else
                                        <input type="text" name="mobile" class="form-control" id="mobile"
                                            placeholder="Mobile No" required>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">Reason for Appointment</label>
                                        <select class="custom-select" id="maritalStatus" name="app_type">
                                            <option value="">Select Reason for Appointment</option>
                                            <option value="P">Primary Consultation </option>
                                            <option value="F">Followup Consultation</option>
                                            <option value="V">For Visit</option>
                                            <option value="C">Patient Counseling</option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Diseases Symptoms<span class="text-danger"></span></label>
                                        <select class="form-control select2 select2-hidden-accessible"
                                            name="symptom_name_en[]" multiple=""
                                            data-placeholder="Select Diseases Symptoms" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true">
                                            @foreach($chiefComplaint as $cc)
                                            <option>{{$cc->symptom_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>রোগ বা সমস্যা<span class="text-danger"></span></label>
                                        <select class="form-control select2 select2-hidden-accessible"
                                            name="symptom_name_bn[]" multiple=""
                                            data-placeholder="রোগ বা সমস্যা নির্বাচন করুন " style="width: 100%;"
                                            tabindex="-1" aria-hidden="true">
                                            @foreach($chiefComplaint as $cc)
                                            <option>{{$cc->symptom_name_bn}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="text-white">.</label>
                                        <a id="chiefCompleint" class="btn btn-sm btn-info form-control mb-1 ">Chief
                                            Complaint</a>
                                    </div>
                                    <div class="form-group col-md-4 text-center m-auto">
                                        <label class="text-info">Appointment Date</label>
                                        <input type="text" class="form-control datepicker text-center btn-outline-info"
                                            name="app_date" id="schDate" placeholder="Schedule Date"
                                            value="{{old('app_date')}}" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body docWeeklyScroll mousepointer" id="weekId">
                                        <table class="text-center" id="docVisitTime">
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            <div class="col-sm-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-center" id="loading" style="display:none;">
                                            <img width="50" height="50" src="{{asset('admin/img/loading.gif')}}"
                                                class="rounded-circle" alt="">
                                        </div>
                                        <div class="row mousepointer" id="loadSlot">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-xs">Confirm</button>
                        </div>
                    </form>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                            </span>
                                        </label>
                                        <!-- <a title="Add Attributes" id="add"><i class="fa fa-plus text-success"
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
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div id="maleRadio" style="overflow: auto;">

                                <table style="width: 100%;">
                                    <tr>
                                        <td id="loadAvatar" style="width: 250px;vertical-align: top;">
                                            @include('frontpage.avatar.male-front')
                                            @include('frontpage.avatar.female-front')
                                            @include('frontpage.avatar.male-back')
                                            @include('frontpage.avatar.female-back')
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <form method="POST" action="{{url('patientHPIsave')}}">
                                @csrf
                                <input type="hidden" name="reg_no" value="" class="form-control">
                                <input type="hidden" name="identifyed_no" value="" class="form-control">
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
    <div class="modal fade" id="morePatientSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Patient List</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <div id="morePatient"></div> -->
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>PID</th>
                                <th>Patient Name</th>
                                <th>Mobile No</th>
                            </tr>
                            <tr>
                                <th><input type="text" name="pid" class="form-control" id="pidregno" placeholder="PID"></th>
                                <th width="250px"><input type="text" name="patient_name" class="form-control nameorcell" id="patientname" placeholder="Patient Name"></th>
                                <th><input type="text" name="pid" class="form-control nameorcell" id="patmobile" placeholder="Mobile No"></th>
                            </tr>
                        </thead>
                        <tbody id="morePatient">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @include('frontpage.includes.footer')
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->

    <script src="{{asset('template/js/jquery.min.js')}}"></script>
    <script src="{{asset('template/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('template/js/popper.min.js')}}"></script>
    <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('template/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('template/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('template/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('template/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('template/js/scrollax.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{asset('template/js/google-map.js')}}"></script>
    <script src="{{asset('template/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{asset('admin/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/jquery.maphilight.js')}}"></script>




    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script> -->

    <script>
    var $jq = jQuery.noConflict();
    // $jq(function() {
    //     onLoadJQ();
    // });
    $(function() {
        $('.select2').select2({
            closeOnSelect: false
        });

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

        $('#newAttrib').hide();
        $('.avatars').hide();
        $('#mf').show();
        onLoadJQ();



        $('.dtobt').on('change', function() {
            var dob = $(this).val();
            date = dob.split("/").reverse().join("-");
            $('.age').val(ageCalculator(date))

        })

   
        var maxBirthdayDate = new Date();
        $('.dtobt').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            endDate: maxBirthdayDate,
            inline: true

        })
        // .on('changeDate', function(ev) {
        //     $('.age').val(ageCalculator($(this).val()));
        // });

    })

    $(document).on("click", ".deptDoctor", function() {
        var doctor = $(this).attr('data-id');
        var schDate = $('#schDate').val();
        $('#doctorinfoId').val(doctor);
        $('#docNo').val($(this).attr('data-docNo'));
        $('#docRoom').val($(this).attr('data-docRoom'));
        getDoctor(doctor);
        getVistDays(doctor, schDate);
        getDoctorSlotLoad(doctor, schDate);
    });

    function getDoctor(id) {
        $.ajax({
            url: "{{url('doctorpatientajax')}}/" + id,
            type: 'get',
            success: function(data) {
                $('#doctor').html(data);
            }
        })
    }


    $('#schDate').on('change', function() {
        var schDate = $(this).val();
        var docNo = $('#doctorId').val();
        getVistDays(docNo, schDate);
        getDoctorSlotLoad(docNo, schDate);

    })

    function getVistDays(doctorId, schDate) {
        $.ajax({
            url: "{{url('getDocWeeklySchedule')}}/" + doctorId + '/' + schDate,
            type: 'get',
            success: function(data) {
                // if (data == '') {
                //     $('#weekId').show();
                // } else {
                //     $('#weekId').show();
                //     $('#docVisitTime').html(data);
                // }
                $('#weekId').html(data);

            }
        })
    }

    $(document).on('click', '.time-slot', function() {
        var startTime = $(this).attr('data-time');
        $('#strtTime').val(startTime);

    })
    $(document).on('click', '#timeId', function(e) {
        e.preventDefault();
        var timeid = $(this).attr('data-time');
        var patSl = $(this).attr('data-serial');
        $('#appointTime').val(timeid);
        $('#sl').val(patSl);
        $('.time-slot').removeClass('bg-info');
        $(this).closest('.time-slot').addClass("bg-info");
    });

    function getDoctorSlotLoad(doctorId, schDate) {
        $.ajax({
            url: "{{url('virtualDocslots')}}/" + doctorId + '/' + schDate,
            type: 'get',
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                $('#loadSlot').html(data).show();
                $('#schDate').val($('#dT').text())

            },
            complete: function() {
                $('#loading').hide();

            }
        })
    }
    $(document).on('click', '.noofDay', function(e) {
        // e.preventDefault();
        $('.noofDay').parent().removeClass('bg-dark');
        $('.noofDay').parent().addClass('bg-info');
        let dayName = $(this).text();
        var sdate = getNextDateOfTheWeek(dayName);
        var docNo = $('#doctorId').val();
        getDoctorSlotLoad(docNo, dayName);
        $(this).parent().removeClass('bg-info');
        $(this).parent().addClass('bg-dark');

    })

    function getNextDateOfTheWeek(dayName) {
        let today = new Date()
        const dayOfWeek = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"]
            .indexOf(dayName.slice(0, 3).toLowerCase());
        if (dayOfWeek < 0) return;
        today.setHours(0, 0, 0, 0);
        today.setDate(today.getDate() +
            (dayOfWeek + 7 - today.getDay()) % 7);
        return today.toLocaleDateString('en-GB');
    }

    if ("{{Session::has('gender')}}") {
        var gen = "{{Session::get('gender')}}";
        $(".gender").each(function() {
            if ($(this).val() == gen) {
                $(this).prop("checked", "true");
            }
        });
    }

    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert").slideUp(1000);
    });


    //Online Chief Complaint


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
            url: "{{url('OnlineAvatarAtrributes')}}/" + bodyPartNo + '/' + parentAtrNo + '/' + gender,
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

    var checked = []

    $(document).on('click', '#attribId', function() {
        checked = [];
        $('input.attribName').each(function() {
            if ($(this).is(':checked')) {
                checked.push($(this).val());
            }
        });

        $('#attadd').val(checked);
        $('#chiefCompModal').modal('hide');
    })

    $('#pid').keypress(function(e) {
        var pid = $('#pid').val();
        if (e.which == 13) {
            getExsitingPatient(pid);
            event.preventDefault();
            return false;
        }
        console.log(pid);
    })

    $('#srcId').on('click', function(e) {
        e.preventDefault();
        var pid = $('#pid').val();
        getExsitingPatient(pid);
    })

    $(document).on('click', '.patientFind', function(e) {
        e.preventDefault();
        var regno = $(this).data('regno');
        $('#pid').val(regno);
        getExsitingPatient(regno);
        $('#morePatientSearch').modal('hide');
        
    })

    $('#clearId').click(function(e) {
        e.preventDefault();
        clear('pid');
        // $(this).hide();
    })

    function clear(id) {
        $('#' + id).val('');
    }


    
    function getExsitingPatient(regno) {
        $.ajax({
            url: "{{url('patientExOnline')}}/" + regno,
            type: 'get',
            success: function(data) {
                if (data.count === 0) {
                    alert('Please Enter Correct PID')
                } else {
                    if (data.count > 1) {
                        $('#morePatient').html('')
                        $.each(data.patient, function(key, val) {
                            console.log([key, val])
                            $('#morePatient').append(
                                `<tr>
                                <td><a href="" class="patientFind" data-regNo="${val.reg_no}">${val.reg_no}</a></td>
                                <td>${val.ful_name}</td>
                                <td>${val.mobile}</td>
                            </tr>`
                            );
                        });
                        $('#morePatientSearch').modal('show');
                    } else {
                        var dob = data.patient.dob;
                        // date = dob.split("-").reverse().join("/");
                        date =dob.toString().split("-").reverse().join("/")
                        
                        $('#salutationId').val(data.patient.salutation_id);
                        $('#regNo').val(data.patient.reg_no);
                        $('#fulName').val(data.patient.ful_name);
                        $('#dob').val(date);
                        $('#age').val(ageCalculator(date))
                        $("input[name=gender][value='" + data.patient.gender + "']").prop("checked", true);
                        $('#mobile').val(data.patient.mobile);
                        $('#email').val(data.patient.email);
                    };
                }

            }
        })
    }

    $('.nameorcell').keyup(function(e) {
        e.preventDefault();
        var pid = $('#pid').val();
        var nameorcell = $(this).val();
        if(nameorcell ==''){
            getExsitingPatient(pid);
        }
        getpidPatnameSearch(pid,nameorcell);
    })

    function getpidPatnameSearch(regno,nameorMobile) {
        $.ajax({
            url: "{{url('patientMultipleSearch')}}/" + regno+ '/' + nameorMobile,
            type: 'get',
            success: function(data) {
                console.log(data);
                $('#morePatient').html('');
                $.each(data, function(key, val) {
                            $('#morePatient').append(
                                `<tr>
                                <td><a href="" class="patientFind" data-regNo="${val.reg_no}">${val.reg_no}</a></td>
                                <td>${val.ful_name}</td>
                                <td>${val.mobile}</td>
                            </tr>`
                            );
                        });

            }
        })
    }
    </script>
</body>

</html>