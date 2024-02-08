@extends('partials.main')
{{-- page title --}}
@section('title_prefix', 'Edit Supplier')
{{-- Content Header --}}
@section('content-header', 'Edit Supplier')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    {{-- download excel file --}}
                    <button onclick="history.back()" class="btn btn-dark  mb-3 px-3">
                        <i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back
                    </button>
                    <div class="card">
                        <form action="{{ route('suppliers.update', $supplier->id) }}" name="modal-form" id="modal-form"
                            class="form-horizontal" enctype="multipart/form-data" method="post">
                            @csrf

                            <div class="card-body">

                                {{-- Error Display here --}}
                                <div id="error"></div>
                                {{-- Reference Id --}}
                                <input type="hidden" name="id" id="id">
                                {{-- sample --}}
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group mt-2">
                                            <label for="logo">Logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo"
                                                        id="logo">
                                                    <label class="custom-file-label" for="logo">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Supplier Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name', $supplier->name) }}" placeholder="Ex. Juan Store"
                                                autocomplete="true">

                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ old('address', $supplier->address) }}"
                                                placeholder="Ex. Digos City">
                                        </div>
                                        <div class="form-group">
                                            <label for="tin">T.I.N <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tin" name="tin"
                                                value="{{ old('tin', $supplier->tin) }}" placeholder="Ex. 000-222-333-0000">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', $supplier->email) }}"
                                                placeholder="Ex. example@email.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact Number <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="contact" name="contact"
                                                value="{{ old('contact', $supplier->contact) }}"
                                                placeholder="Ex. 09123456789">
                                        </div>

                                        <div class="form-group">
                                            <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bank_name" name="bank_name"
                                                value="{{ old('bank_name', $supplier->bank_name) }}"
                                                placeholder="Ex. Land Bank">
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account_name">Bank Account Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bank_account_name"
                                                value="{{ old('bank_account_name', $supplier->bank_account_name) }}"
                                                name="bank_account_name" placeholder="Ex. Juan Store">
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account_number">Bank Account Number <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bank_account_number"
                                                value="{{ old('bank_account_number', $supplier->bank_account_number) }}"
                                                name="bank_account_number" placeholder="Ex. Juan Store">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="attachment">Attachments</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="attachment"
                                                        id="attachment">
                                                    <label class="custom-file-label" for="attachment">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea name="remarks" id="remarks" class="form-control">{{ old('remarks', $supplier->remarks) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select class="custom-select" name="status" id="status">
                                                <option value="">Select...</option>

                                                <option value="1" {{ $supplier->status == 1 ? 'selected' : '' }}>
                                                    Activate</option>
                                                <option value="0" {{ $supplier->status == 0 ? 'selected' : '' }}>
                                                    Deactivate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img id="showImage" alt="Avatar" class="table-avatar"
                                            src="{{ asset('assets/dist/img/avatar/default.jpg') }}"
                                            style="width: 100%;max-width: 150px;height: 150px;object-fit: cover; ">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary float-right">Submit Changes</button>
                                    </div>
                                </div>

                            </div>
                        </form>
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

            // display image
            $('#avatar').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            // Delete Function
            $('body').on('click', '#deleteButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('admin.destroy', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want delete this user?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Confirmed!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: route,
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {

                                //Sweet Alert
                                Swal.fire({
                                    icon: response.icon,
                                    title: response.title,
                                    text: response.message,
                                    timer: 2000
                                });


                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('all.admin') }}";
                                }, 2000);

                            },
                            error: function(response) {
                                console.log('Error : ', response);
                            }
                        });

                    }
                });

            });

             // display image
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

        });
    </script>
@endsection
