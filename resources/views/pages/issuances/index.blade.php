{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Manage Issuance')
{{-- Content Header --}}
@section('content-header', 'Manage Issuance')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3 ">
                        <div class="col-12">
                            <a href="{{ route('issuances.create') }}" class="btn bg-dark mr-2 float-left" accesskey="a">
                                <i class="fa-solid fa-paper-plane mr-2"></i>Add Issuance
                            </a>
                            <button href="javascript:void(0)" class="btn btn-danger" id="export-data" title="Export Excel">
                                <i class="fas fa-file-excel mr-2"></i>Export Issuance
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold"> All Issuances</h3>
                            {{-- <div class="card-tools">
                                <a href="{{ route('issuances.create') }}" class="btn bg-navy mr-2">
                                    <i class="fa fa-plus mr-1"></i>&nbsp;ADD NEW
                                </a>
                            </div> --}}
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableajax" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Issuance Code</th>
                                            <th>Issued By</th>
                                            <th>Issued To</th>
                                            <th class="text-center">Status</th>
                                            <th width="250px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($issuances as $issuance)
                                            <tr>
                                                <td>{{ $issuance->id }}</td>
                                                <td>{{ $issuance->issuance_code }}</td>
                                                <td>{{ $issuance->issuedBy->first_name . ' ' . $issuance->issuedBy->last_name }}
                                                </td>
                                                <td>{{ $issuance->issuedTo->first_name . ' ' . $issuance->issuedTo->last_name }}
                                                </td>
                                                <td class="text-center">

                                                    @if ($issuance->isApproved)
                                                        <span class="badge badge-primary">Approved</span>
                                                    @else
                                                        <span class="badge badge-warning">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('issuances.show', $issuance->id) }}"
                                                        class="btn btn-info btn-sm">Show</a>
                                                    <a href="{{ route('issuances.edit', $issuance->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('issuances.destroy', $issuance->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Nothing Found!</td>
                                            </tr>
                                        @endforelse
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
