@extends('backend.layouts.admin')

@section('page-title', 'General Settings')

@section('page-heading')
    <i class="icon-cog text-indigo mr-2"></i>
    <span class="font-weight-semibold">Settings</span> - General
@endsection

@section('breadcrumbs')
    <span class="breadcrumb-item text-muted"><i class="icon-cog mr-2"></i> Settings</span>
    <span class="breadcrumb-item active">General</span>
@stop

@section('content')

@include('backend.partials.alerts')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Application</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.general.update') }}" method="post" name="general-settings-form" id="general-settings-form">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name:</label>
                        <div class="col-lg-9">
                            <input type="text" id="app_name" name="app_name" value="{{ appSettings('app_name') }}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Update Settings <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop