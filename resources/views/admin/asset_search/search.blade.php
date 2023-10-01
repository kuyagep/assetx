@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Asset Search')
{{-- Content Header --}}
@section('content-header', 'Asset Search')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">Asset Search</h2>
            <div class="row mb-5">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('admin.search') }}" method="Get">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control form-control-lg"
                                placeholder="Type your keywords here">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-9">

                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="text-center display-4  ">
                        <h1 class="text-secondary">Coming Soon!</h1>
                    </div>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')

@endsection
