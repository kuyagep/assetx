@extends('partials.auth.main')
@section('auth-title', 'Login')
@section('auth-content')
    {{-- @include('sweetalert::alert') --}}

    <div class="login-box">

        <div class="login-logo">
            <p href="javascript:void(0)"><b>{{ config('app.name') }}</b></p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h3 class="login-box-msg">Sign in</h3>
                @if (Session::has('status'))
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="bi bi-exclamation-triangle"></i> {{ Session::get('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="login"
                            class="form-control   @error('login')
                            is-invalid
                        @enderror"
                            value="{{ old('login') }}" placeholder="Registered Email/Phone"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>

                        @error('login')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control " placeholder="Password" required>
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
                            <button type="submit" class="btn btn-dark btn-block">LOG IN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 text-center ">
                    <a href="{{ route('register') }}" class="text-secondary">Register</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
