@extends('app')


@section('content')
    <div class="container">
        <h1>@lang('home.index.events.upcoming')</h1>

        @include('home._event_list', ['events' => $upcomingEvents])
    </div>
@endsection