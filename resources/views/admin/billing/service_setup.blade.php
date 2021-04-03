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
                <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Services</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($service as $s)
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>{{$s->service_name }}</td>
                                        <td><input type="checkbox"></td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <aside class="col-md-6">
            <div class="widget category-widget">

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