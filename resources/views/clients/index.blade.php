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
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-warning">{{ $total_pending_purchase }}</h3>
                                    <p class="mb-0">Pending Purchase </p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-exclamation-circle text-warning fa-3x"></i>
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
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-success">{{ $total_approved_purchase }}</h3>
                                    <p class="mb-0">Approved Purchase</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-check-circle text-success fa-3x"></i>
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
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-danger">{{ $total_rebid_purchase }}</h3>
                                    <p class="mb-0">Rebid Purchase</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-undo-alt text-danger fa-3x"></i>
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
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-info">{{ $total_cancelled_purchase }}</h3>
                                    <p class="mb-0">Cancelled Purchase</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-times-circle text-info fa-3x"></i>
                                </div>
                            </div>
                            <div class="px-md-1">
                                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title text-bold">Latest Purchase Request</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0" style="display: block;">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>PR No</th>
                                            <th>Title/Activity</th>
                                            <th>Status</th>
                                            <th>ABC Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latest_purchase as $latest)
                                            <tr>
                                                <td><a href="javascript:void" data-id={{ $latest->id }}
                                                        id="history-button">{{ $latest->purchase_number }}</a>
                                                </td>
                                                <td>{{ $latest->title }}</td>
                                                <td>
                                                    @if ($latest->isApproved === 'approved')
                                                        <span class="badge badge-success">Approved</span>
                                                    @elseif ($latest->isApproved === 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($latest->isApproved === 'cancelled')
                                                        <span class="badge badge-danger">Cancelled</span>
                                                    @elseif ($latest->isApproved === 'rebid')
                                                        <span class="badge badge-primary">Rebid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                        {{ number_format($latest->amount, 2, '.', ',') }}</div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">No Data Found!</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="card-footer clearfix" style="display: block;">
                            <a href="{{ url('client/purchase') }}" class="btn btn-sm btn-info float-left">Add New
                                Purchase</a>
                            <a href="{{ url('client/purchase') }}" class="btn btn-sm btn-secondary float-right">View All
                                Purchase</a>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Recently Added Products</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ asset('assets/dist/img/default-150x150.png') }}" alt="Product Image"
                                            class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">Samsung TV
                                            <span class="badge badge-warning float-right">$1800</span></a>
                                        <span class="product-description">
                                            Samsung 32" 1080p 60Hz LED Smart HDTV.
                                        </span>
                                    </div>
                                </li>

                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ asset('assets/dist/img/default-150x150.png') }}" alt="Product Image"
                                            class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">Bicycle
                                            <span class="badge badge-info float-right">$700</span></a>
                                        <span class="product-description">
                                            26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                        </span>
                                    </div>
                                </li>

                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ asset('assets/dist/img/default-150x150.png') }}" alt="Product Image"
                                            class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">
                                            Xbox One <span class="badge badge-danger float-right">
                                                $350
                                            </span>
                                        </a>
                                        <span class="product-description">
                                            Xbox One Console Bundle with Halo Master Chief Collection.
                                        </span>
                                    </div>
                                </li>

                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ asset('assets/dist/img/default-150x150.png') }}" alt="Product Image"
                                            class="img-size-50">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">PlayStation 4
                                            <span class="badge badge-success float-right">$399</span></a>
                                        <span class="product-description">
                                            PlayStation 4 500GB Console (PS4)
                                        </span>
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="card-footer text-center">
                            <a href="javascript:void(0)" class="uppercase">View All Products</a>
                        </div>

                    </div>

                </div>

            </div>

        </div><!--/. container-fluid -->
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

            //History Function
            $('body').on('click', '#history-button', function() {

                var id = $(this).data('id');
                var route = "{{ route('client.purchase.history', ':id') }}";
                route = route.replace(':id', id);
                window.location.href = route;

            });

        });
    </script>

@endsection
