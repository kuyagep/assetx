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
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Add Issuance</h3>

                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <form action="{{ route('issuances.store') }}" method="POST">
                                @csrf
                                <!-- Issuance Code Field -->
                                <div class="form-group">
                                    <label for="issuance_code">Issuance Code:</label>
                                    <input type="text" name="issuance_code" class="form-control" id="issuance_code"
                                        required>
                                </div>

                                <!-- Select Multiple Assets Field -->
                                <div class="form-group">
                                    <label for="assets">Select Assets:</label>
                                    <select name="assets[]" class="form-control " id="assets" multiple required>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->article }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <!-- Issued To User Field -->
                                <div class="form-group">
                                    <label for="issued_to_user_id">Issued To:</label>
                                    <select name="issued_to_user_id" class="form-control" id="issued_to_user_id" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Total Value Field (Display-only, will be updated via Ajax) -->
                                <div class="form-group">
                                    <label for="total_value">Total Value:</label>
                                    <span id="total_value_display">0.00</span>
                                </div>


                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Issue</button>
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

            $('#assets').change(function() {
                // Get the selected assets' values and calculate the total
                var selectedAssets = $(this).val();
                var totalValue = 0;

                selectedAssets.forEach(function(assetId) {
                    var asset = assetId;
                    totalValue += asset.unit_value;
                });

                // Update the Total Value display
                $('#total_value_display').text(totalValue.toFixed(2));
            });


            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

        });
    </script>



@endsection
