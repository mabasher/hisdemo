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

    <style>
    .main-body {
        padding: 15px;
    }

    .mousepointer {
        cursor: pointer;
    }

    body {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }

    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img img {
        width: 70%;
        height: 100%;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }
    </style>
</head>

<body>
    @include('frontpage.includes.navbar')

    <!-- <div class="container-fluid">
		<div class="main-body">
			<h3></h3>
			<h2 text-center>Comming Soon...</h2>
			<a href="{{url()->previous()}}" class="btn btn-xs btn-outline-info profile">Back</a>
		</div>
	</div> -->
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{asset('admin/img/fake.jpg')}}" alt="" />
                        <!-- <div class="file btn btn-lg btn-primary">
							Change Photo
							<input type="file" name="file" />
						</div> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h3>
                            <span class="text-success">{{$docProfile->doctor_name}}</span>

                        </h3>
                        <h4>
                            {{$docProfile->designation.', '.$docProfile->specialty}}
                        </h4>
                        <h6>
                            {{$docProfile->qualification}}
                        </h6>
                        <!-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                        <br>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Appointmnet Schedules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Overview</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-4 mt-3">


                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Personal Info</h5>
                            <hr>
                            <h6>BMDC/Reg No: <span class="text-primary">{{$docProfile->bmdc}}</span> </h6>
                            <h6 class="card-subtitle mb-2 text-muted">Phone:<span class="text-info">+ (880)
                                    1735-625924</span></h6>
                            <h6 class="card-text">Office:<span class="text-info">+ 88500-567</span></h6>
                            <h6>E-mail:<span class="text-info">ziniazara@gmail.com</span></h6>

                            <!-- <a href="#" class="card-link">Another link</a> -->
                        </div>
                        <div class="card-footer bg-transparent d-flex justify-content-between border-success">
                            <a href="{{url('doctorpatientapp/'.$docProfile->id)}}"
                                class="btn btn-sm btn-outline-success">Appointment</a> 
                            <a href="{{url()->previous()}}" class="btn btn-xs btn-outline-info profile">Back</a>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">

                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">

                                @foreach($day as $d)
                                <div class="col-6">
                                    @if($d->schudules->count()> 0)
                                    <div class="text-center bg-info rounded">
                                        <h4 class="text-white noofDay text-center" data-dId="{{$d->id}}">{{$d->name}}
                                        </h4>
                                    </div>
                                    <!-- <ul class="list-group list-group-flush"> -->
                                    @foreach($d->schudules as $ds)
                                    <h6 class="border rounded text-center ">{{$ds->doctorvisit->visit_name}} :
                                        {{ Carbon\Carbon::parse($ds->start_time)->format('h:i A').' - '.Carbon\Carbon::parse($ds->end_time)->format('h:i A')}}
                                    </h6>
                                    @endforeach
                                    <!-- </ul> -->
                                    @endif
                                </div>
                                @endforeach

                            </div>

                        </div>



                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="order-xl-2 order-lg-2 col-xl-12 col-lg-12 col-md-12 col-12">
                                <div class="team-detail-box-layout1">
                                    <div class="single-item">
                                        <h3 class="section-title title-bar-primary2">About Me:</h3>
                                        <p>Efficiently myocardinate market-driven innovation via open-source alignments.
                                            Dramatically engage high-Phosfluorescently expedite impactful supply chains
                                            via
                                            focused results. Holistically . Compellingly supply just in time catalysts
                                            for
                                            change through..</p>
                                    </div>
                                    <div class="single-item">
                                        <h3 class="section-title title-bar-primary2">Skills:</h3>
                                        <p> Proven and effective communication skills with patients, families, and other
                                            medical professionals. Leadership abilities to lead and manage practice
                                            staff in providing patients with quality care. -Highly organized, which
                                            allows me to keep appointments, records, and patient details in order. -Able
                                            to quickly and properly diagnose patient conditions in emergency situations
                                            to ensure they receive the treatment they need as soon as possible under
                                            controlled conditions. -Detailed oriented, which reduces mistakes made in
                                            patient treatment, diagnosis, and medication administration.</p>
                                    </div>
                                    <div class="single-item">
                                        <div class="table-responsive">
                                            <h3 class="section-title title-bar-primary2">Work Experience:</h3>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Year</th>
                                                        <th>Department</th>
                                                        <th>Position</th>
                                                        <th>Hospital</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>2007 - 2008</td>
                                                        <td>MBBS, M.D</td>
                                                        <td>Senior Prof.</td>
                                                        <td>Midtown Medical Clinic</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2010 - 2018</td>
                                                        <td>M.D. of Medicine</td>
                                                        <td>Associate Prof.</td>
                                                        <td>Netherland Medical College</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="single-item">
                                        <div class="table-responsive">
                                            <h3 class="section-title title-bar-primary2">Education:</h3>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Year</th>
                                                        <th>Degree</th>
                                                        <th>Institute</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>2006</td>
                                                        <td>MBBS, M.D</td>
                                                        <td>University of Wyoming</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2010</td>
                                                        <td>M.D. of Medicine</td>
                                                        <td>Netherland Medical College</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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

    </script>
</body>

</html>