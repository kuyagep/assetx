@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Accountability')
{{-- Content Header --}}
@section('content-header', 'Accountability')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-layer-group"></i> List of Accoutabilities</h3>
                            <div class="card-tools">

                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped" loading="lazy">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Asset Name</th>
                                            <th>Issued Date</th>
                                            <th>Amount Cost</th>
                                            <th class="text-center">Status</th>
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

        </div><!--/. container-fluid -->
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
                ajax: "{{ url('client/accountability') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    }, {
                        data: 'issued_at',
                        name: 'issued_at'
                    },
                    {
                        data: 'cost',
                        name: 'cost'
                    }, {
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

        });
    </script>
@endsection
