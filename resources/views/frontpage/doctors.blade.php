<!DOCTYPE html>
<html lang="en">

<head>
	<title>DTL</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"> -->

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
		.searchabc {
			border: none;
			outline: none;
			padding: 5px 8px;
			background-color: #dff5eb;
			cursor: pointer;
			font-size: 14px;
		}

		.batasactive {
			background-color: #01d28e;
			color: white;
		}

		.btn {
			padding: 7px 5px;
		}

		@media only screen and (max-width: 600px) {
			.searchabc {
				margin: 3px;
			}
		}
	</style>
</head>

<body>
	@include('frontpage.includes.navbar')
	<!-- END nav -->
	<section class="hero-wrap hero-wrap-2" style="background-image: url('template/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container-fluid">

		</div>
	</section>
	<br>
	<div class="row  no-gutters slider-text align-items-center text-center text-white">
		<div id="myDIV" class="col-md-12 ftco-animate pb-5">
			<button class="btn searchabc" value="No-Doctor">All</button>
			<button class="btn searchabc" value="A">A</button>
			<button class="btn searchabc" value="B">B</button>
			<button class="btn searchabc" value="C">C</button>
			<button class="btn searchabc" value="D">D</button>
			<button class="btn searchabc" value="E">E</button>
			<button class="btn searchabc" value="F">F</button>
			<button class="btn searchabc" value="G">G</button>
			<button class="btn searchabc" value="H">H</button>
			<button class="btn searchabc" value="I">I</button>
			<button class="btn searchabc" value="J">J</button>
			<button class="btn searchabc" value="K">K</button>
			<button class="btn searchabc" value="L">L</button>
			<button class="btn searchabc" value="M">M</button>
			<button class="btn searchabc" value="N">N</button>
			<button class="btn searchabc" value="O">O</button>
			<button class="btn searchabc" value="P">P</button>
			<button class="btn searchabc" value="Q">Q</button>
			<button class="btn searchabc" value="R">R</button>
			<button class="btn searchabc" value="S">S</button>
			<button class="btn searchabc" value="T">T</button>
			<button class="btn searchabc" value="U">U</button>
			<button class="btn searchabc" value="V">V</button>
			<button class="btn searchabc" value="W">W</button>
			<button class="btn searchabc" value="X">X</button>
			<button class="btn searchabc" value="Y">Y</button>
			<button class="btn searchabc" value="Z">Z</button>
		</div>
	</div>

	<div id="doctorshow">

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

	<script>
		$('#searchDoctor').on('keyup', function() {
			var doctorName = $(this).val();
			getFindDoctors(doctorName);
			if (doctorName == null || doctorName == '') {
				doctorName = 'No-Doctor';
				getFindDoctors(doctorName);
			}

		})

		$('.searchabc').on('click', function() {
			getFindDoctors($(this).attr('value'))
			$('.searchabc').removeClass('batasactive');
			$(this).addClass('batasactive');
		})

		function getFindDoctors(id) {
			$.ajax({
				url: "{{url('doctorSearch')}}/" + id,
				type: 'get',
				success: function(data) {

					if (data == 'No-Data') {
						$('#doctorshow').html('<br> <div class="text-center m-auto"> <h3 class="btn btn-primary">No Doctor Found</h3> </div>');
					} else {
						$('#doctorshow').html(data);
					}
				}
			})
		}


		$(function() {
			$('.abcactive button').click(function() {
				$('.abcactive button').removeClass("active");
				$(this).addClass("active");
			});
		});
	</script>

</body>

</html>