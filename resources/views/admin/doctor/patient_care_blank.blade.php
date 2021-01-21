@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
@endsection
@section('content')
<div class="content">
    You are Not a Doctor;
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