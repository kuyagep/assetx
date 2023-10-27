{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('page-title', 'Manage Purchase Request')
{{-- Content Header --}}
@section('content-header', 'Manage Purchase Request')
{{-- Main content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3 ">
                        <div class="col-12">
                            <button id="add-button" class="btn bg-navy mr-2 float-left">
                                <i class="fa-regular fa-square-plus"></i>&nbsp;Add Purchase Request
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Purchase Request Details </h3> <span
                                class="float-right"><b>PR-2023-10-001</b></span>
                        </div>

                        <div class="card-body">
                            <strong><i class="fa-solid fa-circle-info"></i> Title/Description</strong>
                            <p class="text-muted">
                                New Bid: This is a sample description/title of the activity/materials
                            </p>
                            <hr>
                            <strong><i class="fa-solid fa-coins"></i> Fund Source</strong>
                            <p class="text-muted">Division Mooe</p>
                            <hr>
                            <strong><i class="fa-solid fa-peso-sign"></i> Amount</strong>
                            <h4 class="text-success"><b>25,005.25</b></h4>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Remarks</strong>
                            <p class="text-muted">Submitted by Admin on October 27, 2023 11:00 AM.</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="timeline">

                        <div>
                            {{-- <i class="fa-solid fa-circle-check bg-success"></i> --}}
                            <i class="fas fa-check bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#">Approved</a> sent you an email</h3>
                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-sm">Read more</a>
                                    <a class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            {{-- <i class="fa-solid fa-circle-check bg-success"></i> --}}
                            <i class="fas fa-check bg-secondary"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#">Approved</a> sent you an email</h3>
                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                            </div>
                        </div>


                        <div>
                            <i class="fas fa-exclamation bg-warning"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend
                                    request</h3>
                            </div>
                        </div>


                        <div>
                            <i class="fas fa-xmark bg-red"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-regular fa-file-lines bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                <h3 class="timeline-header"><a href="#">Jay White</a> Submitted Document for approval
                                </h3>
                                <div class="timeline-body">
                                    <b>PR-2023-10-001</b> <br>
                                    New Bid: This is a sample description/title of the activity/materials <br>
                                    October 28, 2023 11:00 AM
                                </div>
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>


            <!-- End Modal -->
            <!-- /.modal -->
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
