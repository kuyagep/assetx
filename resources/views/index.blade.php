<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

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
    <link rel="stylesheet" href="{{ asset('assets/') }}/dist/css/adminlte.min.css">
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
                            <a href="#" class="nav-link">Home</a>
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
                                            <a tabindex="-1" href="#" class="dropdown-item">Terms & Condition</a>
                                        </li>
                                        <li><a href="#" class="dropdown-item">Disclaimer</a></li>
                                        <li><a href="#" class="dropdown-item">Privacy Policy</a></li>

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
                        <a href="{{ route('login') }}" class="nav-item btn btn-primary px-3">Login/Register</a>
                    @endauth

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Division Asset Management System <small>Version 0.2.9</small></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <div class="time" id="time"> </div> &nbsp; &nbsp;

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                    </li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('brand_logo/hero-1.png') }}" class="d-block w-100"
                                            alt="hero banner">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('brand_logo/hero-2.png') }}" class="d-block w-100"
                                            alt="hero banner">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('brand_logo/hero-3.png') }}" class="d-block w-100"
                                            alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-target="#carouselExampleIndicators" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-target="#carouselExampleIndicators" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

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
