{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Manage Users')
{{-- Content Header --}}
@section('content-header', 'Manage Users')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-users "></i><b> List of User</b></h3>
                            <div class="card-tools">
                                <a href="javascript:void(0)" id="add-button" class="btn btn-primary mr-2">
                                    <i class="fa fa-plus mr-1"></i>&nbsp;Add New User
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Avatar</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th style="width: 8%" class="text-center">Status</th>
                                            <th>Create At</th>
                                            <th width="250px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" name="modal-form" id="modal-form" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                {{-- Error Display here --}}
                                <div id="error"></div>
                                {{-- Reference Id --}}
                                <input type="hidden" name="id" id="id">
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
                                                placeholder="Ex. Juan">

                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                placeholder="Ex. Dela Cruz">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Ex. example@email.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role <span class="text-danger">*</span></label>
                                            <select class="custom-select" name="role" id="role">
                                                <option>Select...</option>
                                                <option value="client" selected>Client</option>
                                                <option value="admin">Admin</option>
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
                                            src="{{ asset('assets/dist/img/avatar.png') }}"
                                            style="width: 150px;max-width: 150px;height: 150px;object-fit: cover; ">

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-end">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark btn-save" id="btn-save">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!-- End Modal -->
            <!-- /.modal -->
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


            // Display data from index controller
            var table = $("#dataTableajax").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                select: true,
                autoWidth: false,
                ajax: "{{ url('s/users') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    }, {
                        data: 'avatar',
                        name: 'avatar'
                    }, {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    }, {
                        data: 'created_at',
                        name: 'created_at'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'text-center'
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });

            // Add Button Function
            $('#add-button').click(function() {
                $('#error').html('');
                $('#modal').modal("show");
                $('#modal-title').html("Add Data");
                $('#btn-save').html("Save");
                $('#btn-save').show();
                $('#id').val('');
                $('#modal-form').trigger("reset");
            });


            // Store Function
            $('#modal-form').submit(function(e) {
                e.preventDefault();

                $('#btn-save').html('Sending...');

                // Serialize the form data using FormData
                let formData = new FormData($('#modal-form')[0]);

                // Send the form data via AJAX using jQuery store function
                $.ajax({
                    // Replace with your route URL
                    type: 'POST',
                    url: "{{ route('super_admin.users.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        // Handle the response from the server (if needed)
                        $('#btn-save').html('Submitted');
                        $('#modal').modal('hide');
                        table.draw();
                        $('#modal-form').trigger("reset");

                        // Display the message on the page
                        Swal.fire({
                            icon: response.icon,
                            title: response.title,
                            text: response.message,
                            timer: 2000
                        });
                    },
                    error: (response) => {
                        // Handle the error (if needed)
                        $('#error').html("<div class='alert alert-danger'>" + response[
                                'responseJSON']['message'] +
                            "</div>");
                        $('#btn-save').html('Save');
                    }
                });

            });

            // View Function
            $('body').on('click', '#viewButton', function() {
                $('#btn-save').attr('disabled', true);

                var id = $(this).data('id');
                var route = "{{ route('super_admin.users.show', ':id') }}";
                route = route.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {

                        $('#modal-title').html("View Data");
                        $('#modal').modal("show");
                        $('#id').val(response.id);
                        $('#first_name').val(response.first_name);
                        $('#last_name').val(response.last_name);
                        $('#email').val(response.email);
                        $('#role').val(response.role);
                        $('#status').val(response.status);
                        $('#error').html('');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            // Edit Function
            $('body').on('click', '#editButton', function() {
                $('#btn-save').attr('disabled', false);
                // $('#ModalForm').attr("id", "editModalForm");
                $('#btn-save').html("Save Changes");
                var id = $(this).data('id');
                var route = "{{ route('super_admin.users.edit', ':id') }}";
                route = route.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(res);
                        $('#modal-title').html("Edit Data");
                        $('#modal').modal("show");
                        $('#id').val(response.id);
                        $('#first_name').val(response.first_name);
                        $('#last_name').val(response.last_name);
                        $('#email').val(response.email);
                        $('#role').val(response.role);
                        $('#status').val(response.status);
                        $('#error').html('');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            // Delete Function
            $('body').on('click', '#deleteButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('super_admin.users.destroy', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this account?",
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
                                console.log(response);
                                var oTable = $('#dataTableajax').dataTable();
                                oTable.fnDraw(false);
                                //Sweet Alert
                                Swal.fire({
                                    icon: response.icon,
                                    title: response.title,
                                    text: response.message,
                                    timer: 2000
                                });

                            },
                            error: function(response) {
                                console.log('Error : ', response);
                            }
                        });

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
