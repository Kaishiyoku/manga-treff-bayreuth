@extends('app')

@section('content')
    <h1>@lang('profile.login_attempts.title')</h1>

    <p class="lead">
        @lang('profile.login_attempts.the_last_logins_are_shown')
    </p>

    @if ($loginAttempts->count() == 0)
        @include('shared._no_entries_yet')
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="40px"></th>
                <th>{{ trans('validation.attributes.status') }}</th>
                <th>{{ trans('validation.attributes.ip_address') }}</th>
                <th>{{ trans('validation.attributes.login_at') }}</th>
                <th>{{ trans('common.estimated_location') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($loginAttempts as $loginAttempt)
                @if ($loginAttempt->isSuccess())
                    <tr>
                @else
                    <tr class="text-danger">
                        @endif
                        <td>
                            @if ($loginAttempt->isFailure())
                                <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td>{{ translateLoginAttemptStatus($loginAttempt->status) }}</td>
                        <td>{{ $loginAttempt->ip_address }}</td>
                        <td>{{ $loginAttempt->login_at->format(__('date.datetime')) }}</td>
                        <td>
                            @include('shared._location', ['location' => geoip($loginAttempt->ip_address)])
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    @endif
@endsection
