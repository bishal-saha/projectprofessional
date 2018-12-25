<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>@yield('page-heading')</h4>
        </div>

        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <a href="{{ route('user.list') }}" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                    <i class="icon-users4 text-pink-300"></i>
                    <span>Users</span>
                </a>
                <a href="{{ Auth::user()->is_admin ? route('activity.index') : route('my.activities') }}" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                    <i class="icon-compass4 text-pink-300"></i>
                    <span>Activities</span>
                </a>
                <a href="{{ route('permission.index') }}" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                    <i class="icon-grid5 text-pink-300"></i>
                    <span>Permissions</span>
                </a>
            </div>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item">
                    <i class="icon-home2 mr-2"></i> Dashboard
                </a>
                @yield('breadcrumbs', '')
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">
                <a href="#" class="breadcrumb-elements-item">
                    <i class="icon-comment-discussion mr-2"></i>
                    Support
                </a>

                <div class="breadcrumb-elements-item dropdown p-0">
                    <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-gear mr-2"></i>
                        Settings
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                        <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                        <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>