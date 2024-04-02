@extends('partials.auth.main')
@section('auth-title', 'Confirm Password')
@section('auth-content')
    <div class="login-box">
        <div class="login-logo mt-5">
            <p href="javascript:void(0)"><b>{{ config('app.name') }}</b></p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">This is a secure area of the application. Please confirm your password before
                    continuing.</p>
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="password" class="form-control  @error('password') is-invalid @enderror"
                            id="password">
                        @error('password')
                            <span class="error invalid-feedback"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark btn-block">CONFIRM</button>
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
