@extends('backend.layouts.admin')

@section('page-title', 'Permissions')

@section('page-heading')
    <i class="icon-grid5 text-indigo mr-2"></i>
    <span class="font-weight-semibold">Permission</span> -
    {{ $edit ? $permission->display_name : 'Add New' }}
@endsection()

@section('breadcrumbs')
    <a href="{{ route('permission.index') }}" class="breadcrumb-item"><i class="icon-grid5 mr-2"></i> Permission</a>
    <span class="breadcrumb-item active">{{ $edit ? 'Edit' : 'Add' }}</span>
@stop

@section('content')

@include('backend.partials.alerts')

<div id="myApp">
    @if ($edit)
        <form action="{{ route('permission.update', $permission->uuid) }}" method="POST" id="permission-form">
            <input type="hidden" name="_method" value="PUT">
    @else
        <form action="{{ route('permission.store') }}" method="POST" id="permission-form">
    @endif
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Permission Details</h5>
                            <p class="text-muted">
                                A general permission information.
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name"
                                       name="name" placeholder="Permission Name" value="{{ $edit ? $permission->name : old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input type="text" class="form-control" id="display_name"
                                       name="display_name" placeholder="Display Name" value="{{ $edit ? $permission->display_name : old('display_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ $edit ? $permission->description : old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn bg-indigo btn-block mb-3 legitRipple">
                                {{ $edit ? 'Update Permission' : 'Add Permission' }} <i class="fa icon-paperplane ml-2"></i>
                            </button>
                            @if ($edit)
                                <button type="button" @click="deleteRecords('{{ $permission->uuid }}')" class="btn bg-pink btn-block mb-3 legitRipple">
                                    Delete This Permission <i class="fa icon-trash ml-2"></i>
                                </button type="button">
                            @endif
                            <a class="btn bg-green btn-block legitRipple" href="{{ route('permission.index') }}">
                                Return to Permissions <i class="fa icon-arrow-left52 ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>



@stop

@push('footer')
    @if ($edit)
        {!! JsValidator::formRequest('App\Http\Requests\Permission\UpdatePermissionRequest', '#permission-form') !!}
    @else
        {!! JsValidator::formRequest('App\Http\Requests\Permission\CreatePermissionRequest', '#permission-form') !!}
    @endif
@endpush