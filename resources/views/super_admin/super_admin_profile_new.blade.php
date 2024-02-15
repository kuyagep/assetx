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
            <div class="row ">
                <div class="col-12">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for user-friendly. Please update your profile account information. See
                        <a href="#">Data Privacy Notice</a>
                    </div>
                </div>
            </div>
            {{-- mt-sm-4 --}}
            <div class="row ">
                <div class="col-xl-3 order-xl-2">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img id="showImage" alt="image" class="profile-user-img img-fluid img-circle"
                                    src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : Gravatar::get(Auth::user()->email) }}""
                                    alt="User profile picture"
                                    style="width: 80px;max-width: 80px;height: 80px;object-fit: cover;">
                            </div>
                            <h3 class="profile-username text-center"> {{ $account->first_name . ' ' . $account->last_name }}
                            </h3>
                            <p class="text-muted text-center">{{ $account->position->name }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>

                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>
                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">Malibu, California</p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                                enim neque.</p>
                        </div>

                    </div>
                </div>
                <div class="col-xl-9 order-xl-1">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item"><a class="nav-link active" href="#account"
                                        data-toggle="tab">Account</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#security_password"
                                        data-toggle="tab">Security</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">


                                <div class="tab-pane active" id="account">
                                    <h6 class="heading-small text-muted mb-4">User information</h6>
                                    <form method="post" class="needs-validation" action="{{ route('profile.update') }}"
                                        novalidate="" enctype="multipart/form-data">

                                        @csrf
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Employee
                                                            No.</label>
                                                        <input type="text" id="employee_number" name="employee_number"
                                                            class="form-control" placeholder="Enter employee number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-email">Email
                                                            address</label>
                                                        <input type="email" id="email" name="email"
                                                            class="form-control" placeholder="example@email.com"
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
                                                        <input type="text" id="first_name" name="first_name"
                                                            class="form-control" placeholder="First name"
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
                                                        <input type="text" id="last_name" name="last_name"
                                                            class="form-control" placeholder="Last name"
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

                                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="phone">Phone</label>
                                                        <input type="text" id="phone" name="phone"
                                                            class="form-control" placeholder="Enter mobile no."
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
                                                        <label class="form-control-label"
                                                            for="input-address">Address</label>
                                                        <input type="text" id="address" name="address"
                                                            class="form-control" placeholder="Home Address"
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
                                                                <input type="file" class="custom-file-input"
                                                                    name="avatar" id="avatar">
                                                                <label class="custom-file-label" for="avatar">Choose
                                                                    file</label>
                                                            </div>

                                                        </div>
                                                        <div>
                                                            <span>Leave it blank if don't want to change the
                                                                avatar.</span>
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
                                            <button type="submit" class="btn btn-danger">
                                                Update Profile</button>
                                        </div>

                                    </form>


                                </div>

                                <div class="tab-pane" id="security_password">
                                    <h6 class="heading-small text-muted mb-4">Update Security Password</h6>
                                    <form class="form-horizontal needs-validation"
                                        action="{{ route('update.password') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="current_password" class="col-sm-2 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password"
                                                    class="form-control @error('current_password')  is-invalid   @enderror "
                                                    id="current_password" name="current_password" placeholder=""
                                                    required>
                                                <small id="verifyCurrentPassword"> </small>
                                                @error('current_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="new_password"
                                                    name="new_password" placeholder="" required>
                                                @error('new_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password_confirmation" class="col-sm-2 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control"
                                                    name="new_password_confirmation" id="new_password_confirmation"
                                                    placeholder="" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        $(document).ready(function() {
            //headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#current_password").keyup(function() {
                var current_password = $("#current_password").val();
                var route = "{{ route('check.password') }}";
                // alert(current_password);
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {
                        current_password: current_password
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response.message);
                        if (response.message == "false") {
                            $("#verifyCurrentPassword").html("Current Password is incorrect!");
                        } else if (response.message == "true") {
                            $("#verifyCurrentPassword").html("Current Password is correct!");
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            // display image
            $('#avatar').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
