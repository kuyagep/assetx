@extends('partials.main')
{{-- page title --}}
@section('title_prefix', 'Edit Admin')
{{-- Content Header --}}
@section('content-header', 'Edit Admin')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    {{-- download excel file --}}
                    <button onclick="history.back()" class="btn btn-dark  mb-3 px-3">
                        <i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back
                    </button>
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('admin.update', $user->id) }}"
                            novalidate="" enctype="multipart/form-data">
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
                                                value="{{ old('first_name', $user->first_name) }}" placeholder="Ex. Juan">

                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                value="{{ old('last_name', $user->last_name) }}"
                                                placeholder="Ex. Dela Cruz">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', $user->email) }}"
                                                placeholder="Ex. example@email.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="phone" name="phone"
                                                value="{{ old('phone', $user->phone) }}" placeholder="Ex. 09123456789">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Office <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="office_name" name="office_name">
                                                <option selected disabled>Choose...</option>
                                                @foreach ($offices as $office)
                                                    <option value="{{ $office->id }}"
                                                        {{ $user->office_id == $office->id ? 'selected' : '' }}>
                                                        {{ $office->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            style="width: 100%;max-width: 100%;height: 240px;object-fit: cover; ">
                                        <button type="submit" class="btn btn-dark btn-save mt-3 btn-block"
                                            id="btn-save">Save
                                            Changes</button>
                                        <a title="Delete" href="javascript:void(0);" data-id="{{ $user->id }}"
                                            class="btn bg-danger btn-block" id="deleteButton">
                                            Delete Permanently </a>
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

            // Delete Function
            $('body').on('click', '#deleteButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('admin.destroy', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this admin user?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: route,
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {

                                //Sweet Alert
                                Swal.fire({
                                    icon: response.icon,
                                    title: response.title,
                                    text: response.message,
                                    timer: 2000
                                });


                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('all.admin') }}";
                                }, 2000);

                            },
                            error: function(response) {
                                console.log('Error : ', response);
                            }
                        });

                    }
                });

            });

        });
    </script>
@endsection
