@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Change Password')
{{-- Content Header --}}
@section('content-header', 'Manage Password')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-sm-4">

                <div class="col-md-6 col-sm-12 ">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('client.update.password') }}"
                            novalidate="">
                            {{-- @method('patch') --}}
                            @csrf
                            <div class="card-header">
                                <h4>Account Change Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label>Current Password</label>
                                    <input type="password"
                                        class="form-control @error('current_password')                                             
                                                    is-invalid                                              
                                                 @enderror "
                                        name="current_password" required="">
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label>New Password</label>
                                    <input type="password"
                                        class="form-control @error('new_password')                                             
                                                    is-invalid                                              
                                                 @enderror "
                                        name="new_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                        required="">
                                    @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row mt-3">
                                    <label>Confirm Password</label>
                                    <input type="password"
                                        class="form-control @error('new_password_confirmation')                                             
                                                    is-invalid                                              
                                                 @enderror "
                                        name="new_password_confirmation" required="">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

@endsection
