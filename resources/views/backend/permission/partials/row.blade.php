<tr>
    <td>
        <label class="form-check-label">
            <input type="checkbox" name="select_id" id="{{ $role->uuid }}" value="{{ $role->uuid }}" v-model="selectedIds" class="">
        </label>
        <span class="ml-2">
            {{ (($roles->currentPage() - 1) * $roles->perPage())+$loop->iteration }}
        </span>
    </td>
    <td>{{ $role->name }}</td>
    <td>{{ $role->display_name }}</td>
    <td>{{ $role->description }}</td>
    <td class="text-center">{{ $role->users_count }}</td>
    <td class="text-center">
        <div class="list-icons">
            <div class="dropdown">
                <a href="#" class="list-icons-item" data-toggle="dropdown">
                    <i class="icon-menu9 text-indigo"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">Options</div>
                    <a href="{{ route('role.view', $role->uuid) }}" class="dropdown-item">
                        <i class="icon-eye"></i>View
                    </a>
                    <a href="{{ route('role.edit', $role->uuid) }}" class="dropdown-item">
                        <i class="icon-pencil7"></i>Edit
                    </a>
                    <a @click="deleteRecords('{{ $role->uuid }}')" class="dropdown-item">
                        <i class="icon-bin"></i>Delete
                    </a>
                    <div class="dropdown-header">Export</div>
                    <a href="javascript:void(0)" @click="exportRecords('xlsx', '{{ $role->uuid }}')" class="dropdown-item"><i class="icon-file-pdf"></i> Export to .xlsx</a>
                    <a href="javascript:void(0)" @click="exportRecords('csv', '{{ $role->uuid }}')" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                    <a href="javascript:void(0)" @click="exportRecords('html', '{{ $role->uuid }}')" class="dropdown-item"><i class="icon-file-spreadsheet"></i> Export to .html</a>
                </div>
            </div>
        </div>
    </td>
</tr>