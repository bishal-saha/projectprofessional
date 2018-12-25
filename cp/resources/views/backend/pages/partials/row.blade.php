<tr>
    <td>
        <label class="form-check-label">
            <input type="checkbox" name="select_id" id="{{ $page->slug }}" value="{{ $page->slug }}" v-model="selectedIds" class="">
        </label>
        <span class="ml-2">
            {{ (($pages->currentPage() - 1) * $pages->perPage())+$loop->iteration }}
        </span>
    </td>
    <td>{{ $page->name }}</td>
    <td><a href="{{ url($page->slug) }}" target="_blank" title="Browse the page in new window"><i class="icon-new-tab mr-1"></i> {{ $page->slug }}</a></td>
    <td>{{ $page->excerpt }}</td>
    <td class="text-center">
        <div class="list-icons">
            <div class="dropdown">
                <a href="#" class="list-icons-item" data-toggle="dropdown">
                    <i class="icon-menu9 text-indigo"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">Options</div>
                    <a href="{{ route('page.view', $page->slug) }}" class="dropdown-item"><i class="icon-eye"></i>View</a>
                    <a href="{{ route('page.edit', $page->slug) }}" class="dropdown-item"><i class="icon-pencil7"></i>Edit</a>
                    <a @click="deleteRecords('{{ $page->slug }}')" class="dropdown-item">
                        <i class="icon-bin"></i>Delete
                    </a>
                    <div class="dropdown-header">Export</div>
                    <a href="javascript:void(0)" @click="exportRecords('xlsx', '{{ $page->id }}')" class="dropdown-item"><i class="icon-file-pdf"></i> Export to .xlsx</a>
                    <a href="javascript:void(0)" @click="exportRecords('csv', '{{ $page->id }}')" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                    <a href="javascript:void(0)" @click="exportRecords('html', '{{ $page->id }}')" class="dropdown-item"><i class="icon-file-spreadsheet"></i> Export to .html</a>
                </div>
            </div>
        </div>
    </td>
</tr>