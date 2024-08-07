<nav class="main-header navbar navbar-expand navbar-light ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('http://projectdavaosur.com/') }}" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
            </a>

        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>

            </a>

        </li>
        <!-- User Menu -->

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : Gravatar::avatar(Auth::user()->email)->defaultImage('identicon') }}"
                    class="user-image img-circle elevation-1" alt="User Image"
                    style="width: 2.1rem;max-width: 2.1rem;height: 2.1rem;object-fit: cover;">
                {{-- <span
                    class="d-none d-md-inline">{{ ucwords(Auth::user()->first_name) . ' ' . ucwords(Auth::user()->last_name) }}</span> --}}
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-default">
                    <img src="{{ !empty(Auth::user()->avatar) ? asset('assets/dist/img/avatar/' . Auth::user()->avatar) : Gravatar::avatar(Auth::user()->email)->defaultImage('identicon') }}"
                        class="img-circle elevation-1" alt="User Image">

                    <p>
                        {{ ucwords(Auth::user()->first_name) . ' ' . ucwords(Auth::user()->last_name) }}
                        <small>{{ Auth::user()->email }}</small>
                    </p>
                </li>
                <!-- Menu Body -->
                {{-- <li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li> --}}
                <!-- Menu Footer-->
                <li class="user-footer">
                    @if (Auth::user()->role === 'client')
                        <a href="{{ url('client/profile') }}" class="btn btn-success btn-flat">Profile</a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ url('account/profile') }}" class="btn btn-success btn-flat">Profile</a>
                    @else
                        <a href="{{ url('my/profile') }}" class="btn btn-success btn-flat">Profile</a>
                    @endif

                    <a href="#" class="btn btn-danger btn-flat float-right" data-toggle="modal"
                        data-target="#logoutModal">Sign out</a>


                </li>
            </ul>
        </li>

    </ul>
</nav>
