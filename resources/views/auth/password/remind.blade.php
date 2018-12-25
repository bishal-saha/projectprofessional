@extends('auth.layouts.auth')

@section('page-title', 'Reset Password')

@section('content')
    <!-- Password recovery form -->
    <form class="login-form" role="form" action="{{ route('password.remind') }}" method="POST" id="remind-password-form" autocomplete="off">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1"></i>
                    <h5 class="mb-0">Forgot Your Password?</h5>
                    <span class="d-block text-muted">Please provide your email below and we will send you a password reset link.</span>
                </div>

                <div class="form-group">
                    @include('backend.partials.alerts')
                </div>

                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Your E-Mail">
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                </div>

                <button type="submit" class="btn bg-blue btn-block" id="btn-reset-password">
                    <i class="icon-spinner11 mr-2"></i> Reset Password
                </button>
            </div>
        </div>
    </form>
    <!-- /password recovery form -->
@stop

@push('header')
@endpush

@push('footer')
    {!! JsValidator::formRequest('App\Http\Requests\Auth\PasswordRemindRequest', '#remind-password-form') !!}
@endpush