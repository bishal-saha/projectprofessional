@extends('auth.layouts.auth')

@section('page-title', 'Login')

@section('content')
    <form class="login-form wmin-sm-400" action="{{ route('post.login') }}" method="post"  id="login-form" autocomplete="off">
        @csrf
        @if(\Illuminate\Support\Facades\Input::has('to'))
            <input type="hidden" value="{{ \App\Http\Requests\Request::get('to') }}" name="to">
        @endif
        <div class="card mb-0">
            <div class="tab-content card-body">
                <div class="tab-pane fade show active" id="login-tab1">
                    <div class="text-center mb-3">
                        <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Login to your account</h5>
                        <span class="d-block text-muted">Your credentials</span>
                    </div>

                    <div class="form-group">
                        @include('backend.partials.alerts')
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input name="username" id="username" type="text" class="form-control" placeholder="Username">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group d-flex align-items-center">
                        @if (appSettings('remember_me'))
                        <div class="form-check mb-0">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" id="remember" value="1" class="form-input-styled" checked data-fouc>
                                Remember
                            </label>
                        </div>
                        @endif
                        @if (appSettings('forgot_password'))
                            <a href="{{ route('password.remind') }}" class="ml-auto">Forgot password?</a>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>

                    @if (appSettings('reg_enabled'))
                    <div class="form-group text-center text-muted content-divider">
                        <span class="px-2">Don't have an account?</span>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('registration') }}" class="btn btn-light btn-block">Sign up</a>
                    </div>
                    @endif
                    <span class="form-text text-center text-muted">
                        By continuing, you're confirming that you've read our <br>
                        <a href="{{ route('frontend.page', 'terms-of-services') }}" target="_blank">Terms &amp; Conditions</a>
                        and <a href="{{ route('frontend.page', 'cookies-policy') }}" target="_blank">Cookie Policy</a>
                    </span>
                </div>
            </div>
        </div>
    </form>
@stop

@push('header')
@endpush

@push('footer')
    {!! JsValidator::formRequest('App\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@endpush