{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Manage Purchase Request')
{{-- Content Header --}}
@section('content-header', 'Manage Purchase Request')
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
                                <i class="fa-solid fa-paper-plane mr-2"></i>&nbsp;Submit New PR
                            </button>
                            <button href="javascript:void(0)" class="btn btn-danger" id="export-data" title="Export Excel">
                                <i class="fas fa-file-excel"></i>&nbsp;Export PR
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card card-outline card-dark">
                        <div class="card-header">
                            <h3 class="card-title">
                                <b><i class="fa-solid fa-ellipsis-vertical mr-2"></i> All Purchase Request</b>
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>PR NO.</th>
                                            <th>Title of Activity</th>
                                            <th>Source of Fund</th>
                                            <th>Amount ABC</th>
                                            {{-- <th>Office</th> --}}
                                            <th>Status</th>
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
            <div class="modal fade" id="modal">
                <div class="modal-dialog modal-lg ">
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
                                            <label for="get_started">Get Started <span class="text-danger"
                                                    title="important">*</span></label>
                                            <select class="custom-select" name="get_started" id="get_started">
                                                <option selected disabled>Select...</option>
                                                <option value="new-bid">New Bid</option>
                                                <option value="rebid-1">Re-Bid 1</option>
                                                <option value="rebid-2">Re-Bid 2</option>
                                                <option value="rebid-3">Re-Bid 3</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="alt_mode_procurement">Alternative Mode of Procurement <span
                                                    class="text-danger" title="important">*</span></label>
                                            <select class="custom-select" name="alt_mode_procurement"
                                                id="alt_mode_procurement">
                                                <option selected disabled>Select...</option>
                                                <option value="Shopping">Shopping</option>
                                                <option value="Direct Contracting">Direct Contracting</option>
                                                <option value="Repeat Order">Repeat Order</option>
                                                <option value="egotiated Procurement">Negotiated Procurement</option>
                                                <option value="Limited Source Bidding">Limited Source Bidding</option>
                                                <option value="Emergency Purchase">Emergency Purchase</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title">Title of Activity <span class="text-danger"
                                                    title="important">*</span></label>
                                            <textarea class="form-control" id="title" name="title" placeholder="Title/Purpose"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="src_fund">Source of Fund <span class="text-danger"
                                                    title="important">*</span></label>
                                            <input list="src_fund_list" class="form-control" id="src_fund" name="src_fund"
                                                placeholder="Ex. Division MOOE">
                                            <datalist id="src_fund_list">
                                                <option value="Division MOOE - CID">
                                                <option value="Division MOOE - CID">
                                                <option value="Division MOOE - SGOD">
                                                <option value="CAPITAL OUTLAY">
                                                <option value="SCHOOL MOOE">
                                                <option value="INSET FUNDS">
                                                <option value="Division MOOE">
                                                <option value="Division MOOE">
                                                <option value="HRTD FUNDS - SGOD">
                                                <option value="HRTD FUNDS">
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="amount_abc">Amount (ABC) <span class="text-danger"
                                                    title="important">*</span></label>
                                            <input type="currency" class="form-control" id="amount_abc"
                                                name="amount_abc" placeholder="Ex. 67997.00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="attachment">Upload Attachment <small>.xlsx, .xls</small><span
                                                    class="text-danger" title="important">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="attachment"
                                                        id="attachment">
                                                    <label class="custom-file-label" for="attachment">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @role('super-admin')
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="isApproved">Approval <span class="text-danger"
                                                        title="important">*</span></label>
                                                <select class="custom-select" name="isApproved" id="isApproved">
                                                    <option>Select...</option>
                                                    <option value="approved" selected>Approved</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="cancelled">Cancelled</option>
                                                    <option value="rebid">Rebid</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endrole

                                <div class="row float-right my-3  ">
                                    <div class="col-12">
                                        <button type="submit" class="btn bg-dark btn-save" accesskey="s"
                                            id="btn-save">Submit</button>
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
                ajax: "{{ url('my/purchase') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center'
                    }, {
                        data: 'purchase_number',
                        name: 'purchase_number'
                    }, {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'src_fund',
                        name: 'src_fund'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    // {
                    //     data: 'office',
                    //     name: 'office'
                    // },
                    {
                        data: 'isApproved',
                        name: 'isApproved',
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
                $('#btn-save').html("Submit");
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
                    url: "{{ route('purchase.store') }}",
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
                var route = "{{ route('purchase.show', ':id') }}";
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
                        $('#budget').val(response.budget);
                        $('#isApproved').val(response.isApproved);
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
                var route = "{{ route('purchase.edit', ':id') }}";
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
                var route = "{{ route('purchase.history', ':id') }}";
                route = route.replace(':id', id);
                window.location.href = route;

            });
            //Download Function
            $('body').on('click', '#downloadButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('purchase.download', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to download this file?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Download'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = route;
                    }

                });

            });

            //approval Function
            $('body').on('click', '#approvedButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('super_admin.purchase.approved', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to approved this purchase request?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Approved!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "PUT",
                            url: route,
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                // console.log(response);
                                table.draw();
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
            // Delete Function
            $('body').on('click', '#deleteButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('purchase.destroy', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this purchase request permanently?",
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
                                // console.log(response);
                                table.draw();
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


            $('body').on('click', '#export-data', function() {
                var route = "{{ route('export.purchase.request') }}";

                Swal.fire({
                    title: 'Do you want to export purchase request?',
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
                            title: 'Export',
                            html: 'Exporting Purchase Request to Excel.',
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


        });
    </script>
@endsection
