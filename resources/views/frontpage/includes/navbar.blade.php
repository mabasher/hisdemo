<style>
/* .modal-dialog {
	max-width: 500px;
} */

.p-5 {
    padding: 1rem !important;
}
</style>
<link rel="stylesheet" href="{{asset('template/css/bootstrap-datepicker.css')}}">
<div class="wrap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-3 mb-md-0 mb-4 d-flex align-items-center">
                <a class="navbar-brand" href="#">Darco <span class="text-success"> Technologies</span></a>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-8 mb-md-0 mb-3">
                        <div class="top-wrap d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-location-arrow"></span></div>
                            <div class="text"><span>Address</span><span>House #1150 Road #9/A Avenue #11 DOHS
                                    Mirpur-1216</span></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="top-wrap d-flex">
                            <div class="icon d-flex align-items-center justify-content-center"><span
                                    class="fa fa-phone"></span></div>
                            <div class="text"><span>Call us</span><span>(+880) 9617-171125</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>
        <div class="order-lg-last">
            <button id="modalBtn" class="btn btn-primary">Make an appointment</button>
        </div>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul id="nav" class="navbar-nav">
                <li class="nav-item"><a href="{{url('/')}}/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{url('doctorpage')}}" class="nav-link">Doctors</a></li>
                <li class="nav-item"><a href="{{url('docDept')}}" class="nav-link">Departments</a></li>
                <li class="nav-item"><a href="{{url('services')}}" class="nav-link">Services</a></li>
                <!-- <li class="nav-item"><a href="{{url('about')}}" class="nav-link">About</a></li> -->
                <!-- <li class="nav-item"><a href="{{url('contact')}}" class="nav-link">Contact</a></li> -->
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link">SignIn</a></li>
                <li class="nav-item"><a href="{{route('register')}}" class="nav-link">SignUp</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade bd-example-modal-lg" id="appointModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title align-center" id="exampleModalLabel">Booking an Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 bg-primary p-3 heading-section heading-section-white">
                <!-- <span class="subheading">Booking an Appointment</span> -->
                <form action="{{url('patientAdd')}}" method="post" class="appointment">
                    @csrf
                    <div class="row justify-content-center">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile No" required>
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
                                            <input type="radio" class="form-check-input" value="F" name="gender">Female
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="O" name="gender">Others
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-wrap">
                                    <input type="text" class="form-control datepicker" name="dob" id="dtob"
                                        placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-wrap">
                                    <input type="text" name="age" class="form-control" id="age" placeholder="Age">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-field">
                                    <div class="select-wrap">
                                        <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                        <select id="specialty" class="form-control">
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
                                        <select name="doctor" id="doctors" class="form-control" required>
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
                                    class="btn btn-secondary py-2 px-3">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('template/js/jquery.min.js')}}"></script>
<script src="{{asset('template/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript">
$(function() {
    var path = window.location.href;
    // alert(location.pathname);
    $('#nav li a').each(function() {
        var $this = $(this);
        if ($this.attr('href') === path) {
            $this.closest('li').addClass('active');
        }
    });
});

$('#modalBtn').on('click', function() {
    $('#appointModal').modal('show');
})

$('#dtob').on('change', function() {
    var dob = $(this).val();
    date = dob.split("/").reverse().join("-");
    $('#age').val(ageCalculator(date))

})

var maxBirthdayDate = new Date();
$('#dtob').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    todayHighlight: true,
    changeMonth: true,
    changeYear: true,
    endDate: maxBirthdayDate,
    inline: true
})

$('#specialty').on('change', function() {
    var spDoctor = $(this).val();
    getDoctorSpeciltyWise(spDoctor);
})

function getDoctorSpeciltyWise(deptNo) {
    $.ajax({
        url: "{{url('onLineSpecialtyWiseDoctor')}}/" + deptNo,
        type: 'get',
        success: function(data) {
            $('#doctors').html(data);
        }
    })
}
</script>