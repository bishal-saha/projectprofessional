@extends('backend.layouts.admin')

@section('page-title', 'Roles')

@section('page-heading')
    <i class="icon-users4 text-indigo mr-2"></i>
    <span class="font-weight-semibold">Role</span> - {{ $role->name }}
@endsection

@section('breadcrumbs')
    <a href="{{ route('role.index') }}" class="breadcrumb-item"><i class="icon-theater mr-2"></i> Roles</a>
    <span class="breadcrumb-item active">View</span>
@stop

@section('content')
    @include('backend.partials.alerts')
<div id="myApp">
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
                    <dl class="row">
                        <dt class="col-md-3">Name:</dt>
                        <dd class="col-md-9">{{ $role->name }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-md-3">Display Name:</dt>
                        <dd class="col-md-9">{{ $role->display_name }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-md-3">Description:</dt>
                        <dd class="col-md-9">{{ $role->description }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <a class="btn bg-indigo btn-block mb-3 legitRipple" href="{{ route('role.edit', $role->uuid) }}">
                        Edit Details <i class="fa icon-paperplane ml-2"></i>
                    </a>
                    <button type="button" @click="deleteRecords('{{ $role->uuid }}')" class="btn bg-pink btn-block mb-3 legitRipple">
                        Delete This Role <i class="fa icon-trash ml-2"></i>
                    </button>
                    <a class="btn bg-green btn-block legitRipple" href="{{ route('role.index') }}">
                        Return to Roles <i class="fa icon-arrow-left52 ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form :action="actionUrl" id="form_delete" name="form_delete" method="POST">
        @csrf
        <input type="hidden" name="uuids" :value="selectedIds">
        <input type="hidden" name="_method" value="DELETE">
    </form>
</div>
@endsection

@push('footer')
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