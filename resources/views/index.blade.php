@extends('partials.frontend.main')

@section('title', 'HOME')

@section('content')
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    {{-- <div class="col-sm-6">
                        <h1 class="m-0"> Division Asset MS <small>Version 0.2.9</small></h1>
                    </div> --}}
                    <!-- /.col -->
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <div class="time" id="time"> </div> &nbsp; &nbsp;

                        </ol>
                    </div> --}}
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                </li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('brand_logo/DAMS-Dashboard.jpg') }}" class="d-block w-100"
                                        alt="hero banner">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('brand_logo/hero-2.png') }}" class="d-block w-100" alt="hero banner">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('brand_logo/hero-3.png') }}" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->

                </div>
                <!-- /.row -->
                <div class="modal fade" id="data-privacy-notice" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Data Privacy Notice</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="entry-content">

                                    <p>In accordance with the Department of Education’s (DepEd) mandate to protect and
                                        promote the
                                        right to and access to quality basic education, DepEd collects various data and
                                        information,
                                        including personal information, from various subjects using different systems.</p>



                                    <p>In the processing of these data and information, DepEd is committed to ensure the
                                        free flow
                                        of information as required under the&nbsp;<em>Freedom of Information
                                            Act</em>&nbsp;(Executive Order No. 2, s. 2016) and to protect and respect the
                                        confidentiality and privacy of these data and information as required under
                                        the&nbsp;<em>Data Privacy Act of 2012</em>&nbsp;(Republic Act No. 10173).</p>



                                    <p>Request for data and information, unless access is denied when such data and
                                        information fall
                                        under any of the exceptions enshrined in the Constitution, existing law or
                                        jurisprudence,
                                        shall be guided by the&nbsp;<em>DepEd Freedom of Information
                                            Manual</em>&nbsp;(Department
                                        Order No. 72, s. 2016).</p>



                                    <p>Only authorized DepEd personnel have access to personal information collected, the
                                        exchange
                                        of which will be facilitated through email and web applications. These will be
                                        stored in a
                                        database in accordance with government policies, rules, regulations, and guidelines.
                                    </p>



                                    <p>You have the right to ask for a copy of any personal information DepEd holds about
                                        you, as
                                        well as the right to ask for its correction, if found erroneous, or deletion on
                                        reasonable
                                        grounds. You may contact&nbsp;<a
                                            href="mailto:deped.davaodelsur@deped.gov.ph">deped.davaodelsur@deped.gov.ph</a>.
                                    </p>



                                    <h2 class="wp-block-heading">WEBSITE ANALYTICS</h2>



                                    <p>The DepEd uses Google analytics, a third-party service to analyze the web traffic
                                        data for
                                        us. This service uses cookies. Data generated are not shared with any other party.
                                        Only
                                        non-identifiable web traffic data are analyzed, including:</p>



                                    <ul>
                                        <li>Your IP address;</li>
                                        <li>The search terms you used;</li>
                                        <li>The pages and internal links accessed on our site;</li>
                                        <li>The date and time you visited the site;</li>
                                        <li>Geographic location;</li>
                                        <li>The referring site or platform through which you clicked through to this site
                                            (if any);
                                        </li>
                                        <li>Your operating system; and</li>
                                        <li>Web browser type, among others.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-right">
                                <button type="button" class="btn btn-flat bg-navy" data-dismiss="modal" id="scrollButton">I
                                    Agree</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
