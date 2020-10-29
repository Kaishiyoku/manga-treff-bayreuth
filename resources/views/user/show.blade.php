@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-12">
        <div class="avatar mr-5">
            @if ($user->is_member && $user->hasMedia())
                <img src="{{ $user->getLatestAvatarUrl('thumb-100') }}" alt="Avatar" class="mb-2 rounded-full"/>
            @else
                @include('shared._none_user_avatar')
            @endif
        </div>

        <div class="text-4xl">{{ $user->name }}</div>
    </div>

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
@endsection
