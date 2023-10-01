@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Dashboard')
{{-- Content Header --}}
@section('content-header', 'Dashboard')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <blockquote class="quote-danger">
                        <h5 id="note"><i class="fas fa-bullhorn"></i> Welcome! {{ Auth::user()->first_name }}</h5>
                        <p>This is your main dashboard you can freely navigate. Please Contact support team if you need
                            help through <a href="https://www.facebook.com/projectdavaosur">Facebook Page</a>.</p>
                    </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-info">{{ $purchasesCount }}</h3>
                                    <p class="mb-0 " title="view"><a href="{{ url('admin/purchase') }}"
                                            class="text-dark">Purchase Request</a>
                                    </p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-book-open text-info fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-info" role="progressbar" style="width:100%"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-warning">0</h3>
                                    <p class="mb-0">Issuances</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="far fa-paste text-warning fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"
                                        aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-success">0</h3>
                                    <p class="mb-0">Total Asset</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-qrcode text-success fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-danger">{{ $users }}</h3>
                                    <p class="mb-0">Total Users</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-map-signs text-danger fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
@endsection
@section('script')

@endsection
