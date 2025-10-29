<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
{{--            <a href="#" class="nav-link">About</a>--}}
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="navbar-search" href="#" role="button">--}}
{{--                <i class="fas fa-search"></i>--}}
{{--            </a>--}}
{{--            <div class="navbar-search-block">--}}
{{--                <form class="form-inline">--}}
{{--                    <div class="input-group input-group-sm">--}}
{{--                        <input class="form-control form-control-navbar" type="search" placeholder="Search"--}}
{{--                               aria-label="Search">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button class="btn btn-navbar" type="submit">--}}
{{--                                <i class="fas fa-search"></i>--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">--}}
{{--                                <i class="fas fa-times"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </li>--}}

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="notification-count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 465px;">
                {{-- <span class="dropdown-header" id="user">15 Notifications</span> --}}
                <div id="notification-list">

                </div>
                {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
                <a href="#" class="dropdown-item dropdown-footer" id="markAllNotificationAsRead">Mark All as Read</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Profile Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ getProfilePicture() }}" class="user-image img-circle elevation-2"
                     alt="User Image">
                <span class="d-none d-md-inline">{{ userFullName() }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ getProfilePicture() }}" class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{ userFullName() }}
                    </p>
                </li>
                <!-- Menu Body -->
{{--                <li class="user-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-4 text-center">--}}
{{--                            <a href="#">Followers</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-4 text-center">--}}
{{--                            <a href="#">Sales</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-4 text-center">--}}
{{--                            <a href="#">Friends</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.row -->--}}
{{--                </li>--}}
                <!-- Menu Footer-->
                <li class="user-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('public.profile') }}" class="btn btn-default btn-flat">Profile</a>
                        <a :href="route('logout')"
                           class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
