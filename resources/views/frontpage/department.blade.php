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
        .mousepointer {
        cursor: pointer;
    }

    .deptactive {
			background-color: #01d28e;
			color: white;
		}
    </style>
</head>

<body>

    @include('frontpage.includes.navbar')
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('template/images/bg_2.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <!-- <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Departments <i class="fa fa-chevron-right"></i></span></p> -->
                    <h1 class="mb-0 bread">Departments</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row doctor-grid justify-content-center m-2">
                @foreach($dept as $dept)
                @if(count($dept->doctors)> 0)
                <div class="col-md-4 col-sm-4  col-lg-3 text-center pt-2 mousepointer">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title deptDoctorFind " data-deptNo="{{$dept->dept_no}}">
                            {{$dept->dept_name}}</h5>
							
                        </div>
                    </div>
                    

                </div>
                @endif
                @endforeach
                
            </div>
            <div id="dptDoctor">
                       
            </div>

        </div>
        
    </section>

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
        
		$(document).on('click','.deptDoctorFind', function() {
			var deptNo = $(this).attr('data-deptNo');
			getDeptWiseDoctor(deptNo);
            $('.deptDoctorFind').removeClass('deptactive');
			$(this).addClass('deptactive');
		})

	function getDeptWiseDoctor(deptNo) {
			$.ajax({
				url: "{{url('deptWiseDoctor')}}/" + deptNo,
				type: 'get',
				success: function(data) {
						$('#dptDoctor').html(data);
				}
			})
		}


	</script>

</body>

</html>