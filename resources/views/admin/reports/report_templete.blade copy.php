@extends('layouts.app')
@section('css')
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #not-print * {
            display: none;
        }

        #to-print,
        #to-print * {
            visibility: visible;
        }

        #to-print {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: auto;
            height: 99%;
        }
    }
</style>
@endsection
@section('content')
<div class="content">
    <div class="row m-auto">

        <div class="col-md-12" id="report">
            <div class="card w-100 p-3">
                <div class="text-right">

                    <h3 class="">
                    
                        <span class="text-center">
                            <a href="#"  class="btn btn-sm btn-success mb-1">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </a></span>
                        {{$presPrint->consultation->designation.' '.$presPrint->consultation->doctor_name}}
                    </h3>
                    <p>
                        {{$presPrint->consultation->qualification}}
                        <br>specialty: {{$presPrint->consultation->specialty}}
                        <br>Department: {{$presPrint->consultation->dept_name}}
                    </p>


                </div>

                <div>
                    <table width="100%" style="margin-bottom: 10px;">
                        <thead>
                            <tr class="text-success">
                                <th> <span class="prescription-p-title">Name : </span>{{$presPrint->patAppinfo->salutation_id.' '.$presPrint->patAppinfo->ful_name}}</th>
                                <th> <span class="prescription-p-title">Age</span>
                                    : &nbsp;<span id="age"></span>,&nbsp;{{$presPrint->patAppinfo->gender == 'M'?'Male':'Female'}}</th>
                                <th><span class="prescription-p-title">Contact No: </span>
                                    {{$presPrint->patAppinfo->mobile}}
                                </th>
                                <th>
                                    <span class="prescription-p-title">Date :</span>
                                    {{ \Carbon\Carbon::createFromTimestamp(strtotime($presPrint->consult_dt))->format('d-M-Y')}}
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="row">
                    <div class="col-4 d-flex flex-column justify-content-between">
                        <div>
                            <b>Chief Complain :</b><br>
                            @foreach($cc as $cc )
                            <span>{{$loop->iteration}}. </span>{{$cc}}<br>
                            @endforeach
                            <b><br>On Examination :</b><br>
                            @foreach($patTest as $pt)
                            <span>{{$loop->iteration}}. </span> {{$pt->ehprescpoes[0]->test_name}}<br>
                            @endforeach
                        </div>
                        <!-- <div class="mt-4 d-flex">Last Visit: 24-Jan-2021</div> -->
                    </div>

                    <div class="col-8 d-flex flex-column justify-content-between bd-highlight" style="border-left: 1px solid black;">
                        <div class="bd-highlight">
                            <div class="bd-highlight"><img src="{{asset('admin\img\rx.png')}}" alt="Rx" width="30px;"></div>
                            <div class="ml-4">
                                <br>
                                @foreach($patMedicine as $pm)
                                <p>{{$loop->iteration }}. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$pm->presMedicine[0]->test_name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>({{$pm->rx_total_dpt}})</span>
                                    <br><span class="ml-5">{{$pm->getDose->dpt_details}}</span>
                                </p>
                                @endforeach

                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end">
                            <p class="prescription-p-title text-right" style="border-top: 1px solid black; width: 150px;">Seal and Signature</p>
                        </div>
                        <!-- <button class="btn btn-info pull-right"><i class="fa fa-print"></i></button>
                        <button id="print" class="btn btn-info pull-right"><i class="fa fa-print"></i></button> -->
                        <!-- <button id="printPageBtn" class="btn btn-success pull-right" style="margin-right: 15px;"><i class="fa fa-print"></i> &nbsp; Print Page</button> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    jQuery.fn.printMe=function(a){var b=$.extend({path:[],title:"",head:!1},a);return this.each(function(){var a=$(this),c=window.open();c.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'),c.document.write("<html>"),c.document.write("<head>"),c.document.write("<meta charset='utf-8'>");for(i in b.path)c.document.write('<link rel="stylesheet" href="'+b.path[i]+'">');c.document.write("</head><body>"),""!=b.title&&c.document.write("<h1>"+b.title+"</h1>"),c.document.write(a.html()),c.document.write('<script type="text/javascript">function closeme(){window.close();}setTimeout(closeme,50);window.print();</script></body></html>'),c.document.close()})};
    
$(function() {
        var dob = '{{$presPrint->patAppinfo->dob}}';
        var age = ageCalculator(dob);
        $('#age').html(age);

    });

    $('.btn').click(function(e){
        alert('test');
        e.preventDefault();
        $("#report").printMe();
        // $("#report").printMe({"title": "My First Print" });
    });
</script>
@stop