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
    <h3 class="text-primary text-center">Service Rate Center</h3>
    <hr>
    <div class="row m-auto">

        <div class="col-md-4">
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
                                    <td><input id="serviceType" value="{{$s->service_type}}" type="radio"></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <aside class="col-md-8">
            <div class="widget category-widget">
            <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable" id="servWiseItem">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Test Name</th>
                                    <th>Routine</th>
                                    <th>Urgent</th>
                                    <th>Stat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testinfo as $test)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$test->test_name }}</td>
                                    <td width="100px"><input type="text" placeholder="Routine" class="form-control" /></td>
                                    <td width="100px"><input type="text" placeholder="Urgent" class="form-control" /></td>
                                    <td width="100px"><input type="text" placeholder="Stat" class="form-control" /></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        var fstday = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 1);
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

    });


    $('#serviceType').on('change', function() {
        var servType = $(this).val();
        getServiceWiseRate(servType);

    })

    function getServiceWiseRate(servType) {
        $.ajax({
            url: "{{url('rateCenter')}}/" + servType,
            type: 'get',
            success: function(data) {
                $('#servWiseItem').html(data);
            }
        })
    }
</script>
@endsection