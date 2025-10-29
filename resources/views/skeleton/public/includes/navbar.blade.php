<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ getDefaultLogo() }}" alt="Alumni Portal Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'UITS Alumni Portal') }}</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.alumni-list.index') }}" class="nav-link {{ routeNameMatched('public.alumni-list.index') }}">Alumni</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.student-list.index') }}" class="nav-link {{ routeNameMatched('public.student-list.index') }}">Students</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.events.index') }}" class="nav-link {{ routeNameMatched('public.events.index') }}">Events</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.donations.index') }}" class="nav-link {{ routeNameMatched('public.events.index') }}">Donations</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('public.jobs.index') }}" class="nav-link">Jobs</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/chat') }}" class="nav-link">Chat <span style="color: green; font-weight: bold;" id="chat-notification"></span></a>
                </li>
{{--                <li class="nav-item dropdown">--}}
{{--                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"--}}
{{--                       aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>--}}
{{--                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">--}}
{{--                        <li><a href="#" class="dropdown-item">Some action </a></li>--}}
{{--                        <li><a href="#" class="dropdown-item">Some other action</a></li>--}}

{{--                        <li class="dropdown-divider"></li>--}}

{{--                        <!-- Level two dropdown-->--}}
{{--                        <li class="dropdown-submenu dropdown-hover">--}}
{{--                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"--}}
{{--                               aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover--}}
{{--                                for action</a>--}}
{{--                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">--}}
{{--                                <li>--}}
{{--                                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>--}}
{{--                                </li>--}}

{{--                                <!-- Level three dropdown-->--}}
{{--                                <li class="dropdown-submenu">--}}
{{--                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown"--}}
{{--                                       aria-haspopup="true" aria-expanded="false"--}}
{{--                                       class="dropdown-item dropdown-toggle">level 2</a>--}}
{{--                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">--}}
{{--                                        <li><a href="#" class="dropdown-item">3rd level</a></li>--}}
{{--                                        <li><a href="#" class="dropdown-item">3rd level</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <!-- End Level three -->--}}

{{--                                <li><a href="#" class="dropdown-item">level 2</a></li>--}}
{{--                                <li><a href="#" class="dropdown-item">level 2</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <!-- End Level two -->--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>

            <!-- SEARCH FORM -->
{{--            <form class="form-inline ml-0 ml-md-3">--}}
{{--                <div class="input-group input-group-sm">--}}
{{--                    <input class="form-control form-control-navbar" type="search" placeholder="Search"--}}
{{--                           aria-label="Search">--}}
{{--                    <div class="input-group-append">--}}
{{--                        <button class="btn btn-navbar" type="submit">--}}
{{--                            <i class="fas fa-search"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
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
                        <img src="{{ getProfilePicture() }}" class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ userFullName() }}

                        </p>
                    </li>
                    <!-- Menu Body -->
{{--                    <li class="user-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <a href="#">Followers</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <a href="#">Sales</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-4 text-center">--}}
{{--                                <a href="#">Friends</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.row -->--}}
{{--                    </li>--}}
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <form method="POST" action="{{ route('logout') }}" class="d-flex">
                            @csrf
                            @php
                                $dashboardLink = isAdmin()
                                                    ? 'admin/dashboard'
                                                    : (isAlumni()
                                                        ? 'backend/alumni'
                                                        : 'backend/student');
                            @endphp
                            <a href="{{ route('public.profile') }}" class="btn btn-default btn-flat mr-1">Profile</a>
                            <a href="{{ url($dashboardLink) }}" class="btn btn-default btn-flat mr-1">Dashboard</a>
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
    </div>
</nav>
