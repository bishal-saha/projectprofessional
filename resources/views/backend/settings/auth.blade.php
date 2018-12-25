@extends('backend.layouts.admin')

@section('page-title', 'Authentication Settings')
@section('page-heading')
    <i class="icon-cog text-indigo mr-2"></i>
    <span class="font-weight-semibold">Settings</span> - Authentication
@endsection

@section('breadcrumbs')
    <span class="breadcrumb-item text-muted"><i class="icon-cog mr-2"></i> Settings</span>
    <span class="breadcrumb-item active">Authentication</span>
@stop

@section('content')
    @include('backend.partials.alerts')
    <div class="row">
        <div class="col-md-6">
            @include('backend.settings.partials.auth')
        </div>
        <div class="col-md-6">
            @include('backend.settings.partials.registration')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('backend.settings.partials.throttling')
        </div>
        <div class="col-md-6">
            @include('backend.settings.partials.recaptcha')
        </div>
    </div>
@stop

@push('footer')
@endpush
