{{-- Extend main layout --}}
@extends('partials.main')
{{-- Page Title --}}
@section('title_prefix', 'Manage Purchase Request')
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
                            <button onclick="history.back()" class="btn bg-navy  mb-3 px-3">
                                <i class="fas fa-chevron-left"></i>&nbsp;&nbsp;Back
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Purchase Request Details </h3> <span
                                class="float-right"><b>{{ $purchase->purchase_number }}</b></span>
                        </div>

                        <div class="card-body">
                            <strong><i class="fa-solid fa-circle-info"></i> Title/Description</strong>
                            <p class="text-muted">
                                {{ $purchase->get_started . ':' . $purchase->title }}
                            </p>
                            <hr>
                            <strong><i class="fa-solid fa-coins"></i> Fund Source</strong>
                            <p class="text-muted">{{ $purchase->src_fund }}</p>
                            <hr>
                            <strong><i class="fa-solid fa-peso-sign"></i> Amount</strong>
                            <h4 class="text-success"><b>{{ number_format($purchase->amount, 2, '.', ',') }}</b></h4>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Remarks</strong>
                            <p class="text-muted">Submitted by
                                {{ $purchase->user->first_name . ' ' . $purchase->user->last_name }} <br> on
                                {{ $purchase->created_at->format('d-m-Y H:i:s') }}.</p>
                            <div class="text-center mt-5 mb-3">
                                <a href="javascript:void(0)" id="downloadButton" data-id="{{ $purchase->attachment }}"
                                    class="btn btn-primary"><i class="fa-regular fa-file-excel"></i>
                                    Download File</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="timeline">
                        {{-- <div>
                            <i class="fas fa-check bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05 </span>
                                <h3 class="timeline-header"><a href="#">Approved</a></h3>
                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-sm">Read more</a>
                                    <a class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div>
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
                        </div> --}}
                        @foreach ($histories as $history)
                            <div>
                                @if ($history->action == 'submit')
                                    <i class="fas fa-folder bg-primary"></i>
                                @elseif($history->action == 'pending')
                                    <i class="fas fa-exclamation bg-warning"></i>
                                @elseif($history->action == 'approved')
                                    <i class="fas fa-check bg-green"></i>
                                @elseif($history->action == 'cancelled')
                                    <i class="fas fa-xmark bg-red"></i>
                                @elseif($history->action == 'rebid')
                                    <i class="fas fa-undo  bg-purple"></i>
                                @endif
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i>
                                        {{ $history->created_at->diffForHumans() }}</span>
                                    <h3 class="timeline-header"><a href="#"
                                            class="text-primary">{{ $history->user->first_name . ' ' . $history->user->last_name }}</a>
                                    </h3>
                                    <div class="timeline-body">
                                        {{ $history->remarks }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

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

            //Download Function
            $('body').on('click', '#downloadButton', function() {

                var id = $(this).data('id');
                var route = "{{ route('purchase.download', ':id') }}";
                route = route.replace(':id', id);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to download this file?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Download'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = route;
                    }

                });

            });
        });
    </script>
@endsection
