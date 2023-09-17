@extends('partials.auth.main')
@section('auth-title', 'Reset Password')
@section('auth-content')
    <div class="login-box">
        <div class="login-logo">
            <p href="javascript:void(0)"><b>{{ config('app.name') }}</b></p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">


                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group mb-3">
                        <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            class="form-control  @error('email')
                            is-invalid
                        @enderror"
                            value="{{ old('email', $request->email) }}" placeholder="Enter Registered Email" required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password"
                            class="form-control  @error('password')
                            is-invalid
                        @enderror"
                            placeholder="New Password" required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password_confirmation"
                            class="form-control h-2 @error('password_confirmation')
                            is-invalid
                        @enderror"
                            placeholder="Confirm Password" required>

                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark btn-block">RESET PASSWORD</button>
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
