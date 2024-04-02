@hasanyrole('super-admin')
    <aside class="main-sidebar sidebar-dark-red elevation-1">
        <!-- Brand Logo -->
        @include('partials.brand_logo')

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- SidebarSearch Form -->
            <div class="form-inline mt-2">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search by Property Code"
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
                    <li class="nav-header">DASHBOARD</li>
                    @role('super-admin')
                        <li class="nav-item">
                            <a href="{{ url('my/dashboard') }}"
                                class="nav-link {{ Request::is('my/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fa-regular fa-compass"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                    @endrole

                    <li class="nav-item">
                        <a href="{{ url('my/ppmp') }}" class="nav-link {{ Request::is('my/ppmp') ? 'active' : '' }}">

                            <i class="nav-icon fa-solid fa-vector-square"></i>
                            <p>PPMP</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('my/purchase') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)" class="nav-link {{ Request::is('my/purchase') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-cart-shopping"></i>
                            <p>
                                Manage Purchase
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('my/purchase') }}"
                                    class="nav-link {{ Request::is('my/purchase') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-receipt"></i>
                                    <p>All Purchase Request</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('my/purchase-order') }}"
                            class="nav-link {{ Request::is('my/purchase-order') ? 'active' : '' }}">

                            <i class="nav-icon fa-solid fa-file-lines"></i>
                            <p>Purchase Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('my/suppliers') }}"
                            class="nav-link {{ Request::is('my/suppliers') ? 'active' : '' }}">

                            <i class="nav-icon fa-solid fa-store"></i>
                            <p>Manage Suppliers</p>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('my/assets', 'my/assets/non/expendable') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)" class="nav-link {{ Request::is('my/assets') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dice-d6"></i>
                            <p>
                                Assets
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('my/assets') }}"
                                    class="nav-link {{ Request::is('my/assets') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Expendable</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('my/assets/non/expendable') }}"
                                    class="nav-link {{ Request::is('my/assets/non/expendable') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Non Expendable</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('my/classifications') }}"
                            class="nav-link {{ Request::is('my/classifications') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shapes"></i>
                            <p>
                                Asset Classification
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('my/asset-status') }}"
                            class="nav-link {{ Request::is('my/asset-status') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hourglass-half"></i>
                            <p>
                                Asset Status
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('my/issuances') }}"
                            class="nav-link {{ Request::is('my/issuances') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Issuances
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('my/issuance-type') }}"
                            class="nav-link {{ Request::is('my/issuance-type') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Issuance Type
                            </p>
                        </a>
                    </li>




                    <li
                        class="nav-item {{ Request::is('my/division', 'my/districts', 'my/schools', 'my/offices', 'my/positions') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                            class="nav-link {{ Request::is('my/division', 'my/districts', 'my/schools', 'my/offices', 'my/positions') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>
                                Components
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">


                            <li class="nav-item">
                                <a href="{{ url('my/division') }}"
                                    class="nav-link {{ Request::is('my/division') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p> Manage Division </p>
                                </a>
                            </li>



                            <li class="nav-item">
                                <a href="{{ url('my/districts') }}"
                                    class="nav-link {{ Request::is('my/districts') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Manage District
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('my/schools') }}"
                                    class="nav-link {{ Request::is('my/schools') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>
                                        Manage Schools
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('my/offices') }}"
                                    class="nav-link {{ Request::is('my/offices') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <p>
                                        Manage Office
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('my/positions') }}"
                                    class="nav-link {{ Request::is('my/positions') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>
                                        Manage Position
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">USER MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ url('my/online/users') }}"
                            class="nav-link {{ Request::is('my/online/users') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>Online Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}"
                            class="nav-link {{ Request::is('my/user') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('my/admin/all') }}"
                            class="nav-link {{ Request::is('my/admin/all') ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon "></i>
                            <p>Manage Admin</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ Request::is('my/permission', 'my/permission-group', 'my/roles', 'my/roles/permission/all', 'my/roles/permission') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)"
                            class="nav-link {{ Request::is('my/permission', 'my/permission-group', 'my/roles', 'my/roles/permission/all', 'my/roles/permission') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-users-gear"></i>
                            <p>
                                Role & Permission
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('my/roles') }}"
                                    class="nav-link {{ Request::is('my/roles') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('my/roles/permission') }}"
                                    class="nav-link {{ Request::is('my/roles/permission') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Add Role Permission</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('my/roles/permission/all') }}"
                                    class="nav-link {{ Request::is('my/roles/permission/all') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>All Roles Permission</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('my/permission') }}"
                                    class="nav-link {{ Request::is('my/permission') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('my/permission-group') }}"
                                    class="nav-link {{ Request::is('my/permission-group') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Permission Group</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('my/profile') }}"
                            class="nav-link {{ Request::is('my/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-solid fa-user-gear"></i>

                            <p>
                                Account Settings
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



@hasanyrole('admin')
    <aside class="main-sidebar sidebar-dark-light elevation-1">
        <!-- Brand Logo -->
        @include('partials.brand_logo')

        <!-- Sidebar -->
        <div class="sidebar">




            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   with font-awesome or any other icon font library -->
                    <li class="nav-header">DASHBOARD</li>

                    <li class="nav-item">
                        <a href="{{ url('my/account/dashboard') }}"
                            class="nav-link {{ Request::is('my/account/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-regular fa-compass"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('my/purchase') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)" class="nav-link {{ Request::is('my/purchase') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-cart-shopping"></i>
                            <p>
                                Purchase Request
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('my/purchase') }}"
                                    class="nav-link {{ Request::is('my/purchase') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-receipt"></i>
                                    <p>All Purchase Request</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('my/purchase-order') }}"
                            class="nav-link {{ Request::is('my/purchase-order') ? 'active' : '' }}">

                            <i class="nav-icon fa-solid fa-file-lines"></i>
                            <p>Purchase Order</p>
                        </a>
                    </li>
                    @role('admin')
                        <li class="nav-item">
                            <a href="{{ url('my/account/profile') }}"
                                class="nav-link {{ Request::is('my/account/profile') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Profile Settings
                                </p>
                            </a>
                        </li>
                    @endrole
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
@endhasanyrole


{{-- Client --}}
@hasanyrole('client')
    <aside class="main-sidebar sidebar-light-danger elevation-1">
        <!-- Brand Logo -->
        @include('partials.brand_logo')

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <!-- Add icons to the links using the .nav-icon class                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           with font-awesome or any other icon font library -->
                    <li class="nav-header">DASHBOARD</li>
                    <li class="nav-item">
                        <a href="{{ url('client/dashboard') }}"
                            class="nav-link {{ Request::is('client/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-chart-simple"></i>
                            <p>
                                My Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('client/purchase') }}"
                            class="nav-link {{ Request::is('client/purchase') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-solid fa-cart-shopping"></i>
                            <p>Purchase Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('client/purchase-order') }}"
                            class="nav-link {{ Request::is('client/purchase-order') ? 'active' : '' }}">

                            <i class="nav-icon fa-solid fa-file-lines"></i>
                            <p>Purchase Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('client.issuances.index') }}"
                            class="nav-link {{ Request::is('client/issuances') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                Issuances Received
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                Issued Items
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                Reports
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">ACCOUNT MANAGEMENT</li>
                    <li class="nav-item">
                        <a href="{{ url('client/profile') }}"
                            class="nav-link {{ Request::is('client/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
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
