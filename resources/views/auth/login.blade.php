@extends('partials.auth.main')
@section('auth-title', 'Login')
@section('auth-content')
    @include('sweetalert::alert')

    <div class="login-box">

        <div class="login-logo">
            <a href="javascript:void(0)"><b>{{ config('app.name') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h3 class="login-box-msg">Sign in</h3>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="email" name="email"
                            class="form-control   @error('email')
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
                        <input type="password" name="password" class="form-control " placeholder="Enter Password" required>
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
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
