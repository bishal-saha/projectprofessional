@permission([
    config('permissions.datawarehouse.country.view'),
    config('permissions.datawarehouse.country.add'),
    config('permissions.datawarehouse.state.view'),
    config('permissions.datawarehouse.state.add')
], false)
<li class="nav-item nav-item-submenu
    {{ Route::is(
        'datawarehouse.country.*', 'datawarehouse.state.*')
        ? 'nav-item-expanded nav-item-open'
        : ''
        }}"
>
    <a href="#" class="nav-link">
        <i class="icon-database"></i>
        <span>Data Warehouse</span>
    </a>
    <ul class="nav nav-group-sub" data-submenu-title="Settings">
        @permission([
        config('permissions.datawarehouse.country.view'),
        config('permissions.datawarehouse.country.add')
        ], false)
        <li class="nav-item nav-item-submenu {{ Route::is('datawarehouse.country.*') ? 'nav-item-expanded nav-item-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="icon-earth"></i>
                <span>Manage Countries</span>
            </a>
            <ul class="nav nav-group-sub" data-submenu-title="Settings">
                @permission(config('permissions.datawarehouse.country.view'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.country.list') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.country.list') }}">
                        All Countries
                    </a>
                </li>
                @endpermission
                @permission(config('permissions.datawarehouse.country.add'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.country.create') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.country.create') }}">
                        Add New Country
                    </a>
                </li>
                @endpermission
            </ul>
        </li>
        @endpermission

        @permission([
        config('permissions.datawarehouse.state.view'),
        config('permissions.datawarehouse.state.add')
        ], false)
        <li class="nav-item nav-item-submenu {{ Route::is('datawarehouse.state.*') ? 'nav-item-expanded nav-item-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="icon-flag3"></i>
                <span>Manage States</span>
            </a>
            <ul class="nav nav-group-sub" data-submenu-title="Settings">
                @permission(config('permissions.datawarehouse.state.view'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.state.list') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.state.list') }}">
                        All States
                    </a>
                </li>
                @endpermission
                @permission(config('permissions.datawarehouse.state.add'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.state.create') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.state.create') }}">
                        Add New State
                    </a>
                </li>
                @endpermission
            </ul>
        </li>
        @endpermission
        <li class="nav-item nav-item-submenu {{ Route::is('datawarehouse.taxpayerCategory.*') ? 'nav-item-expanded nav-item-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="icon-flag3"></i>
                <span>Taxpayer Categories</span>
            </a>
            <ul class="nav nav-group-sub" data-submenu-title="Settings">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.taxpayercategory.list') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.taxpayerCategory.list') }}">
                        View All
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.taxpayercategory.create') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.taxpayerCategory.create') }}">
                        Add New
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item nav-item-submenu {{ Route::is('datawarehouse.businessConstitution.*') ? 'nav-item-expanded nav-item-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="icon-flag3"></i>
                <span>Business Constitutions</span>
            </a>
            <ul class="nav nav-group-sub" data-submenu-title="Settings">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.businessConstitution.list') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.businessConstitution.list') }}">
                        View All
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('datawarehouse.businessConstitution.create') ? 'active' : ''  }}"
                       href="{{ route('datawarehouse.businessConstitution.create') }}">
                        Add New
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
@endpermission