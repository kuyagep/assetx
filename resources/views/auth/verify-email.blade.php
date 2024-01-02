@extends('partials.auth.main')
@section('auth-title', 'Verify Email')
@section('auth-content')
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('brand_logo/dams_logo.png') }}" width="100%" alt="Dams Logo" srcset="">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg ">Thanks for signing up! Before getting started, could you verify your email
                    address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly
                    send you another.</p>

                @if (Session::has('status' == 'verification-link-sent'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div class="row">
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">RESEND VERIFICATION EMAIL </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1 text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="text-muted" type="submit"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();"
                        href="javascript:void(0)">Logout</a>
                </form>

                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection
