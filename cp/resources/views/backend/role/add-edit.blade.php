@extends('backend.layouts.admin')

@section('page-title', 'Roles')

@section('page-heading')
    <i class="icon-users4 text-indigo mr-2"></i>
    <span class="font-weight-semibold">Role</span> -
    {{ $edit ? $role->name : 'Add New' }}
@endsection

@section('breadcrumbs')
    <a href="{{ route('role.index') }}" class="breadcrumb-item"><i class="icon-theater mr-2"></i> Roles</a>
    <span class="breadcrumb-item active">{{ $edit ? 'Edit' : 'Add' }}</span>
@stop

@section('content')

    @include('backend.partials.alerts')

    <div id="myApp">
        @if ($edit)
            <form action="{{ route('role.update', $role->uuid) }}" method="POST" id="role-form">
                <input type="hidden" name="_method" value="PUT">
        @else
            <form action="{{ route('role.store') }}" method="POST" id="role-form">
        @endif
                @csrf
                <div class="row">
                    <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h5 class="card-title">Role Details</h5>
                                        <p class="text-muted">
                                            A general role information.
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                   name="name" placeholder="Role Name" value="{{ $edit ? $role->name : old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="display_name">Display Name</label>
                                            <input type="text" class="form-control" id="display_name"
                                                   name="display_name" placeholder="Display Name" value="{{ $edit ? $role->display_name : old('display_name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control">{{ $edit ? $role->description : old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <button type="submit" class="btn bg-indigo btn-block mb-3 legitRipple">
                                            {{ $edit ? 'Update' : 'Add' }} <i class="fa icon-paperplane ml-2"></i>
                                        </button>
                                        @if ($edit)
                                            <button type="button" @click="deleteRecords('{{ $role->uuid }}')" class="btn bg-pink btn-block mb-3 legitRipple">
                                                Delete This Role <i class="fa icon-trash ml-2"></i>
                                            </button>
                                        @endif
                                        <a class="btn bg-green btn-block legitRipple" href="{{ route('role.index') }}">
                                            Return to Roles <i class="fa icon-arrow-left52 ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                </div>
            </form>
            <form :action="actionUrl" id="form_delete" name="form_delete" method="POST">
                @csrf
                <input type="hidden" name="uuids" :value="selectedIds">
                <input type="hidden" name="_method" value="DELETE">
            </form>
    </div>
@endsection

@push('footer')
    @if ($edit)
        {!! JsValidator::formRequest('App\Http\Requests\Role\UpdateRoleRequest', '#role-form') !!}
    @else
        {!! JsValidator::formRequest('App\Http\Requests\Role\CreateRoleRequest', '#role-form') !!}
    @endif
    <script>
        const myApp = new Vue({
            el: '#myApp',
            data: {
                actionUrl: '',
                selectedIds: [],
            },
            methods: {
                deleteRecords: function (uuid) {
                    this.actionUrl = '{{ route('role.delete') }}';

                    // if single delete
                    if (uuid) {
                        this.selectedIds = uuid;
                    }

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