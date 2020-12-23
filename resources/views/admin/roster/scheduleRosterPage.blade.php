    @extends('layouts.app')
    @section('css')
    <style>


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
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Schedule</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Schedule Type</label>
                                <select class="custom-select" id="doctor" name="doctorinfo_id">
                                    <option value="all">Select Schedule Type</option>
                                    <option value="D">Daily</option>
                                    <option value="W">Weekly</option>
                                    <option value="TW">This Week</option>
                                    <option value="NW">Next Week</option>
                                    <option value="M">Monthly</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Start Date</label>
                                    <input type="text" class="form-control datepicker" name="start_date"
                                                        id="startDate" placeholder="Start Date" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>End Date</label>
                                    <input type="text" class="form-control datepicker" name="end_date"
                                                        id="endDate" placeholder="End Date" value="">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label>Message</label>
                        <textarea cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Schedule Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_active"
                                value="option1" checked>
                            <label class="form-check-label" for="product_active">
                                Active
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_inactive"
                                value="option2">
                            <label class="form-check-label" for="product_inactive">
                                Inactive
                            </label>
                        </div>
                    </div> -->
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Create Schedule</button>
                    </div>
                </form>
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

    $('#startDate').on('change', function(){
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
    
});
    </script>
    @endsection