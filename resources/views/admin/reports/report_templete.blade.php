@extends('layouts.app')
@section('css')
<style>

</style>
@endsection
@section('content')
<div class="content">
    <div class="row m-auto">
        <div class="col-md-12">
            <div class="card w-100 p-3">
                <div class="col text-center" style="position:absolute; top:-10px">
                    <a href="{{url('prescriptions/'.$presPrint->patAppinfo->reg_no)}}" class="btn btn-sm btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    <a href="#" id="printBtn" class="btn btn-sm btn-success">
                        <i class="fa fa-print" aria-hidden="true"></i>
                    </a>
                    &nbsp;&nbsp;
                </div>

                <div class="m-5" id="report">
                    <div class="text-right">

                        <h3 class="">

                            {{$presPrint->consultation->designation.' '.$presPrint->consultation->doctor_name}}
                        </h3>
                        <h5>
                            {{$presPrint->consultation->qualification}}
                            <br>Specialty: {{$presPrint->consultation->specialty}}
                            <br>Department: {{$presPrint->consultation->dept_name}}
                            <br>BMDC/Reg No: {{$presPrint->consultation->bmdc}}
                        </h5>


                    </div>

                    <h5>
                        <span class="prescription-p-title">Date :</span>
                         {{ \Carbon\Carbon::createFromTimestamp(strtotime($presPrint->consult_dt))->format('d-M-Y')}}
                         
                        <table class="mt-2" width="100%" style="margin-bottom: 10px;">
                            <thead>
                                <tr class="text-success font-weight-normal">
                                    <th> <span class="prescription-p-title">Name : </span>{{$presPrint->patAppinfo->salutation_id.' '.$presPrint->patAppinfo->ful_name}}</th>
                                    <th> <span class="prescription-p-title">Age</span>
                                        : &nbsp;<span id="age"></span>,&nbsp;{{$presPrint->patAppinfo->gender == 'M'?'Male':'Female'}}</th>
                                    <th><span class="prescription-p-title">Contact No: </span>
                                        {{$presPrint->patAppinfo->mobile}}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </h5>

                    <div class="row">
                        <div class="col-4 d-flex flex-column justify-content-between mb-5" style="border-right: solid; border-color:black;">
                            <h5>
                                <b><br>Chief Complaint :<br></b>
                                @foreach($cc as $cc )
                                <span class="mb-5">{{$loop->iteration}}.&nbsp;&nbsp; {{$cc}}<br></span>
                                @endforeach
                                <b><br>On Examination :</b><br>
                                @foreach($patTest as $pt)
                                <span>{{$loop->iteration}}. &nbsp;&nbsp;{{$pt->dctestmst->test_name}}<br></span>
                                @endforeach
                            </h5>
                            <div class="d-flex justify-content-start" style="margin-top:120px">
                                <h5 class="prescription-p-title text-center" style="border-top:solid; border-color:black; width: 200px;">Seal and Signature</h5>
                            </div>
                            <!-- <div class="mt-4 d-flex">Last Visit: 24-Jan-2021</div> -->
                        </div>

                        <div class="col-8 d-flex flex-column justify-content-between">
                            <h5>
                                <div class="bd-highlight"><img src="{{asset('admin\img\rx.png')}}" alt="Rx" width="30px;"></div>
                                <div class="ml-4">
                                    <br>
                                    @foreach($patMedicine as $pm)
                                    <p>{{$loop->iteration }}. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pm->presMedicine[0]->test_name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>({{$pm->rx_total_dpt}})</span>
                                        <br><span class="ml-5">{{$pm->getDose->dpt_details}}</span>
                                    </p>
                                    @endforeach

                                </div>
                            </h5>
                        
                        </div>
                        <div class="m-auto mb-5">
                            <h5>Pathology: 2nd Floor, Room #220 <span>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;</span> <span class="text-success">Opd Pharmacy: 1st Floor Room #110</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

<script src="{{asset('js/printme.min.js')}}"></script>
<script>
    $(function() {
        var dob = '{{$presPrint->patAppinfo->dob}}';
        var age = ageCalculator(dob);
        $('#age').html(age);

    });

    $("#printBtn").click(function() {
        $("#report").printMe({
            "path": ["{{asset('admin/css/bootstrap.min.css')}}"],
            "title": ""
        });
    });
</script>
@stop