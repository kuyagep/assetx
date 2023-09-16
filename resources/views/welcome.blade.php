<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AssetX') }}</title>

    {{-- icons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('brand_logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('brand_logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('brand_logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('brand_logo/site.webmanifest') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Google Font: Source Sans Pro -->

    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <style>
        .content-wrapper {
            width: 100%;
            height: 95vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.9)), url("https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        }
    </style>
</head>

<body id="app" class="hold-transition layout-top-nav layout-navbar-fixed layout-fixed  accent-dark">
    <div class="wrapper">
        @include('sweetalert::alert')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-dark ">
                <div class="container ">
                    <a href="#" class="navbar-brand">
                        <img src="{{ asset('brand_logo/logo.png') }}" alt="Logo" class="brand-image  elevation-0"
                            style="opacity: .8; height: 60px">
                        {{-- <span class="brand-text font-weight-light h5">{{ config('app.name') }}</span> --}}
                    </a>

                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav justify-content-center">
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link active">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">About</a>
                            </li> --}}

                            {{-- <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="nav-link dropdown-toggle">Features</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li><a href="#" class="dropdown-item">Dashboard </a></li>
                                    <li><a href="#" class="dropdown-item">Profile</a></li>

                                    <li class="dropdown-divider"></li>

                                    <!-- Level two dropdown-->
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"
                                            class="dropdown-item dropdown-toggle">Password</a>
                                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                            <li>
                                                <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                            </li>

                                            <!-- Level three dropdown-->
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
                                            <li><a href="#" class="dropdown-item">level 2</a></li>
                                        </ul>
                                    </li>
                                    <!-- End Level two -->
                                </ul>
                            </li> --}}
                            @auth()
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                            @endauth

                        </ul>



                    </div>

                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                    </ul>

                </div>

            </nav>
            <!-- /.navbar -->
            <!-- Content Header (Page header) -->
            <div class="row mb-3"></div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content mt-5 ">
                <div class="container ">
                    <div class="login-box">
                        <div class="login-logo">
                            <p class="text-white"><b>{{ config('app.name') }}</b></p>
                        </div>
                        <!-- /.login-logo -->
                        <div class="card">
                            <div class="card-body login-card-body">
                                <h3 class="login-box-msg">Sign in</h3>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="email" name="email"
                                            class="form-control form-control-lg  @error('email')
                            is-invalid
                        @enderror"
                                            value="{{ old('email') }}" placeholder="Enter Registered Email"
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg"
                                            placeholder="Enter Password" required>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-7">
                                            <div class="icheck-secondary">
                                                <input type="checkbox" id="remember" name="remember">
                                                <label for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-5">
                                            @if (Route::has('password.request'))
                                                <div class="mt-1">
                                                    <a href="{{ route('password.request') }}">Forgot
                                                        Password?</a>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-lg btn-dark btn-block">LOG
                                                IN</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.login-card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>


    {{-- @include('partials.footer') --}}

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436720/particles.js"></script>
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1561436735/app.js"></script>

    <script>
        $(document).ready(function() {

            var count_particles, stats, update;
            stats = new Stats;
            stats.setMode(0);
            stats.domElement.style.position = 'absolute';
            stats.domElement.style.left = '0px';
            stats.domElement.style.top = '0px';
            document.body.appendChild(stats.domElement);
            count_particles = document.querySelector('.js-count-particles');
            update = function() {
                stats.begin();
                stats.end();
                if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
                    count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
                }
                requestAnimationFrame(update);
            };
            requestAnimationFrame(update);


        });
    </script>
</body>

</html>
