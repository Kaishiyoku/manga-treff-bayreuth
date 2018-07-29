@extends('app')

@section('content')
    <div class="container">
        <p class="lead">@lang('home.index.description')</p>

        <p>
            <a class="btn btn-primary btn-lg" href="http://bit.ly/manga-treff-bayreuth">
                @lang('home.index.events.series')
            </a>
        </p>

        <h2>@lang('home.index.events.upcoming')</h2>

        @include('home._event_list', ['events' => $futureEvents])


        <h2>@lang('home.index.events.past')</h2>

        @include('home._event_list', ['events' => $pastEvents])
    </div>
@endsection
