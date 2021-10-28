<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Registered Roles| Reservation System
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/now-ui-dashboard.css?v=1.3.0')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
  {{-- datepicker....Jquery-ui --}}
  <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/jquery-ui.structure.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/jquery-ui.theme.min.css')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body class="">
  <div class="wrapper ">

    {{-- side bar --}}
    <div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
        <div class="logo airfly">
        <a href="{{route('index')}}" class="simple-text logo-mini">
          Go
        </a>
        <a href="{{route('index')}}" class="simple-text logo-normal">
          <img src="{{ asset('img/logo.png') }}" alt="" width="100">
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">

          <li class="{{ 'admin' == request()->path() ? 'active' : '' }} ">
            <a href="{{ route('dashboard') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>

          @hasrole(['admin'])
            <li class="{{ 'admin/users' == request()->path() ? 'active' : '' }} ">
              <a href="{{ route('admin.users.index') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p>Users</p>
              </a>
            </li>
          @endhasrole

          <li class="{{ 'admin/flights' == request()->path() ? 'active' : '' }} ">
            <a href="{{ route('admin.flights.index') }}">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Flights</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand">
              @yield('name')
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">

            @yield('form')

            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                    @if(auth()->user()->unreadNotifications->count())
                      <span class="badge badge-primary">{{auth()->user()->unreadNotifications->count()}}</span>
                    @endif
                    <p>
                      <span class="d-lg-none d-md-block">Notifications</span>
                    </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="height: 300px; overflow: hidden; overflow-y: scroll;" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('admin.markRead') }}">
                      Mark all ss Read
                    </a>
                  @foreach (auth()->user()->unreadNotifications as $notify)
                    <a class="dropdown-item bg-light text-info" href="#">
                      {{$notify->data['data']}}<br>
                      {{$notify->created_at->diffForHumans()}}
                    </a>
                    @endforeach
                    @foreach (auth()->user()->readNotifications as $notify)
                    <a class="dropdown-item" href="#">
                      {{$notify->data['data']}}<br>
                      {{$notify->created_at->diffForHumans()}}
                    </a>
                    @endforeach  
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="now-ui-icons ui-1_email-85"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Messages</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} 
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
            @include('inc.messages')
            @yield('content')
      </div>

    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/select2.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/now-ui-dashboard.min.js?v=1.3.0')}}" type="text/javascript"></script>
  {{-- datepicker....Jquery-ui --}}
  <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/demo/demo.js')}}"></script>


  @yield('script')

  
</body>

</html>