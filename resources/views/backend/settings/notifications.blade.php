@extends('backend.layouts.admin')

@section('page-title', 'Notifications Settings')
@section('page-heading')
    <i class="icon-cog text-indigo mr-2"></i>
    <span class="font-weight-semibold">Settings</span> - Notifications
@endsection

@section('breadcrumbs')
    <span class="breadcrumb-item text-muted"><i class="icon-cog mr-2"></i> Settings</span>
    <span class="breadcrumb-item active">Notifications</span>
@stop

@section('content')
    @include('backend.partials.alerts')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Email Notifications</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.notifications.update') }}" method="post" name="notification-settings-form" id="notification-settings-form">
                        @csrf
                        <div class="form-group my-4">
                            <div class="form-check form-check-right form-check-switchery">
                                <label class="form-check-label">
                                    Sign-Up Notification

                                    <input type="hidden" value="0" name="notifications_signup_email">
                                    <input type="checkbox" name="notifications_signup_email" value="1"
                                           id="switch-signup-email" class="form-check-input-switchery"
                                           {{ appSettings('notifications_signup_email') ? 'checked' : '' }} data-fouc>

                                    <br>
                                    <small class="pt-0 text-muted">
                                        Send an email to the Administrators when user signs up.
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
        </div>
    </div>
@stop

@push('footer')

@endpush
