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

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PQVBC2BK');
    </script>
    <!-- End Google Tag Manager -->
</head>
<style>
    .content-wrapper {
        background-image: url('https://localhost/assetx/public/assets/dist/img/background.png') !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        background-size: cover !important;
    }

    .modal-body {
        max-height: 50vh;
        overflow-y: scroll;
    }
</style>

<body class="hold-transition layout-top-nav ">
    <<!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PQVBC2BK" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div class="wrapper ">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-dark accent-navy bg-navy">
                <div class="container">
                    <a href="javascript:void(0);" class="navbar-brand mt-2 text-white">
                        <img src="{{ asset('brand_logo/logo.png') }}" alt="Logo" class="brand-image  elevation-0"
                            style="opacity: .8; height: 70px;">
                    </a>

                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>



                    <!-- Right navbar links -->
                    <div class="text-center collapse navbar-collapse order-2" id="navbarCollapse">
                        <ul class=" order-md-2 navbar-nav navbar-no-expand ml-auto">

                            <li class="nav-item">
                                <span href="javascript:void(0)" aria-expanded="false" class="nav-link text-white">
                                    <div class="current-date" id="current-date"> </div>
                                </span>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">

                                    @auth
                                        <img src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : asset('assets/dist/img/avatar/default.jpg') }}"
                                            class="user-image img-circle elevation-0" alt="User Profile Image"
                                            style="width: 2rem;max-width: 2rem;height: 2rem;object-fit: cover;">
                                    @else
                                        MY ACCOUNT
                                    @endauth
                                </a>
                                <ul aria-labelledby="dropdownSubMenu1"
                                    class="dropdown-menu dropdown-menu-right border-0 shadow ">
                                    @auth
                                        @if (auth()->user()->hasRole('super-admin'))
                                            <li><a href="{{ url('/my/dashboard') }}" class="dropdown-item">Dashboard </a>
                                            </li>
                                            <li><a href="{{ url('/my/profile') }}" class="dropdown-item">Profile</a></li>
                                        @elseif(auth()->user()->hasRole('admin'))
                                            <li><a href="{{ url('/account/dashboard') }}" class="dropdown-item">Dashboard
                                                </a>
                                            </li>
                                            <li><a href="{{ url('/account/profile') }}" class="dropdown-item">Profile</a>
                                            </li>
                                        @else
                                            <li><a href="{{ url('/client/dashboard') }}" class="dropdown-item">Dashboard
                                                </a>
                                            </li>
                                            <li><a href="{{ url('/client/profile') }}" class="dropdown-item">Profile</a>
                                            </li>
                                        @endif

                                        <li class="dropdown-divider"></li>

                                        <!-- Level two dropdown-->
                                        <li class="dropdown-submenu dropdown-hover">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <a href="javascript:void(0)"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                    role="button" aria-expanded="false"
                                                    class="dropdown-item text-danger"><strong>Logout</strong></a>
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}" class="dropdown-item">Login</a></li>
                                        <li><a href="{{ route('register') }}" class="dropdown-item">Register</a></li>
                                    @endauth
                                </ul>
                            </li>

                        </ul>
                    </div>

                </div>
            </nav>
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- /.content-wrapper -->



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
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#data-privacy-notice').modal('show');
                const $modalBody = $('#modal-body');
                const $scrollButton = $('#scrollButton');

                $modalBody.scroll(function() {
                    // Check if the user has scrolled to a certain point (e.g., 200 pixels)
                    if ($modalBody.scrollTop() >= 200) {
                        $scrollButton.prop('disabled', false);
                    } else {
                        $scrollButton.prop('disabled', true);
                    }
                });
            });
        </script>

        {{-- <script>
        $(document).ready(function() {
            const $modalBody = $('#modal-body');
            const $scrollButton = $('#scrollButton');

            $modalBody.scroll(function() {
                // Check if the user has scrolled to a certain point (e.g., 200 pixels)
                if ($modalBody.scrollTop() >= 200) {
                    $scrollButton.prop('disabled', false);
                } else {
                    $scrollButton.prop('disabled', true);
                }
            });
        });
    </script> --}}
</body>

</html>
