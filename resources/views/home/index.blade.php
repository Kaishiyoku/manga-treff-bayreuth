@extends('layouts.app')

@section('content')
    <div class="lg:flex lg:items-start lg:justify-between">
        <div class="lg:w-12/20">
            <div class="md:flex md:items-start">
                <div>
                    <div class="card text-xl mt-4 mb-12">
                        <div class="border-t-4 border-pink-500 p-4">
                            <p>
                                @lang('home.index.description')
                            </p>

                            @if ($nextUpcomingMeetup)
                                <p class="pt-5">
                                    @lang('home.index.meetups.next_upcoming_at', ['date' => '<a href="' . $nextUpcomingMeetup->getUrl() . '" class="link">' . $nextUpcomingMeetup->date_start->format(__('date.short')) . '</a>'])
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="lg:hidden">
                        @include('shared._visitor_notices')
                    </div>

                    <div class="flex flex-col text-center">
                        <a class="btn btn-outline-primary text-xl bg-white" href="{{ route('home.animexx') }}">
                            <i class="far fa-calendar"></i>

                            @lang('home.index.meetups.animexx_series')

                            @include('shared._external_icon')
                        </a>

                        <div class="my-3">
                            @lang('common.or')
                        </div>

                        <a class="btn btn-outline-primary text-xl bg-white" href="{{ route('home.calendar') }}">
                            <i class="far fa-calendar"></i>

                            @lang('home.index.meetups.google_calendar')

                            @include('shared._external_icon')
                        </a>
                    </div>
                </div>

                <img src="{{ asset('img/drawing.png') }}" alt="Mascot" class="hidden md:block w-64 mt-4"/>
            </div>

            @if ($nextUpcomingMeetup)
                <h1 class="pt-12">@lang('home.index.meetups.next_upcoming')</h1>

                @include('home._meetup_card', ['meetup' => $nextUpcomingMeetup, 'classNames' => 'bg-pink-600 text-white'])
            @endif
        </div>

        <div class="lg:w-7/20 lg:mt-0 mt-12">
            <div class="hidden lg:block">
                @include('shared._visitor_notices')
            </div>

            <div class="card">
                <div class="flex items-center bg-teal-500 text-white text-xl px-5 py-3">
                    <i class="fab fa-discord mr-2"></i>

                    <div class="flex-grow">
                        {{ __('common.discord.title') }}
                    </div>

                    <a href="{{ $discordItem->instant_invite }}" class="btn btn-outline-white btn-sm float-right m-0">
                        <i class="fas fa-arrow-right"></i>

                        {{ __('common.discord.connect') }}

                        @include('shared._external_icon')
                    </a>
                </div>

                <div class="p-5 text-sm">
                    <div class="pb-5">
                        @foreach (\Illuminate\Support\Arr::sort($discordItem->channels, function ($channel) { return $channel->position; }) as $channel)
                            <div class="my-1">
                                {{ $channel->name }}

                                @foreach ($getDiscordMembersInChannel($discordItem, $channel->id) as $member)
                                    <div class="flex items-center my-1 ml-5">
                                        <img src="{{ $member->avatar_url }}" alt="Avatar" class="mr-3 rounded-full w-5"/>
                                        {{ $member->username }}
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <p>
                        {{ __('common.discord.members_online', ['count' => count($discordItem->members)]) }}
                    </p>

                    <div class="pt-5">
                        @foreach ($discordItem->members as $member)
                            <div class="flex items-center my-1">
                                <img src="{{ $member->avatar_url }}" class="mr-3 rounded-full w-5" alt="Avatar"/>
                                <div class="flex-grow">{{ $member->username }}</div>
                                @if (property_exists($member, 'game'))
                                    <div class="text-xs text-muted">
                                        {{ $member->game->name }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img src="{{ asset('img/drawing.png') }}" alt="Mascot" class="md:hidden w-full mt-12"/>
@endsection
