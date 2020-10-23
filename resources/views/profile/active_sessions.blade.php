@extends('layouts.app')

@section('content')
    <h1>{{ __('profile.active_sessions.title') }}</h1>

    <div class="italic">
        {{ __('profile.active_sessions.here_are_all_your_sessions_displayed') }}
    </div>

    <div class="alert alert-info">
        {{ __('profile.active_sessions.current_session_info') }}
    </div>

    @if ($databaseSessions->count() === 0)
        @include('shared._no_entries_yet')
    @else
        <div class="card">
            <table class="table">
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
                            {{ html()->form('delete', route('profile.destroy_session'))->open() }}
                                {{ html()->hidden('id', $databaseSession->id) }}

                                {{ html()->button('<i class="fas fa-sign-out-alt"></i>', 'submit')->attributes(['class' => 'btn btn-sm btn-danger', 'data-confirm' => '']) }}
                            {{ html()->form()->close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
