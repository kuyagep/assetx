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
                            <div class="table-responsive" id="">
                                <table id="dataTable" class="table table-bordered table-striped ">
                                    <thead class="text-center align-items">
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Article</th>
                                            <th rowspan="2">Description</th>
                                            <th rowspan="2">Refference</th>
                                            <th rowspan="2">Property No</th>
                                            <th rowspan="2">UOM</th>
                                            <th rowspan="2">Unit Value</th>
                                            <th colspan="2">Balance per Card</th>
                                            <th colspan="2">Onhand per Card</th>
                                            <th colspan="2"> Shortage Overage</th>
                                            <th rowspan="2">Classification</th>
                                            <th rowspan="2">Status</th>
                                            <th rowspan="2">Remark</th>
                                            <th rowspan="2" width="250px">Action</th>
                                        </tr>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Value</th>
                                            <th>Qty</th>
                                            <th>Value</th>
                                            <th>Qty</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($assets as $asset)
                                            <tr>
                                                <td>{{ $asset->id }}</td>
                                                <td>{{ $asset->article }}</td>
                                                <td>{{ $asset->description }}</td>
                                                <td>{{ $asset->reference }}</td>
                                                <td>{{ $asset->property_no }}</td>
                                                <td>{{ $asset->unit_of_measure }}</td>
                                                <td>{{ $asset->unit_value }}</td>
                                                <td>{{ $asset->balance_per_card_qty }}</td>
                                                <td>{{ $asset->balance_per_card_value }}</td>
                                                <td>{{ $asset->onhand_per_count_qty }}</td>
                                                <td>{{ $asset->onhand_per_count_value }}</td>
                                                <td>{{ $asset->shortage_overage_qty }}</td>
                                                <td>{{ $asset->shortage_overage_value }}</td>
                                                <td>{{ $asset->classification->name }}</td>
                                                <td>{{ $asset->status->name }}</td>
                                                <td>{{ $asset->remarks }}</td>
                                                <td>
                                                    <a href="" class="btn bg-navy btn-sm" title="View"><i
                                                            class="fa-solid fa-circle-info"></i></a>
                                                    <a href="{{ route('assets.edit', $asset->id) }}"
                                                        class="btn btn-warning btn-sm"><i
                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                    <form method="POST"
                                                        action="{{ route('assets.destroy', $asset->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa-solid fa-trash-can"></i></button>
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

            // var table = $("#dataTable").DataTable();

        });
    </script>
@endsection
