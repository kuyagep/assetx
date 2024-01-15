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
                            {{-- <button id="add-button" class="btn bg-navy mr-2 float-left" accesskey="a">
                                <i class="fa-regular fa-square-plus"></i>&nbsp;Add New
                            </button> --}}
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
                ajax: "{{ url('client/purchase-order') }}",
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


            // View Function
            $('body').on('click', '#viewButton', function() {
                $('#btn-save').attr('disabled', true);

                var id = $(this).data('id');
                var route = "{{ route('client.purchase.order.show', ':id') }}";
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
