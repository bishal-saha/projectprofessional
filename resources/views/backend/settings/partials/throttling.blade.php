<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Authentication Throttling</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('settings.auth.update') }}" method="post" name="auth-throttle-settings-form" id="auth-throttle-settings-form">
            @csrf
            <div class="form-group my-4">
                <div class="form-check form-check-right form-check-switchery">
                    <label class="form-check-label">
                        Throttle Authentication

                        <input type="hidden" value="0" name="throttle_enabled">
                        <input type="checkbox" name="throttle_enabled" value="1"
                               id="switch-tos" class="form-check-input-switchery"
                               {{ appSettings('throttle_enabled') ? 'checked' : '' }} data-fouc>

                        <br>
                        <small class="pt-0 text-muted">
                            Should the system throttle authentication attempts?
                        </small>
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label for="throttle_attempts" class="col-lg-10 col-form-label">
                    Should the system throttle authentication attempts?: <br>
                    <small class="text-muted">Should the system throttle authentication attempts?</small></label>
                <div class="col-lg-2">
                    <input type="number" name="throttle_attempts" id="throttle_attempts" class="form-control"
                           value="{{ appSettings('throttle_attempts', 10) }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="throttle_lockout_time" class="col-lg-10 col-form-label">
                    Lockout Time <br>
                    <small class="text-muted">Number of minutes to lock the user out for after
                        specified maximum number of incorrect login attempts.</small>
                </label>
                <div class="col-lg-2">
                    <input type="number" name="throttle_lockout_time" id="throttle_lockout_time" class="form-control"
                           value="{{ appSettings('throttle_lockout_time', 10) }}">
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Update Settings <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>