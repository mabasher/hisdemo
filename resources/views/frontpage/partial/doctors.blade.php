
<div class="container-fluid">
		<div class="row doctor-grid justify-content-center m-2">
			@foreach($doctors as $doc)
			<div class="col-md-4 col-sm-4  col-lg-3 text-center pt-2">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><a class="text-success" href="">{{$doc->doctor_name}} </a></h5>
                        <p class="card-text"><a class="text-info" href="">{{$doc->designation.', '.$doc->department->dept_name}}</a></p>
                        <p>{{$doc->qualification}}</p>
                        <a href="{{url('doctorpatientapp/'.$doc->id)}}" class="btn btn-xs btn-outline-success">Appointment</a>
                        <a href="{{url('doctorprofile/'.$doc->id)}}" class="btn btn-xs btn-outline-warning">Profile</a>
                    </div>
                </div>
				
			</div>
			@endforeach
		</div>

    </div>
    
	<script src="{{asset('template/js/jquery.min.js')}}"></script>
	<script>
		
	</script>