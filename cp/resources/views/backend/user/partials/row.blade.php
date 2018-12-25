<tr>
    <td>
        <label class="form-check-label">
            <input type="checkbox" name="select_id" id="{{ $user->uuid }}" value="{{ $user->uuid }}" v-model="selectedIds" class="">
        </label>
        <span class="ml-2">
                {{ (($users->currentPage() - 1) * $users->perPage())+$loop->iteration }}
            </span>
    </td>
    <td><img src="{{ $user->present()->avatar }}" alt="{{ $user->present()->name }}" class="rounded-circle img-responsive mr-1" width="40"> {{ $user->first_name . ' ' . $user->last_name }}</td>
    <td>{{ $user->username ?: 'N/A' }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone ?: 'N/A' }}</td>
    <td>{!! $user->present()->userStatusBadge !!}</td>
    <td class="text-center">
        <div class="list-icons">
            <div class="dropdown">
                <a href="#" class="list-icons-item" data-toggle="dropdown">
                    <i class="icon-menu9 text-indigo"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">Options</div>
                    <a href="{{ route('user.show', $user->uuid) }}" class="dropdown-item"><i class="icon-eye"></i>View</a>
                    <a href="{{ route('user.edit', $user->uuid) }}" class="dropdown-item"><i class="icon-pencil7"></i>Edit</a>
                    <a @click="deleteRecords('{{ $user->uuid }}')" class="dropdown-item">
                        <i class="icon-bin"></i>Delete
                    </a>
                    <div class="dropdown-header">Export</div>
                    <a href="javascript:void(0)" @click="exportRecords('xlsx', '{{ $user->uuid }}')" class="dropdown-item"><i class="icon-file-pdf"></i> Export to .xlsx</a>
                    <a href="javascript:void(0)" @click="exportRecords('csv', '{{ $user->uuid }}')" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                    <a href="javascript:void(0)" @click="exportRecords('html', '{{ $user->uuid }}')" class="dropdown-item"><i class="icon-file-spreadsheet"></i> Export to .html</a>
                </div>
            </div>
        </div>
    </td>
</tr>