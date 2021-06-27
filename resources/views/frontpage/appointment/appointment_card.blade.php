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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <style>
        @page {
        margin: 10 auto;
    }
	body { margin: 0px; }
    
        .img {
        margin-top: 15px;
    }

    .imgsize {
        width: 50px;
    }
    </style>
</head>

<body>
    @include('frontpage.includes.navbar')
    
    <div class="container">
        <div class="main-body">
            <div class="col-md-5 m-auto">
                <div class="card border-primary  m-3">
                    <h4 class="card-header text-center bg-primary text-white">Darco Technologies Limited.</h4>
                    <h5 class="card-header text-center text-primary">Appointment Card</h5>

                    <div class="card-body text-center">
                        <h5 class="card-title">Patient Name: <span class="text-success">{{$appointCard->ful_name}}</span></h5>
                        <h6 class="card-title">PID: <span class="text-success">{{$appointCard->reg_no}}</span></h6>
                        <h6 class="card-title">Appoint No: <span class="text-success">{{$appointCard->appoint_no}}</span></h6>
                        <h6 class="card-title">Date & Time: <span class="text-success">{{\Carbon\Carbon::parse($appointCard->app_date)->format('d-m-Y')}} </span>{{\Carbon\Carbon::parse($appointCard->start_time)->format('h:i A')}}</h6>
                        <p class="card-text">Care Giver: <span class="text-info">{{$appointCard->appdoctor->doctor_name.', '.$appointCard->appdoctor->designation}}</span></p>
                        <p class="card-text">Chember: &nbsp; <span class="text-info">{{$appointCard->appdoctor->doc_chember.', '.'2nd Floor, Main Building'}}</span></p>
                    </div>
                    <div class="text-center mb-2">                      
                       {!!\QrCode::size(80)->generate(str_replace("<br>", "\r\n", $QrGenerate))!!}
                    </div>
                </div>
                <div class="text-center mb-3">
                <a href="{{url('pidCardPdf/'.$appointCard->reg_no)}}" id="" type="button" class="btn btn-outline-success"><i class="fa fa-download" aria-hidden="true"></i>PID Card</a>
                    <a href="{{url('appointCardPdf/'.$appointCard->id)}}" id="" type="button" class="btn btn-outline-success"><i class="fa fa-download" aria-hidden="true"></i>Appoint Card</a>
                </div>
            </div>
        </div>
    </div>

    @include('frontpage.includes.footer')
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>


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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{asset('template/js/google-map.js')}}"></script>
    <script src="{{asset('template/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        // $('#download').on('click', function() {
        //     alert('Comming Soon ...')
        // })
    </script>
</body>

</html>