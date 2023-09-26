@if (Auth::user()->role == 'super_admin')
    <aside class="main-sidebar sidebar-dark-danger elevation-1">
        <!-- Brand Logo -->
        @include('partials.brand_logo')

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : asset('assets/dist/img/avatar/avatar5.png') }}"
                        class="img-circle elevation-0" style="width: 32px;max-width: 32px;height: 32px;object-fit: cover;"
                        alt="Account Avatar">
                </div>
                <div class="info">
                    <a href="#"
                        class="d-block text-white">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
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
                        <a href="{{ url('s/dashboard') }}"
                            class="nav-link {{ Request::is('s/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Manage Division
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Manage Office
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Manage District
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Manage Schools
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('super_admin.users.index') }}"
                            class="nav-link {{ Request::is('s/users') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>User Management</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('s/change/password', 'admin/profile') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Request::is('s/change/password', 'admin/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Account Settings
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
                            <li class="nav-item">
                                <a href="{{ url('s/change/password') }}"
                                    class="nav-link {{ Request::is('s/change/password') ? 'active' : '' }}">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>

                        </ul>
                    </li>

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
                    <img src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : asset('assets/dist/img/avatar/avatar5.png') }}"
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
                        <a href="" class="nav-link ">
                            <i class="nav-icon fa-regular fa-square-plus"></i>
                            <p>
                                Asset Registration
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>
                                Manage Maintenance
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Accountability
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ">
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
                        <a href="" class="nav-link ">
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
                        <a href="{{ url('/client/accountability') }}"
                            class="nav-link {{ Request::is('client/accountability') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>
                                Accountability
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/client/transferred-items') }}"
                            class="nav-link {{ Request::is('client/transferred-items') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                Transferred Asset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/client/returned-items') }}"
                            class="nav-link {{ Request::is('client/returned-items') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                Returned Asset
                            </p>
                        </a>
                    </li>
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
