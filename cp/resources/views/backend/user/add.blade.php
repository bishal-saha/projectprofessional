@extends('backend.layouts.admin')

@section('page-title', 'Add User')

@section('page-heading')
    <i class="icon-user text-indigo mr-2"></i>
    <span class="font-weight-semibold">User</span> - Add
@endsection

@section('breadcrumbs')
    <a href="{{ route('user.list') }}" class="breadcrumb-item"><i class="icon-users4 mr-2"></i> Users</a>
    <span class="breadcrumb-item active">Add</span>
@stop

@section('content')

@include('backend.partials.alerts')
<form action="{{ route('user.store') }}" method="post" name="user-form" id="user-form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>User Details</h5>
                        <p class="text-muted font-weight-light">
                            A general user profile information.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    @include('backend.user.partials.details', ['edit' => false, 'profile' => false])
                </div>
            </div>

        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Login Details</h5>
                        <p class="text-muted font-weight-light">
                            Details used for authenticating with the application.
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    @include('backend.user.partials.auth', ['edit' => false])
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary" id="update-login-details-btn">Save User Details <i class="icon-paperplane ml-2"></i></button>
            <a href="{{ url()->previous() }}" class="btn btn-light ml-2" id="cancel-btn">Cancel </a>
        </div>
    </div>
</form>

@endsection

@push('header')
    <link href="{{ asset('vendor/datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">
@endpush
@push('footer')
    <script src="{{ asset('vendor/datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/user_pages_profile.js') }}"></script>
    <script src="{{ asset('backend/js/as/profile.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\User\CreateUserRequest', '#user-form') !!}
@endpush