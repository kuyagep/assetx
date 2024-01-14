{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Add Issuance')
{{-- Content Header --}}
@section('content-header', 'Add Issuance')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Select Assets</h3>

                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <form action="{{ route('asset_issuance.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="issuanceId" value="{{ $issuance->id }}">
                                <!-- Classification -->
                                <div class="form-group">
                                    <label for="classification_id">Classification:</label>
                                    <select name="classification_id" id="classification_id" class="custom-select" required>
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($classifications as $classification)
                                            <option value="{{ $classification->id }}">{{ $classification->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Select Multiple Assets Field -->
                                <div class="form-group">
                                    <label for="assets">Select Assets:</label>
                                    <select name="assets" class="custom-select" id="assets" required>
                                        <option value="" selected disabled>Select Asset</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="quantity ">Qty:</label>
                                    <input type="number" name="quantity" id="quantity" placeholder="Enter Quantity"
                                        class="form-control">
                                </div>

                                <div class="row  float-right">
                                    <div class="col-12">
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary pull-right">Add to Issuance</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Asset Issuance</h3>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <form action="#" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <!-- Issuance Code Field -->
                                        <div class="form-group">
                                            <label for="issuance_code">Issuance Code:</label>
                                            <input type="text" name="issuance_code" id="" class="form-control"
                                                value="{{ $issuance->issuance_code }}" disabled>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <!-- Issued To User Field -->
                                        <div class="form-group">
                                            <label for="issued_to_user_id">Issued To:</label>
                                            <input type="text" name="" id="" class="form-control"
                                                value="{{ $issuance->issuedTo->first_name }}" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 float-right">
                                        <button class="btn btn-primary ">Add Asset Issuance</button>
                                        <a href="{{ route('asset_issuance.generate', $issuance->id) }}" target="_blank"
                                            class="btn btn-danger ">Generate
                                            Issuance</a>
                                        <button class="btn btn-success mr-2">Preview Issuance</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Select Multiple Assets Field -->
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>

                                            @foreach ($assetIssuances as $assetItem)
                                                <tr>
                                                    <td>{{ $assetItem->id }}</td>
                                                    <td>{{ $assetItem->asset->article }}</td>
                                                    <td>{{ $assetItem->quantity }}</td>
                                                    <td>{{ $assetItem->quantity * $assetItem->asset->unit_value }}</td>
                                                    <td width="150px">
                                                        <button class="btn btn-danger btn-sm">Remove</button>
                                                        <button class="btn btn-warning btn-sm">Edit</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th colspan="3">Total Value</th>
                                                <td>{{ $totalValue }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

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

            $('#classification_id').on('change', function() {
                var id = $(this).val();


                var route = "{{ route('get.asset') }}";
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
                        console.log(data);
                        // Update the assets dropdown with the received data
                        var assetsDropdown = $('#assets');
                        assetsDropdown.empty();

                        $.each(data, function(key, value) {
                            assetsDropdown.append($('<option>', {
                                value: value.id,
                                text: value.article
                            }));
                        });
                    }
                });
            });

        });
    </script>



@endsection
