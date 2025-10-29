<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('img/logo.jpeg') }}" alt="image here" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Alumni Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="height: 2.1rem;" src="{{ getProfilePicture() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if (auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN)
                    <li class="nav-item">
                        <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @elseif(auth()->user()->role->id == \App\Models\Role::ROLE_ALUMNI)
                    <li class="nav-item">
                        <a href="{{ url('/backend/alumni') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @elseif(auth()->user()->role->id == \App\Models\Role::ROLE_STUDENT)
                    <li class="nav-item">
                        <a href="{{ url('/backend/student') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN)
                    <li class="nav-item {{ routeNameMatched('job-board.*', 'menu-open') }}">
                        <a href="#" class="nav-link {{ routeNameMatched('job-board.*') }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Job Board
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/admin/job-board/create') }}"
                                   class="nav-link {{ routeNameMatched('job-board.create') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Jobs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/job-board/') }}"
                                   class="nav-link {{ routeNameMatched('job-board.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Jobs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/job-board/applicants-list') }}"
                                   class="nav-link {{ routeNameMatched('job-board.applicants') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Applicants</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/users-posts/') }}" class="nav-link">
                            <i class="nav-icon fas fa-sticky-note"></i>
                            <p>
                                All Users Posts
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/events/') }}" class="nav-link {{ routeNameMatched('events.*') }}">
                            <i class="nav-icon fa fa-calendar-alt"></i>
                            <p>
                                Events
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/donations/') }}" class="nav-link {{ routeNameMatched('donations.*') }}">
                            <i class="nav-icon fas fa-donate"></i>
                            <p>
                                Donations
                            </p>
                        </a>
                    </li>
                @elseif(auth()->user()->role->id == \App\Models\Role::ROLE_ALUMNI)
                    <li class="nav-item {{ routeNameMatched('job-board.*', 'menu-open') }}">
                        <a href="#" class="nav-link {{ routeNameMatched('job-board.*') }}">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Job Board
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/backend/alumni/job-board/create') }}"
                                   class="nav-link {{ routeNameMatched('job-board.create') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Jobs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/backend/alumni/job-board/') }}"
                                   class="nav-link {{ routeNameMatched('job-board.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Jobs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/backend/alumni/job-board/applicants') }}"
                                   class="nav-link {{ routeNameMatched('job-board.applicants') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Applicants</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/backend/alumni/donations/') }}" class="nav-link {{ routeNameMatched('donations.*') }}">
                            <i class="nav-icon fas fa-donate"></i>
                            <p>
                                Donations
                            </p>
                        </a>
                    </li>
                @elseif(auth()->user()->role->id == \App\Models\Role::ROLE_STUDENT)
                    <li class="nav-item">
                        <a href="{{ url('/backend/student/job-applications-list') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Your Application
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN)
                    <li class="nav-item">
                        <a href="{{ url('/admin/users/') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>