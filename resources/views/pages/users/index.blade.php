@extends('partials.main')
@section('title', 'Dashboard')
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
                                <h3 class="card-title"><b>List of Products</b></h3>
                                <div class="card-tools">
                                    <!-- Buttons, labels, and many other things can be placed here! -->

                                    {{-- <a class="btn bg-olive" onClick="add()" href="javascript:void(0)">
                                        <i class="fa fa-user-plus"></i>&nbsp;ADD NEW PRODUCT
                                    </a> --}}
                                    {{-- new button --}}
                                    <a href="javascript:void(0)" id="addNewUserBtn" class="btn bg-olive">
                                        <i class="fa fa-plus"></i>&nbsp;Add New Product
                                    </a>
                                </div>
                                <!-- /.card-tools -->
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTableajax" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Create At</th>
                                                <th width="200px">Action</th>
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
                                    <div id="error"></div>
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Product Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="name" name="name"
                                                class="form-control" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-2 col-form-label">Price <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="price" name="price"
                                                placeholder="Enter Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-2 col-form-label">Product Image <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-10 offset-2">
                                            <img id="showImage" alt="image"
                                                src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/product/' . Auth::user()->avatar) : asset('assets/dist/img/product/no_image.jpg') }}"
                                                class="rounded-circle author-box-picture"
                                                style="width: 80px;max-width: 80px;height: 80px;object-fit: cover;">
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

            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                        data: 'image',
                        name: 'image'
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
                        name: 'status'
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


            $('#addNewUserBtn').click(function() {
                $('#error').html('');
                $('#ModalDialog').modal("show");
                $('#ModalTitle').html("Add Product");
                $('#btn-save').html("Save User");
                $('#id').val('');
                $('#ModalForm').trigger("reset");
            });

            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            $('body').on('click', '#editButton', function() {
                $('#btn-save').html("Save User");
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
                    success: function(res) {
                        // console.log(res);
                        $('#ModalTitle').html("Edit User");
                        $('#ModalDialog').modal("show");
                        $('#id').val(res.id);
                        $('#name').val(res.name);
                        $('#price').val(res.price);
                        $('#image').val(res.image);
                        $('#error').html('');
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            });

            $('#ModalForm').submit(function(event) {
                event.preventDefault();

                $('#btn-save').html('Sending...');

                // Serialize the form data using FormData
                const formData = new FormData(this);

                // Send the form data via AJAX using jQuery
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
                        console.log(response);
                        $('#error').html("<div class='alert alert-danger'>" + response[
                                'responseJSON']['message'] +
                            "</div>");
                        $('#btn-save').html('Save User');
                    }
                });
            });

            $('body').on('click', '#deleteButton', function() {
                var id = $(this).data('id');
                var route = "{{ route('admin.users.destroy', ':id') }}";
                route = route.replace(':id', id);
                if (confirm('Are you sure to delete this data?') == true) {
                    $.ajax({
                        type: "DELETE",
                        url: route,
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            var oTable = $('#dataTableajax').dataTable();
                            oTable.fnDraw(false)
                        },
                        error: function(res) {
                            console.log('Error : ', res);
                        }
                    });
                }

            });




        });
    </script>
@endsection
