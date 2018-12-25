<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">General</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('settings.auth.update') }}" method="post" name="general-settings-form" id="auth-general-settings-form">
            @csrf
            <div class="form-group my-4">
                <div class="form-check form-check-right form-check-switchery">
                    <label class="form-check-label">
                        Allow "Remember Me

                        <input type="hidden" value="0" name="remember_me">
                        <input type="checkbox" name="remember_me" value="1"
                               id="switch-remember-me" class="form-check-input-switchery"
                               {{ appSettings('remember_me') ? 'checked' : '' }} data-fouc>
                        <br>
                        <small class="pt-0 text-muted">
                            Should 'Remember Me' checkbox be displayed on login form?'
                        </small>
                    </label>
                </div>
            </div>
            <div class="form-group my-4">
                <div class="form-check form-check-right form-check-switchery">
                    <label class="form-check-label">
                        Forgot Password

                        <input type="hidden" value="0" name="forgot_password">
                        <input type="checkbox" name="forgot_password" value="1"
                               id="switch-forgot-pass" class="form-check-input-switchery"
                               {{ appSettings('forgot_password') ? 'checked' : '' }} data-fouc>

                        <br>
                        <small class="pt-0 text-muted">
                            Enable/Disable forgot password feature.
                        </small>
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-10 col-form-label" for="login_reset_token_lifetime">
                    Reset Token Lifetime:
                </label>
                <div class="col-lg-2">
                    <input type="text" name="login_reset_token_lifetime" id="login_reset_token_lifetime"
                           class="form-control" value="{{ appSettings('login_reset_token_lifetime', 30) }}">
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Update Settings <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>