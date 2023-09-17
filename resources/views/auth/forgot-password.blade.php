@extends('partials.auth.main')
@section('auth-title', 'Forgot Password')
@section('auth-content')
    <div class="login-box">
        <div class="login-logo">
            <p href="javascript:void(0)"><b>{{ config('app.name') }}</b></p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <small class="login-box-msg">Forgot your password? No problem. Just let us know your email address and we
                    will email you a password reset link that will allow you to choose a new one.</small>

                @if (Session::has('status'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mb-3 mt-3">
                        <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror"
                            id="email" placeholder="Enter registered email address" value="{{ old('email') }}">
                        @error('email')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn  btn-dark btn-block">EMAIL PASSWORD RESET LINK</button>
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
@endsection
