{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Add Issuance')
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
                            <form action="{{ route('issuances.store') }}" method="POST">
                                @csrf

                                <!-- Classification -->
                                <div class="form-group">
                                    <label for="classification_id">Classification:</label>
                                    <select name="classification_id" id="classification_id" class="custom-select" required>
                                        <option value="" selected disabled>Select</option>
                                        {{-- @foreach ($classifications as $classification)
                                            <option value="{{ $classification->id }}">{{ $classification->name }}
                                            </option>
                                        @endforeach --}}
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
                                    <label for="qty">Qty:</label>
                                    <input type="number" name="qty" id="qty" class="form-control">
                                </div>

                                <!-- Total Value Field (Display-only, will be updated via Ajax) -->
                                <div class="form-group">
                                    <label for="total_value">Total Value:</label>
                                    <span id="total_value_display">0.00</span>
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
                            <form action="{{ route('issuances.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <!-- Issuance Code Field -->
                                        <div class="form-group">
                                            <label for="issuance_code">Issuance Code:</label>
                                            <input type="text" name="" id="" class="form-control"
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
                                <!-- Select Multiple Assets Field -->
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead class="table-dark">
                                                <th>No</th>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Value</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Chair</td>
                                                    <td>1</td>
                                                    <td>8978</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Total Value</th>
                                                    <td>5689</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row float-right">
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary mr-5">Issue Item</button>
                                </div>


                            </form>
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

                var route = "{{ route('get.assets', ':id') }}";
                route = route.replace(':id', id);


                // Make an Ajax request to fetch assets for the selected classification
                $.ajax({
                    url: route,
                    type: 'GET',
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
