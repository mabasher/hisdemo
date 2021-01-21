@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<style>

</style>
@endsection

@section('content')
<div class="content">
    <div class="row">
        <aside class="col-md-10 m-auto">
            <div class="widget category-widget">
                <div class="row text-success">
                    <div class="col-md-3">
                        <h4>PID : {{$patientPrescrip->reg_no}}</h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Name : {{$patientPrescrip->salutation_id.' '.$patientPrescrip->ful_name}}</h4>
                    </div>
                    <div class="col-md-3" >
                        <h4>Age : <span id="age"></span></h4>
                    </div>
                    <div class="col-md-2" >
                        <h4>Gender : {{$patientPrescrip->gender == 'M'?'Male':Female}}</h4>
                    </div>
                </div>
                <div class="row text-success">
                    <div class="col-md-3">
                        <h4>Mobile : {{$patientPrescrip->mobile}}</h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Appoint Type : @switch($patientPrescrip->app_type)
                            @case('P')
                            Primary Consultation
                            @break

                            @case('F')
                            Followup Consultation
                            @break
                            @case('V')
                            For Visit
                            @break
                            @case('C')
                            Patient Counseling
                            @break
                            @default
                            
                            @endswitch
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Doctor : {{$patientPrescrip->appdoctor->doctor_name}}</h4>
                    </div>
                    <div class="col-md-1">
                        <a href="{{url('patientCare')}}" class="btn btn-success">Back</a>
                    </div>
                </div>
                
            </div>
        </aside>
        <div class="col-md-10 m-auto">
            <div class="card-box">
                <!-- <h6 class="card-title">Bottom line justified</h6> -->
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1" data-toggle="tab">Medication</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2" data-toggle="tab">Investigation</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab3" data-toggle="tab">Messages</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="bottom-justified-tab1">
                        <div class="card">
                            <div class="card-body">
                                <form autocomplete="off" method="POST" action="{{url('SaveDoctor')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Therapeutic Group</label>
                                                <input type="text" class="form-control" name="contact_no" placeholder="Therapeutic Group">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label>Generic Name</label>
                                                <input type="text" class="form-control" name="contact_no" placeholder="Generic Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>Brand Name</label>
                                            <input type="text" class="form-control" name="contact_no" placeholder="Brand Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label>Dis. Form</label>
                                                <input type="text" placeholder="Dispense Form" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="text" placeholder="Stock" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Dose/Take</label>
                                            <input type="text" placeholder="Dose/Take" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Frequency</label>
                                            <select class="custom-select" name="frequency">
                                                <option value="">Frequency</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Duration</label>
                                            <input type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Type</label>
                                            <select class="custom-select" name="frequency">
                                                <option value="">Hour's</option>
                                                <option value="">Days</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label>DPT. Details</label>
                                                <input type="text" placeholder="DPT. Details" class="form-control">
                                            </div>
                                        </div>



                                        <div class="col-md-2 mb-3">
                                            <div class="form-group">
                                                <label>Route</label>
                                                <select class="custom-select" name="frequency">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Instruction</label>
                                            <select class="custom-select" name="frequency">
                                                <option value="">Instruction</option>
                                                <option value="">hs</option>
                                                <option value="">ad</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Start At</label>
                                            <input type="text" placeholder="Start At" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Priority</label>
                                            <select class="custom-select" name="frequency">
                                                <option value=""></option>
                                                <option value="">Routine</option>
                                                <option value="">Urgent</option>
                                                <option value="">Stat</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label>Prescribed Qty</label>
                                            <input type="text" placeholder="Prescribed Qty" class="form-control">
                                        </div>
                                    </div>

                                    <!-- <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{url('doctormenu')}}" class="btn btn-success">Back</a>
                        </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bottom-justified-tab2">
                        <div class="col-md-8 m-auto">
                            <div class="form-row text-info mb-3">
                                <div class="col-md-5">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="service_type" id="pathology" value="P" checked>
                                        <h4 class="form-check-label" for="gender_male">Pathology & Diagnostics</h4>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="service_type" id="service" value="S">
                                        <h4 class="form-check-label"
                                            for="gender_female">Services</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="service_type" id="radiology" value="R">
                                        <h4 class="form-check-label"
                                            for="gender_female">Radiology & Imaging</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 m-auto">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Investigation</label>
                                        <select class="custom-select" name="investigation">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label>Service Type</label>
                                        <input type="text" class="form-control" name="contact_no" placeholder="Service Type">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Status</label>
                                    <select class="custom-select" name="frequency">
                                        <option value=""></option>
                                        <option value="">Routine</option>
                                        <option value="">Urgent</option>
                                        <option value="">Stat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label>Lab Instruction</label>
                                    <textarea rows="2" cols="2"
                                        class="form-control disableEnable"
                                        placeholder="Lab Instruction" id="labInstrc"
                                        name="per_address"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Additional Instruction</label>
                                    <textarea rows="2" cols="2"
                                        class="form-control disableEnable"
                                        placeholder="Additional Instruction" id="additInstrc"
                                        name="per_address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script>
    $(function() {
       var dob ='{{$patientPrescrip->dob}}';
        var age = ageCalculator(dob);
        $('#age').html(age);
    });

    function getPatient(regno) {
        $.ajax({
            url: "{{url('prescriptions')}}/" + regno,
            type: 'get',
            success: function(data) {
                $('#salutationId').val(data.salutation_id);
                $('#fulName').val(data.ful_name);
                // $('#dob').val(data.dob);
                // $("input[name=gender][value='" + data.gender + "']").prop("checked", true);
                // $('#mobile').val(data.mobile);
                // $('#email').val(data.email);
                // $('#emContactNo').val(data.em_contact_no);
                // $('#emContactPerson').val(data.em_contact_person);
                // $('#nid').val(data.national_id);
                // $('#religion').val(data.religion_no);
                // $('#preAddress').val(data.pre_address);
                // $('#preDivision').val(data.pre_division);
                // getCity(data.pre_division, 'city');
                // setTimeout(() => {
                //     $('#city').val(data.pre_district);
                // }, 300);
                // $('#postalCode').val(data.pre_postoffice);

                console.log(data);

            }
        })
    }
</script>
@endsection