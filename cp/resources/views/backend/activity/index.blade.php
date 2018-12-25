@extends('backend.layouts.admin')

@section('page-title', 'Activity Log')

@section('page-heading')
    <i class="icon-compass4 text-indigo mr-2"></i>
    <span class="font-weight-semibold">User</span> -
    @if (isset($user))
    <span class="font-weight-semibold">{{ $user->present()->nameOrEmail }}</span> -
    @endif
    Activity Log
@endsection()

@section('breadcrumbs')
    <span class="breadcrumb-item active"><i class="icon-compass4 mr-2"></i> Activity Log</span>
@stop

@section('content')
    @include('backend.partials.alerts')
    <div class="card" id="myApp">
        @include('backend.activity.partials.header')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-togglable table-hover">
                    <thead>
                        <tr>
                            @if (isset($adminView))
                            <th width="15%" data-toggle="true">User</th>
                            @endif
                            <th width="15%" data-hide="phone">IP Address</th>
                            <th width="" data-hide="phone">Activity</th>
                            <th width="20%" data-hide="phone">Time</th>
                            <th width="10%" data-hide="phone">More Info</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($activities))
                        @foreach ($activities as $activity)
                        <tr>
                            @if (isset($adminView))
                                <td>
                                    @if (isset($user))
                                        {{ $activity->user->present()->nameOrEmail }}
                                    @else
                                        <a href="{{ route('activity.user', $activity->user->uuid) }}"
                                           data-toggle="tooltip" title="View Activity Lo">
                                            {{ $activity->user->present()->nameOrEmail }}
                                        </a>
                                    @endif
                                </td>
                            @endif
                            <td>{{ $activity->ip_address }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->created_at->format(config('app.date_time_format')) }}</td>
                            <td class="text-center">
                                <a tabindex="0" role="button" class="btn btn-icon"
                                   data-trigger="focus"
                                   data-placement="left"
                                   data-toggle="popover"
                                   title="User Agent"
                                   data-content="{{ $activity->user_agent }}">
                                    <i class="icon-info22"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center"><em>No activity yet!</em></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        @if(count($activities))
        <div class="card-footer">
            <div class="pull-right">
				<?php $paginaParam = ['per_page' => Request::get('per_page'), 'search' => Request::get('search')];?>
                {{ $activities->appends($paginaParam)->links('backend.vendor.pagination.bootstrap-4') }}
            </div>
            <div>
                Showing <span class="font-weight-bold text-indigo">{{ $activities->firstItem() }}</span>
                to <span class="font-weight-bold text-indigo">{{ $activities->lastItem() }}</span>
                of <span class="font-weight-bold text-indigo">{{ $activities->total() }}</span> entries
            </div>
        </div>
        @endif
    </div>
@stop

