<div class="card">
    <div class="card-header">
        <h5 class="card-title">Google reCAPTCHA</h5>
        <small class="text-muted d-block mb-4">
            Enable/Disable Google reCAPTCHA during the registration.
        </small>
    </div>
    <div class="card-body">
        @if (! (!config('captcha.secret') && !config('captcha.sitekey')))
            <div class="alert alert-info">
                To utilize Google reCAPTCHA, please get your',
                'site_key <code>Site Key</code> and <code>Secret Key</code>
                from <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank"><strong>reCAPTCHA Website</strong></a>,
                and update your <code>RECAPTCHA_SITEKEY</code> and <code>RECAPTCHA_SECRETKEY</code> environment variables inside <code>.env</code> file.
            </div>
        @else
            @if (appSettings('registration.captcha.enabled'))
                <form action="{{ route('settings.registration.captcha.disable') }}" method="post" name="captcha-settings-form" id="captcha-settings-form">
                    @csrf
                <button type="submit" class="btn btn-danger">
                    Disable <i class="icon-paperplane ml-2"></i>
                </button>

                </form>
            @else
                <form action="{{ route('settings.registration.captcha.enable') }}" method="post" name="captcha-settings-form" id="captcha-settings-form">
                    @csrf
                <button type="submit" class="btn btn-primary">
                    Enable <i class="icon-paperplane ml-2"></i>
                </button>
                </form>
            @endif
        @endif
    </div>
</div>