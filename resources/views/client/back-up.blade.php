@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Back-up Database')
{{-- Content Header --}}
@section('content-header', 'Back-up Database')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-layer-group"></i> Back-up Database</h3>
                            <div class="card-tools">

                            </div>
                            <!-- /.card-tools -->
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="db_name" class="col-sm-2 col-form-label">Database Name: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="db_name" value="project_davaosur_db"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Security Key: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="db_name"
                                        value="136f6b37641a9e0f907a8ba20ebbaab9" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button class="btn btn-info ">Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

@endsection
