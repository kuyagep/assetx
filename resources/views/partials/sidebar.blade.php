@hasanyrole('client|admin|super-admin')
    <aside class="main-sidebar sidebar-dark-light bg-navy elevation-1">
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
            {{-- <div class="form-inline ">
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
                        <a href="{{ url('s/division') }}" class="nav-link {{ Request::is('s/division') ? 'active' : '' }}">
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
                        <a href="{{ url('s/schools') }}" class="nav-link {{ Request::is('s/schools') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>
                                Manage Schools
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/offices') }}" class="nav-link {{ Request::is('s/offices') ? 'active' : '' }}">
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
                        <a href="{{ route('super_admin.user.index') }}"
                            class="nav-link {{ Request::is('s/user') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('s/admin/all') }}"
                            class="nav-link {{ Request::is('s/admin/all') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>Manage Admin</p>
                        </a>
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
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endhasanyrole
