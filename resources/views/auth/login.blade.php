@extends('partials.auth.main')
@section('auth-title', 'Login')
@section('auth-content')

    <div class="login-box mt-5">
        <div class="login-logo mt-5">

            <img src="{{ asset('brand_logo/deped-logo.png') }}" width="130px" alt="Dams Logo" srcset="">


            {{-- <p href="javascript:void(0)"><b>DIVISION ASSET MANAGEMENT SYSTEM</b></p> --}}
        </div>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary ">
            <div class="card-body login-card-body">


                <p class="login-box-msg"><b>Welcome back!</b></p>

                @if (Session::has('status'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <input type="email" name="email"
                            class="form-control   @error('email')
                            is-invalid
                        @enderror"
                            placeholder="Email" value="{{ old('email') }}" id="login" autocomplete="true" autofocus
                            required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                            required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" checked>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            @if (Route::has('password.request'))
                                <div class="mt-1">
                                    <a href="{{ route('password.request') }}">
                                        Forgot
                                        Password?
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-center">
                            <div class="row align-content-between">
                                <div class="col-12 ">
                                    <!-- Google Recaptcha -->
                                    <div class="g-recaptcha" data-sitekey={{ config('services.recaptcha.key') }}>
                                    </div>

                                </div>
                            </div>
                            @if (Session::has('recaptcha_status'))
                                <span class="text-danger">
                                    <small>{{ Session::get('recaptcha_status') }}</small>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="submit" class="btn bg-primary btn-block" id="loginBtn">
                                Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                {{-- <p class="mt-3 text-center">
                    Don't have an account? <a href="{{ route('register') }}" class="text-primary"> Register here</a>
                </p> --}}

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
