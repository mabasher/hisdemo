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
    cursor: pointer;
}

.noofDay {
    cursor: pointer;
}

.slotScroll {
    height: 160px;
    overflow-y: auto;
}

thead input {
    width: 100%;
}

.form-control {
    min-height: 20px !important;
}
    </style>
    <link rel="stylesheet" href="{{asset('css/imgcss.css')}}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/select2ud.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    @endsection
    @section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-xl-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-info text-center">Patient Appointment</h4>
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

                                <form class="needs-validation" autocomplete="off" method="POST" target="_blank" id="appointmentInsert"
                                    action="{{url('appointmentInsert')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card col-xl-11 m-auto">
                                        <h5 class="card-header text-success">Doctor Information</h5>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Schedule Date<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control datepicker text-center"
                                                        name="app_date" id="schDate" placeholder="Schedule Date"
                                                        value="{{old('app_date')}}" required>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Doctor Specilty</label>
                                                    <select class="custom-select" id="specialty">
                                                        <option value="">Select Specilty</option>
                                                        @foreach($specialty as $sp)
                                                        <option value="{{$sp->dept_no}}">
                                                            {{$sp->dept_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="">Doctor Designation</label>
                                                    <select class="custom-select" id="desig">
                                                        <option value="">Select Doctor Designation</option>
                                                        @foreach($designation as $desig)
                                                        <option value="{{$desig->job_id}}">
                                                            {{$desig->job_desc}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5 ">
                                                    <label for="">Care Giver<span class="text-danger">*</span></label>
                                                    <select class="custom-select" id="doctor" name="doctorinfo_id"
                                                        required>
                                                        <option value="">Select Care Giver</option>
                                                        @foreach($doctors as $doc)
                                                        <option data-doctorNo="{{$doc->doctor_no}}"
                                                            data-room="{{$doc->doc_chember}}" value="{{$doc->id}}">
                                                            {{$doc->designation.' '.$doc->doctor_name.' '.$doc->qualification}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 slotScroll" id="weekId" style="display:none;">
                                                    <table class="text-center" id="docVisitTime">
                                                    </table>


                                                </div>
                                                <div class="col-md-9">
                                                    <div class="text-center" id="loading" style="display:none;">
                                                        <img width="50" height="50"
                                                            src="{{asset('admin/img/loading.gif')}}"
                                                            class="rounded-circle" alt="">
                                                    </div>
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
                                                            placeholder="Search PID" name="reg_no" value="{{$regNo}}"
                                                            aria-label="Search Patient Id"
                                                            aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <a href="" id="clearId" class="btn btn-outline-secondary"
                                                                type="button"><i class="fa fa-refresh"
                                                                    aria-hidden="true"></i></a>

                                                            <a href="" id="srcId" class="btn btn-outline-secondary"
                                                                type="button" data-backdrop="static"
                                                                data-keyboard="false" data-toggle="modal"><i
                                                                    class="fa fa-search-plus"
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
                                                        id="dob" placeholder="DOB" value="{{old('dob')}}" required>
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
                                                        <option value="{{$title->salutation_name}}">
                                                            {{$title->salutation_name}}
                                                        </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom04">Patient Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="ful_name" value="{{old('ful_name')}}"
                                                        class="form-control" id="fulName"
                                                        placeholder="Enter Patient Name" required>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="">Mobile No<span class="text-danger">*</span></label>
                                                    <input type="text" id="mobile" name="mobile" class="form-control"
                                                        placeholder="Mobile No" value="" required>
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

                                        </div>
                                    </div>
                                    <div class="card col-xl-11 m-auto">
                                        <h5 class="card-header text-success">Appointment Information</h5>
                                        <div class="card-body">


                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label>Chief Complaint<span class="text-danger">*</span></label>
                                                    <select class="form-control select2 select2-hidden-accessible"
                                                        name="chief_complaint[]" multiple=""
                                                        data-placeholder="Select Chief Complaint" style="width: 100%;"
                                                        tabindex="-1" aria-hidden="true">
                                                        @foreach($chiefComplaint as $cc)
                                                        <option>{{$cc->atr_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <!-- <textarea rows="1" cols="1" class="form-control" placeholder="Enter Chief Complaint" name="chief_complaint" required></textarea> -->
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
                                                        <option value="P">Primary Consultation </option>
                                                        <option value="F">Followup Consultation</option>
                                                        <option value="V">For Visit</option>
                                                        <option value="C">Patient Counseling</option>
                                                    </select>
                                                </div>
                                                <!-- <div class="col-md-3 mb-3">
                                                    <label for="">Appoint No</label>
                                                    <input type="text" name="appoint_no" value="" class="form-control" id="validationCustom04" placeholder="Appoint No" readonly>
                                                </div> -->
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
                                            <button class="btn btn-primary" id="appointmentInsertBtn"  type="submit">Submit</button>
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

    <div class="modal fade" id="patient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success m-auto" id="exampleModalCenterTitle">
                        <div class="row">
                            <div class="col-sm">
                                <input type="text" id="findpid" class="form-control border border-success patientsearch"
                                    placeholder="Search PID">
                            </div>
                            <div class="col-md-5">
                                Patient Information
                            </div>
                            <div class="col-sm">
                                <input type="text" id="findpatient" class="form-control border-success patientsearch"
                                    placeholder="Search Patient Name">
                            </div>
                        </div>


                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="col-lg-12 m-auto">
                        <div class="table-responsive">
                            <div class="panel panel-primary">
                                <div id="udSearchPatient" class="m-auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('js')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script> -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('.dataTable').DataTable();
        
        $(function() {

            $('#appointmentInsertBtn').on('click', function(e){
                e.preventDefault();
                $('#appointmentInsert').submit();
                location.reload();
            });
            
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: "GET",
                    beforeSend: function() {

                    },
                    success: function(data) {
                        $('#udSearchPatient').html(data);
                        console.log(data);
                    },
                    complete: function() {

                    }
                })
            });


            $('.select2').select2({
                closeOnSelect: false
            });

            $('#loading').hide();
            $('#pid').keyup(function() {
                $('#clearId').show();
            });
            var pid = $('#pid').val();
            if (pid != '') {
                getPatient(pid);
            }
            


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
            $('#dob').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true,
                changeMonth: true,
                changeYear: true,
                endDate: maxBirthdayDate,
                inline: true

            }).on('changeDate', function(ev) {
                $('#age').val(ageCalculator($(this).val()));
            });

            $(document).on('click', '.patientFind', function(e) {
                e.preventDefault();
                var regno = $(this).data('regno');
                $('#pid').val(regno);
                getPatient(regno);
                $('#patient').modal('hide');
            })
        });
        $('#specialty').on('change', function() {
            var spDoctor = $(this).val();
            getDoctorSpeciltyWise(spDoctor);
            setTimeout(() => {
                var docid = $('#doctor').val();
                var schDate = $('#schDate').val();
                if (docid == '' || docid == null) {
                    $('#docVisitTime').hide();
                    $('#loadSlot').hide();
                    // $('#docVisitTime').html('No Schedule');
                } else {
                    getDoctorSlotLoad(docid, schDate);
                    getVistDays(docid, schDate);

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

        $('#desig').on('change', function() {
            var DesigDoctor = $(this).val();
            getDoctorDesigWise(DesigDoctor);
            setTimeout(() => {
                var docid = $('#doctor').val();
                var schDate = $('#schDate').val();
                if (docid == '' || docid == null) {
                    $('#docVisitTime').hide();
                    $('#loadSlot').hide();
                    // $('#docVisitTime').html('No Schedule');
                } else {
                    getDoctorSlotLoad(docid, schDate)
                    getVistDays(docid, schDate);

                }
            }, 300);

        })

        function getDoctorDesigWise(jobId) {
            $.ajax({
                url: "{{url('desigWiseDoctor')}}/" + jobId,
                type: 'get',
                success: function(data) {
                    console.log(data);
                    $('#doctor').html(data);
                }
            })
        }

        $('#srcId').on('click', function(e) {
            e.preventDefault();
            var pid = $('#pid').val();
            if (pid == '') {
                getFindingPatient('all');
                $('#patient').modal('show');
            } else {
                getPatient(pid);
            }
            //alert(pid);
        })

        $('#clearId').click(function(e) {
            e.preventDefault();
            clear('pid');
            $(this).hide();
        })

        function clear(id) {
            $('#' + id).val('');
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
            if (docNo == '') {
                $('#loadSlot').hide();
                $('#docVisitTime').hide();
                // $('#docVisitTime').html('No Schedule');
            } else {
                getVistDays(docNo, schDate);
                getDoctorSlotLoad(docNo, schDate);

            }

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

        function getDoctorSlotLoad(doctorId, schDate) {
            $.ajax({
                url: "{{url('virtualslots')}}/" + doctorId + '/' + schDate,
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
            $('.noofDay').parent().parent().removeClass('bg-info');
            $('.noofDay').parent().parent().addClass('bg-success');
            let dayName = $(this).text();
            var sdate = getNextDateOfTheWeek(dayName);
            var docNo = $('#doctor').val();
            getDoctorSlotLoad(docNo, dayName);
            $(this).parent().parent().removeClass('bg-success');
            $(this).parent().parent().addClass('bg-info');

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


        $('#schDate').on('change', function() {
            var schDate = $(this).val();
            var docNo = $('#doctor').val();
            // alert(typeof docNo);
            if (docNo == '') {

            } else {
                getDoctorSlotLoad(docNo, schDate);
                getVistDays(docNo, schDate);
            }

        })

        function getVistDays(doctorId, schDate) {
            $.ajax({
                url: "{{url('doctorWeeklySchedule')}}/" + doctorId + '/' + schDate,
                type: 'get',
                success: function(data) {
                    console.log(data);
                    if (data == '') {
                        $('#weekId').hide();
                    } else {
                        $('#weekId').show();
                        $('#docVisitTime').html(data);
                    }

                }
            })
        }

        function getpdfGenerate(regNo) {
            $.ajax({
                url: "{{url('downloadPDF')}}/" + regNo,
                type: 'get',
                success: function(data) {
                    // console.log(data);
                    // $('#doctor').html(data);
                }
            })
        }

        $('.patientsearch').on('keyup', function() {
            var pid = $(this).val();
            // var name = $('#findpatient').val();
            getFindingPatient(pid);
            if (pid == null || pid == '') {
                // patientsearch = 'No-Doctor';
                getFindingPatient('all');
            }

        })

        function getFindingPatient(keyword) {
            $.ajax({
                url: "{{url('patientSearch')}}/" + keyword,
                type: 'get',
                success: function(data) {
                    console.log(data);
                    $('#udSearchPatient').html(data);
                }
            })
        }
    </script>
    @endsection