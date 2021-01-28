@extends('layouts.app')
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="{{asset('admin/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-datetimepicker.min.css')}}"> -->
<link rel="stylesheet" href="{{asset('css/select2ud.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Doctor Information</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{url('doctorAdd')}}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i>
                Add
                Doctor</a>
        </div>
    </div>
    <!-- <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">Doctor Name</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <label class="focus-label">Specialty</label>
                <select class="select floating">
                    <option>Select Specialty</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <label class="focus-label">Designation</label>
                <select class="select floating">
                    <option>Select Designation</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <label class="focus-label">Gender</label>
                <select class="select floating">
                    <option value="">Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Others</option>
                </select>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th style="min-width:200px;">Doctor Name</th>
                            <th>Doctor No</th>
                            <th>Designation</th>
                            <th>Contact No</th>
                            <th style="min-width: 110px;">Email</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctorMenu as $doc)
                        <tr>
                            <td>
                                <img width="28" height="28" src="{{$doc->doctor_image}}" class="rounded-circle" alt="">
                                <h2>{{$doc->doctor_name}}</h2>
                            </td>
                            <td>{{$doc->doctor_no}}</td>
                            <td>{{$doc->designation}}</td>
                            <td>{{$doc->contact_no}}</td>
                            <td>{{$doc->email}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item editDoctor" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                            data-target="#edit_doctor" href="" data-id="{{ $doc->id }}"
                                            data-doctorName="{{$doc->doctor_name}}" data-desig="{{$doc->jobcode_id}}"
                                            data-gender="{{$doc->gender}}" data-special="{{$doc->specialization_id}}"
                                            data-dept="{{$doc->dept_no}}" data-qualification="{{$doc->qualification}}" 
                                            data-clinicalInterest="{{$doc->special_interest}}" data-contactNo="{{$doc->contact_no}}"
                                            data-officePhone="{{$doc->office_phone}}" data-email="{{$doc->email}}"
                                            data-chamber="{{$doc->doc_chember}}" data-docType="{{$doc->doctor_type}}"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- {{url('doctorEdit/'.$doc->id)}} -->
    <!-- <div id="edit_doctor" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						    
					</div>
				</div>
			</div>
		</div> -->
    <div class="modal fade" id="edit_doctor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-success" id="exampleModalCenterTitle" class="doctorName">Edit of <span id="docName"></span> </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="col-lg-10 m-auto">
                        <form autocomplete="off" method="POST" action="{{url('updateDoctor')}}">
                            @csrf
                            <input type="hidden" name="id" id="docId">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input gender" type="radio" name="gender"
                                                id="gender_male" value="M" checked>
                                            <label class="form-check-label" for="gender_male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input gender" type="radio" name="gender"
                                                id="gender_female" value="F">
                                            <label class="form-check-label" for="gender_female">Female</label>
                                        </div>
                                    </label>
                                    <select class="custom-select" id="jobId" name="jobcode_id">
                                        <option value="">Select designation</option>
                                        @foreach($designation as $desig)
                                        <option value="{{$desig->id}}">{{$desig->job_desc}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Doctor Name</label>
                                        <input class="form-control" type="text" id="doctorName" class="doctorName" name="doctor_name"
                                            placeholder="Doctor Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">

                                        <label for="">Specialty</label>
                                        <select class="custom-select" id="special" name="specialization_id">
                                            <option value="">Select Specialty</option>
                                            @foreach($specialty as $sp)
                                            <option value="{{$sp->id}}">{{$sp->special_name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select class="custom-select" id="dept" name="dept_no">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $d)
                                            <option value="{{$d->dept_no}}">{{$d->dept_name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <select class="form-control select2 select2-hidden-accessible"
                                            id="qualification" name="qualification[]" multiple=""
                                            data-placeholder="Select Qualification" style="width: 100%;" tabindex="-1"
                                            aria-hidden="true">
                                            @foreach($qualification as $q)
                                                <option value="{{trim(strtolower($q->short_special))}}">{{$q->short_special}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Clinical Interest</label>
                                        <select class="form-control select2 select2-hidden-accessible"
                                            id="clinicalInterest" name="special_interest[]" multiple=""
                                            data-placeholder="Select Clinical Interest" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true">
                                            @foreach($specialty as $sp)
                                            <option value="{{trim(strtolower($sp->special_name))}}">{{$sp->special_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Contact No</label>
                                        <input class="form-control" type="text" id="contactNo" name="contact_no"
                                            placeholder="Mobile/Phone No">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Office Phone</label>
                                        <input class="form-control" type="text" id="officePhone" name="office_phone"
                                            placeholder="Office Phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label>Email</label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label>Chamber/Room</label>
                                        <select class="custom-select" id="chamber" name="doc_chember">
                                            <option value="">Select Doctor Chamber</option>
                                            @foreach($room as $r)
                                            <option value="{{$r->room_name}}">{{$r->room_name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Doctor Type</label>
                                    <select class="custom-select js-example-basic-single" id="doctorType"
                                        name="doctor_type">
                                        <option value="">Select Doctor Type</option>
                                        <option value="I">Internal</option>
                                        <option value="E">External</option>

                                    </select>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <div id="delete_doctor" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <!-- <img src="assets/img/sent.png" alt="" width="50" height="46"> -->
                    <h3>Are you sure want to delete this Patient?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
$(function() {
    $('.select2').select2({
        closeOnSelect: false
        
    });
    
    $('.editDoctor').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#docId').val(id);
        var name = $(this).attr('data-doctorName');
        $('#doctorName').val(name);
        $('#docName').html(name);
        var jobId = $(this).attr('data-desig');
        $('#jobId').val(jobId);
        var gender = $(this).attr('data-gender');
        $('.gender').val(gender);
        var special = $(this).attr('data-special');
        $('#special').val(special);
        var dept = $(this).attr('data-dept');
        $('#dept').val(dept);
        var qualification = $(this).attr('data-qualification');
        qualification = qualification.toLocaleString().toLowerCase().split(',');
	    // var stringArray = qualification.split(',');
		$('#qualification').val(qualification).change();
         //alert(typeof stringArray);
        var clinicalInterest = $(this).attr('data-clinicalInterest');
        clinicalInterest = clinicalInterest.toLocaleString().toLowerCase().split(',');
	    // var stringArray = qualification.split(',');
		$('#clinicalInterest').val(clinicalInterest).change();
         //alert(typeof stringArray);
        var contactNo = $(this).attr('data-contactNo');
        $('#contactNo').val(contactNo);
        var officePhone = $(this).attr('data-officePhone');
        $('#officePhone').val(officePhone);
        var email = $(this).attr('data-email');
        $('#email').val(email);
        var chamber = $(this).attr('data-chamber');
        $('#chamber').val(chamber);
        var doctorType = $(this).attr('data-docType');
        $('#doctorType').val(doctorType);   
    })

    
		
});
</script>
@endsection