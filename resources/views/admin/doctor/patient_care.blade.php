@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<style>
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
    <div class="row m-auto">
        <div class="col-md-5 ml-2">
            <div class="blog-view">
                <div class="widget category-widget">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 m-auto">
                                <input type="text" class="form-control text-success text-center toDate" name="app_date" id="toDate" placeholder="Visit Date" value="" style="border:none">
                            </div>
                            <!-- <h5>Doctor Information</h5> -->
                            <div class="text-center">
                                <img src="{{asset($doctor->doctor_image)}}" class="rounded-circle" alt="" width="150" height="150">
                            </div>
                            <ul class="categories border-bottom text-center">
                                <li><a href="#." class=" text-success">{{$doctor->designation.' '.$doctor->doctor_name}}</a></li>
                                <li><a href="#." class="">Specialty: {{$doctor->specialty}}</a></li>
                                <li><a href="#." class="">Department: {{$doctor->dept_name}}</a></li>
                                <li><a href="#." class=" text-info">Qualification: {{$doctor->qualification}}</a></li>
                                <li><a href="#.">Chember: {{'#'.$doctor->doc_chember}}  2nd Floor Main Building</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <aside class="col-md-6">
            <div class="widget category-widget">
                <h5>Patient Search</h5>
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="row" id="appList">
                    @foreach($doctor->appoints as $pat)
                    <div class="col-md-6">
                        <ul class="categories border-bottom">
                            <li><a href="{{url('prescriptions/'.$pat->reg_no)}}" class="text-success"><i class="fa fa-long-arrow-right"></i>{{$pat->reg_no}}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="categories border-bottom">
                            <li>{{$pat->ful_name}}</li>
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script>
    $(function() {
        var date = new Date();
        var fstday = new Date(date.getFullYear(), date.getMonth(), date.getDate()-1);
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
           getappointedPatient($(this).val());

        });

    });

    function getappointedPatient(appDt) {
    $.ajax({
        url: "{{url('patientCare')}}/" + appDt,
        type: "Get",
        success: function(data) {
            $('#appList').html(data);
        }
    })
}
</script>
@endsection