<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- Styles -->
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"><link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    {{--Datepicker  --}}
    <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/jquery-ui.structure.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/jquery-ui.theme.min.css')}}" rel="stylesheet" />

	<!-- Theme style  -->
    <link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
    <script src="js/modernizr-2.6.2.min.js"></script>
</head>
<body>
    <div class="gtco-loader"></div>
    <div id="page">
        <nav class="gtco-nav" role="navigation">
            <div class="gtco-container">

                <div class="menu-container">
                    <div class="col-sm-4 col-xs-12">
                        <div id="gtco-logo"><a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="" width="100">
                        </a></div>
                    </div>
                    <div class="col-xs-8 text-right menu-1">
                        <ul>
                           
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                        <a href="{{ route('contact') }}">Contact</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" style="color: black !important;" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

       
        <div class="gototop js-top">
            <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
        </div>
    </div>

    <!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>

	<!-- Datepicker -->
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>

	<!-- Main -->
    <script src="js/main.js"></script>

    @yield('script')
	</body>
</html>
