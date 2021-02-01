<html>

<head>

    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <style type="text/css">
    .table td,
    .table th {
        padding: .10rem !important;
        font-size: 11px;
    }

    @page {
        margin: 10 auto;
    }
	body { margin: 0px; }

    /* .header{
			padding-top:25px;
			padding-bottom:25px;
		} */

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
        <div class="" style="margin-top: 10;">
            <h5 class="text-center text-success">Darco Technologies Ltd.</h5>
        </div>
        <div class="card-body pt-5 pl-5 pb-0">

            <div class="my-2">
                <table class="table">
                    <tbody>
                        <tr>
                            <td width="60px">Appoint No</td>
                            <td>: {{$appoint->appoint_no}}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>: {{$appoint->reg_no}}</td>
                        </tr>
                        <tr>
                            <td>Patient</td>
                            <td>: {{$appoint->salutation_id.' '.$appoint->ful_name}}</td>
                        </tr>
                        <tr>
                            <td>DOB</td>
                            <td>: {{$appoint->dob}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
							
                            <td>: {{$appoint->gender=='M'?'Male':($appoint->gender=='F'?'Female':'Others')}}</td>
                        </tr>
                        <tr>
                            <td>Mobile No</td>
                            <td>: {{$appoint->mobile}}</td>
                        </tr>
                        <!-- <tr>
                            <td></td>
                            <td>
								<img class="imgsize" src="{{url('/simple-qr-code/'.$appoint->reg_no)}}" alt="No QR">
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
			<div class="text-center">
				<img class="imgsize" src="{{url('/simple-qr-code/'.$appoint->appoint_no.' '.$appoint->salutation_id.' '.$appoint->ful_name)}}" alt="No QR">
			</div>
        </div>
    </div>
    <!-- <div class="row">
	<p>{{$pid->reg_no}}</p>
    <p>{{$pid->reg_date}}</p>
    <p>{{$pid->ful_name}}</p>
	<p>{{$pid->dob}}</p>
	<p>{{$pid->mobile}}</p>
	<img class="img-thumbnail" src="{{url('/simple-qr-code/'.$pid->regNo)}}" alt="No QR" height="100px" width="100px">
	</div> -->



</body>

</html>