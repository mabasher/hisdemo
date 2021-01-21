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
                        <table class="table">
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
                                <tr>
                                    <td>{{$ns->reg_no}}</td>
                                    <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
                                    <td>{{$ns->appoint_no}}</td>
                                    <td>{{$ns->consult_no}}</td>
                                    <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
                                    <td>
                                        <div class="material-switch float-right">
                                            <input id="staff_module" type="checkbox">
                                            <label for="staff_module" class="badge-success"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab2">
                        <div class="col-md-6 m-auto">
                            <input type="text" class="form-control text-success text-center nsDate" name="nscomplete_dt" id="nsDate" placeholder="Visit Date" value="" style="border:none">
                        </div>
                        <table class="table">
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
                                <tr>
                                    <td>{{$ns->reg_no}}</td>
                                    <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
                                    <td>{{$ns->appoint_no}}</td>
                                    <td>{{$ns->consult_no}}</td>
                                    <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <div class="card mt-2 border">
                            <h5 class="card-header text-success mt-2">
                                Vital Sign Information
                            </h5>
                            <div class="card-body">
                                <form autocomplete="off" method="POST" action="{{url('SaveDoctor')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label>Chief Complaint</label>
                                                <div class="form-row">
                                                    <textarea rows="1" cols="1" class="form-control disableEnable" placeholder="Chief Complaint" id="perAddress" name="per_address"></textarea>
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
                                            <select class="custom-select" name="frequency">
                                                <option value="Oral">Oral</option>
                                                <option value="Ear">Ear</option>
                                                <option value="Rectal">Rectal</option>
                                                <option value="Axillary">Axillary</option>
                                                <option value="Temporal">Temporal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Pulse Rate</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="pulse" name="temp_c" placeholder="Pulse Rate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Taken Position</label>
                                            <select class="custom-select" name="frequency">
                                                <option value="Left arm">Left Arm</option>
                                                <option value="Right arm">Right Arm</option>
                                                <option value="left leg">Left Leg</option>
                                                <option value="Right leg">Right Leg</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <label>Respiration  Rate</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_c" placeholder="Resting Heart Rate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Taken Position</label>
                                            <select class="custom-select" name="frequency">
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
                                                        <input type="text" class="form-control" id="systolic" name="temp_f" placeholder="Systolic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>BP Diastolic</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="diastolic" name="temp_c" placeholder="Diastolic mmHg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Taken Position</label>
                                            <select class="custom-select" name="frequency">
                                                <option value="Laying">Laying</option>
                                                <option value="Standing">Standing</option>
                                                <option value="Sitting">Sitting</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Taken From</label>
                                            <select class="custom-select" name="frequency">
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
                                                        <input type="text" class="form-control" name="temp_c" placeholder="Heart Rate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>LMP (dd/mm/yyyy)</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_c" placeholder="LMP">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>OFC</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_c" placeholder="OFC">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Weight (KG)</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_f" placeholder="Weight (KG)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Weight (LB)</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_f" placeholder="Weight (LB)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Height (cm)</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_f" placeholder="Height (cm)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <label>BMI</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_c" placeholder="BMI">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>BSA</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_c" placeholder="BSA">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Pain Location</label>
                                            <div class="form-row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="temp_f" placeholder="Pain Location">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Severity Level</label>
                                            <select class="custom-select" name="frequency">
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
                                                        <input type="text" class="form-control" name="temp_f" placeholder="Remarks">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab3">

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
        var diastolic =$('#diastolic').val();
        if (systolic < diastolic) {
            alert('BP higer must be greter than BP lower.')
            $(this).val('');
        } else {
            systolic = $(this).val();
        }

    });

    $('#diastolic').on("change", function() {
        var diastolic = $(this).val();
        var systolic =$('#systolic').val();
        if (diastolic > systolic) {
            alert('BP lower must be less than BP higer.')
            $(this).val('');
        } else {
            diastolic = $(this).val();
        }

    });
</script>
@endsection