@permission(['pages.manage'], false)
<li class="nav-item-header">
    <div class="text-uppercase font-size-xs line-height-xs">Content management System</div>
    <i class="icon-menu" title="Main"></i>
</li>

@permission(['pages.manage'])
<li class="nav-item">
    <a class="nav-link {{ Route::is('page.*') ? 'active' : ''  }}" href="{{ route('page.index') }}">
        <i class="icon-magazine"></i>
        <span>Pages</span>
    </a>
</li>
@endpermission
@endpermission