<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('auth-title') | {{ config('app.name') }}</title>

    {{-- icons --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('brand_logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('brand_logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('brand_logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('brand_logo/site.webmanifest') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <script async src="https://www.google.com/recaptcha/api.js"></script>
    @include('partials.analytics')
</head>
<style>
    body {
        /* background-image: linear-gradient(to top, #ad0505ba, #ad0505ba), url({{ asset('assets/dist/img/background.png') }}) !important; */
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        background-size: cover !important;
    }

    /* .login-box,
    .card-body {
        backdrop-filter: blur(14px) !important;
        background-color: rgba(255, 255, 255, 0.2) !important;
    } */
</style>

<body class="hold-transition login-page bg-dark  accent-dark">
    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('brand_logo/android-chrome-192x192.png') }}"
            alt="Brand Logo Preloader" height="60" width="60">
    </div> --}}
    <!-- /.navbar -->
    @yield('auth-content')
    <div class="lockscreen-footer text-center text-white">
        Copyright © {{ date('Y') }} <b><a href="index" class="text-white">{{ config('app.name') }} </a></b>. 
        All
        rights reserved.
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function($) {
            // token header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // Login Button
            $('#loginBtn').click(function(e) {
                // e.preventDefault();
                $('#loginBtn').html("Loading...");
            });
            $('#login').keyup(function() {
                $('#loginBtn').html("LOGIN");
            });
            $('#password').keyup(function() {
                $('#loginBtn').html("LOGIN");
            });

            // Register Button
            $('#registerBtn').click(function(e) {
                $('#registerBtn').html("Loading...");
            });
            $('#first_name').keyup(function() {
                $('#registerBtn').html("REGISTER");
            });
            $('#last_name').keyup(function() {
                $('#registerBtn').html("REGISTER");
            });
            $('#email').keyup(function() {
                $('#registerBtn').html("REGISTER");
            });
            $('#reg_password').keyup(function() {
                $('#registerBtn').html("REGISTER");
            });
            $('#reg_confirm_password').keyup(function() {
                $('#registerBtn').html("REGISTER");
            });

        });
    </script>
</body>

</html>
