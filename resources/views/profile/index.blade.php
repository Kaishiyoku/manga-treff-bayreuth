@extends('layouts.app')

@section('content')
    <h1>@lang('profile.index.title')</h1>

    <div class="md:flex md:justify-between">
        <div class="mr-4">
            <h2>@lang('common.general')</h2>

            <div>
                @lang('profile.index.registered_at'): {{ $user->created_at->format(__('date.datetime')) }}
            </div>

            <h2>@lang('common.security')</h2>

            <div class="text-lg mb-2">
                {!! Html::decode(Html::linkRoute('profile.login_attempts', '<i class="fas fa-shield-alt"></i> ' . __('profile.login_attempts.title'), null, ['class' => 'link'])) !!}
            </div>

            <div class="text-lg mb-2">
                {!! Html::decode(Html::linkRoute('profile.active_sessions', '<i class="fas fa-desktop" aria-hidden="true"></i> ' . __('profile.active_sessions.title'), null, ['class' => 'link'])) !!}
            </div>

            <div class="text-lg">
                {!! Html::decode(Html::linkRoute('profile.show_delete_account_confirmation', '<i class="fas fa-user-times"></i> ' . __('profile.delete_account.title'), null, ['class' => 'link'])) !!}
            </div>

            <h2>{{ __('profile.index.options') }}</h2>

            <p class="text-lg mb-2">
                {!! Html::decode(Html::linkRoute('profile.edit_email', '<i class="fas fa-envelope" aria-hidden="true"></i> ' . __('profile.edit_email.title'), null, ['class' => 'link'])) !!}
            </p>

            <div class="text-lg">
                {!! Html::decode(Html::linkRoute('profile.edit_password', '<i class="fas fa-key" aria-hidden="true"></i> ' . __('profile.edit_password.title'), null, ['class' => 'link'])) !!}
            </div>
        </div>

        <div class="w-1/2 mt-12 md:mt-0">
            <h2>@lang('profile.index.visited_meetups')</h2>

            @if ($user->meetupRegistrations->isEmpty())
                <div class="italic text-lg text-muted">@lang('profile.index.no_visited_meetups_yet')</div>
            @else
                @foreach ($user->meetupRegistrations as $meetupRegistration)
                    {{ Html::linkRoute('meetups.show', $meetupRegistration->meetup->name, $meetupRegistration->meetup, ['class' => 'link']) }}
                    am
                    {{ $meetupRegistration->meetup->date_start->format(__('date.datetime')) }}
                @endforeach
            @endif
        </div>
    </div>
@endsection
