{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Manage Issuance')
{{-- Content Header --}}
@section('content-header', 'Manage Issuance')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> ALL ISSUANCES</h3>
                            <div class="card-tools">
                                <a href="{{ route('issuances.create') }}" class="btn bg-navy mr-2">
                                    <i class="fa fa-plus mr-1"></i>&nbsp;ADD NEW
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
                                            <th>ISSUANCE CODE</th>
                                            <th>TOTAL VALUE</th>
                                            <th>ISSUED BY</th>
                                            <th>ISSUED TO</th>
                                            <th style="width: 8%" class="text-center">STATUS</th>
                                            <th width="250px">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($issuances as $issuance)
                                            <tr>
                                                <td>{{ $issuance->issuance_code }}</td>
                                                <td>{{ $issuance->total_value }}</td>
                                                <td>{{ $issuance->issuedTo->firstname }}</td>
                                                <td>{{ $issuance->isApproved }}</td>
                                                <td>
                                                    <a href="{{ route('issuances.show', $issuance->id) }}"
                                                        class="btn btn-info">Show</a>
                                                    <a href="{{ route('issuances.edit', $issuance->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('issuances.destroy', $issuance->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
