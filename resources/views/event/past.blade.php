@extends('app')


@section('content')
    <h1>@lang('home.index.events.past')</h1>

    <p>
        <a href="{{ route('events.upcoming') }}">@lang('home.index.events.upcoming')</a>
    </p>

    @include('home._event_list', ['events' => $pastEvents])
@endsection