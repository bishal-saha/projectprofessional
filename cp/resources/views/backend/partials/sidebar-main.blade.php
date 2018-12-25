<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body"
                 style="background: url('{{ asset('backend/global_assets/images/backgrounds/user_bg5.png') }}') center center no-repeat">
                <div class="card-body text-center">
                    <a href="{{ route('my.profile') }}">
                        <img src="{{ auth()->user()->present()->avatar }}" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark">{{ auth()->user()->present()->nameOrEmail }}</h6>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse">
                        <span>My Account</span>
                    </a>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="{{ route('my.profile') }}" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('my.sessions') }}" class="nav-link">
                            <i class="icon-coins"></i>
                            <span>active sessions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link {{ (Route::currentRouteName() == 'admin') ? 'active' : ''  }}">
                        <i class="icon-home4"></i> <span>Dashboard</span>
                    </a>
                </li>
                <!-- User Management System -->
                @include('backend.partials.sidebar-menu.content-management-system')
                <!-- User Management -->
                @include('backend.partials.sidebar-menu.user-management')

                <!-- System Management -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">System Management</div>
                    <i class="icon-menu" title="Main"></i>
                </li>
                @include('backend.partials.sidebar-menu.settings')
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>