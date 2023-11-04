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
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Edit Asset</h3>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" id="id" name="id" value="{{ $asset->id }}">

                                <!-- Article -->
                                <div class="form-group">
                                    <label for="article">Article:</label>
                                    <input type="text" name="article" id="article" class="form-control"
                                        value="{{ old('article', $asset->article) }}" required>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <input type="text" name="description" id="description" class="form-control"
                                        value="{{ old('description', $asset->description) }}" required>
                                </div>

                                <!-- Reference -->
                                <div class="form-group">
                                    <label for="reference">Reference:</label>
                                    <input type="text" name="reference" id="reference" class="form-control"
                                        value="{{ old('reference', $asset->reference) }}">
                                </div>

                                <!-- Unit of Measure -->
                                <div class="form-group">
                                    <label for="unit_of_measure">Unit of Measure:</label>
                                    <input type="text" name="unit_of_measure" id="unit_of_measure" class="form-control"
                                        value="{{ old('unit_of_measure', $asset->unit_of_measure) }}" required>
                                </div>

                                <!-- Unit Value -->
                                <div class="form-group">
                                    <label for="unit_value">Unit Value:</label>
                                    <input type="number" step="0.01" name="unit_value" id="unit_value"
                                        class="form-control" value="{{ old('unit_value', $asset->unit_value) }}" required>
                                </div>

                                <!-- Balance per Card Quantity -->
                                <div class="form-group">
                                    <label for="balance_per_card_qty">Balance per Card Quantity:</label>
                                    <input type="number" name="balance_per_card_qty" id="balance_per_card_qty"
                                        class="form-control"
                                        value="{{ old('balance_per_card_qty', $asset->balance_per_card_qty) }}" required>
                                </div>

                                <!-- Date Acquired -->
                                <div class="form-group">
                                    <label for="date_acquired">Date Acquired:</label>
                                    <input type="date" name="date_acquired" id="date_acquired" class="form-control"
                                        value="{{ old('date_acquired', $asset->date_acquired) }}" required>
                                </div>

                                <!-- Remarks -->
                                <div class="form-group">
                                    <label for="remarks">Remarks:</label>
                                    <textarea name="remarks" id="remarks" class="form-control">{{ old('remarks', $asset->remarks) }}</textarea>
                                </div>

                                <!-- Classification -->
                                <div class="form-group">
                                    <label for="classification_id">Classification:</label>
                                    <select name="classification_id" id="classification_id" class="form-control" required>
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($classifications as $classification)
                                            <option value="{{ $classification->id }}"
                                                {{ $classification->id == $asset->classification_id ? 'selected' : '' }}>
                                                {{ $classification->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status_id">Status:</label>
                                    <select name="status_id" id="status_id" class="form-control" required>
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($asset_status as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $status->id == $asset->status_id ? 'selected' : '' }}>
                                                {{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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

        });
    </script>
@endsection
