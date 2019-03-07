@extends('app')

@section('content')
    <h1>@lang('home.index.events.upcoming')</h1>

    <p>
        <a href="{{ route('events.past') }}">@lang('home.index.events.past')</a>
    </p>

    @include('home._event_list', ['events' => $upcomingEvents, 'isNextEventHighlighted' => true])
@endsection