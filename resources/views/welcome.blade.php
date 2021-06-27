<!DOCTYPE html>
<html lang="en">

<head>
    <title>DTL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('template/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('template/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('template/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/jquery.timepicker.css')}}">

    <link rel="stylesheet" href="{{asset('template/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}">
</head>

<body>
    @include('frontpage.includes.navbar')
    <!-- END nav -->
    <div class="hero-wrap">
        <div class="home-slider owl-carousel">
            <div class="slider-item" style="background-image:url(template/images/bg_1.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-end">
                        <div class="col-md-6 ftco-animate">
                            <div class="text w-100">
                                <h3 class="mb-4  ">Welcome to Darco Technologies</h3>
                                <p class="text-success">DARCO TECHNOLOGIES LIMITED has ventured into ICT sector to build
                                    a strong reputation, as an IT Solution Provider to our patrons, promoters and
                                    clients through consultation, development and integration of technology. </p>
                                <p><a href="{{url('appointmentCardduplicate')}}" class="btn btn-primary">Appointment
                                        Card</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item" style="background-image:url(template/images/bg_2.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-end">
                        <div class="col-md-6 ftco-animate">
                            <div class="text w-100">
                                <h3 class="mb-4 text-white">Darco care for the whole family</h3>
                                <p class="text-warning">DARCO TECHNOLOGIES LIMITED has ventured into ICT sector to build
                                    a strong reputation, as an IT Solution Provider to our patrons, promoters and
                                    clients through consultation, development and integration of technology. </p>
                                <p><a href="{{url('appointmentCardduplicate')}}" class="btn btn-primary">Appointment
                                        Card</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item" style="background-image:url(template/images/bg_3.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-end">
                        <div class="col-md-6 ftco-animate">
                            <div class="text w-100">
                                <h3 class="mb-4">We are here for Your care</h3>
                                <p class="text-primary">DARCO TECHNOLOGIES LIMITED has ventured into ICT sector to build
                                    a strong reputation, as an IT Solution Provider to our patrons, promoters and
                                    clients through consultation, development and integration of technology. </p>
                                <p><a href="{{url('appointmentCardduplicate')}}" class="btn btn-primary">Appointment
                                        Card</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb">
        <div class="overlay"></div>
        <div class="container">
            <div class="row d-md-flex justify-content-center">
                <div class="col-md-7">
                    <div class="wrap-appointment d-md-flex">
                        <div class="col-md-12 bg-primary p-5 heading-section heading-section-white">
                            <!-- <span class="subheading">Booking an Appointment</span> -->
                            <h2 class="mb-4">Booking an Appointment</h2>
                            <form action="{{url('patientAdd')}}" method="post" class="appointment">
                                @csrf
                                <div class="row justify-content-center">
                                    <!-- <div class="col-md-3">
                                        <select class="custom-select" id="salutationId" name="salutation_Id">
                                            <option value="">Select Title</option>
                                            @foreach($salutations as $title)
                                            <option value="{{$title->salutation_name}}">{{$title->salutation_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Your Name"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="mobile" class="form-control"
                                                placeholder="Mobile No" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-wrap text-dark">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" checked value="M"
                                                            name="gender">Male
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="F"
                                                            name="gender">Female
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" value="O"
                                                            name="gender">Others
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-wrap">
                                                <input type="text" class="form-control datepicker dtob" name="dob" id="dtob"
                                                    placeholder="dd/mm/yyyy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-wrap">
                                                <input type="text" name="age" class="form-control" id="patAge"
                                                    placeholder="Age">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-field">
                                                <div class="select-wrap">
                                                    <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                    <select id="docSpecialty" class="form-control">
                                                        <option value="">Select Speciality</option>
                                                        @foreach($specialty as $sp)
                                                        <option value="{{$sp->dept_no}}">{{$sp->dept_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-field">
                                                <div class="select-wrap">
                                                    <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                    <select name="doctor" id="careGiver" class="form-control" required>
                                                        <option value="">Select Care Giver</option>
                                                        @foreach($doctors as $doc)
                                                        <option value="{{$doc->id}}">{{$doc->doctor_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <input id="nextStep"  type="button" value="Next Step .." class="btn btn-secondary py-3 px-4"> -->
                                            <input id="nextStep" type="submit" value="Next Page .."
                                                class="btn btn-secondary py-3 px-4">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="col-md-5 bg-white text-center p-5">
							<div class="desc border-bottom pb-4">
								<h2>Business Hours</h2>
								<div class="opening-hours">
									<h4>Opening Days:</h4>
									<p class="pl-3">
										<span><strong>Saturday – Thursday:</strong> 9am to 20 pm</span>
										<span><strong>Monday :</strong> 9am to 17 pm</span>
									</p>
									<h4>Vacations:</h4>
									<p class="pl-3">
										<span>All Friday Days</span>
										<span>All Official Holidays</span>
									</p>
								</div>
							</div>
							<div class="desc pt-4 ">
								<h3 class="heading">For Emergency Cases</h3>
								<span class="phone">(+880) 9617-171125</span>
							</div>
						</div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="appointModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <br>

    @include('frontpage.includes.footer')
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="{{asset('template/js/jquery.min.js')}}"></script>
    <script src="{{asset('template/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('template/js/popper.min.js')}}"></script>
    <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('template/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('template/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('template/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('template/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('template/js/scrollax.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{asset('template/js/google-map.js')}}"></script>
    <script src="{{asset('template/js/main.js')}}"></script>

    <script>
    $('.dtob').on('change', function() {
        var dob = $(this).val();
        date = dob.split("/").reverse().join("-");
        $('#patAge').val(ageCalculator(date));

    })

    var maxBirthdayDate = new Date();
    $('.dtob').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true,
        changeMonth: true,
        changeYear: true,
        endDate: maxBirthdayDate,
        inline: true
    })

    $('#docSpecialty').on('change', function() {
        var spDoctor = $(this).val();
        getDoctorSpeciltyWise(spDoctor);
    })

    function getDoctorSpeciltyWise(deptNo) {
        $.ajax({
            url: "{{url('onlineSpWiseDoctor')}}/" + deptNo,
            type: 'get',
            success: function(data) {
                $('#careGiver').html(data);
            }
        })
    }

    // $('#modalBtn').on('click', function() {
    // 	$('#appointModal').modal('show');
    // })
    </script>
</body>

</html>