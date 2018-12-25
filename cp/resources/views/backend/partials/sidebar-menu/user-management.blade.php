@permission(['users.manage', 'users.activity', 'roles.manage', 'permissions.manage'], false)
<li class="nav-item-header">
    <div class="text-uppercase font-size-xs line-height-xs">User Authentication</div>
    <i class="icon-menu" title="Main"></i>
</li>

@permission(['roles.manage'])
<li class="nav-item">
    <a class="nav-link {{ Route::is('role.*') ? 'active' : ''  }}" href="{{ route('role.index') }}">
        <i class="icon-theater"></i>
        <span>Roles</span>
    </a>
</li>
@endpermission

@permission(['permissions.manage'])
<li class="nav-item">
    <a class="nav-link {{ Route::is('permission.*') ? 'active' : ''  }}" href="{{ route('permission.index') }}">
        <i class="icon-grid5"></i>
        <span>Permissions</span>
    </a>
</li>
@endpermission

@permission(['users.activity'])
<li class="nav-item">
    <a class="nav-link {{ Route::is('activity.*') ? 'active' : ''  }}" href="{{ route('activity.index') }}">
        <i class="icon-compass4"></i>
        <span>Users Activity</span>
    </a>
</li>
@endpermission

@permission(['users.manage'])
<li class="nav-item">
    <a class="nav-link {{ Route::is('user.*') ? 'active' : ''  }}" href="{{ route('user.list') }}">
        <i class="icon-users4"></i>
        <span>Users</span>
    </a>
</li>
@endpermission
@endpermission