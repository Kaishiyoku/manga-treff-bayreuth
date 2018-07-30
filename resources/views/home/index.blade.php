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
            <a class="btn btn-outline-primary" href="http://bit.ly/manga-treff-bayreuth">
                @lang('home.index.events.series')
            </a>
        </p>
    </div>
@endsection
