<html>

<head>

    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <style type="text/css">
    
    @page {
        margin: 10 auto;
    }


    .img {
        margin-top: 15px;
    }

    .imgsize {
        width: 50px;
    }
    </style>

</head>

<body>
    <div class="card header">
        <div class="">
            <h5 class="text-center text-success">Darco Technologies Ltd.</h5>
            <hr>
        </div>
        <div class="card-body">

            <div class="my-2">
                <div class="card-body">
                    <h6 class="card-title">Patient Name: <span class="text-success">{{$appoint->ful_name}}</span></h6>
                    <h6 class="card-title">PID: <span class="text-success">{{$appoint->reg_no}}</span></h6>
                    <h6 class="card-title">Appoint No: <span class="text-success">{{$appoint->appoint_no}}</span></h6>
                    <h6 class="card-title">Date & Time: <span class="text-success">{{\Carbon\Carbon::parse($appoint->app_date)->format('d-m-Y')}} </span>{{\Carbon\Carbon::parse($appoint->start_time)->format('h:i A')}}</h6>
                    <h6 class="">Care Giver: <span class="text-info">{{$appoint->appdoctor->doctor_name.', '.$appoint->appdoctor->designation}}</span></h6>
                    <h6 class="">Chember: &nbsp; <span class="text-info">{{$appoint->appdoctor->doc_chember.', '.'2nd Floor, Main Building'}}</span></h6>
                </div>
                
            </div>

                    
			<div class="text-center">
				<img class="imgsize" src="{{url('/simple-qr-code/'.$appoint->appoint_no.' '.$appoint->salutation_id.' '.$appoint->ful_name)}}" alt="No QR">
			</div>
        </div>
    </div>
    



</body>

</html>