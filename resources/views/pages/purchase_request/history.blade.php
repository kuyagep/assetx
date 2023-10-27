{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Manage Purchase Request')
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
                            <button id="add-button" class="btn bg-navy mr-2 float-left">
                                <i class="fa-regular fa-square-plus"></i>&nbsp;Add Purchase Request
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card card-outline card-navy">
                        <div class="card-header">
                            <h3 class="card-title"> Document Trail</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Data Name</th>
                                    <th>Data Name</th>
                                    <th>Data Name</th>
                                    <th>Data Name</th>
                                    <th>Data Name</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                    </tr>
                                    <tr>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                    </tr>
                                    <tr>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                        <td>Data</td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script type="text/javascript">
        $(document).ready(function($) {
            // token header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection
