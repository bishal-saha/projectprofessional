@extends('backend.layouts.admin')

@section('page-title', 'Pages')

@section('page-heading')
    <i class="icon-magazine text-indigo mr-2"></i>
    <span class="font-weight-semibold">Pages</span>
@endsection

@section('breadcrumbs')
    <span class="breadcrumb-item active"><i class="icon-magazine mr-2"></i> Pages</span>
@stop

@section('content')
    @include('backend.partials.alerts')

    <div class="card" id="myApp">
        @include('backend.pages.partials.header')
        <div class="table-responsive">
            <table class="table table-togglable table-hover">
                <thead>
                <tr>
                    <th width="5%" data-hide="phone" data-ignore="true">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="checkbox" v-model="selectAll" class="">
                            </label>
                            <div class="list-icons ml-2">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9 text-indigo"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">Options</div>
                                        <a href="javascript:void(0)" @click="deleteRecords()" class="dropdown-item"><i class="icon-bin"></i>Delete</a>
                                        <div class="dropdown-header">Export</div>
                                        <a href="javascript:void(0)" @click="exportRecords('xlsx')" class="dropdown-item"><i class="icon-file-excel"></i> Export to .xlsx</a>
                                        <a href="javascript:void(0)" @click="exportRecords('csv')" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                        <a href="javascript:void(0)" @click="exportRecords('html')" class="dropdown-item"><i class="icon-file-spreadsheet"></i> Export to .html</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </th>
                    <th width="20%" data-toggle="true">Name</th>
                    <th width="20%" data-hide="phone">Browse Slug</th>
                    <th width="50%" data-hide="phone">Excerpt</th>
                    <th width="5%" class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($pages))
                    @foreach ($pages as $page)
                        @include('backend.pages.partials.row')
                    @endforeach
                @else
                    <tr>
                        <td colspan="6"><em>No records found!</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    Showing <span class="font-weight-bold text-indigo">{{ $pages->firstItem() }}</span>
                    to <span class="font-weight-bold text-indigo">{{ $pages->lastItem() }}</span>
                    of <span class="font-weight-bold text-indigo">{{ $pages->total() }}</span> entries
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="pull-right">
						<?php $paginaParam = ['per_page' => Request::get('per_page'), 'search' => Request::get('search')];?>
                        {{ $pages->appends($paginaParam)->links('backend.vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>

            <div>

            </div>
        </div>
        <form :action="actionUrl" id="form_export" name="form_export" method="POST">
            @csrf
            <input type="hidden" name="uuids" :value="selectedIds">
            <input type="hidden" name="export_type" :value="exportType">
        </form>
        <form :action="actionUrl" id="form_delete" name="form_delete" method="POST">
            @csrf
            <input type="hidden" name="slugs" id="slugs" :value="selectedIds">
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
                                $('#'+value.toString()).prop('checked', true);
                            });
                        }
                        this.selectedIds = selected;
                    }
                }
            },
            methods: {
                deleteRecords: function (slug) {
                    this.actionUrl = '{{ route('page.delete') }}';

                    swal({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this page!',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function (result) {
                        if (result.value) {
                            if (slug) {
                                $('#slugs').val(slug);
                            }
                            $('#form_delete').submit();
                        }
                    });
                },
                exportRecords: function (exportType, uuid = null) {
                    this.exportType = exportType;
                    this.actionUrl = '{{ route('page.export') }}';

                    // if single export
                    if (uuid) {
                        this.selectedIds = uuid;
                    }

                    swal({
                        title: 'Report prepared',
                        text: 'Press the button DOWNLOAD to save the file.',
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Download ' + this.exportType + ' file.',
                        cancelButtonText: 'Discard',
                    }).then(function (result) {
                        if (result.value) {
                            $('#form_export').submit();
                        }
                    });
                }
            }
        });
    </script>
@endpush
