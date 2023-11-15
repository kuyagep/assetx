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
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf


                    {{-- old version --}}
                    <div class="form-group mb-3">
                        <input type="text" name="login"
                            class="form-control   @error('login')
                            is-invalid
                        @enderror"
                            placeholder="Registered Email/Phone" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            value="{{ old('login') }}" required>

                        @error('login')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control  " placeholder="Password" required>
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
                            <button type="submit" class="btn bg-danger btn-block">LOG
                                IN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 text-center ">
                    {{-- <a href="{{ route('register') }}" class="text-secondary">Register</a> --}}
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
