{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Manage Office')
{{-- Content Header --}}
@section('content-header', 'Manage Office')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3 ">
                        <div class="col-12">
                            <a href="javascript:void(0)" id="add-button" class="btn bg-dark mr-2 float-left" accesskey="a">
                                <i class="fa-solid fa-paper-plane mr-2"></i>&nbsp;Add Office
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> List of Office</h3>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Office</th>
                                            <th>Division</th>
                                            <th>Slug</th>
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
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">Select Division <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="division_name" name="division_name">
                                                <option>Choose...</option>
                                                @foreach ($divisions as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Office Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Ex. Supply">
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

                                </div>

                            </div>
                            <div class="modal-footer justify-end">
                                <button type="button" class="btn btn-danger  px-5" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark btn-save px-5" id="btn-save">Save</button>
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
                ajax: "{{ url('my/offices') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    }, {
                        data: 'name',
                        name: 'name'
                    }, {
                        data: 'division',
                        name: 'division'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
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
                $('#btn-save').attr('disabled', false);
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
                    url: "{{ route('offices.store') }}",
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
                var route = "{{ route('offices.show', ':id') }}";
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

                        $('#name').val(response.name);
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
                var route = "{{ route('offices.edit', ':id') }}";
                route = route.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        var division = response.division;
                        var office = response.office;
                        // console.log(division);
                        // console.log(district);
                        var htmlDivision = "<option value=''>Select Division</option>";
                        $('#id').val(office['id']);
                        $('#division_id').val(response.division_id);
                        $('#name').val(office['name']);
                        $('#status').val(office['status']);

                        for (let i = 0; i < division.length; i++) {
                            if (office['division_id'] === division[i]['id']) {
                                htmlDivision += `<option value="` + division[i]['id'] +
                                    `" selected>` + division[i]['name'] +
                                    `</option>`;
                            } else {
                                htmlDivision += `<option value="` + division[i]['id'] +
                                    `">` + division[i]['name'] +
                                    `</option>`;
                            }
                        }
                        $('#division_name').html(htmlDivision);

                        // console.log(res);
                        $('#modal-title').html("Edit Data");
                        $('#modal').modal("show");

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
                var route = "{{ route('offices.destroy', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this data?",
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
