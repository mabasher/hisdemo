@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>

</style>
@endsection

@section('content')
<div class="content">
    <div class="col-md-4 m-auto">
        <select class="custom-select" name="nurse_station" id="oss">
            <option value="1015">
                <h3>OPD SERVICE STATION</h3>
            </option>
        </select>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 m-auto">
            <div class="card-box">
                <!-- <h6 class="card-title">Bottom line justified</h6> -->
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item"><a class="nav-link active" id="arrived-link" href="#arrived" data-toggle="tab">Arrived</a></li>
                    <li class="nav-item"><a class="nav-link" id="queueControl-link" href="#queueControl" data-toggle="tab">Queue Control</a></li>
                    <li class="nav-item"><a class="nav-link" id="currentPatient-link" href="#currentPatient" data-toggle="tab">Current Patient</a></li>
                    <li class="nav-item"><a class="nav-link" id="completePatient-link" href="#completePatient" data-toggle="tab">Complete Patient</a></li>
                    <li class="nav-item"><a class="nav-link" id="missingPatient-link" href="#missingPatient" data-toggle="tab">Missing Patient (Recall)</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="arrived">
                        <!-- <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center ssinId" name="consult_dt" id="ssinId" placeholder="Visit Date" value="" style="border:none">
                        </div> -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>PID</th>
                                    <th>Patient Name</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                    <th>Room</th>
                                    <th>Arrived</th>
                                </tr>
                            </thead>
                            <tbody id="ssinPatList">
                                @foreach($patArrived as $patArr)
                                @if($patArr->oppatmovement->count() > 0 && $patArr->oppatmovement[0]->opmovetype_id == 3)
                                <tr>
                                    <td>{{$patArr->reg_no}}</td>
                                    <td>{{$patArr->patName->salutation_id .' '.$patArr->patName->ful_name}}</td>
                                    <td>{{$patArr->appoint_no}}</td>
                                    <td>{{$patArr->consult_no}}</td>
                                    <td>{{$patArr->consultation->designation.' '.$patArr->consultation->doctor_name}}</td>
                                    <td>{{$patArr->consultation->doc_chember}}</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="check" class="check" name="checkbox" data-consultno="{{$patArr->consult_no}}" data-id="{{$patArr->id}}" data-moveid="4" data-movemname="Service Station IN" data-regno="{{$patArr->reg_no}}" value="{{$patArr->id}}">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="queueControl">
                        <!-- <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center" name="nscomplete_dt" id="queDate" placeholder="Visit Date" value="" style="border:none">
                        </div> -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>MP</th>
                                    <th>PID</th>
                                    <th>Patient Name</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                    <th>Room</th>
                                    <th>Waiting</th>
                                </tr>
                            </thead>
                            <tbody id="queCtrlId">
                                @foreach($patArrived as $qc)
                                @if($qc->oppatmovement->count() > 0 && $qc->oppatmovement[0]->opmovetype_id == 4)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="missingPat" class="missingPat" name="checkbox" data-consultno="{{$qc->consult_no}}" data-id="{{$qc->id}}" data-moveid="5" data-movemname="Missing Patient" data-regno="{{$qc->reg_no}}" value="{{$qc->id}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{$qc->reg_no}}</td>
                                    <td>{{$qc->patName->salutation_id .' '.$qc->patName->ful_name}}</td>
                                    <td>{{$qc->appoint_no}}</td>
                                    <td>{{$qc->consult_no}}</td>
                                    <!-- <td>{{__('ff.'.$qc->type_code)}}</td> -->
                                    <td>{{$qc->consultation->designation.' '.$qc->consultation->doctor_name}}</td>
                                    <td>{{$patArr->consultation->doc_chember}}</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="queControl" class="queControl" name="checkbox" data-consultno="{{$qc->consult_no}}" data-id="{{$qc->id}}" data-moveid="6" data-movemname="Waiting Patient" data-regno="{{$qc->reg_no}}" value="{{$qc->id}}">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="currentPatient">
                        <!-- <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center vsComDate" name="nscomplete_dt" id="vsComDate" placeholder="Visit Date" value="" style="border:none">
                        </div> -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>PID</th>
                                    <th>Basher</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                    <th>Room</th>
                                    <th class="text-success">Doc Room In</th>
                                    <th>Doc Room Out</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @foreach($patArrived as $qc)

                                @if($qc->oppatmovement->count() > 0 && $qc->oppatmovement[0]->opmovetype_id == 6 || $qc->oppatmovement[0]->opmovetype_id == 7 )
                                @if($qc->oppatmovement[0]->opmovetype_id == 7)
                                <tr class="text-success" id="tr_{{$qc->id}}">
                                    <td>{{$qc->reg_no}}</td>
                                    <td>{{$qc->patName->salutation_id .' '.$qc->patName->ful_name}}</td>
                                    <td>{{$qc->appoint_no}}</td>
                                    <td>{{$qc->consult_no}}</td>
                                    <td>{{$qc->consultation->designation.' '.$qc->consultation->doctor_name}}</td>
                                    <td>{{$patArr->consultation->doc_chember}}</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="doctorIn" name="checkbox" checked disabled="disabled" data-consultno="{{$qc->consult_no}}" data-id="{{$qc->id}}" data-moveid="7" data-movemname="Doctor's Room IN" data-regno="{{$qc->reg_no}}" value="{{$qc->id}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                            
                                                <a href="{{url('#completePatient')}}">
                                                <input type="checkbox" class="doctorOut" name="checkbox" data-consultno="{{$qc->consult_no}}" data-id="{{$qc->id}}" data-moveid="8" data-movemname="Doctor's Room OUT" data-regno="{{$qc->reg_no}}" value="{{$qc->id}}">
                                                </a>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @elseif($qc->oppatmovement[0]->opmovetype_id == 6)
                                <tr class="" id="tr_{{$qc->id}}">
                                    <td>{{$qc->reg_no}}</td>
                                    <td>{{$qc->patName->salutation_id .' '.$qc->patName->ful_name}}</td>
                                    <td>{{$qc->appoint_no}}</td>
                                    <td>{{$qc->consult_no}}</td>
                                    <td>{{$qc->consultation->designation.' '.$qc->consultation->doctor_name}}</td>
                                    <td>{{$patArr->consultation->doc_chember}}</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="doctorIn" name="checkbox" data-consultno="{{$qc->consult_no}}" data-id="{{$qc->id}}" data-moveid="7" data-movemname="Doctor's Room IN" data-regno="{{$qc->reg_no}}" data-doctor_id="{{$qc->consultation->id}}" value="{{$qc->id}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="doctorOut" name="checkbox" data-consultno="{{$qc->consult_no}}" data-id="{{$qc->id}}" data-moveid="8" data-movemname="Doctor's Room OUT" data-regno="{{$qc->reg_no}}" value="{{$qc->id}}">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="completePatient">
                        <!-- <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center vsComDate" name="nscomplete_dt" id="vsComDate" placeholder="Visit Date" value="" style="border:none">
                        </div> -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>PID</th>
                                    <th>Patient Name</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                    <th>Room</th>
                                </tr>
                            </thead>
                            <tbody id="nsComPatList">
                                @foreach($patArrived as $qc)
                                @if($qc->oppatmovement->count() > 0 && $qc->oppatmovement[0]->opmovetype_id == 8)
                                <tr>
                                    <td>{{$qc->reg_no}}</td>
                                    <td>{{$qc->patName->salutation_id .' '.$qc->patName->ful_name}}</td>
                                    <td>{{$qc->appoint_no}}</td>
                                    <td>{{$qc->consult_no}}</td>
                                    <td>{{$qc->consultation->designation.' '.$qc->consultation->doctor_name}}</td>
                                    <td>{{$patArr->consultation->doc_chember}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="missingPatient">
                        <!-- <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center nsDate" name="nscomplete_dt" id="nsDate" placeholder="Visit Date" value="" style="border:none">
                        </div> -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>PID</th>
                                    <th>Patient Name</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                    <th>Room</th>
                                    <th>Recall</th>
                                </tr>
                            </thead>
                            <tbody id="nsComPatList">
                                @foreach($patArrived as $qc)
                                @if($qc->oppatmovement->count() > 0 && $qc->oppatmovement[0]->opmovetype_id == 5)
                                <tr>
                                    <td>{{$qc->reg_no}}</td>
                                    <td>{{$qc->patName->salutation_id .' '.$qc->patName->ful_name}}</td>
                                    <td>{{$qc->appoint_no}}</td>
                                    <td>{{$qc->consult_no}}</td>
                                    <!-- <td>{{__('ff.'.$qc->type_code)}}</td> -->
                                    <td>{{$qc->consultation->designation.' '.$qc->consultation->doctor_name}}</td>
                                    <td>{{$patArr->consultation->doc_chember}}</td>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="recall" class="recall" name="checkbox" data-consultno="{{$qc->consult_no}}" data-id="{{$qc->id}}" data-moveid="6" data-movemname="Waiting Patient" data-regno="{{$qc->reg_no}}" value="{{$qc->id}}">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script>
    $(function() {
        var hash = window.location.hash;
        if(hash.length > 0){
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('active');
            $(hash+'-link').addClass('active');
            $(hash).addClass('active');
        }

        var date = new Date();
        var fstday = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 4);
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        var consultNo, consultId, movementId, movemname, deptNo, doctor_id, reg_no;
        var fourceRoomIn = 0;



        $('#ssinId').datepicker({
            format: "dd-M-yyyy DD",
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            startDate: fstday,
            endDate: date,
            inline: true,
        });
        $('#ssinId').datepicker('setDate', today);

        $('#ssinId').on("change", function() {
            getSsIndate($(this).val());

        });

        $('#queDate').datepicker({
            format: "dd-M-yyyy DD",
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            startDate: fstday,
            endDate: date,
            inline: true,
        });
        $('#queDate').datepicker('setDate', today);

        $('#queDate').on("change", function() {
            getQueControl($(this).val());

        });
    });

    $(document).on('click', ".check", function() {
            if (confirm('Do you want to Move this Patient for Queue?')) {
                $(this).prop('checked', true);
                consultNo = $(this).data('consultno');
                consultId = $(this).data('id');
                movementId = $(this).data('moveid');
                movemname = $(this).data('movemname');
                deptNo = $('#oss').val();
                ssInMovement();
            } else {
                $(this).prop('checked', false);
            }
    });

    $(document).on('click', ".queControl", function() {
            if (confirm('Do you want to Forward this Patient?')) {
                $(this).prop('checked', true);
                consultNo = $(this).data('consultno');
                consultId = $(this).data('id');
                movementId = $(this).data('moveid');
                movemname = $(this).data('movemname');
                deptNo = $('#oss').val();
                queControlMovement();
            } else {
                $(this).prop('checked', false);
            }
    });

    $(document).on('click', ".missingPat", function() {
            if (confirm('Do you want to Move this Patient on Missing List?')) {
                $(this).prop('checked', true);
                consultNo = $(this).data('consultno');
                consultId = $(this).data('id');
                movementId = $(this).data('moveid');
                movemname = $(this).data('movemname');
                deptNo = $('#oss').val();
                missingPatMovement();
            } else {
                $(this).prop('checked', false);
            }
    });

    $(document).on('click', ".recall", function() {
            if (confirm('Do you want to Forward this Patient?')) {
                $(this).prop('checked', true);
                consultNo = $(this).data('consultno');
                consultId = $(this).data('id');
                movementId = $(this).data('moveid');
                movemname = $(this).data('movemname');
                deptNo = $('#oss').val();
                recallMovement();
            } else {
                $(this).prop('checked', false);
            }
    });

    $(document).on('click', ".doctorIn", function() {
        fourceRoomIn = 0;
                $(this).prop('checked', true);
                consultNo = $(this).data('consultno');
                consultId = $(this).data('id');
                movementId = $(this).data('moveid');
                movemname = $(this).data('movemname');
                doctor_id = $(this).data('doctor_id');
                reg_no = $(this).data('regno');
                deptNo = $('#oss').val();
               var status = doctorIn();
               if(status == 'cancle'){
                $(this).prop('checked', false);
               }
    });

    $(document).on('click', ".doctorOut", function() {
            if (confirm('Are you sure you want to move this patient for doctor room out?')) {
                $(this).prop('checked', true);
                consultNo = $(this).data('consultno');
                consultId = $(this).data('id');
                movementId = $(this).data('moveid');
                movemname = $(this).data('movemname');
                deptNo = $('#oss').val();
                doctorOut();
            } else {
                $(this).prop('checked', false);
            }
    });

    function ssInMovement() {
        // alert('ssInMovement');
        $.ajax({
            url: "{{url('ssInMovement')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'consult_no': consultNo,
                'opconsultation_id': consultId,
                'opmovetype_id': movementId,
                'movement_name': movemname,
                'dept_no': deptNo
            },
            success: function(data) {
                window.location.href ='/serviceStation/#arrived';
                // window.location.reload();
            }
        })
    }

    function queControlMovement() {
        $.ajax({
            url: "{{url('queControlMovement')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'consult_no': consultNo,
                'opconsultation_id': consultId,
                'opmovetype_id': movementId,
                'movement_name': movemname,
                'dept_no': deptNo
            },
            success: function(data) {
                window.location.href ='/serviceStation/#queueControl';
                // window.location.reload();
            }
        })
    }

    function missingPatMovement() {
        $.ajax({
            url: "{{url('missingPatMovement')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'consult_no': consultNo,
                'opconsultation_id': consultId,
                'opmovetype_id': movementId,
                'movement_name': movemname,
                'dept_no': deptNo
            },
            success: function(data) {
                window.location.href ='/serviceStation/#missingPatient';
                // window.location.reload();
            }
        })
    }

    function recallMovement() {
        $.ajax({
            url: "{{url('recallMovement')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'consult_no': consultNo,
                'opconsultation_id': consultId,
                'opmovetype_id': movementId,
                'movement_name': movemname,
                'dept_no': deptNo
            },
            success: function(data) {
                window.location.href ='/serviceStation/#missingPatient';
                // window.location.reload();
            }
        })
    }

    function doctorIn() {
        $.ajax({
            url: "{{url('doctorIn')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'consult_no': consultNo,
                'opconsultation_id': consultId,
                'opmovetype_id': movementId,
                'movement_name': movemname,
                'dept_no': deptNo,
                'doctorinfo_id': doctor_id,
                'reg_no': reg_no,
                'fourceRoomIn': fourceRoomIn
            },
            success: function(data) {
                if(data == 'Patient Exist'){
                    if (confirm('Patient Already Exist in Doctor Room! Do you want to move?')) {
                        fourceRoomIn = 1;
                        doctorIn();
                    }
                }
                if(data == 'Empty'){
                    if (confirm('Are you sure! you want to move this patient for doctor room in?')) {
                        fourceRoomIn = 1;
                        doctorIn();
                    }
                }
                
                if(data == 'Success'){
                    window.location.href ='/serviceStation/#currentPatient';
                    // window.location.reload();
                }
                
                // $('#tr_' + consultId).addClass('text-success');
            }
        })

        return 'cancle';
    }

    function doctorOut() {
        $.ajax({
            url: "{{url('doctorOut')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'consult_no': consultNo,
                'opconsultation_id': consultId,
                'opmovetype_id': movementId,
                'movement_name': movemname,
                'dept_no': deptNo
            },
            success: function(data) {
                window.location.href ='/serviceStation/#currentPatient';
                // $('#tr_'+consultId).remove();
            }
        })
    }
</script>
@endsection