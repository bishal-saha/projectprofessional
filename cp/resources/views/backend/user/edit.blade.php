@extends('backend.layouts.admin')

@section('page-title', 'Edit User')

@section('page-heading')
    <i class="icon-user text-indigo mr-2"></i>
    <span class="font-weight-semibold">User</span> - {{ $user->present()->nameOrEmail }} - Edit
@endsection

@section('breadcrumbs')
    <a href="{{ route('user.list') }}" class="breadcrumb-item"><i class="icon-users4 mr-2"></i> Users</a>
    <span class="breadcrumb-item active">Edit</span>
@stop

@section('content')
    @include('backend.partials.alerts')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active"
                               id="details-tab"
                               data-toggle="tab"
                               href="#details"
                               role="tab"
                               aria-controls="home"
                               aria-selected="true">
                                <strong>User Details</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               id="authentication-tab"
                               data-toggle="tab"
                               href="#login-details"
                               role="tab"
                               aria-controls="home"
                               aria-selected="true">
                                <strong>Login Details</strong>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-4" id="nav-tabContent">
                        <div class="tab-pane fade show active px-2" id="details" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form action="{{ route('user.update.details', $user->uuid) }}" method="POST" id="details-form">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                @include('backend.user.partials.details', ['profile' => false])
                            </form>
                        </div>
                        <div class="tab-pane fade px-2" id="login-details" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form action="{{ route('user.update.login-details', $user->uuid) }}" method="POST" id="login-details-form">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                @include('backend.user.partials.auth')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <form action="{{ route('user.update.avatar', $user->uuid) }}" method="post" id="avatar-form" enctype="multipart/form-data">
                @csrf
                @include('backend.user.partials.avatar', ['updateUrl' => route('user.update.avatar.external', $user->uuid)])
            </form>
        </div>
    </div>

@stop

@push('header')
    <link href="{{ asset('vendor/datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/croppie/croppie.css') }}" rel="stylesheet" type="text/css">
@endpush
@push('footer')
    <script src="{{ asset('vendor/datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/croppie/croppie.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/user_pages_profile.js') }}"></script>
    <script src="{{ asset('backend/js/as/profile.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateDetailsRequest', '#details-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\User\UpdateLoginDetailsRequest', '#login-details-form') !!}
@endpush