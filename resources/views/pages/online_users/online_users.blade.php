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
                            <h5><i class="fas fa-users "></i>&nbsp;Online Users</h5>
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
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th class="text-center">Status</th>
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
                ajax: "{{ url('my/online/users') }}",
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
                        data: 'phone',
                        name: 'phone'
                    }, {
                        data: 'role',
                        name: 'role'
                    }, {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
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
                $('#modal-title').html("Add User");
                $('#btn-save').html("Save");
                // <iclass='fa-regular fa-floppy-disk'></>Save

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
                    url: "{{ route('user.store') }}",
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


            // Edit Function
            $('body').on('click', '#editButton', function() {
                $('#btn-save').attr('disabled', false);
                // $('#ModalForm').attr("id", "editModalForm");
                var id = $(this).data('id');
                var route = "{{ route('user.edit', ':id') }}";
                route = route.replace(':id', id);
                window.location.href = route;

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
