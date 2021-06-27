<div class="row justify-content-center">
    @foreach($deptWiseDoctor as $dpdoc)
    <div class="col-4">

        <div class="card border-success m-3">
            <!-- <div class="card-header bg-transparent border-success"></div> -->
            <div class="card-body text-success text-center">
                <h5 class="card-title">{{$dpdoc->doctor_name}}</h5>
                <h6 class="card-text">{{$dpdoc->designation}}, <span class="text-info">{{$dpdoc->dept_name}}</span></h6>
                <h6 class="card-text">{{$dpdoc->qualification}}</h6>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-between border-success">
                <a href="{{url('doctorpatientapp/'.$dpdoc->id)}}" class="btn btn-sm btn-outline-info">Appointment</a>
                <a href="{{url('doctorprofile/'.$dpdoc->id)}}" class="btn btn-sm btn-outline-success">Profile</a>
            </div>
        </div>

    </div>
    @endforeach
</div>