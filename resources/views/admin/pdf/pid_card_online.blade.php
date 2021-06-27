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
        <h5 class="text-center text-success">Registration Card.</h5>
        <hr>
        </div>
        
        <div class="card-body">

            <div class="my-2">
                <div class="card-body">
                    
                    <h6 class="card-title">Patient Name: <span class="text-success">{{$pid->ful_name}}</span></h6>
                    <h6 class="card-title">PID: <span class="text-success">{{$pid->reg_no}}</span></h6>
                    <h6 class="card-title">Reg Date: <span class="text-success">{{\Carbon\Carbon::parse($pid->reg_date)->format('d/m/Y')}}</span></h6>
                    <h6 class="">DOB: <span class="text-info">{{\Carbon\Carbon::parse($pid->dob)->format('d/m/Y')}}</span> &nbsp; Age:</h6>
                    <h6 class="">Gender: &nbsp; <span class="text-info">{{$pid->gender == 'M'?'Male':'Female'}}</span></h6>
                </div>
                
            </div>

                    
			<div class="text-center">
				<img class="imgsize" src="{{url('/simple-qr-code/'.$pid->reg_no.' '.$pid->salutation_id.' '.$pid->ful_name)}}" alt="No QR">
			</div>
        </div>
    </div>
    



</body>

</html>