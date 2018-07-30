@extends('app')


@section('content')
    <div class="container">
        <h1>@lang('home.index.events.past')</h1>

        @include('home._event_list', ['events' => $pastEvents])
    </div>
@endsection