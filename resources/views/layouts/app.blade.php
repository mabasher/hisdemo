<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/img/favicon.ico')}}"> -->
    <title>DTL</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @yield('css')
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="javascript:void(0);" class="logo">
                    <img src="{{asset('admin/img/drc.png')}}" height="35" alt="" id="long-logo">
                    <img src="{{asset('admin/img/logo.png')}}" height="35" alt="" id="short-logo" style="display:none;">
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{asset('admin/img/user.jpg')}}" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        <span>{{auth()->user()->name}}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="#">Logout</a>

                </div>
            </div>
        </div>
        @include('includes.sidemenu')
        <div class="page-wrapper">
             @yield('content')
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/js/Chart.bundle.js')}}"></script>
    <!-- <script src="{{asset('admin/js/chart.js')}}"></script> -->
    <script src="{{asset('admin/js/app.js')}}"></script>
    <script src="{{asset('admin/js/custom.js')}}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var current = location;
            console.log(current);
            $('.sitebar li a').each(function() {
                var $this = $(this);
                var url = $this.attr('href');
                console.log('Testing' + url);
                // if the current path is like this link, make it active
                if (url.indexOf(current) !== -1) {
                    $this.parent().addClass('active');
                    $this.parent().parent().css('display', 'block');
                    $this.parent().parent().parent().children('a').addClass('subdrop');

                }
            })
        })

        $('.module').click(function(e) {
            e.preventDefault();
            console.log('Blank Url Module');
        })
    </script>
    @yield('js')


</body>

</html>