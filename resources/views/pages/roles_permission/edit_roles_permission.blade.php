@extends('partials.main')
{{-- page title --}}
@section('page-title', 'Role Permission')
{{-- Content Header --}}
@section('content-header', 'Edit Roles in Permission')
{{-- content --}}
@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">

                    <div class="card">
                        <form method="post" class="needs-validation"
                            action="{{ route('super_admin.roles.permission.update', $role->id) }}" novalidate=""
                            enctype="multipart/form-data">
                            {{-- @method('patch') --}}
                            @csrf

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="role_name">Role Name </label>
                                        <h3>{{ $role->name }}</h3>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="check_all_permission">
                                        <label for="check_all_permission">
                                            All Permissions
                                        </label>
                                    </div>
                                </div>

                                <hr>
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            @php
                                                $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                            @endphp
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="{{ $group->group_name }}"
                                                        {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                    <label for="{{ $group->group_name }}">
                                                        {{ $group->group_name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-9">



                                            @foreach ($permissions as $permission)
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" name="permission[]"
                                                            id="{{ $permission->id }}" value="{{ $permission->id }}"
                                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                        <label for="{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div>
                                @endforeach


                                <button class="btn btn-success mt-2 float-right"><i
                                        class="fa-solid fa-save"></i>&nbsp;Save</button>

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

            $('#check_all_permission').click(function() {
                if ($(this).is(':checked')) {
                    $('input[type=checkbox]').prop('checked', true);
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                }
            });
        });
    </script>
@endsection
