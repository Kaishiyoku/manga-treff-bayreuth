@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="avatar mr-5">
            @if ($user->is_member && $user->hasMedia())
                <img src="{{ $user->getLatestAvatarUrl('thumb-100') }}" alt="Avatar" class="mb-2 rounded-full"/>
            @else
                @include('shared._none_user_avatar')
            @endif
        </div>

        <div class="text-4xl">@lang('profile.index.title')</div>
    </div>

    <div class="md:flex md:justify-between">
        <div class="mr-4">
            <h2>@lang('common.general')</h2>

            <div>
                @lang('profile.index.registered_at'): {{ $user->created_at->format(__('date.datetime')) }}
            </div>

            <h2>@lang('common.security')</h2>

            <div class="text-lg mb-2">
                {{ html()->a(route('profile.login_attempts'), '<i class="fas fa-shield-alt"></i> ' . __('profile.login_attempts.title'))->class('link') }}
            </div>

            <div class="text-lg mb-2">
                {{ html()->a(route('profile.active_sessions'), '<i class="fas fa-desktop" aria-hidden="true"></i> ' . __('profile.active_sessions.title'))->class('link') }}
            </div>

            <div class="text-lg">
                {{ html()->a(route('profile.show_delete_account_confirmation'), '<i class="fas fa-user-times"></i> ' . __('profile.delete_account.title'))->class('link') }}
            </div>

            <h2>{{ __('profile.index.options') }}</h2>

            <p class="text-lg mb-2">
                {{ html()->a(route('profile.edit'), '<i class="fas fa-user-edit"></i> ' . __('profile.edit.title'))->class('link') }}
            </p>

            <p class="text-lg mb-2">
                {{ html()->a(route('profile.edit_email'), '<i class="fas fa-envelope" aria-hidden="true"></i> ' . __('profile.edit_email.title'))->class('link') }}
            </p>

            <div class="text-lg">
                {{ html()->a(route('profile.edit_password'), '<i class="fas fa-key" aria-hidden="true"></i> ' . __('profile.edit_password.title'))->class('link') }}
            </div>
        </div>

        <div class="w-1/2 mt-12 md:mt-0">
            <h2>@lang('profile.index.visited_meetups')</h2>

            @if ($user->meetupRegistrations->isEmpty())
                <div class="italic text-lg text-muted">@lang('profile.index.no_visited_meetups_yet')</div>
            @else
                @foreach ($user->meetupRegistrations as $meetupRegistration)
                    <div>
                        {{ html()->a(route('meetups.show', $meetupRegistration->meetup), $meetupRegistration->meetup->name)->class('link') }}
                        @lang('common.at')
                        {{ $meetupRegistration->meetup->date_start->format(__('date.datetime')) }}
                    </div>
                @endforeach
            @endif

            <h2 class="mt-8">@lang('validation.attributes.about_me')</h2>

            @if ($user->about_me)
                <div class="prose max-w-none">
                    {!! parseMarkdown($user->about_me) !!}
                </div>
            @else
                <div class="italic text-lg text-muted">@lang('user.show.about_me_empty', ['name' => $user->name])</div>
            @endif
        </div>
    </div>
@endsection
