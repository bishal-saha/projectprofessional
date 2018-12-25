@extends('auth.layouts.auth')

@section('page-title', 'Reset Password')

@section('content')
    <!-- Password recovery form -->
    <form class="login-form" role="form" action="{{ route('post.password.reset') }}" method="POST" id="reset-password-form" autocomplete="off">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">Reset Your Password</h5>
                    <span class="d-block text-muted">Please provide your email and pick a new password below.</span>
                </div>

                <div class="form-group">
                    @include('backend.partials.alerts')
                </div>

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Your E-Mail">
                    <div class="form-control-feedback">
                        <i class="icon-user-plus text-muted"></i>
                    </div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
                    <div class="form-control-feedback">
                        <i class="icon-user-lock text-muted"></i>
                    </div>
                </div>

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm New Password">
                    <div class="form-control-feedback">
                        <i class="icon-user-lock text-muted"></i>
                    </div>
                </div>

                <button type="submit" class="btn bg-blue btn-block" id="btn-reset-password">
                    <i class="icon-spinner11 mr-2"></i> Update Password
                </button>
            </div>
        </div>
    </form>
    <!-- /password recovery form -->
@stop


@push('footer')
    <!-- Laravel Javascript Validation -->
    {!! JsValidator::formRequest('App\Http\Requests\Auth\PasswordResetRequest', '#reset-password-form') !!}
@endpush