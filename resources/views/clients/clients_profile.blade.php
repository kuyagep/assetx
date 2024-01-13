@extends('partials.main')
{{-- page title --}}
@section('title_prefix', 'Manage Profile')
{{-- Content Header --}}
@section('content-header', 'Manage Profile')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-sm-4">
                <div class="col-xl-4 order-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <a href="#">
                                    <img id="showImage" alt="image"
                                        src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : asset('assets/dist/img/avatar/default.jpg') }}"
                                        class="rounded-circle author-box-picture"
                                        style="width: 80px;max-width: 80px;height: 80px;object-fit: cover;">
                                </a>
                            </div>
                            <hr>
                            <div class="author-box-details mt-3 text-center">
                                <div class="author-box-name">
                                    <b><a href="#" class="h5">
                                            {{ $account->first_name . ' ' . $account->last_name }}</a></b>
                                </div>
                                <div class="author-box-job"> {{ $account->email }}</div>

                                <div class="mb-2 mt-3">
                                    <div class="text-md font-weight-bold">
                                        @if ($account->address)
                                            <i class="fa-solid fa-location-dot"></i>
                                            {{ $account->address }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary btn-sm"><i class="fa-regular fa-message"></i>
                                    Message</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('client.profile.update') }}"
                            novalidate="" enctype="multipart/form-data">
                            {{-- @method('patch') --}}
                            @csrf
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="mb-0"><b>Update Profile</b> </h4>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="#change_password" class="btn btn-primary">
                                            Change Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- new version --}}
                                <h6 class="heading-small text-muted mb-4">User Information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Employee No.</label>
                                                <input type="text" id="employee_number" name="employee_number"
                                                    class="form-control" placeholder="Enter employee number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email
                                                    address</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    placeholder="example@email.com"
                                                    value="{{ old('email', $account->email) }}">
                                                @error('email')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">First
                                                    name</label>
                                                <input type="text" id="first_name" name="first_name" class="form-control"
                                                    placeholder="First name"
                                                    value="{{ old('first_name', $account->first_name) }}">
                                                @error('first_name')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Last
                                                    name</label>
                                                <input type="text" id="last_name" name="last_name" class="form-control"
                                                    placeholder="Last name"
                                                    value=" {{ old('last_name', $account->last_name) }}">
                                                @error('last_name')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">

                                <h6 class="heading-small text-muted mb-4">Contact Information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="phone">Phone</label>
                                                <input type="text" id="phone" name="phone" class="form-control"
                                                    placeholder="Enter mobile no."
                                                    value="{{ old('phone', $account->phone) }}">
                                                @error('phone')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Address</label>
                                                <input type="text" id="address" name="address" class="form-control"
                                                    placeholder="Home Address"
                                                    value="{{ old('address', $account->address) }}">
                                                @error('address')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="avatar">Upload Avatar</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="avatar"
                                                            id="avatar">
                                                        <label class="custom-file-label" for="avatar">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                @error('avatar')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row float-right mt-3">
                                    <button type="submit" class="btn bg-dark">
                                        <i class="fa-regular fa-floppy-disk"></i>
                                        Update Profile</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="row" id="change_password">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('client.update.password') }}"
                            novalidate="" enctype="multipart/form-data">
                            {{-- @method('patch') --}}
                            @csrf
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h4 class="mb-0"><b>Change Password</b> </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- new version --}}
                                <h6 class="heading-small text-muted mb-4">Update Security Password</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <label>Current Password</label>
                                            <input type="password"
                                                class="form-control @error('current_password')  is-invalid   @enderror "
                                                name="current_password" placeholder="Enter Current Password" required>
                                            @error('current_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-6 col-sm-12"><label>New Password</label>
                                            <input type="password"
                                                class="form-control @error('new_password')                                             
                                                    is-invalid                                              
                                                 @enderror "
                                                name="new_password" placeholder="Enter New Password" required="">
                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-sm-12"><label>Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('new_password_confirmation')                                             
                                                    is-invalid                                              
                                                 @enderror "
                                                name="new_password_confirmation"
                                                placeholder="Confirm New Password"required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row float-right mt-3">
                                    <button type="submit" class="btn bg-dark">
                                        <i class="fa-regular fa-floppy-disk"></i>
                                        Save Changes</button>
                                </div>
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
    <script>
        // display image
        $('#avatar').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    </script>
@endsection
