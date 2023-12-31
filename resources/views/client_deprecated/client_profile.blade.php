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
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-left">
                                <img id="showImage" alt="image"
                                    src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : asset('assets/dist/img/avatar/avatar5.png') }}"
                                    class="rounded-circle author-box-picture"
                                    style="width: 80px;max-width: 80px;height: 80px;object-fit: cover;">
                                <div class="clearfix"></div>

                            </div>
                            <div class="author-box-details mt-3">
                                <div class="author-box-name">
                                    <b><a href="#">
                                            {{ ucwords(Auth::user()->first_name) . ' ' . ucwords(Auth::user()->last_name) }}</a></b>
                                </div>
                                <div class="author-box-job"> {{ Auth::user()->email }}</div>

                                <div class="mb-2 mt-3">
                                    <div class="text-md font-weight-bold">Emp. No: </div>
                                </div>
                                <div class="mb-2 mt-2">
                                    <div class="text-md font-weight-bold">Phone: {{ $account->phone }}</div>
                                </div>
                                <div class="mb-2 mt-2">
                                    <div class="text-md font-weight-bold">Address: {{ $account->address }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('client.profile.update') }}"
                            novalidate="" enctype="multipart/form-data">
                            {{-- @method('patch') --}}
                            @csrf
                            <div class="card-header">
                                <h4>Update Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value=" {{ old('first_name', $account->first_name) }}" required="">
                                        @error('first_name')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value=" {{ old('last_name', $account->last_name) }}" required="">
                                        @error('last_name')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value=" {{ old('email', $account->email) }}" required="">
                                        @error('email')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Phone</label>
                                        <input type="tel" class="form-control" name="phone"
                                            value="{{ old('phone', $account->phone) }}">
                                        @error('phone')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Address</label>
                                        <input type="tel" class="form-control" name="address"
                                            value="{{ old('address', $account->address) }}">
                                    </div>
                                    @error('address')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="row">
                                    {{-- <div class="form-group col-12">
                                        <label for="image" class="form-label">Upload Avatar</label>
                                        <input class="form-control" type="file" name="avatar" id="image">
                                        @error('avatar')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div> --}}

                                    <div class="form-group col-12">
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
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Update Profile</button>
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
