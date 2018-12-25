@extends('backend.layouts.admin')

@section('page-title', $user->present()->nameOrEmail)
@section('page-heading')
    <i class="icon-users4 text-indigo mr-2"></i>
    <span class="font-weight-semibold">User</span> - {{ $user->present()->nameOrEmail }} - View
@endsection

@section('breadcrumbs')
    @if (isset($adminView))
        <span class="breadcrumb-item"><a href="{{ route('user.list') }}">Users</a></span>

        <span class="breadcrumb-item">
            <a href="{{ route('user.show', $user->id) }}">
                <i class="icon-user mr-2"></i> {{ $user->present()->nameOrEmail }}
            </a>
        </span>
    @endif

    <span class="breadcrumb-item active">Sessions</span>
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
                            <div class="row">
                                <div class="col-md-5">
                                    <dl class="row">
                                        <dt class="col-md-4">Name:</dt>
                                        <dd class="col-md-8">{{ $user->present()->name }}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-md-4">Role:</dt>
                                        <dd class="col-md-8">{{ $user->role->name }}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-md-4">Status:</dt>
                                        <dd class="col-md-8">{{ $user->status }}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-md-4">Registered:</dt>
                                        <dd class="col-md-8">
                                            {{ $user->created_at }}
                                        </dd>
                                    </dl>
                                </div>
                                <div class="col-md-7">
                                    <dl class="row">
                                        <dt class="col-md-4">Birthday:</dt>
                                        <dd class="col-md-8">{{ $user->present()->birthday }}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-md-4">Phone:</dt>
                                        <dd class="col-md-8">{{ $user->phone }}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-md-4">Address:</dt>
                                        <dd class="col-md-8">{{ $user->present()->fullAddress }}</dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-md-4">Last Logged In:</dt>
                                        <dd class="col-md-8">{{ $user->present()->lastLogin }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade px-2" id="login-details" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <dl class="row">
                                <dt class="col-md-2">Email:</dt>
                                <dd class="col-md-10">{{ $user->email }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md-2">Username:</dt>
                                <dd class="col-md-10">{{ $user->username }}</dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-md-2">Password:</dt>
                                <dd class="col-md-10">******</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center avatar-wrapper">
                    <div id="avatar"></div>
                    <!-- display image -->
                    <div class="card-img-actions avatar-preview">
                        <img class="img-fluid rounded-circle" src="{{ $user->present()->avatar }}" alt="" width="150">
                        <a class="btn bg-teal-400 btn-block mb-2 legitRipple mt-3" href="{{ route('user.edit', $user->uuid) }}">
                            Edit Details <i class="fa icon-paperplane ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5>Latest Activities</h5>
                    <div class="header-elements">
                        @if (count($userActivities))
                        <a class="btn btn-primary legitRipple" href="{{ route('activity.user', $user->uuid) }}" title="Complete Activity Log">View All <i class="fa icon-paperplane ml-2"></i></a>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    @if (count($userActivities))
                    <table class="table table-lg">
                        <thead>
                            <tr>
                                <th style="width: 30%">Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($userActivities as $activity)
                            <tr>
                                <td>{{ $activity->created_at->format(config('app.date_time_format')) }}</td>
                                <td>{{ $activity->description }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="card-body">
                            <p class="text-muted font-weight-light text-center mt-2"><em>No activity from this user yet.</em></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop