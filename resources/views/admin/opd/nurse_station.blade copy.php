@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>

</style>
@endsection

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="card-box">
                <!-- <h6 class="card-title">Bottom line justified</h6> -->
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1" data-toggle="tab">Nurse Station In</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2" data-toggle="tab">Vital Sign</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab3" data-toggle="tab">Vital Sign Complated</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="bottom-justified-tab1">
                        <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center toDate" name="consult_dt" id="toDate" placeholder="Visit Date" value="" style="border:none">
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Pid</th>
                                    <th>Patient Name</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="nsPatList">
                                @foreach($nsin as $ns)
                                @if($ns->oppatmovement->count() > 0 && $ns->oppatmovement[0]->opmovetype_id == 1)
                                <tr>
                                    <td>{{$ns->reg_no}}</td>
                                    <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
                                    <td>{{$ns->appoint_no}}</td>
                                    <td>{{$ns->consult_no}}</td>
                                    <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
                                    <td>
                                        <div class="material-switch float-right">
                                            <input id="ns" data-consultno="{{$ns->consult_no}}" data-id="{{$ns->id}}" 
                                            data-moveid="2" data-movemname="Nurse Station IN" name="check" type="checkbox">
                                            <label for="ns" class="badge-success"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab2">
                        <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center nsDate" name="nscomplete_dt" id="nsDate" placeholder="Visit Date" value="" style="border:none">
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Pid</th>
                                    <th>Patient Name</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                </tr>
                            </thead>
                            <tbody id="nsComPatList">
                                @foreach($nsin as $ns)
                                @if($ns->oppatmovement->count() > 0 && $ns->oppatmovement[0]->opmovetype_id == 2)
                                <tr>
                                    <td>{{$ns->reg_no}}</td>
                                    <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
                                    <td>{{$ns->appoint_no}}</td>
                                    <td>{{$ns->consult_no}}</td>
                                    <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
                                    <td>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="radio" data-consultno="{{$ns->consult_no}}" data-id="{{$ns->id}}" 
                                                data-moveid="3" data-movemname="Vital Sign Completed" data-regno="{{$ns->reg_no}}" value="{{$ns->id}}" >
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>

                        </table>

                        <div class="card mt-2 border">
                            <h5 class="card-header text-success mt-2">
                                Vital Sign Information
                            </h5>
                            <div class="card-body">
                                <form autocomplete="off" id="nsFormId" method="POST" action="{{url('vitalSignInsert')}}">
                                    @csrf
                                    <div class="form-row">
                                        <!-- <input type="text" class="form-control" id="consultId" name="opconsultation_id">
                                        <input type="text" class="form-control" id="consultNo" name="consult_no">
                                        <input type="text" class="form-control" id="regNo" name="reg_no"> -->
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label>Chief Complaint</label>
                                                <div class="form-row">
                                                    <textarea rows="1" cols="1" class="form-control disableEnable" placeholder="Chief Complaint" id="chiefComplain" name="chief_complain"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2 mb-3">
                                            <label>Temp °F</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="tempF" name="temp_f" placeholder="°F Fahrenheit">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Temp °C</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="tempC" name="temp_c" placeholder="°C Celsius">
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
                                                        <input type="text" class="form-control" id="pulse" name="pulse" placeholder="Pulse (min)">
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
                                                        <input type="text" class="form-control" name="respiratory_rate" placeholder="Respiratory Rate">
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
                                                        <input type="text" class="form-control" id="systolic" name="bp_higher" placeholder="Systolic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>BP Diastolic</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="diastolic" name="bp_lower" placeholder="Diastolic mmHg">
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
                                                        <input type="text" class="form-control" name="heart_rate" placeholder="Heart Rate">
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
                                                        <input type="text" class="form-control" name="weight_kg" placeholder="Weight (KG)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Weight (LB)</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="weight_lb" placeholder="Weight (LB)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Height (cm)</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="height_cm" placeholder="Height (cm)">
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
                                                        <input type="text" class="form-control" name="pain_location" placeholder="Pain Location">
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
                                                        <input type="text" class="form-control" name="comments" placeholder="Remarks">
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
                    <div class="tab-pane" id="bottom-justified-tab3">
                    <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center nsDate" name="nscomplete_dt" id="nsDate" placeholder="Visit Date" value="" style="border:none">
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Pid</th>
                                    <th>Patient Name</th>
                                    <th>Appooint No</th>
                                    <th>Consult No</th>
                                    <th>Doctor</th>
                                </tr>
                            </thead>
                            <tbody id="nsComPatList">
                                @foreach($nsin as $ns)
                                @if($ns->oppatmovement->count() > 0 && $ns->oppatmovement[0]->opmovetype_id == 3)
                                <tr>
                                    <td>{{$ns->reg_no}}</td>
                                    <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
                                    <td>{{$ns->appoint_no}}</td>
                                    <td>{{$ns->consult_no}}</td>
                                    <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
                                    <td>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="radio" data-consultno="{{$ns->consult_no}}" data-id="{{$ns->id}}" 
                                                data-moveid="3" data-movemname="Vital Sign Completed" data-regno="{{$ns->reg_no}}" value="{{$ns->id}}" >
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
        var date = new Date();
        var fstday = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 4);
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());


        $('#toDate').datepicker({
            format: "dd-M-yyyy DD",
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            startDate: fstday,
            endDate: date,
            inline: true,
        });
        $('#toDate').datepicker('setDate', today);

        $('#toDate').on("change", function() {
            getNSdate($(this).val());
        });

        $('#nsDate').datepicker({
            format: "dd-M-yyyy DD",
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            startDate: fstday,
            endDate: date,
            inline: true,
        });
        $('#nsDate').datepicker('setDate', today);

        $('#nsDate').on("change", function() {
            getNSCompletedate($(this).val());

        });

    });

    function getNSdate(consultDt) {
        $.ajax({
            url: "{{url('ns')}}/" + consultDt,
            type: "Get",
            success: function(data) {
                $('#nsPatList').html(data);
            }
        })
    }

    function getNSCompletedate(nsDt) {
        $.ajax({
            url: "{{url('nsComp')}}/" + nsDt,
            type: "Get",
            success: function(data) {
                console.log(data);
                $('#nsComPatList').html(data);
            }
        })
    }
    


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
            diastolic = $(this).val();
        }

    });

    // $('#check').on('change', function() {
    //     alert('Checkbox Yes');
    // });
    
    $(".material-switch").find("input[type=checkbox]").on("change",function() {
        var consultNo = $(this).data('consultno');
        var consultId = $(this).data('id');
        var movementId = $(this).data('moveid');
        var movemname = $(this).data('movemname');
        nsMovement(consultNo,consultId,movementId,movemname);
    });

    $(function () {
        $('.radio input[type=radio]').change(function(){
        // alert ( $(this).val() )
        // return
            $('#consultId').val($(this).attr('data-id'));
            $('#consultNo').val($(this).attr('data-consultno'));
            $('#regNo').val($(this).attr('data-regno'));
        
        })
    })

    function nsMovement(consultNo,consultId,movementId,movementName) {
        $.ajax({
            url: "{{url('nsMovement')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'consult_no': consultNo,
                'opconsultation_id': consultId,
                'opmovetype_id': movementId,
                'movement_name': movementName
            },
            success: function(data) {
                console.log(data);
            }
        })
    }
    
</script>
@endsection