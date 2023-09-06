@extends('partials.main')
@section('page-title', 'Manage Users')
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-users "></i><b> List of User</b></h3>
                                <div class="card-tools">
                                    <a href="javascript:void(0)" id="addNewUserBtn" class="btn btn-primary btn-sm">
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
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th style="width: 8%" class="text-center">Status</th>
                                                <th>Create At</th>
                                                <th width="300px">Action</th>
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
                <div class="modal fade" id="ModalDialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="ModalTitle"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="javascript:void(0)" method="post" name="ModalForm" id="ModalForm"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    {{-- Error Display here --}}
                                    <div id="error"></div>
                                    {{-- Reference Id --}}
                                    <input type="hidden" name="id" id="id">
                                    {{-- Data --}}
                                    <div class="form-group row">
                                        <label for="first_name" class="col-sm-2 col-form-label">First Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="first_name" name="first_name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="last_name" class="col-sm-2 col-form-label">Last Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="last_name" name="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-end">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
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
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function($) {
            // token header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //toastr message
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            // Display data from index controller
            var table = $("#dataTableajax").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                select: true,
                autoWidth: false,
                ajax: "{{ url('admin/users') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    }, {
                        data: 'avatar',
                        name: 'avatar'
                    }, {
                        data: 'first_name',
                        name: 'first_name'
                    }, {
                        data: 'last_name',
                        name: 'last_name'
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
            $('#addNewUserBtn').click(function() {
                $('#error').html('');
                $('#ModalDialog').modal("show");
                $('#ModalTitle').html("Add User");
                $('#btn-save').html("Save User");
                $('#id').val('');
                $('#ModalForm').trigger("reset");
            });

            // Store Function
            $('#ModalForm').submit(function(e) {
                e.preventDefault();

                $('#btn-save').html('Sending...');

                // Serialize the form data using FormData
                let formData = new FormData(this);

                // Send the form data via AJAX using jQuery store function
                $.ajax({
                    // Replace with your route URL
                    url: "{{ route('admin.users.store') }}",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        // Handle the response from the server (if needed)
                        $('#ModalDialog').modal('hide');
                        var oTable = $('#dataTableajax').dataTable();
                        oTable.fnDraw(false);

                        $('#btn-save').html('Submit');
                        $('#btn-save').attr('disabled', false);
                        // Display the message on the page
                        toastr.success(response.message, 'Success');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        });
                    },
                    error: (response) => {
                        // Handle the error (if needed)
                        //console.log(response);
                        $('#error').html("<div class='alert alert-danger'>" + response[
                                'responseJSON']['message'] +
                            "</div>");
                        $('#btn-save').html('Save User');
                    }
                });


            });

            // View Function
            $('body').on('click', '#viewButton', function() {
                $('#btn-save').attr('disabled', true);
                var id = $(this).data('id');
                var route = "{{ route('admin.users.show', ':id') }}";
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
                        $('#ModalTitle').html("View User");
                        $('#ModalDialog').modal("show");
                        $('#id').val(response.id);
                        $('#first_name').val(response.first_name);
                        $('#last_name').val(response.last_name);
                        $('#email').val(response.email);
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
                $('#btn-save').html("Save Changes");
                var id = $(this).data('id');
                var route = "{{ route('admin.users.edit', ':id') }}";
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
                        $('#ModalTitle').html("Edit User");
                        $('#ModalDialog').modal("show");
                        $('#id').val(response.id);
                        $('#first_name').val(response.first_name);
                        $('#last_name').val(response.last_name);
                        $('#email').val(response.email);
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
                var route = "{{ route('admin.users.destroy', ':id') }}";
                route = route.replace(':id', id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
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
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
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
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
