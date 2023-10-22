@if (Auth::user()->role == 'super_admin')
    <aside class="main-sidebar sidebar-dark-secondary bg-navy elevation-1">
        <!-- Brand Logo -->
        @include('partials.brand_logo')

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : asset('assets/dist/img/avatar/default.jpg') }}"
                        class="img-circle elevation-0" style="width: 32px;max-width: 32px;height: 32px;object-fit: cover;"
                        alt="Account Avatar">
                </div>
                <div class="info">
                    <a href="#"
                        class="d-block text-white">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            {{-- <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div> --}}

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-header">DASHBOARD</li>
                    <li class="nav-item">
                        <a href="{{ url('s/dashboard') }}"
                            class="nav-link {{ Request::is('s/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-regular fa-compass"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('s/purchase') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('s/purchase') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-cart-shopping"></i>
                            <p>
                                Manage Purchase
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('s/purchase') }}"
                                    class="nav-link {{ Request::is('s/purchase') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-receipt"></i>
                                    <p>All Purchase Request</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('s/accountability') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p> Accountability</p>
                        </a>
                    </li>
                    {{-- @if (Auth::user()->can('division.menu'))
                    @endif --}}
                    <li class="nav-item">
                        <a href="{{ url('s/division') }}"
                            class="nav-link {{ Request::is('s/division') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p> Manage Division </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ url('s/districts') }}"
                            class="nav-link {{ Request::is('s/districts') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Manage District
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/schools') }}"
                            class="nav-link {{ Request::is('s/schools') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Manage Schools
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/offices') }}"
                            class="nav-link {{ Request::is('s/offices') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Manage Office
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/positions') }}"
                            class="nav-link {{ Request::is('s/positions') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Manage Position
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/classifications') }}"
                            class="nav-link {{ Request::is('s/classifications') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>
                                Asset Classification
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/asset-status') }}"
                            class="nav-link {{ Request::is('s/asset-status') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-toggle-on"></i>
                            <p>
                                Asset Status
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-qrcode"></i>
                            <p>
                                Assets
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/issuance-type') }}"
                            class="nav-link {{ Request::is('s/issuance-type') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Issuance Type
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                All Issuances
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">USER MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ route('super_admin.users.index') }}"
                            class="nav-link {{ Request::is('s/users') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('s/admin/all') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('s/admin/all') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-users-gear"></i>
                            <p>
                                Manage Admin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('s/admin/all') }}"
                                    class="nav-link {{ Request::is('s/admin/all') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>All Admin</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="nav-item {{ Request::is('s/permission', 's/permission-group', 's/roles', 's/roles/permission/all', 's/roles/permission') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Request::is('s/permission', 's/permission-group', 's/roles', 's/roles/permission/all', 's/roles/permission') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-users-gear"></i>
                            <p>
                                Role & Permission
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('s/roles') }}"
                                    class="nav-link {{ Request::is('s/roles') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('s/roles/permission') }}"
                                    class="nav-link {{ Request::is('s/roles/permission') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Add Role Permission</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('s/roles/permission/all') }}"
                                    class="nav-link {{ Request::is('s/roles/permission/all') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>All Roles Permission</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('s/permission') }}"
                                    class="nav-link {{ Request::is('s/permission') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('s/permission-group') }}"
                                    class="nav-link {{ Request::is('s/permission-group') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Permission Group</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/profile') }}"
                            class="nav-link {{ Request::is('s/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Profile Settings
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item {{ Request::is('s/profile') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('s/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Profile Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('s/profile') }}"
                                    class="nav-link {{ Request::is('s/profile') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@elseif(Auth::user()->role == 'admin')
    <aside class="main-sidebar sidebar-dark-danger elevation-1">
        <!-- Brand Logo -->
        @include('partials.brand_logo')

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : asset('assets/dist/img/avatar/default.jpg') }}"
                        class="img-circle elevation-0"
                        style="width: 32px;max-width: 32px;height: 32px;object-fit: cover;" alt="Account Avatar">
                </div>
                <div class="info">
                    <a href="#"
                        class="d-block text-white">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                </div>
            </div> --}}

            <!-- SidebarSearch Form -->
            <div class="form-inline mt-3 mb-3">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent nav-collapse-hide-child"
                    data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">PROCUREMENT MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/purchase') }}"
                            class="nav-link {{ Request::is('admin/purchase') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Purchase Request
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">ISSUANCE MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/issue-items') }}"
                            class="nav-link {{ Request::is('admin/issue-items') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>
                                Issue Items
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/issuance-type') }}"
                            class="nav-link {{ Request::is('admin/issuance-type') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Issuance Type
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/all-issuances') }}"
                            class="nav-link {{ Request::is('admin/all-issuances') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                All Issuances
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">ACCOUNTABILITY MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/search') }}"
                            class="nav-link {{ Request::is('admin/search') ? 'active' : '' }}">

                            <i class="nav-icon fa-solid fa-magnifying-glass"></i>
                            <p>
                                Asset Search
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/classifications') }}"
                            class="nav-link {{ Request::is('admin/classifications') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>
                                Asset Classification
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/asset-status') }}"
                            class="nav-link {{ Request::is('admin/asset-status') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-toggle-on"></i>
                            <p>
                                Asset Status
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/asset-registration') }}"
                            class="nav-link {{ Request::is('admin/asset-registration') ? 'active' : '' }}">
                            <i class="nav-icon fa-regular fa-square-plus"></i>
                            <p>
                                Asset Registration
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>User Management</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/reports') }}"
                            class="nav-link {{ Request::is('admin/reports') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-print"></i>
                            <p>
                                Manage Reports
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">ACCOUNT</li>
                    <li
                        class="nav-item {{ Request::is('admin/change/password', 'admin/profile') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Request::is('admin/change/password', 'admin/profile') ? 'active' : '' }}">
                            <i class="nav-icon far fa-user-circle "></i>
                            <p>
                                My Account
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/profile') }}"
                                    class="nav-link {{ Request::is('admin/profile') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Update Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/change/password') }}"
                                    class="nav-link {{ Request::is('admin/change/password') ? 'active' : '' }}">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-header">SYSTEM</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/backups') }}"
                            class="nav-link {{ Request::is('admin/backups') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cloud-download-alt text-danger"></i>
                            <p>
                                Backup/Restore
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle text-warning"></i>
                            <p>
                                Level 1
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Level 2
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-dot-circle nav-icon"></i>
                                            <p>Level 3</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Level 2</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@else
    <aside class="main-sidebar sidebar-light-danger elevation-1">
        <!-- Brand Logo -->
        @include('partials.brand_logo')

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- SidebarSearch Form -->
            <div class="form-inline mt-3">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ url('/client/dashboard') }}"
                            class="nav-link {{ Request::is('client/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('client/purchase') }}"
                            class="nav-link {{ Request::is('client/purchase') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Purchase Request
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/client/accountability') }}"
                            class="nav-link {{ Request::is('client/accountability') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>
                                Accountability
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ url('/client/transferred-items') }}"
                            class="nav-link {{ Request::is('client/transferred-items') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                Transferred Asset
                            </p>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ url('/client/returned-items') }}"
                            class="nav-link {{ Request::is('client/returned-items') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                Returned Asset
                            </p>
                        </a>
                    </li> --}}
                    <li
                        class="nav-item {{ Request::is('client/change/password', 'client/profile') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Request::is('client/change/password', 'client/profile') ? 'active' : '' }}">
                            <i class="nav-icon far fa-user-circle "></i>
                            <p>
                                My Account
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('client/profile') }}"
                                    class="nav-link {{ Request::is('client/profile') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Update Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('client/change/password') }}"
                                    class="nav-link {{ Request::is('client/change/password') ? 'active' : '' }}">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-header">SYSTEM</li>
                    <li class="nav-item">
                        <a href="{{ url('/client/backup') }}"
                            class="nav-link {{ Request::is('client/backup') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-database text-info"></i>
                            <p>
                                Backup
                            </p>
                        </a>
                    </li>



                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endif
