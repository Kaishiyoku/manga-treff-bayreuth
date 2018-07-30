@extends('app')


@section('content')
    <div class="container">
        <h1>@lang('home.index.events.past')</h1>

        <p>
            <a href="{{ route('events.upcoming') }}">Kommende Events</a>
        </p>

        @include('home._event_list', ['events' => $pastEvents])
    </div>
@endsection