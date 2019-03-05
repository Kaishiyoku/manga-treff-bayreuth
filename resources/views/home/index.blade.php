@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-5 col-sm-8 col-8 pb-5">
            <p class="lead">@lang('home.index.description')</p>

            @if ($nextUpcomingEvent)
                <p class="lead">
                    @lang('home.index.events.next_upcoming_at', ['date' => '<a href="' . $nextUpcomingEvent->getUrl() . '">' . $nextUpcomingEvent->date_start->format(__('date.short')) . '</a>'])
                </p>
            @endif

            <p>
                <a class="btn btn-outline-primary" href="{{ env('SHORT_EVENT_BASE_URL') }}">
                    @lang('home.index.events.animexx_series')
                </a>

                <span class="btn-text">
                    @lang('common.or')
                </span>

                <a class="btn btn-outline-primary" href="{{ env('GOOGLE_CALENDAR_PUBLIC_URL') }}">
                    @lang('home.index.events.google_calendar')
                </a>
            </p>
        </div>

        <div class="col-md-3 col-sm-4 col-4">
            <img src="{{ asset('img/drawing.png') }}" class="img-fluid"/>
        </div>

        <div class="col-md-4 col-12">
            <div class="card shadow-sm">
                <h5 class="card-header bg-secondary text-white">
                    <i class="fab fa-discord"></i>

                    <span class="d-inline d-md-none d-lg-inline">
                        Discord
                    </span>

                    <a href="{{ $discordItem->instant_invite }}" class="btn btn-outline-light btn-xs float-right m-0">Verbinden</a>
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
                            {{ count($discordItem->members) }} Mitglieder online
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

    @if ($nextUpcomingEvent)
        <h1 class="pt-5">@lang('home.index.events.next_upcoming')</h1>

        @include('home._event_card', ['event' => $nextUpcomingEvent])
    @endif
@endsection
