<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <style type="text/css" media="all">
        .tr {
            text-align: right;
            /* background-color: red;
            color:green; */
        }

        .col-md-4 {
            width: 38%;
            float: left;
            border-right: 0.01em solid #ccc;
        }

        .col-md-8 {
            width: 60%;
            float: right;
        }

        .bl {
            border-left: 5px solid black;
        }

        .pb {
            padding-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="row m-auto">
            <div class="col-md-12">
                <div class="card w-100 p-3 d-flex">
                    <div class="tr">
                        <h3>
                            {{$presPrint->consultation->designation.' '.$presPrint->consultation->doctor_name}}
                        </h3>
                        <p>
                            {{$presPrint->consultation->qualification}}
                            <br>specialty: {{$presPrint->consultation->specialty}}
                            <br>Department: {{$presPrint->consultation->dept_name}}
                        </p>
                    </div>
                    <div>
                        <table width="100%" style="margin-bottom: 20px;">
                            @php
                            $dob = $presPrint->patAppinfo->dob;
                            $d =\Carbon\Carbon::parse($presPrint->patAppinfo->dob)->diff(\Carbon\Carbon::now())->format('%d');
                            $m =\Carbon\Carbon::parse($presPrint->patAppinfo->dob)->diff(\Carbon\Carbon::now())->format('%m');
                            $y =\Carbon\Carbon::parse($presPrint->patAppinfo->dob)->diff(\Carbon\Carbon::now())->format('%y');
                            @endphp
                            <thead>
                                <tr class="text-success">
                                    <th> <span class="prescription-p-title">Name :
                                        </span>{{$presPrint->patAppinfo->salutation_id.' '.$presPrint->patAppinfo->ful_name}}
                                    </th>
                                    <th> <span class="prescription-p-title">Age</span>
                                        : &nbsp;<span>{{$y?$y.'Y ':''}}{{$m?$m.'M ':''}}{{$d?$d.'D':''}}</span>,&nbsp;{{$presPrint->patAppinfo->gender == 'M'?'Male':'Female'}}
                                    </th>
                                    <th><span class="prescription-p-title">Contact No: </span>
                                        {{$presPrint->patAppinfo->mobile}}
                                    </th>
                                    <th>
                                        <span class="prescription-p-title">Dt:</span>
                                        {{ \Carbon\Carbon::createFromTimestamp(strtotime($presPrint->consult_dt))->format('d-M-Y')}}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div style="border-right: dotted; border-color:black ">
                                <!-- dotted solid double dashed -->
                                <b>Chief Complain :</b><br>
                                @foreach($cc as $cc )
                                <div class="pb">
                                    <span>{{$loop->iteration}}. </span> {{$cc}}<br>
                                </div>
                                @endforeach

                                <b><br>On Examination :</b><br>
                                @foreach($patTest as $pt)
                                <div class="pb">
                                    <span>{{$loop->iteration}}. </span>{{$pt->ehprescpoes[0]->test_name}}<br>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-8 bl">
                            <div>
                                <img src="{{url('/admin/img/rx.png')}}" width="30px" alt="">
                                <ol>
                                    @foreach($patMedicine as $drug)
                                    <li class="pb"><i>{{$drug->prescribe_type}}</i> <b>{{$drug->presMedicine[0]->test_name}}</b>
                                        ({{$drug->rx_total_dpt}})
                                        <ul style="padding-left: 10px">
                                            <li style="list-style: none">
                                                {{$drug->getDose->dpt_details}}</li>
                                            <li style="list-style: none">{{$drug->remarks}}</li>
                                        </ul>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                            <br><br>
                            <!-- <p style="text-align:right"> -->
                                <!-- <span>

                                ________________
                                </span> -->
                                <div style="float: right">
                                    <div style="border-top: dotted; border-color:black; width: 150px;" >
                                        Seal and Signature
                                    </div>
                                </div>
                                
                            <!-- </p> -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>