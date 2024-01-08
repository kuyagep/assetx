{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Manage suppliers')
{{-- Content Header --}}
@section('content-header', 'Manage suppliers')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3 ">
                        <div class="col-12">
                            <button id="add-button" class="btn btn-primary mr-2 float-left" title="Add [Alt+A]">
                                <i class="fa-regular fa-square-plus" accesskey="a"></i>&nbsp;Add New
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fas fa-suppliers "></i>&nbsp;List of All Suppliers</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th class="text-center">Status</th>
                                            <th>Remarks</th>
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
                <div class="modal-dialog modal-lg modal-dialog-centered">
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
                                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="phone" name="phone"
                                                placeholder="Ex. 09123456789">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Position <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="position_name" name="position_name">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}">{{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="district_name">District <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="district_name" name="school_name">
                                                <option value="" selected>Select District...</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="school_name">School <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="school_name" name="school_name">
                                                <option value="" selected disabled>Select School...</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="office_name">Office <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="office_name" name="office_name">
                                                <option value="" selected>Choose...</option>
                                                @foreach ($offices as $office)
                                                    <option value="{{ $office->id }}">{{ $office->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="custom-select" name="status" id="status">
                                                <option value="">Select...</option>
                                                <option value="1" selected>Activate</option>
                                                <option value="0">Deactivate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img id="showImage" alt="Avatar" class="table-avatar"
                                            src="{{ asset('assets/dist/img/avatar/default.jpg') }}"
                                            style="width: 100%;max-width: 150px;height: 150px;object-fit: cover; ">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-end">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" title="Close [Alt+C]"
                                    accesskey="c"><i class="fa-solid fa-xmark"></i> Close</button>
                                <button type="submit" class="btn btn-dark" id="btn-save" title="Save [Alt+S]"
                                    accesskey="s">Save</button>
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
                ajax: "{{ url('my/supplier') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center'
                }, {
                    data: 'purchase_number',
                    name: 'purchase_number'
                }, {
                    data: 'purchase_order_number',
                    name: 'purchase_order_number'
                }, {
                    data: 'title',
                    name: 'title'
                }, {
                    data: 'amount',
                    name: 'amount'
                }, {
                    data: 'status',
                    name: 'status',
                    class: 'text-center'
                }, {
                    data: 'created-at',
                    name: 'created-at',
                    class: 'text-center'
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
                $('#error').html('');
                $('#modal').modal("show");
                $('#modal-title').html("Add supplier");
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
                    url: "{{ route('supplier.store') }}",
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
                var route = "{{ route('supplier.edit', ':id') }}";
                route = route.replace(':id', id);
                window.location.href = route;

            });

            // Delete Function
            $('body').on('click', '#deleteButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('supplier.destroy', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this supplier?",
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
