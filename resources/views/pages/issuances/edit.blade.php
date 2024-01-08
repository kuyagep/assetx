{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Edit Issuance')
{{-- Content Header --}}
@section('content-header', 'Edit Issuance')
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
                                    <h4 class="mb-0">Edit Issuance</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="needs-validation"
                                action="{{ route('issuances.update', $issuance->id) }}">
                                @csrf
                                @method('PUT')
                                {{-- new version --}}
                                <h6 class="heading-small text-muted mb-4">Recipient Information</h6>
                                <input type="hidden" name="id" value="{{ $issuance->id }}">
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
                                                        <option value="{{ $district->id }}"
                                                            {{ $district->id === isset($issuance->issuedTo->user->school->district->id) ? 'selected' : '' }}>
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
                                                        <option value="{{ $schoolOrOffice->id }}"
                                                            @if (empty($issuance->user->school_id)) {{ $schoolOrOffice->id == $issuance->issuedTo->office_id ? 'selected' : '' }}
                                                        @else
                                                         {{ $schoolOrOffice->id === $issuance->issuedTo->school_id ? 'selected' : '' }} @endif>
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
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ $user->id === $issuance->issuedTo->id ? 'selected' : '' }}>
                                                            {{ $user->first_name . ' ' . $user->last_name }}
                                                        </option>
                                                    @endforeach

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
                                                        <option value="{{ $type->id }}"
                                                            {{ $type->id === $issuance->issuance_type_id ? 'selected' : '' }}>
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
                                        Continue</button>
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
