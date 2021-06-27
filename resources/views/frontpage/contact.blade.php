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
    <section class="hero-wrap hero-wrap-2" style="background-image: url('template/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact us <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Contact us</h1>
          </div>
        </div>
      </div>
    </section>
		
		<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-12">
						<div id="map" class="map"></div>
					</div>
					<div class="col-md-12">
						<div class="wrapper">
							<div class="row no-gutters">
								<div class="col-md-7 d-flex">
									<div class="contact-wrap w-100 p-md-5 p-4">
										<h3 class="mb-4">Get in touch</h3>
										<form method="POST" id="contactForm" class="contactForm">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" name="name" id="name" placeholder="Name">
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group">
														<input type="email" class="form-control" name="email" id="email" placeholder="Email">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<textarea name="message" class="form-control" id="message" cols="30" rows="7" placeholder="Message"></textarea>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" value="Send Message" class="btn btn-primary">
														<div class="submitting"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="col-md-5 d-flex align-items-stretch">
									<div class="info-wrap bg-primary w-100 p-lg-5 p-4">
										<h3 class="mb-4 mt-md-4">Contact us</h3>
					        	<div class="dbox w-100 d-flex align-items-start">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-map-marker"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-phone"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-paper-plane"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
						          </div>
					          </div>
					        	<div class="dbox w-100 d-flex align-items-center">
					        		<div class="icon d-flex align-items-center justify-content-center">
					        			<span class="fa fa-globe"></span>
					        		</div>
					        		<div class="text pl-3">
						            <p><span>Website</span> <a href="#">yoursite.com</a></p>
						          </div>
					          </div>
				          </div>
								</div>
							</div>
						</div>
					</div>
				</div>
    	</div>
    </section>

    @include('frontpage.includes.footer')
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
    
  </body>
</html>