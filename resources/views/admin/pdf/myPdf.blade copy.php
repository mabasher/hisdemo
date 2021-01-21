<html>

<head>

	<style type="text/css">
		.img{
			height:100px;
			width:100px;
			float:right;
		}
		.qr{
			height:100px;
			width:100px;
		}

	</style>

</head>

<body>
    <!-- <div class="card text-center">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div> -->
	
    
	<img class="img" src="{{url('simple-qr-code/'.$pid->reg_no)}}" alt="">
	<img class="qr" src="{{asset($pid->img_url)}}" alt="">
	<p>PID   :{{$pid->reg_no}}</p>
    <p>PID DT:{{$pid->reg_date}}</p>
    <p>Name  :{{$pid->ful_name}}</p>
	<p>DOB   :{{$pid->dob}}</p>
	<p>Mobile:{{$pid->mobile}}</p>
	
	

</body>

</html>