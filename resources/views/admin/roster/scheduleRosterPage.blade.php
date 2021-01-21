    @extends('layouts.app')
    @section('css')
    <style>
.scroldiv {
    /* overflow:scroll; */
}
    </style>
    <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css/imgcss.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-datetimepicker.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @endsection
    @section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Schedule</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{url('scheduleRoster')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Doctor Specilty</label>
                                <select class="custom-select" id="specialty">
                                    <option value="All">Select Specilty</option>
                                    @foreach($specialty as $sp)
                                    <option value="{{$sp->dept_no}}">
                                        {{$sp->dept_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Designation</label>
                                <select class="custom-select" id="desig">
                                    <option value="All">Select Designation</option>
                                    @foreach($designation as $desig)
                                    <option value="{{$desig->job_id}}">
                                        {{$desig->job_desc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Care Giver</label>
                                <select class="custom-select" id="doctor" name="doctorinfo_id" required="">
                                    <option value="">Select Care Giver</option>
                                    @foreach($doctors as $doc)
                                    <option value="{{$doc->id}}">
                                        {{$doc->designation.' '.$doc->doctor_name.' '.$doc->qualification}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border border-success">
                                <h3 class="ml-1 text-success pt-2">
                                    <div class="form-group">
                                        <div class="checkbox select-all">
                                            <label>Select all</label>
                                            <input id="all" type="checkbox" />
                                        </div>
                                    </div>
                                </h3>

                                <table class="table" id="dynamicTable">
                                    <tbody>
                                        @foreach($days as $ds)
                                        <tr id="">
                                            <td width="100">{{$ds->name}}</td>
                                            <td>
                                                <input type="checkbox" name="day_id[]" value="{{$ds->id}}">
                                            </td>
                                            <td width="80">
                                                <input type="text" name="avg_duration{{$ds->name}}"
                                                    placeholder="Visit Duration" class="form-control" />
                                            </td>
                                            <td>
                                                <select class="custom-select" name="doctorvisit_id{{$ds->name}}[]" >
                                                    <option value="">Visit Time</option>
                                                    @foreach($visits as $v)
                                                    <option value="{{$v->id}}">
                                                        {{$v->visit_name}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" name="start_time{{$ds->name}}[]"
                                                    placeholder="Enter Start Time" class="form-control timepicker" />

                                                <input type="text" name="end_time{{$ds->name}}[]"
                                                    placeholder="Enter End Time" class="form-control timepicker" />
                                            </td>
                                            <td>
                                                <div id="extraTime{{$ds->id}}" class="d-flex scroldiv">
                                                </div>

                                            </td>
                                            <td><button type="button" data-id="{{$ds->id}}" data-day="{{$ds->name}}"
                                                    name="add" class="btn btn-success add">+</button></td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection
    @section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    function initTimePicker(){
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 15,
            minTime: '10',
            maxTime: '10:00pm',
            // defaultTime: '11',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    }
    initTimePicker();

var i = 0;
$(".add").click(function() {
    var id = $(this).data('id');
    var day = $(this).data('day');

    ++i;
    var data = `<div class="mx-1">
                        <select class="custom-select" id="" name="doctorvisit_id${day}[]">
                        @foreach($visits as $v) <option value="{{$v->id}}"> {{$v->visit_name}}</option> @endforeach </select>
                        <input type="text" name="start_time${day}[]" placeholder="Enter Start Time" class="form-control timepicker" />
                        <input type="text" name="end_time${day}[]" placeholder="Enter end Time" class="form-control timepicker" />
                        <button type="button" class="btn btn-danger btn-sm btn-block remove-tr">Remove</button>
                    </div>`;
    $('#extraTime' + id).append(data);
    initTimePicker();
    // $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][start_time]" placeholder="Enter Start Time" class="form-control" /></td><td><input type="text" name="addmore['+i+'][end_time]" placeholder="Enter end Time" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function() {
    $(this).parent().remove();
    // $(this).parents('tr').remove();
});
// end Add Column
$(function() {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#startDate').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        startDate: date,
        inline: true
    });


    $('#startDate').on('change', function() {
        var enddate = $(this).val();
        $('#endDate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: false,
            changeMonth: true,
            changeYear: true,
            startDate: enddate,
            inline: true

        });

    })

    $("#endDate").change(function() {
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        if ((Date.parse(startDate) > Date.parse(endDate))) {
            alert("End date should be greater than Start date");
            document.getElementById("endDate").value = "";
        }
    });

    // day Array Value
    $(".btn_click").click(function() {
        var test = new Array();
        $("input[name='id']:checked").each(function() {
            test.push($(this).val());
        });

        alert("Day Value are: " + test);
    });


});

$('#specialty').on('change', function() {
    var spDoctor = $(this).val();
    getDoctorSpeciltyWise(spDoctor);

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
// checkbox for Days
$("#all").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
    </script>
    @endsection