@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Import Permission')
{{-- Content Header --}}
@section('content-header', 'Import Permission')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 ">
                    {{-- download excel file --}}
                    <a href="javascript:void(0)" class="btn btn-danger mb-3" id="export-data">
                        <i class="fa-solid fa-download"></i>&nbsp;Export
                    </a>
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('import.permissions') }}"
                            novalidate="" enctype="multipart/form-data">
                            {{-- @method('patch') --}}
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="logo">Import Excel File <small>.xlsx</small></label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="import_file"
                                                    id="import_file">
                                                <label class="custom-file-label" for="import_file">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                        @error('import_file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <button class="btn btn-success mt-2 float-right"><i
                                        class="fa-solid fa-upload"></i>&nbsp;Import</button>

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

            // Store Function
            // $('#modal-form').submit(function(e) {
            //     e.preventDefault();

            //     $('#btn-save').html('Sending...');

            //     // Serialize the form data using FormData
            //     let formData = new FormData($('#modal-form')[0]);

            //     // Send the form data via AJAX using jQuery store function
            //     $.ajax({
            //         // Replace with your route URL
            //         type: 'POST',
            //         url: "{{ route('permission.add') }}",
            //         data: formData,
            //         cache: false,
            //         contentType: false,
            //         processData: false,
            //         success: (response) => {
            //             // Handle the response from the server (if needed)
            //             $('#btn-save').html('Submitted');
            //             $('#modal').modal('hide');
            //             table.draw();
            //             $('#modal-form').trigger("reset");

            //             // Display the message on the page
            //             Swal.fire({
            //                 icon: response.icon,
            //                 title: response.title,
            //                 text: response.message,
            //                 timer: 2000
            //             });
            //         },
            //         error: (response) => {
            //             // Handle the error (if needed)
            //             $('#error').html("<div class='alert alert-danger'>" + response[
            //                     'responseJSON']['message'] +
            //                 "</div>");
            //             $('#btn-save').html('Save');
            //         }
            //     });
            // });

            $('body').on('click', '#export-data', function() {
                var route = "{{ route('export.permission') }}";

                Swal.fire({
                    title: 'Do you want to export permission?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#716add',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Export'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Exporting permission
                        let timerInterval
                        Swal.fire({
                            title: 'Export',
                            html: 'Exporting Permission Data.',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {

                                window.location.href = route;
                            }
                        });
                    }
                })




            });


        });
    </script>
@endsection
