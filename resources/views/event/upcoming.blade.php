@extends('app')


@section('content')
    <div class="container">
        <h1>@lang('home.index.events.upcoming')</h1>

        <p>
            <a href="{{ route('events.past') }}">Vergangene Events</a>
        </p>

        @include('home._event_list', ['events' => $upcomingEvents, 'isNextEventHighlighted' => true])
    </div>
@endsection