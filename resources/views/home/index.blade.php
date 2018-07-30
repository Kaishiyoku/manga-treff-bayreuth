@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-9 col-sm-8 col-8">
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
        </div>

        <div class="col-md-3 col-sm-4 col-4">
            <img src="{{ asset('img/drawing.png') }}" class="img-fluid"/>
        </div>
    </div>

    @if ($nextUpcomingEvent)
        <h1 class="pt-5">@lang('home.index.events.next_upcoming')</h1>

        @include('home._event_card', ['event' => $nextUpcomingEvent])
    @endif
@endsection
