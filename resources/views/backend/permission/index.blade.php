@extends('backend.layouts.admin')

@section('page-title', 'Permissions')

@section('page-heading')
    <i class="icon-grid5 text-indigo mr-2"></i>
    <span class="font-weight-semibold">Permissions</span>
@endsection

@section ('breadcrumbs')
    <span class="breadcrumb-item active"><i class="icon-grid5 mr-2"></i> Permissions</span>
@endsection

@section('content')
    @include('backend.partials.alerts')

    <div class="card" id="myApp">
        @include('backend.permission.partials.header')
        <form action="{{ route('permission.save') }}" method="post">
            @csrf
            <div class="table-responsive">
            <table class="table table-togglable table-hover">
                <thead>
                <tr>
                    <th class="min-width-200">Name</th>
                    @foreach ($roles as $role)
                        <th class="text-center">{{ $role->display_name }}</th>
                    @endforeach
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if (count($permissions))
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->display_name ?: $permission->name }}</td>

                            @foreach ($roles as $role)
                                <td class="text-center">
                                    <label>
                                        <input type="checkbox" name="roles[{{ $role->uuid }}][]" id="cb-{{ $role->uuid }}-{{ $permission->uuid }}" value="{{ $permission->id }}" class="" @if ($role->hasPermission($permission->name)) checked @endif>
                                    </label>
                                </td>
                            @endforeach

                            <td width="15%">
                                <a href="{{ route('permission.edit', $permission->uuid) }}" class="btn btn-icon"
                                   title="Edit Permission">
                                    <i class="icon-pencil5"></i>
                                </a>

                                @if ($permission->removable)
                                    <button type="button" @click="deleteRecords('{{ route('permission.destroy', $permission->uuid) }}' )" class="btn btn-icon text-danger" title="Delete Permission">
                                        <i class="icon-trash-alt"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6"><em>No records found!</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
            @if (count($permissions))
                <div class="row">
                    <div class="col-md-12 text-center mt-4 mb-4">
                        <button type="submit" class="btn bg-indigo">
                            Save Permissions <i class="fa icon-paperplane ml-2"></i>
                        </button>
                    </div>
                </div>
            @endif
        </form>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    Showing <span class="font-weight-bold text-indigo">{{ $permissions->firstItem() }}</span>
                    to <span class="font-weight-bold text-indigo">{{ $permissions->lastItem() }}</span>
                    of <span class="font-weight-bold text-indigo">{{ $permissions->total() }}</span> entries
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="pull-right">
						<?php $paginaParam = ['per_page' => Request::get('per_page'), 'search' => Request::get('search')];?>
                        {{ $permissions->appends($paginaParam)->links('backend.vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <form :action="actionUrl" id="form_export" name="form_export" method="POST">
            @csrf
            <input type="hidden" name="uuids" :value="selectedIds">
            <input type="hidden" name="export_type" :value="exportType">
        </form>
        <form :action="actionUrl" id="form_delete" name="form_delete" method="POST">
            @csrf
            <input type="hidden" name="uuids" :value="selectedIds">
            <input type="hidden" name="_method" value="DELETE">
        </form>
    </div>
@endsection

@push('footer')
    <script>
        var rowIds = [];
        $.each($("input[name='select_id']"), function() {
            rowIds.push($(this).val());
        });
        const myApp = new Vue({
            el: '#myApp',
            data: {
                actionUrl : '',
                selectedIds: [],
                rowIdArray: rowIds,
                exportType : 'csv'
            },
            computed: {
                selectAll: {
                    get: function () {
                        return this.rowIdArray ? this.selectedIds.length === this.rowIdArray.length : false;
                    },
                    set: function (value) {
                        let selected = [];
                        if (value) {
                            this.rowIdArray.forEach(function (value) {
                                selected.push(value.toString());
                                $('#'+value.toString()).attr('checked');
                            });
                        }
                        this.selectedIds = selected;
                    }
                }
            },
            methods: {
                deleteRecords: function (deleteUrl) {
                    this.actionUrl = deleteUrl;

                    swal({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this record!',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function (result) {
                        if (result.value) {
                            $('#form_delete').submit();
                        }
                    });
                }
            }
        });
    </script>
@endpush
