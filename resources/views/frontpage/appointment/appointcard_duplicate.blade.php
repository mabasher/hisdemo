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

    </style>
</head>

<body>
    @include('frontpage.includes.navbar')

    <div class="container">
        <div class="main-body">
            <div class="col-md-5 m-auto">
                <div class="card border-primary  m-3">
                    <h4 class="card-header text-center bg-primary text-white">PID / Appointment Card</h4>
                    <div class="card-body text-center">
                        <form action="{{url('appointmentCardduplicate')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">PID / Appoint No</label>
                                    <input type="test" name="pidorappno" class="form-control" id="" placeholder="Search PID/Appoint No">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Mobile No</label>
                                    <input type="test" name="mobile" class="form-control" id="" placeholder="Mobile No">
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-outline-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                        @if(Session::has('status'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('status') }}</p>
                        @endif
                    </div>
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
        $(".alert").fadeTo(2000, 500).slideUp(500, function() {
            $(".alert").slideUp(1000);
        });
    </script>
</body>

</html>