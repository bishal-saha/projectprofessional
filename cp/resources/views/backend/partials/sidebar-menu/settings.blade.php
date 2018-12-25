@permission(['settings.general', 'settings.auth', 'settings.notifications'], false)
<li class="nav-item nav-item-submenu {{ Request::is('*/settings*') ? 'nav-item-expanded nav-item-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="icon-cog"></i>
        <span>Settings</span>
    </a>

    <ul class="nav nav-group-sub" data-submenu-title="Settings">
        @permission('settings.general')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('*/settings') ? 'active' : ''  }}"
               href="{{ route('settings.general') }}">
                General
            </a>
        </li>
        @endpermission
        @permission('settings.auth')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('*/settings/auth*') ? 'active' : ''  }}"
               href="{{ route('settings.auth') }}">Auth & Registration</a>
        </li>
        @endpermission
        @permission('settings.notifications')
        <li class="nav-item">
            <a class="nav-link {{ Request::is('*/settings/notifications*') ? 'active' : ''  }}"
               href="{{ route('settings.notifications') }}">Notifications</a>
        </li>
        @endpermission
    </ul>
</li>
@endpermission