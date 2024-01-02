@extends('partials.auth.main')
@section('auth-title', 'Login')
@section('auth-content')
    {{-- @include('sweetalert::alert') --}}

    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('brand_logo/dams_logo.png') }}" width="100%" alt="Dams Logo" srcset="">
            {{-- <p href="javascript:void(0)"><b>{{ config('app.name') }}</b></p> --}}
        </div>
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-body login-card-body">
                <h5 class="login-box-msg"><b>Enter your valid credentials</b></h5>

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
                            placeholder="Registered Email/Phone" value="{{ old('email') }}" id="login" required>

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
                    <div class="text-center mb-3">
                        <!-- Google Recaptcha -->
                        <div class="g-recaptcha " data-sitekey={{ config('services.recaptcha.key') }}></div>
                        @if (Session::has('recaptcha_status'))
                            <span class="text-danger">
                                <small>{{ Session::get('recaptcha_status') }}</small>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn bg-danger btn-block" id="loginBtn">
                                LOGIN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 text-center ">
                    Don't have an account?<a href="{{ route('register') }}" class="text-secondary"> Register here.</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
