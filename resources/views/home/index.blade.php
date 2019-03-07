@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-8 pb-5">
            <div class="row">
                <div class="col-md-7">
                    <p class="border border-gray rounded shadow-sm lead p-3">
                        @lang('home.index.description')
                    </p>

                    @if ($nextUpcomingEvent)
                        <p class="lead">
                            @lang('home.index.events.next_upcoming_at', ['date' => '<a href="' . $nextUpcomingEvent->getUrl() . '">' . $nextUpcomingEvent->date_start->format(__('date.short')) . '</a>'])
                        </p>
                    @endif

                    <div>
                        <a class="btn btn-block btn-lg btn-outline-primary" href="{{ env('SHORT_EVENT_BASE_URL') }}">
                            <i class="far fa-calendar"></i>

                            @lang('home.index.events.animexx_series')

                            @include('shared._external_icon')
                        </a>

                        <div class="btn-text btn-block text-center">
                            @lang('common.or')
                        </div>

                        <a class="btn btn-block btn-lg btn-outline-primary" href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}">
                            <i class="far fa-calendar"></i>

                            @lang('home.index.events.google_calendar')

                            @include('shared._external_icon')
                        </a>
                    </div>
                </div>

                <div class="col-md-5 d-none d-md-block">
                    <img src="{{ asset('img/drawing.png') }}" class="img-fluid"/>
                </div>
            </div>

            @if ($nextUpcomingEvent)
                <h1 class="pt-5">@lang('home.index.events.next_upcoming')</h1>

                @include('home._event_card', ['event' => $nextUpcomingEvent, 'isHighlighted' => true])
            @endif
        </div>

        <div class="col-lg-4 pb-5">
            <div class="card shadow-sm">
                <h5 class="card-header bg-secondary text-white">
                    <i class="fab fa-discord"></i>

                    <span>
                        {{ __('common.discord.title') }}
                    </span>

                    <a href="{{ $discordItem->instant_invite }}" class="btn btn-outline-light btn-xs float-right m-0">
                        <i class="fas fa-arrow-right"></i>

                        {{ __('common.discord.connect') }}

                        @include('shared._external_icon')
                    </a>
                </h5>

                <div class="card-body">
                    <div class="font-xs">
                        <ul class="list-unstyled">
                            @foreach (\Illuminate\Support\Arr::sort($discordItem->channels, function ($channel) { return $channel->position; }) as $channel)
                                <li class="media my-1">
                                    <div class="media-body">
                                        {{ $channel->name }}

                                        @foreach ($getDiscordMembersInChannel($discordItem, $channel->id) as $member)
                                            <div class="media mt-1 ml-3">
                                                <img src="{{ $member->avatar_url }}" class="mr-3 rounded-circle" width="20px"/>
                                                {{ $member->username }}
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <p>
                            {{ __('common.discord.members_online', ['count' => count($discordItem->members)]) }}
                        </p>

                        <ul class="list-unstyled">
                            @foreach ($discordItem->members as $member)
                                <li class="media my-1">
                                    <img src="{{ $member->avatar_url }}" class="mr-3 rounded-circle" width="20px"/>
                                    <div class="media-body text-muted">
                                        {{ $member->username }}

                                        @if (property_exists($member, 'game'))
                                            <span class="text-muted-extra float-right d-md-none d-sm-inline d-xl-inline">
                                        {{ $member->game->name }}
                                    </span>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-block d-md-none">
        <img src="{{ asset('img/drawing.png') }}" class="img-fluid"/>
    </div>
@endsection
