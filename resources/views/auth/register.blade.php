@extends('partials.auth.main')
@section('auth-title', 'Registers')
@section('auth-content')
    <div class="register-box">
        {{-- <div class="register-logo">
            <p href="javascript:void(0)"><b>{{ config('app.name') }}</b></p>
        </div> --}}
        <div class="login-logo">
            <img src="{{ asset('brand_logo/dams_logo.png') }}" width="100%" alt="Dams Logo" srcset="">
            {{-- <p href="javascript:void(0)"><b>{{ config('app.name') }}</b></p> --}}
        </div>
        <div class="card card-outline card-danger">
            <div class="card-body register-card-body">
                <h5 class="login-box-msg"><b>Create Account</b></h5>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="first_name" id="first_name"
                            class="form-control @error('first_name')
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
                        <input type="text" name="last_name" id="last_name"
                            class="form-control @error('last_name')
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
                        <input type="email" name="email" id="email"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="Email" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" id="reg_password"
                            class="form-control @error('password')
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
                        <input type="password" name="password_confirmation" id="reg_confirm_password"
                            class="form-control @error('password_confirmation')
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
                            <button type="submit" class="btn  btn-danger btn-block" id="registerBtn">REGISTER</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 text-center ">
                    Already registered? <a href="{{ route('login') }}" class="text-secondary">Login here.</a>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
