<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') {{ config('app.name') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('brand_logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('brand_logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('brand_logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('brand_logo/site.webmanifest') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition layout-top-nav ">
    <div class="wrapper ">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark accent-danger">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="{{ asset('brand_logo/logo.png') }}" alt="Logo" class="brand-image  elevation-0"
                        style="opacity: .8; height: 60px;">
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/index') }}" class="nav-link">Home</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">About</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item">Overview </a></li>
                                <li><a href="#" class="dropdown-item">Features</a></li>

                                <li class="dropdown-divider"></li>

                                <!-- Level two dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Privacy Notice</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="{{ url('/terms-of-service') }}"
                                                class="dropdown-item">Terms & Condition</a>
                                        </li>
                                        <li><a href="{{ url('/disclaimer') }}" class="dropdown-item">Disclaimer</a></li>
                                        <li><a href="{{ url('/privacy') }}" class="dropdown-item">Privacy
                                                Policy</a></li>

                                        {{-- <!-- Level three dropdown-->
                                        <li class="dropdown-submenu">
                                            <a id="dropdownSubMenu3" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                class="dropdown-item dropdown-toggle">level 2</a>
                                            <ul aria-labelledby="dropdownSubMenu3"
                                                class="dropdown-menu border-0 shadow">
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            </ul>
                                        </li>
                                        <!-- End Level three -->

                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                        <li><a href="#" class="dropdown-item">level 2</a></li> --}}
                                    </ul>
                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="nav-link dropdown-toggle">My Account</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    @if (Auth::user()->role === 'client')
                                        <li><a href="{{ url('/client/dashboard') }}" class="dropdown-item">Dashboard </a>
                                        </li>
                                    @elseif(Auth::user()->role === 'admin')
                                        <li><a href="{{ url('/admin/dashboard') }}" class="dropdown-item">Dashboard </a>
                                        </li>
                                    @else
                                        <li><a href="{{ url('/s/dashboard') }}" class="dropdown-item">Dashboard </a>
                                        </li>
                                    @endif
                                    <li><a href="#" class="dropdown-item">Profile</a></li>

                                    <li class="dropdown-divider"></li>

                                    <!-- Level two dropdown-->

                                    <li class="dropdown-submenu dropdown-hover">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <a href="javascript:void(0)"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                role="button" aria-expanded="false" class="dropdown-item">Logout</a>
                                        </form>


                                    </li>
                                    <!-- End Level two -->
                                </ul>
                            </li>
                        @endauth

                    </ul>

                    <!-- SEARCH FORM -->

                    <form class="form-inline ml-0 ml-md-3 d-none">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    @auth
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <a href="{{ route('login') }}"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                class="nav-item btn btn-danger px-3">Logout</a>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-item btn btn-default px-3 ">Demo</a>
                    @endauth

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                {{-- Developed with ❤️ by Geperson C. Mamalias --}}
                <a href="#">Privacy</a> | <a href="#">Terms & Condition</a>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ date('Y') }} <a
                    href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong> All
            rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/') }}/dist/js/adminlte.min.js"></script>

    <script src="{{ asset('assets/custom/js/realtime.js') }}"></script>
</body>

</html>
