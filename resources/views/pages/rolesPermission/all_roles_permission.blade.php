{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Roles Permission')
{{-- Content Header --}}
@section('content-header', 'All Roles Permission')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="javascript:void(0)" id="add-button" class="btn btn-primary mr-2" title="Add data">
                                <i class="fa-regular fa-square-plus"></i>&nbsp;Add Roles
                            </a>
                            <a href="{{ route('super_admin.import.permission') }}" class="btn btn-success mr-2"
                                title="Import Excel">
                                <i class="fa-solid fa-upload"></i>&nbsp;Import
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger mr-2" title="Export to Excel">
                                <i class="fa-solid fa-download"></i>&nbsp;Export
                            </a>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> All Roles</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role Name</th>
                                            <th>Permission</th>
                                            <th>Action</th>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Role Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder=" ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-end">
                                <button type="button" class="btn btn-default px-4" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-secondary btn-save px-4" id="btn-save">Save</button>
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
                lengthChange: false,
                searching: false,
                processing: true,
                serverSide: true,
                select: true,
                autoWidth: false,
                ajax: "{{ url('s/roles/permission/all') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'permission',
                    name: 'permission'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                }, ],
                order: [
                    [0, 'desc']
                ]
            });

            // Add Button Function
            $('#add-button').click(function() {
                $('#btn-save').attr('disabled', false);
                $('#error').html('');
                $('#modal').modal("show");
                $('#modal-title').html("Add Role");
                $('#btn-save').html('Save');
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
                    url: "{{ route('super_admin.roles.add') }}",
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

            // Edit Function
            $('body').on('click', '#editButton', function() {
                $('#btn-save').attr('disabled', false);
                // $('#ModalForm').attr("id", "editModalForm");
                $('#btn-save').html("Save Changes");
                var id = $(this).data('id');
                var route = "{{ route('super_admin.roles.permission.edit', ':id') }}";
                route = route.replace(':id', id);
                window.location.href = route;
                // $.ajax({
                //     type: "GET",
                //     url: route,
                //     data: {
                //         id: id
                //     },
                //     dataType: 'json',
                //     success: function(response) {
                //         $('#modal-title').html("Edit Data");
                //         $('#modal').modal("show");
                //         $('#id').val(response.id);
                //         $('#name').val(response.name);
                //         $('#error').html('');

                //     },
                //     error: function(response) {
                //         console.log(response);
                //     }
                // });
            });

            // Delete Function
            $('body').on('click', '#deleteButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('super_admin.roles.permission.destroy', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this role?",
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

        });
    </script>
@endsection
