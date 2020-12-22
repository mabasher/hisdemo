<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/imgcss.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">

                <!-- Custom Boostrap Validation -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-info">Patient Registration</h5>
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
                                <form class="needs-validation" method="POST" action="{{url('SaveRegistration')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card">
                                        <h5 class="card-header text-success">Patient Information</h5>
                                        <div class="card-body">


                                            <div class="form-row">
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender_male" value="M" checked>
                                                        <label class="form-check-label" for="gender_male">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender_female" value="F">
                                                        <label class="form-check-label"
                                                            for="gender_female">Female</label>
                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="gender_others" value="O">
                                                        <label class="form-check-label"
                                                            for="gender_female">Others</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <input type="text" class="form-control datepicker" name="dob" id="dob"
                                                        placeholder="DOB" value="{{old('dob')}}" required="">
                                                    <!-- <div class="valid-feedback">
																Looks good!
															</div> -->
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <input type="text" class="form-control" id="age"
                                                        placeholder="Age" disabled="">
                                                    <!-- <div class="invalid-feedback">
																Please provide a valid city.
															</div> -->
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-2">
                                                    <img id="imgOpenRegistration" src="{{asset('images/fake.jpg')}}">
                                                    <input type="file" id="imgReg" name="img_url" style="display: none;" src="" accept="image/x-png,image/gif,image/jpeg" >
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="validationCustom03">Title</label>
                                                    <select class="custom-select" name="salutation_Id" required="">
                                                        <option value="">Select Title</option>
                                                        @foreach($salutations as $title)
                                                        <option value="{{$title->id}}">{{$title->salutation_name}}</option>
                                                        @endforeach
                                                
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="validationCustom04">Patient Name</label>
                                                    <input type="text" name="ful_name"  value="{{old('ful_name')}}" class="form-control" id="validationCustom04"
                                                        placeholder="Enter Patient Name" required="">
                                                    <!-- <div class="invalid-feedback">
																Please provide a valid state.
															</div> -->
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationDefault01">NID</label>
                                                    <input type="text" name="national_id" class="form-control" id="validationDefault01"
                                                        placeholder="National ID" value="" required="">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationDefault02">Mobile No</label>
                                                    <input type="text" name="mobile" class="form-control" id="validationDefault02"
                                                        placeholder="Mobile No" value="" required="">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationDefaultUsername">Email</label>
                                                    <div class="input-group">
                                                        <input type="text" name="email" class="form-control"
                                                            id="validationDefaultUsername" placeholder="Email"
                                                            aria-describedby="inputGroupPrepend2">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom03">Religion</label>
                                                    <select class="custom-select" name="religion_no" required="">
                                                        <option value="">Select Religion</option>
                                                        @foreach($religions as $religion)
                                                        <option value="{{$religion->RELIGION_NO}}">{{$religion->RELIGION_NAME}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom03">Blood Group</label>
                                                    <select class="custom-select" name="blood_group">
                                                        <option value="">Select Blood Group</option>
                                                        @foreach($bloodGroups as $blg)
                                                            <option value="{{$blg->BG_CODE}}">{{$blg->BG_DESC}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom03">Marital Status</label>
                                                    <select class="custom-select" id="maritalStatus" name="marital_status">
                                                        <option value="">Select Marital Status</option>
                                                        <option value="Single">Single </option>
                                                        <option value="Married">Married </option>
                                                        <option value="Widowed">Widowed </option>
                                                        <option value="Separated">Separated </option>
                                                        <option value="Divorced">Divorced  </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationServerUsername">Spouse Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="spouseName" name="spouse_name"
                                                            placeholder="Spouse Name" value="">
                                                        <!-- <div class="invalid-feedback">
																		Please choose a username.
																	</div> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationServerUsername">Father Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="father_name" id="validationDefault02"
                                                            placeholder="Father Name" value="">
                                                        <!-- <div class="invalid-feedback">
																		Please choose a username.
																	</div> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationServerUsername">Mother Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="mother_name" id="validationDefault02"
                                                            placeholder="Mother Name" value="">
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
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Address Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h4 class="card-title">Present Address    
                                                            </h4>
                                                            <div class="form-group">
                                                                <label>Address:</label>
                                                                <textarea rows="2" cols="2" class="form-control"
                                                                    placeholder="Enter Address" name="pre_address"></textarea>   
                                                            </div>
                                                            
                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationCustom03">City</label>
                                                                    <select class="custom-select" name="pre_district">
                                                                        <option value="">Select City</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label
                                                                        for="validationCustom03">State/Province</label>
                                                                    <select class="custom-select" name="pre_division">
                                                                        <option value="">Select State/Province</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationCustom03">Country</label>
                                                                    <select class="custom-select" name="pre_country">
                                                                        <option value="">Select Country</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Zip/Postal code</label>
                                                                        <input type="text" name="pre_postoffice" class="form-control" placeholder="Zip/Postal Code">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 border-left">
                                                            <h4 class="card-title">Permanent Address</h4>
                                                            <span>
                                                                <div class="form-check form-check-inline float-right text-success">
                                                                <input type="checkbox" class="form-check-input" id="perAddr" name="perAddr"  value="1">
                                                                <label class="form-check-label" for="exampleCheck1">Same as Present Address</label>
                                                                </div>
                                                                </span>
                                                            
                                                            <div class="form-group">
                                                                <label>Address:</label>
                                                                <textarea rows="2" cols="2" class="form-control"
                                                                    placeholder="Enter Address" id="perAddress" name="per_address"></textarea>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationCustom03">City</label>
                                                                    <select class="custom-select" name="per_district">
                                                                        <option value="">Select City</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label
                                                                        for="validationCustom03">State/Province</label>
                                                                    <select class="custom-select" name="per_division">
                                                                        <option value="">Select State/Province</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="validationCustom03">Country</label>
                                                                    <select class="custom-select" name="per_country">
                                                                        <option value="">Select City</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Zip/Postal code</label>
                                                                        <input type="text" name="per_postoffice" class="form-control" placeholder="Zip/Postal Code">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                                                        <input type="text" name="em_contact_no" class="form-control" placeholder="Contact No">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Contact Name</label>
                                                                        <input type="text" name="em_contact_person" class="form-control" placeholder="Contact Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Contact Relation</label>
                                                                        <input type="text" name="em_relation" class="form-control" placeholder="Contact Relation"> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <div class="form-group">
                                                                        <label>Contact Address</label>
                                                                        <input type="text" name="em_address" class="form-control" placeholder="Contact Address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(function() {
            $('#spouseName').attr('disabled','disabled');

			$( "#imgOpenRegistration" ).click(function() {
				$('#imgReg').click();
	    	});
			
			$( "#imgReg" ).change(function() {
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
                inline: true
            
            }).on('changeDate', function (ev) {

                var birthDay = $('#dob').val();
                var DOB = new Date(birthDay);
                var today = new Date();
                var age = today.getTime() - DOB.getTime();
                var elapsed = new Date(age);
                var year = elapsed.getYear()-70;
                var month = elapsed.getMonth();
                var day = elapsed.getDay();
                if(year=='0'){year = '';}else{year += " Y ";}
                if(month=='0'){month = '';}else{month += " M ";}
                if(day=='0'){day = '';}else{day +=" D";}
                var ageTotal = year + month + day;

                $('#age').val(ageTotal);
            }); 
		});
		
		function imageReaderURL(input){
			if (input.files && input.files[0]){ 
					var reader = new FileReader();
					reader.onload = function(e){ 
					$('#imgOpenRegistration').attr('src', e.target.result);									 
					} 
				reader.readAsDataURL(input.files[0]); 
			} 
		}


        $('#maritalStatus').change(function(){
			var mStatus =$('#maritalStatus').val();
			if (mStatus == 'Married'){
				$('#spouseName').removeAttr('disabled');
				
			}else{
				//$('#dob').removeAttr('disabled');
				$('#spouseName').attr('disabled','disabled');
			}
		}); 

        $('#perAddr').click(function() {
        if ($(this).is(':checked')) {
            $('#perAddress').attr('disabled','disabled');
        }else{
            $('#perAddress').removeAttr('disabled');
        }
        });

    </script>
</body>

</html>