@extends('partials.auth.main')
@section('auth-title', 'Register')
@section('auth-content')
    <div class="register-box">
        <div class="register-logo">
            <a href="javascript:void(0)"><b>{{ config('app.name') }}</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <h3 class="login-box-msg">Register</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="first_name"
                            class="form-control form-control-lg @error('first_name')
                            is-invalid
                        @enderror"
                            value="{{ old('first_name') }}" placeholder="First name" required>
                        @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="last_name"
                            class="form-control form-control-lg @error('last_name')
                            is-invalid
                        @enderror"
                            value="{{ old('last_name') }}" placeholder="Last name" required>
                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" placeholder="Email" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password"
                            class="form-control form-control-lg @error('password')
                            is-invalid
                        @enderror"
                            value="{{ old('password') }}" placeholder="Password"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                            required>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password_confirmation"
                            class="form-control form-control-lg @error('password_confirmation')
                            is-invalid
                        @enderror"
                            value="{{ old('password_confirmation') }}" placeholder="Confirm password" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-8">
                            <div class="icheck-secondary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->

                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-lg btn-dark btn-block">REGISTER</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="{{ route('login') }}" class="text-center text-secondary">I already have a account</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
