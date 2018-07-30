@extends('app')

@section('content')
    <div class="container">
        <p class="lead">@lang('home.index.description')</p>

        @if ($nextUpcomingEvent)
            <p class="lead">
                @lang('home.index.events.next_upcoming_at', ['date' => '<a href="' . $nextUpcomingEvent->getUrl() . '">' . $nextUpcomingEvent->date->format(__('date.short')) . '</a>'])
            </p>
        @endif

        <p>
            <a class="btn btn-outline-primary" href="{{ env('SHORT_EVENT_BASE_URL') }}">
                @lang('home.index.events.animexx_series')
            </a>
        </p>

        @if ($nextUpcomingEvent)
            <h1 class="pt-5">@lang('home.index.events.next_upcoming')</h1>

            @include('home._event_card', ['event' => $nextUpcomingEvent])
        @endif
    </div>
@endsection
