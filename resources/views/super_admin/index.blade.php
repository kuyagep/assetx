@extends('partials.main')
{{-- page title --}}
@section('title_prefix', 'Home')
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
                        <p>This is your main dashboard you can freely navigate. Contact support team if you need help.</p>
                    </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-info">278</h3>
                                    <p class="mb-0">New Reports</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-book-open text-info fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
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
                                    <h3 class="text-warning">156</h3>
                                    <p class="mb-0">New Issued</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="far fa-comments text-warning fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 35%"
                                        aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
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
                                    <h3 class="text-success">64.89 %</h3>
                                    <p class="mb-0">Tranfer</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-mug-hot text-success fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%"
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
                                    <h3 class="text-danger">423</h3>
                                    <p class="mb-0">Condenmed</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-map-signs text-danger fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-pencil-alt text-info fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>278</h3>
                                    <p class="mb-0">New Procuments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="far fa-comment-alt text-warning fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>156</h3>
                                    <p class="mb-0">New Issuance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-chart-line text-success fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>45,670</h3>
                                    <p class="mb-0">Accountabilities</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i class="fas fa-map-marker-alt text-danger fa-3x"></i>
                                </div>
                                <div class="text-end">
                                    <h3>4,656,089</h3>
                                    <p class="mb-0">Total Value</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-danger">278</h3>
                                    <p class="mb-0">New Accounts</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-rocket text-danger fa-3x"></i>
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
                                    <h3 class="text-success">156</h3>
                                    <p class="mb-0">New Accoutabiities</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="far fa-user text-success fa-3x"></i>
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
                                    <h3 class="text-warning">345,782</h3>
                                    <p class="mb-0">Inventories</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-chart-pie text-warning fa-3x"></i>
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
                                    <h3 class="text-info">423</h3>
                                    <p class="mb-0">Support Tickets</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="far fa-life-ring text-info fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Section: Minimal statistics cards-->
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center mr-4">
                                        <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Asset Cost</h4>
                                        <p class="mb-0">Yearly Accounts</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">18,000</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center mr-4">
                                        <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                                    </div>
                                    <div>
                                        <h4>Total Feedbacks</h4>
                                        <p class="mb-0">Monthly feedbacks</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">84,695</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center mr-3">
                                        <h2 class="h1 mb-0 me-4">76,456.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Sales</h4>
                                        <p class="mb-0">Monthly Issued Amount</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="far fa-heart text-danger fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center mr-3">
                                        <h2 class="h1 mb-0 me-4">36,000.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Cost</h4>
                                        <p class="mb-0">Monthly Cost</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-wallet text-success fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Section: Statistics with subtitles-->

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

@endsection
