{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Manage Assets Inventories')
{{-- Content Header --}}
@section('content-header', 'Manage Assets Inventories')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> List of Assets Inventories</h3>
                            <div class="card-tools">
                                <a href="{{ route('assets.create') }}" class="btn btn-primary mr-2">
                                    <i class="fa fa-plus mr-1"></i>&nbsp;Add Assets
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
                                            <th>Article</th>
                                            <th>Description</th>
                                            <th>Property No</th>
                                            <th>UOM</th>
                                            <th>Unit Value</th>
                                            <th>Status</th>
                                            <th>Remark</th>
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
                <div class="modal-dialog modal-lg">
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
                                            <label for="name">Select Classification <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select" id="classification_name"
                                                name="classification_name">
                                                <option>Choose...</option>
                                                @foreach ($classifications as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Article <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="article" name="article"
                                                placeholder="Ex. Chairs">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" rows="3" id="description" name="description">Enter Description</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Reference <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="reference" name="reference"
                                                placeholder="Ex. PO #/Date/Invoice No.">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Unit of Measure <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="unit_of_measure"
                                                        name="unit_of_measure" placeholder="Ex. pieces, bundle">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Unit Value <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="unit_value"
                                                        name="unit_value" placeholder="Ex. 2900.00">
                                                </div>
                                            </div>
                                        </div>
                                        <h5>Balance per Card</h5>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Qty <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="balance_per_card_qty"
                                                        name="balance_per_card_qty" placeholder="Ex. 0">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Value <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control"
                                                        id="balance_per_card_value" name="balance_per_card_value"
                                                        placeholder="Ex. 0">
                                                </div>
                                            </div>
                                        </div>
                                        <h5>On Hand per Count</h5>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Qty <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="onhand_per_count_qty"
                                                        name="onhand_per_count_qty" placeholder="Ex. 0">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Value <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control"
                                                        id="onhand_per_count_value" name="onhand_per_count_value"
                                                        placeholder="Ex. 0">
                                                </div>
                                            </div>
                                        </div>
                                        <h5>Shortage Overage</h5>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Qty <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="shortage_overage_qty"
                                                        name="shortage_overage_qty" placeholder="Ex. 0">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Value <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control"
                                                        id="shortage_overage_value" name="shortage_overage_value"
                                                        placeholder="Ex. 0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Date Acquired <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="date_acquired"
                                                        name="date_acquired">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="name">Asset Status <span
                                                            class="text-danger">*</span></label>
                                                    <select class="custom-select" id="asset_status_id"
                                                        name="asset_status_id">
                                                        <option>Choose...</option>
                                                        @foreach ($asset_status as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

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
                ajax: "{{ url('my/assets') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    }, {
                        data: 'article',
                        name: 'article'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    }, {
                        data: 'property_no',
                        name: 'property_no'
                    }, {
                        data: 'unit_of_measure',
                        name: 'unit_of_measure'
                    }, {
                        data: 'unit_value',
                        name: 'unit_value'
                    }, {
                        data: 'asset_status',
                        name: 'asset_status'
                    }, {
                        data: 'remarks',
                        name: 'remarks',
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
                    url: "{{ route('assets.store') }}",
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
                var route = "{{ route('assets.show', ':id') }}";
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
                var route = "{{ route('assets.edit', ':id') }}";
                route = route.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        var asset = response.asset;
                        var classification = response.classification;
                        var asset_status = response.asset_status;
                        var issuances = response.issuances;
                        // console.log(division);
                        // console.log(district);
                        var htmlclassification =
                            "<option value=''>Select Classification</option>";
                        var htmlasset_status =
                            "<option value=''>Select Asset Status</option>";

                        $('#id').val(asset['id']);
                        $('#article').val(asset['article']);
                        $('#description').val(asset['description']);
                        $('#reference').val(asset['reference']);
                        $('#unit_of_measure').val(asset['unit_of_measure']);
                        $('#unit_value').val(asset['unit_value']);
                        $('#balance_per_card_qty').val(asset['balance_per_card_qty']);
                        $('#balance_per_card_value').val(asset['balance_per_card_value']);
                        $('#onhand_per_count_qty').val(asset['onhand_per_count_qty']);
                        $('#balance_per_card_value').val(asset['balance_per_card_value']);
                        $('#shortage_overage_qty').val(asset['shortage_overage_qty']);
                        $('#shortage_overage_value').val(asset['shortage_overage_value']);
                        $('#date_acquired').val(asset['date_acquired']);
                        $('#remarks').val(asset['remarks']);

                        for (let i = 0; i < classification.length; i++) {
                            if (asset['classification_id'] === classification[i]['id']) {
                                htmlclassification += `<option value="` + classification[i][
                                        'id'
                                    ] +
                                    `" selected>` + classification[i]['name'] +
                                    `</option>`;
                            } else {
                                htmlclassification += `<option value="` + classification[i][
                                        'id'
                                    ] +
                                    `">` + classification[i]['name'] +
                                    `</option>`;
                            }
                        }
                        $('#classification_name').html(htmlclassification);


                        for (let i = 0; i < asset_status.length; i++) {
                            if (asset['asset_status_id'] === asset_status[i]['id']) {
                                htmlasset_status += `<option value="` + asset_status[i][
                                        'id'
                                    ] +
                                    `" selected>` + asset_status[i]['name'] +
                                    `</option>`;
                            } else {
                                htmlasset_status += `<option value="` + asset_status[i][
                                        'id'
                                    ] +
                                    `">` + asset_status[i]['name'] +
                                    `</option>`;
                            }
                        }
                        $('#asset_status_id').html(htmlasset_status);

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
                var route = "{{ route('districts.destroy', ':id') }}";
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
