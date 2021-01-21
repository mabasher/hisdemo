@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('css/imgcss.css')}}">
<link rel="stylesheet" href="{{asset('css/select2ud.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>

</style>
@endsection
@section('content')

<div class="content">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Add Doctor</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form autocomplete="off" method="POST" action="{{url('SaveDoctor')}}">
                @csrf
                <div class="form-row">
                    <div class="col-md-3">
                        <label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="gender_male"
                                    value="M" checked>
                                <label class="form-check-label" for="gender_male">Male</label>
                            </div>
                            <!-- </div>
                    <div class="col-md-2"> -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input gender" type="radio" name="gender" id="gender_female"
                                    value="F">
                                <label class="form-check-label" for="gender_female">Female</label>
                            </div>
                        </label>
                        <select class="custom-select" id="jobId" name="designation">
                            <option value="">Select designation</option>
                            @foreach($designation as $desig)
                            <option value="{{$desig->job_desc}}">{{$desig->job_desc}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Doctor Name</label>
                            <input class="form-control" type="text" name="doctor_name" placeholder="Doctor Name">
                        </div>
                    </div>

                    <div class="col-3">
                        <img id="imgOpenRegistration" src="{{asset('images/fake.jpg')}}" style="margin-left: 60px;">
                        <input type="file" id="imgReg" name="doctor_image" style="display: none;" src=""
                            accept="image/x-png,image/gif,image/jpeg">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">

                            <label for="">Specialty</label>
                            <select class="custom-select" id="orgId" name="specialty">
                                <option value="">Select Specialty</option>
                                @foreach($specialty as $sp)
                                <option value="{{$sp->special_name}}">{{$sp->special_name}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="">Department</label>
                            <select class="custom-select" id="deptId" name="dept_no">
                                <option value="">Select Department</option>
                                @foreach($departments as $d)
                                <option value="{{$d->dept_name}}">{{$d->dept_name}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">Doctor Type</label>
                        <select class="custom-select js-example-basic-single" id="doctorType" name="doctor_type">
                            <option value="">Select Doctor Type</option>
                            <option value="I">Internal</option>
                            <option value="I">External</option>

                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Qualification</label>
                            <select class="form-control select2 select2-hidden-accessible" id="qualification" name="qualification[]"
                                multiple="" data-placeholder="Select Qualification" style="width: 100%;" tabindex="-1"
                                aria-hidden="true">
                                @foreach($qualification as $q)
                                <option>{{$q->short_special}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Clinical Interest</label>
                            <select class="form-control select2 select2-hidden-accessible" name="special_interest[]"
                                multiple="" data-placeholder="Select Clinical Interest" style="width: 100%;"
                                tabindex="-1" aria-hidden="true">
                                @foreach($specialty as $sp)
                                <option>{{$sp->special_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Contact No</label>
                            <input class="form-control" type="text" name="contact_no" placeholder="Mobile/Phone No">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Office Phone</label>
                            <input class="form-control" type="text" name="office_phone" placeholder="Office Phone">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Chamber/Room</label>
                            <select class="custom-select" id="room" name="doc_chember">
                                <option value="">Select Doctor Chamber</option>
                                @foreach($room as $r)
                                <option value="{{$r->room_name}}">{{$r->room_name}}
                                </option>
                                @endforeach

                            </select>
                            <!-- <input class="form-control" type="text" name="doc_chember" placeholder="Chamber/Room"> -->
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label>Floor</label>
                            <input class="form-control" type="text" placeholder="Floor" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Building</label>
                        <input class="form-control" type="text" placeholder="Building" >
                    </div> 
                </div>

                <!-- <div class="form-group">
                                <label class="display-block">Department Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_active" value="option1" checked>
									<label class="form-check-label" for="product_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_inactive" value="option2">
									<label class="form-check-label" for="product_inactive">
									Inactive
									</label>
								</div>
                            </div> -->
                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('doctormenu')}}" class="btn btn-success">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
// $(document).ready(function() {
//     $('.js-example-basic-multiple').select2();
// });
// $(document).ready(function() {
//     $("#RiskRatingTypes").select2({
//         multiple: true,
//         placeholder: "Select",
//         allowClear: true
//     });
// });

$(function() {
    $('.select2').select2({
        closeOnSelect: false
    });

    $("#imgOpenRegistration").click(function() {
        $('#imgReg').click();
    });

    $("#imgReg").change(function() {
        imageReaderURL(this);
    });
});


function imageReaderURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imgOpenRegistration').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
<!-- <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/js/app.js')}}"></script> -->



<!-- departments23:21-->