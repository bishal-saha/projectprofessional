@extends('backend.layouts.admin')

@section('page-title', $user->present()->nameOrEmail . ' - ' . 'Active Sessions')

@section('page-heading')
    <i class="icon-user text-indigo mr-2"></i>
    <span class="font-weight-semibold">Sessions</span> - {{ $user->present()->nameOrEmail }}
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

<div class="card" id="myApp">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>IP Address</th>
                        <th>Device</th>
                        <th>Browser</th>
                        <th>Last Activity</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($sessions))
                        @foreach ($sessions as $session)
                            <tr>
                                <td>{{ $session->ip_address }}</td>
                                <td>
                                    {{ $session->device ?: 'Unknown' }} ({{ $session->platform ?: 'Unknown' }})
                                </td>
                                <td>{{ $session->browser ?: 'Unknown' }}</td>
                                <td>{{ $session->last_activity->format(config('app.date_time_format')) }}</td>
                                <td class="text-center">
                                    <a href="javascript:return void(0);"
                                       class="btn btn-icon"
                                       title="Invalidate Session"
                                       @click="invalidateSession('{{ isset($profile) ? route('invalidate.my.sessions', $session->id) : route('user.sessions.invalidate', [$user->id, $session->id]) }}')">
                                        <i class="icon-cross3 text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="6"><em>No records found.</em></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <form :action="actionUrl" id="form_action" name="form_action" method="POST">
        @csrf
        <input type="hidden" name="_method" value="delete">
    </form>
</div>


@stop

@push('footer')
    <script>
        const myApp = new Vue({
            el: '#myApp',
            data: {
                actionUrl : '',
                sessionId : '',
            },
            methods: {
                invalidateSession: function (actionUrl) {
                    this.actionUrl = actionUrl;
                    swal({
                        title: 'Please Confirm',
                        text: 'Are you sure that you want to invalidate this session?',
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonClass: "btn btn-primary",
                        confirmButtonText: 'Yes, proceed!',
                        confirmButtonClass: "btn btn-danger",
                    }).then(function (result) {
                        if (result.value) {
                            $('#form_action').submit();
                        }
                    });
                }
            }
        });
    </script>
@endpush
