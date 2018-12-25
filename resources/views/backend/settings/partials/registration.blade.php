<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Registration</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('settings.auth.update') }}" method="post" name="registration-settings-form" id="registration-settings-form">
            @csrf
            <div class="form-group my-4">
                <div class="form-check form-check-right form-check-switchery">
                    <label class="form-check-label">
                        Allow Registration

                        <input type="hidden" value="0" name="reg_enabled">
                        <input type="checkbox" name="reg_enabled" value="1"
                               id="switch-reg-enabled" class="form-check-input-switchery"
                               {{ appSettings('reg_enabled') ? 'checked' : '' }} data-fouc>
                    </label>
                </div>
            </div>
            <div class="form-group my-4">
                <div class="form-check form-check-right form-check-switchery">
                    <label class="form-check-label">
                        Terms & Conditions

                        <input type="hidden" value="0" name="tos">
                        <input type="checkbox" name="tos" value="1"
                               id="switch-tos" class="form-check-input-switchery"
                               {{ appSettings('tos') ? 'checked' : '' }} data-fouc>

                        <br>
                        <small class="pt-0 text-muted">
                            The user has to confirm that he agree with terms
                            and conditions in order to create an account.
                        </small>
                    </label>
                </div>
            </div>
            <div class="form-group my-4">
                <div class="form-check form-check-right form-check-switchery">
                    <label class="form-check-label">
                        Email Confirmation

                        <input type="hidden" value="0" name="reg_email_confirmation">
                        <input type="checkbox" name="reg_email_confirmation" value="1"
                               id="switch-reg-email-confirm" class="form-check-input-switchery"
                               {{ appSettings('reg_email_confirmation') ? 'checked' : '' }} data-fouc>

                        <br>
                        <small class="pt-0 text-muted">
                            Require email confirmation from your newly registered users.
                        </small>
                    </label>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Update Settings <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>