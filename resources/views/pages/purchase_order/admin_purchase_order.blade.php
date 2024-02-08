{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Manage Purchase Order')
{{-- Content Header --}}
@section('content-header', 'Manage Purchase Order')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3 ">
                        <div class="col-12">
                            <button id="add-button" class="btn btn-success mr-2 float-left" accesskey="a">
                                <i class="fa-regular fa-square-plus"></i>&nbsp;Add Purchase Order
                            </button>
                            <button href="javascript:void(0)" class="btn btn-danger" id="export-data" title="Export Excel">
                                <i class="fas fa-file-excel"></i>&nbsp;Export
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card card-outline card-navy">
                        <div class="card-header">
                            <h3 class="card-title"> All Purchase Order</h3>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>PR NO.</th>
                                            <th>PO NO.</th>
                                            <th>Title of Activity</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                            <th>Submitted At</th>
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
            <div class="modal fade " id="modal">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" accesskey="c">
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
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="po_category">Category <span class="text-danger"
                                                    title="important">*</span></label>
                                            <select class="custom-select" name="po_category" id="po_category">
                                                <option selected disabled>Select Category...</option>
                                                <option value="catering-services">Catering & Services</option>
                                                <option value="goods-services">Goods & Services</option>
                                                <option value="furniture-fixtures">Furniture & Fixtures</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="purchase_id">PR No. <span class="text-danger"
                                                    title="important">*</span></label>
                                            <select class="custom-select" name="purchase_id" id="purchase_id" required>
                                                <option selected disabled>Select...</option>
                                                @forelse ($purchases as $purchase)
                                                    <option value="{{ $purchase->id }}">
                                                        {{ $purchase->purchase_number . ' ' . $purchase->title }}
                                                    </option>
                                                @empty
                                                    <option value="">No data found!</option>
                                                @endforelse


                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="supplier_id">Supplier <span class="text-danger"
                                                    title="important">*</span></label>
                                            <select class="custom-select" name="supplier_id" id="supplier_id" required>
                                                <option selected disabled>Select Supplier...</option>
                                                @forelse ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">
                                                        {{ $supplier->name }}
                                                    </option>
                                                @empty
                                                    <option value="">No data found!</option>
                                                @endforelse


                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="po_date">PO Date <span class="text-danger"
                                                    title="important">*</span></label>
                                            <input type="date" class="form-control" id="po_date"_date name="po_date"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="amount">PO Total Amount <span class="text-danger"
                                                    title="important">*</span></label>
                                            <input type="currency" class="form-control" id="amount" name="amount"
                                                placeholder="Ex. 12345.00" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="logo">Upload Attachment <small>.xlsx, .xls</small></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="attachment"
                                                        id="attachment">
                                                    <label class="custom-file-label" for="logo">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="remarks">Remarks <span class="text-danger"
                                                    title="important">*</span></label>
                                            <textarea class="form-control" id="remarks" name="remarks" placeholder="Type here"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row float-right my-3  ">
                                    <div class="col-12">
                                        <button type="submit" class="btn bg-navy btn-save" accesskey="s"
                                            id="btn-save">Save</button>
                                    </div>
                                </div>
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

    {{-- dataTable --}}
    <script>
        $(function() {
            $("#dataTable").DataTable({
                "responsive": true,
                "searching": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
        });
    </script>
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
                ajax: "{{ url('my/purchase-order') }}",
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
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-center'
                    }, {
                        data: 'remarks',
                        name: 'remarks'
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
                $('#modal-title').html("Create New Purchase Order");
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
                    url: "{{ route('purchase.order.store') }}",
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
                var route = "{{ route('purchase.order.show', ':id') }}";
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
                        $('#supplier_id').val(response.supplier_id);
                        $('#po_date').val(response.po_date);
                        $('#amount').val(response.amount);
                        $('#remarks').val(response.remarks);
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
                var route = "{{ route('purchase.order.edit', ':id') }}";
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
                        $('#title').val(response.title);
                        $('#src_fund').val(response.src_fund);
                        $('#amount_abc').val(response.amount);
                        $('#isApproved').val(response.isApproved);
                        $('#alt_mode_procurement').val(response.alt_mode_procurement);
                        $('#get_started').val(response.get_started);
                        $('#error').html('');

                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            //Download Function
            $('body').on('click', '#history-button', function() {

                var id = $(this).data('id');
                var route = "{{ route('client.purchase.order.history', ':id') }}";
                route = route.replace(':id', id);
                window.location.href = route;

            });

            //Download Function


            $('body').on('click', '#export-data', function() {
                var route = "{{ route('client.export.purchase.order') }}";

                Swal.fire({
                    title: 'Do you want to export purchase order?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#716add',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Export'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Exporting permission
                        let timerInterval
                        Swal.fire({
                            title: 'Exporting',
                            html: 'Exporting Purchase Order to Excel.',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {

                                window.location.href = route;
                            }
                        });
                    }
                });
            });

            ////////////////////////getting schools
            $('#purchase_request').on('change', function() {
                var id = $(this).val();


                var route = "{{ route('client.get.purchase.request') }}";
                // route = route.replace(':id', id);


                // Make an Ajax request to fetch assets for the selected classification
                $.ajax({
                    url: route,
                    type: 'GET',
                    data: {

                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Update the assets dropdown with the received data
                        var assetsDropdown = $('#purchase_request');
                        assetsDropdown.empty();

                        $.each(data, function(key, value) {
                            assetsDropdown.append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                    }
                });
            });


        });
    </script>
@endsection
