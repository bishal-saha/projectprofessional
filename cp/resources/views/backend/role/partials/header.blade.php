<form action="" method="GET" id="search-form" class="">
    <div class="card-header header-elements-sm-inline">
        <div class="card-title header-elements-inline">
            <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control input-solid" placeholder="Type to search...">
            <button type="submit" class="btn bg-indigo btn-icon ml-2 mr-2 legitRipple">
                <i class="icon-search4"></i>
            </button>
            <a href="{{ route('role.index') }}" title="Refresh the page">
                <button type="button" class="btn bg-indigo btn-icon legitRipple">
                    <i class="icon-reload-alt"></i>
                </button>
            </a>
        </div>
        <div class="header-elements-inline">
            <label class="mr-2" for="per_page">Show: </label>
            <select name="per_page" id="per_page" onchange="this.form.submit()" class="form-control pl-2 pr-2 mr-2">
                <option value="10" {{ Request::get('per_page') == '10' ? 'selected' : '' }} >10</option>
                <option value="25"  {{ Request::get('per_page') == '25' ? 'selected' : '' }}>25</option>
                <option value="50" {{ Request::get('per_page') == '50' ? 'selected' : '' }}>50</option>
                <option value="100" {{ Request::get('per_page') == '100' ? 'selected' : '' }}>100</option>
            </select>
            <a href="{{ route('role.create') }}" title="Add New">
                <button type="button" class="btn bg-indigo btn-icon ml-2 legitRipple">
                    <i class="icon-plus3"></i>
                </button>
            </a>
        </div>
    </div>
</form>