@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Home')
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
            <!-- Info boxes -->
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">INFORMATION COMMUNICATION AND TECHNOLOGY
                                EQUIPMENT
                            </span>
                            <span class="info-box-number">
                                10
                                <small>%</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">OTHER MACHINERY AND EQUIPMENT</span>
                            <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">IT EQUIPMENT AND SOFTWARE</span>
                            <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">FURNITURE AND FIXTURE</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">LAND INVENTORY</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">MEDICAL AND DENTAL EQUIPMENT</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">BUILDING INVENTORY</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TVL SPECIALIZATION TOOLS AND EQUIPMENT</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">TRANSPORTATION AND EQUIPMENT</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">DISTRICTS</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">SECONDARY SCHOOLS</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">ELEMENTARY SCHOOLS</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        const xValues = ["SULOP", "MALALAG", "PADADA", "HAGONOY 1", "HAGONOY 2"];
        const yValues = [55, 49, 44, 24, 15];
        const barColors = ["red", "red", "red", "red", "red"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "World Wine Production 2018"
                }
            }
        });
    </script>
@endsection
