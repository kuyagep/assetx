{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Create Issuance')
{{-- Content Header --}}
@section('content-header', 'Create Issuance')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 order-xl">
                    <div class="card">

                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h4 class="mb-0">Create Issuance</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" class="needs-validation" action="{{ route('issuances.store') }}">
                                @csrf
                                {{-- new version --}}
                                <h6 class="heading-small text-muted mb-4">Recipient Information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Division</label>
                                                <input type="text" id="division" name="division"
                                                    value="{{ Auth::user()->office->division->name }}" class="form-control"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="district">District</label>
                                                <select name="district" id="district" class="custom-select">
                                                    <option value="" selected>Select District</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}">
                                                            {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('district')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="school">School/Office</label>
                                                <select name="schoolOrOffice" id="schoolOrOffice" class="custom-select"
                                                    required>
                                                    <option value="" selected>Select School/Office</option>
                                                    @foreach ($schoolOrOffices as $schoolOrOffice)
                                                        <option value="{{ $schoolOrOffice->id }}">
                                                            {{ $schoolOrOffice->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('schoolOrOffice')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="issued_to">Issued to</label>
                                                <select name="issued_to" id="issued_to" class="custom-select" required>
                                                    <option value="" selected>Select Recipient</option>

                                                </select>
                                                @error('issued_to')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr class="my-4">

                                <h6 class="heading-small text-muted mb-4">Type of Issuance</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="issuance_type">Type</label>
                                                <select name="issuance_type" id="issuance_type" class="custom-select"
                                                    required>
                                                    <option value="" selected>Select Issuance Type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('phone')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row float-right mt-3">
                                    <button type="submit" class="btn bg-navy"><i class="fa-regular fa-floppy-disk"></i>
                                        Create Issuance</button>
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

            $('#district').on('change', function() {
                var id = $(this).val();
                var route = "{{ route('get.school.office') }}";
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
                        var assetsDropdown = $('#schoolOrOffice');
                        assetsDropdown.empty();

                        $.each(data, function(key, value) {
                            assetsDropdown.append($('<option>', {
                                value: value.id,
                                text: value.name
                            }));
                        });
                    }
                });
            });


            $('#schoolOrOffice').on('change', function() {
                var id = $(this).val();
                var district_id = $('#district').val();

                var route = "{{ route('get.issued.to') }}";
                // route = route.replace(':id', id);


                // Make an Ajax request to fetch assets for the selected classification
                $.ajax({
                    url: route,
                    type: 'GET',
                    data: {
                        district_id: district_id,
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        // Update the assets dropdown with the received data
                        var assetsDropdown = $('#issued_to');
                        assetsDropdown.empty();

                        $.each(data, function(key, value) {
                            assetsDropdown.append($('<option>', {
                                value: value.id,
                                text: value.first_name + " " + value
                                    .last_name
                            }));
                        });
                    }
                });
            });

        });
    </script>



@endsection
