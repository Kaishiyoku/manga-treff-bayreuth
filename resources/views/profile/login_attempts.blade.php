@extends('layouts.app')

@section('content')
    <h1>@lang('profile.login_attempts.title')</h1>

    <div class="italic pb-5">
        @lang('profile.login_attempts.the_last_logins_are_shown')
    </div>

    @if ($loginAttempts->count() == 0)
        @include('shared._no_entries_yet')
    @else
        <div class="card">
            <table class="table">
                <thead>
                <tr>
                    <th>@lang('validation.attributes.status')</th>
                    <th>@lang('validation.attributes.ip_address')</th>
                    <th>@lang('validation.attributes.login_at')</th>
                    <th>@lang('common.estimated_location')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($loginAttempts as $loginAttempt)
                    <tr class="{{ classNames('border-l-8', ['border-transparent' => $loginAttempt->isSuccess(), 'text-red-700 border-red-500' => $loginAttempt->isFailure()]) }}">
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
        </div>
    @endif
@endsection
