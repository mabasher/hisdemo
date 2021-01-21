    @extends('layouts.app')
    @section('css')

    <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
    <link rel="stylesheet" href="{{asset('css/imgcss.css')}}">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
    @endsection
    @section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- Custom Boostrap Validation -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-info text-center">Patient Registration</h5>
                        <p class="card-text"><a href="javascript:void(0)" target="_blank"></a></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form class="needs-validation" autocomplete="off" method="POST"
                                    action="{{url('SaveRegistration')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card col-xl-11 m-auto">
                                        <h5 class="card-header text-success">Patient Information</h5>
                                        <div class="card-body">


                                            <div class="form-row">
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input gender" type="radio"
                                                            name="gender" id="gender_male" value="M" checked>
                                                        <label class="form-check-label" for="gender_male">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input gender" type="radio"
                                                            name="gender" id="gender_female" value="F">
                                                        <label class="form-check-label"
                                                            for="gender_female">Female</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input gender" type="radio"
                                                            name="gender" id="gender_others" value="O">
                                                        <label class="form-check-label"
                                                            for="gender_female">Others</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <input type="text" class="form-control datepicker" name="dob"
                                                        id="dob" placeholder="DOB" value="{{old('dob')}}" required="">

                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <input type="text" class="form-control" id="age" placeholder="Age"
                                                        disabled="">

                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-2">
                                                    <img id="imgOpenRegistration" src="{{asset('images/fake.jpg')}}">
                                                    <input type="file" id="imgReg" name="img_url" style="display: none;"
                                                        src="" accept="image/x-png,image/gif,image/jpeg">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-2 mb-3">
                                                    <label for="validationCustom03">Title</label>
                                                    <select class="custom-select" id="salutationId"
                                                        name="salutation_Id">
                                                        <!-- <option value="">Select Title</option> -->
                                                        @foreach($salutations as $title)
                                                        <option value="{{$title->salutation_name}}">{{$title->salutation_name}}
                                                        </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="validationCustom04">Patient Name</label>
                                                    <input type="text" name="ful_name" value="{{old('ful_name')}}"
                                                        class="form-control" id="validationCustom04"
                                                        placeholder="Enter Patient Name" required="">
                                                    <!-- <div class="invalid-feedback">
																Please provide a valid state.
															</div> -->
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationDefault01">NID</label>
                                                    <input type="text" name="national_id" class="form-control"
                                                        id="validationDefault01" placeholder="National ID" value="">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationDefault02">Mobile No</label>
                                                    <input type="text" name="mobile" class="form-control"
                                                        id="validationDefault02" placeholder="Mobile No" value=""
                                                        required="">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationDefalt02">Phone No</label>
                                                    <input type="text" name="home_phone" class="form-control" id=""
                                                        placeholder="Phone No" value="">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="">Email</label>
                                                    <div class="input-group">
                                                        <input type=" " name="email" class="form-control" id=""
                                                            placeholder="Email" aria-describedby="inputGroupPrepend2">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom03">Religion</label>
                                                    <select class="custom-select" name="religion_no">
                                                        <option value="">Select Religion</option>
                                                        @foreach($religions as $religion)
                                                        <option value="{{$religion->RELIGION_NO}}">
                                                            {{$religion->RELIGION_NAME}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom03">Blood Group</label>
                                                    <select class="custom-select" name="blood_group">
                                                        <option value="">Select Blood Group</option>
                                                        @foreach($bloodGroups as $blg)
                                                        <option value="{{$blg->BG_CODE}}">{{$blg->BG_CODE}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group">
                                                        <label>Emergency Contact No</label>
                                                        <input type="text" name="em_contact_no" class="form-control"
                                                            placeholder="Contact No" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group">
                                                        <label>Emergency Contact Name</label>
                                                        <input type="text" name="em_contact_person" class="form-control"
                                                            placeholder="Contact Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group">
                                                        <label>Emergency Contact Relation</label>
                                                        <input type="text" name="em_relation" class="form-control"
                                                            placeholder="Contact Relation">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group">
                                                        <label>Emergency Contact Address</label>
                                                        <input type="text" name="em_address" class="form-control"
                                                            placeholder="Contact Address">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationCustom03">Marital Status</label>
                                                    <select class="custom-select" id="maritalStatus"
                                                        name="marital_status">
                                                        <option value="">Select Marital Status</option>
                                                        <option value="Single">Single </option>
                                                        <option value="Married">Married </option>
                                                        <option value="Widowed">Widowed </option>
                                                        <option value="Separated">Separated </option>
                                                        <option value="Divorced">Divorced </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationServerUsername">Spouse Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="spouseName"
                                                            name="spouse_name" placeholder="Spouse Name" value="">
                                                        <!-- <div class="invalid-feedback">
																		Please choose a username.
																	</div> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationServerUsername">Father Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="father_name"
                                                            id="validationDefault02" placeholder="Father Name" value="">
                                                        <!-- <div class="invalid-feedback">
																		Please choose a username.
																	</div> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationServerUsername">Mother Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="mother_name"
                                                            id="validationDefault02" placeholder="Mother Name" value="">
                                                        <!-- <div class="invalid-feedback">
																		Please choose a username.
																	</div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card col-xl-11 m-auto">
                                                <div class="card-header">
                                                    <h4 class="card-title text-success">Address Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Present Address
                                                            </h4>
                                                            <div class="form-group">
                                                                <label>Address:</label>
                                                                <textarea rows="2" cols="2" class="form-control"
                                                                    placeholder="Enter Address" id="preAddress"
                                                                    name="pre_address"></textarea>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationCustom03">Country</label>
                                                                    <select class="custom-select" name="pre_country">
                                                                        <option value="12">Bangladesh</option>
                                                                        <!-- <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option> -->
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="">Divition/Province</label>
                                                                    <select class="custom-select division"
                                                                        id="preDivision" name="pre_division">
                                                                        <!-- <option value="">Select Divition/Province</option> -->
                                                                        @foreach($divisions as $dv)
                                                                        <option value="{{$dv->DIVISION_CODE}}">
                                                                            {{$dv->DIVISION_NAME}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationCustom03">City</label>
                                                                    <select class="custom-select city" id="preCity"
                                                                        name="pre_district">
                                                                        <option value="">Select City</option>
                                                                        <!-- @foreach($districts as $city)
                                                                            <option value="{{$city->DISTRICT_CODE}}">{{$city->DISTRICT_NAME}}</option>
                                                                        @endforeach -->
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Zip/Postal code</label>
                                                                        <input type="text" id="prePoCode"
                                                                            name="pre_postoffice" class="form-control"
                                                                            placeholder="Zip/Postal Code">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 border-left">
                                                            <h4 class="card-title">Permanent Address</h4>
                                                            <span>
                                                                <div
                                                                    class="form-check form-check-inline float-right text-success">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="perAddr" name="perAddr" value="1">
                                                                    <label class="form-check-label"
                                                                        for="exampleCheck1">Same as Present
                                                                        Address</label>
                                                                </div>
                                                            </span>

                                                            <div class="form-group">
                                                                <label>Address:</label>
                                                                <textarea rows="2" cols="2"
                                                                    class="form-control disableEnable"
                                                                    placeholder="Enter Address" id="perAddress"
                                                                    name="per_address"></textarea>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationCustom03">Country</label>
                                                                    <select class="custom-select disableEnable"
                                                                        name="per_country">
                                                                        <option value="12">Bangladesh</option>
                                                                        <!-- <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option> -->
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="">Divition/Province</label>
                                                                    <select class="custom-select division disableEnable"
                                                                        id="perDivision" name="per_division">
                                                                        <!-- <option value="">Select Divition/Province</option> -->
                                                                        @foreach($divisions as $dv)
                                                                        <option value="{{$dv->DIVISION_CODE}}">
                                                                            {{$dv->DIVISION_NAME}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="">City</label>
                                                                    <select class="custom-select city disableEnable"
                                                                        id="perCity" name="per_district">
                                                                        <option value="">Select City</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Zip/Postal code</label>
                                                                        <input type="text" id="perPoCode"
                                                                            name="per_postoffice"
                                                                            class="form-control disableEnable"
                                                                            placeholder="Zip/Postal Code">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Emergency Contact</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-3 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Contact No</label>
                                                                        <input type="text" name="em_contact_no"
                                                                            class="form-control"
                                                                            placeholder="Contact No">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Contact Name</label>
                                                                        <input type="text" name="em_contact_person"
                                                                            class="form-control"
                                                                            placeholder="Contact Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Contact Relation</label>
                                                                        <input type="text" name="em_relation"
                                                                            class="form-control"
                                                                            placeholder="Contact Relation">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Contact Address</label>
                                                                        <input type="text" name="em_address"
                                                                            class="form-control"
                                                                            placeholder="Contact Address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col text-center mt-2">
                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Custom Boostrap Validation -->
                </div>
            </div>
        </div>
    </div>


    @endsection
    @section('js')
    <!-- <script src="{{asset('js/app.js')}}"></script> -->
    <!-- <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script> -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

    <script>





$('#perDivision').on('change', function() {
    var diviCode = $(this).val();
    //getPerCity(diviCode);
    getCity(diviCode, 'perCity');

});

$('#preDivision').on('change', function() {
    var diviCode = $(this).val();
    //getPerCity(diviCode);
    getCity(diviCode, 'preCity');

});



$(function() {

    var preCode = $('#preDivision :selected').val();
    var percode = $('#perDivision :selected').val();
    getCity(preCode, 'preCity');
    getCity(percode, 'perCity');

    $('#spouseName').attr('disabled', 'disabled');

    $("#imgOpenRegistration").click(function() {
        $('#imgReg').click();
    });

    $("#imgReg").change(function() {
        imageReaderURL(this);
    });


    var maxBirthdayDate = new Date();
    // maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 10 );
    console.log(maxBirthdayDate);
    /* $('#dob').datepicker().on('changeDate', function (ev) {
        alert('dob');
    }); */
    $('#dob').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        endDate: maxBirthdayDate,
        inline: true,
        zIndexOffset: 10000

    }).on('changeDate', function(ev) {
        $('#age').val(ageCalculator($(this).val()));
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


$('#maritalStatus').change(function() {
    var mStatus = $('#maritalStatus').val();
    if (mStatus == 'Married') {
        $('#spouseName').removeAttr('disabled');

    } else {
        //$('#dob').removeAttr('disabled');
        $('#spouseName').attr('disabled', 'disabled');
    }
});


$('#perAddr').on('change', function() {
    if (this.checked) {

        var perAddress = $('#preAddress').val();
        var perDivision = $('#preDivision').val();
        var perCity = $('#preCity').val();
        var perPoCode = $('#prePoCode').val();
        $('#perAddress').val(perAddress);
        $('#perDivision').val(perDivision);
        getCity(perDivision, 'perCity');
        setTimeout(() => {
            $('#perCity').val(perCity);
        }, 300);
        $('#perPoCode').val(perPoCode);
        // $('#perPoCode').attr('disabled', 'disabled');
        $('.disableEnable').attr('disabled', 'disabled');
    } else {
        $('.disableEnable').removeAttr('disabled');
    }
    //    this.value = this.checked ? 1 : 0;

}).change();


function getCity(diviCode, distId) {
    $.ajax({
        url: "{{url('perDivision')}}/" + diviCode,
        type: 'get',
        success: function(data) {
            //console.log(data);
            $('#' + distId).html(data);
        }
    })
}


$('.gender').change(function() {
    var gen_val = $('input[name="gender"]:checked').val();
    if (gen_val == 'M') {
        $('#salutationId [value=Mr. ]').attr('selected', 'true');
        $('#salutationId [value=Mrs. ]').removeAttr('selected');
        //$('#salutationId').combobox('setValues',  '1');
    } else if (gen_val == 'F') {

        $('#salutationId [value=Mrs. ]').attr('selected', 'true');
        $('#salutationId [value=Mr. ]').removeAttr('selected');
        //$('#salutationId').combobox('setValues',  '2');
    } else {
        //$('#salutationId').combobox('Value',  'Child');
    }
});

   </script>
    @endsection