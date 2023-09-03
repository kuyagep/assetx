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

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page accent-danger">
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:void(0)"><b>{{ config('app.name', 'AssetX') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Forgot your password? No problem. Just let us know your email address and we
                    will email you a password reset link that will allow you to choose a new one.</p>

                @if (Session::has('status'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="email"
                            class="form-control form-control-border border-width-2 @error('email') is-invalid @enderror"
                            id="email" placeholder="Enter registered email address" value="{{ old('email') }}">
                        @error('email')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark btn-block">EMAIL PASSWORD RESET LINK</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a class="text-muted" href="{{ url('/login') }}">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
