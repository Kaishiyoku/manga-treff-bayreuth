@extends('app')

@section('content')
    <h1>{{ __('profile.active_sessions.title') }}</h1>

    <p class="lead">
        {{ __('profile.active_sessions.here_are_all_your_sessions_displayed') }}
    </p>

    <div class="alert alert-info">
        {{ __('profile.active_sessions.current_session_info') }}
    </div>

    @if ($databaseSessions->count() == 0)
        @include('shared._no_entries_yet')
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="15%">{{ __('validation.attributes.ip_address') }}</th>
                    <th>{{ __('validation.attributes.user_agent') }}</th>
                    <th width="22%">{{ __('common.estimated_location') }}</th>
                    <th width="12%">{{ __('validation.attributes.last_activity') }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($databaseSessions as $databaseSession)
                    <tr>
                        <td>{{ $databaseSession->ip_address }}</td>
                        <td>{{ $databaseSession->user_agent }}</td>
                        <td>
                            @include('shared._location', ['location' => geoip($databaseSession->ip_address)])
                        </td>
                        <td>
                            {{ (new \Carbon\Carbon(date("Y-m-d H:i:s", $databaseSession->last_activity)))->format(__('date.short')) }}
                        </td>
                        <td>
                            {{ Form::open(['route' => 'profile.destroy_session', 'method' => 'delete', 'role' => 'form']) }}
                                {{ Form::hidden('id', $databaseSession->id) }}

                                {{ Form::button('<i class="fas fa-sign-out" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sn', 'data-confirm' => '', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => __('profile.active_sessions.destroy')]) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection