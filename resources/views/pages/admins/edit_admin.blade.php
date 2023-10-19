@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Edit Admin')
{{-- Content Header --}}
@section('content-header', 'Edit Admin')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 ">
                    {{-- download excel file --}}
                    <a href="javascript:void(0)" class="btn btn-dark  mb-3">
                        <i class="fa-solid fa-download"></i>&nbsp;Back
                    </a>
                    <div class="card">
                        <form method="post" class="needs-validation"
                            action="{{ route('super_admin.admin.update', $user->id) }}" novalidate=""
                            enctype="multipart/form-data">
                            {{-- @method('patch') --}}
                            @csrf

                            <div class="card-body">

                                {{-- Error Display here --}}
                                <div id="error"></div>
                                {{-- Reference Id --}}
                                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                                {{-- sample --}}
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group mt-2">
                                            <label for="avatar">Avatar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="avatar"
                                                        id="avatar">
                                                    <label class="custom-file-label" for="avatar">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                value="{{ $user->first_name }}" placeholder="Ex. Juan">

                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                value="{{ $user->last_name }}" placeholder="Ex. Dela Cruz">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $user->email }}" placeholder="Ex. example@email.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="phone" name="phone"
                                                value="{{ $user->phone }}" placeholder="Ex. 09123456789">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="roles" name="roles">
                                                <option selected disabled>Choose...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="custom-select" name="status" id="status">
                                                <option>Select...</option>
                                                <option value="active" selected>Activate</option>
                                                <option value="inactive">Deactivate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img id="showImage" alt="Avatar" class="table-avatar"
                                            src="{{ asset('assets/dist/img/avatar/default.jpg') }}"
                                            style="width: 240px;max-width: 240px;height: 240px;object-fit: cover; ">
                                        <button type="submit" class="btn btn-dark btn-save mt-3 btn-block"
                                            id="btn-save">Save
                                            Changes</button>
                                        <button type="button" class="btn btn-danger btn-save mt-3 btn-block"
                                            id="btn-save">Delete Permanently</button>
                                    </div>



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
    <script type="text/javascript">
        $(document).ready(function($) {
            // token header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
