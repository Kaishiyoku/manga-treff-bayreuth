@extends('app')

@section('content')
    <div class="container">
        <p class="lead">@lang('home.index.description')</p>

        <p>
            <a class="btn btn-primary btn-lg" href="http://bit.ly/manga-treff-bayreuth">
                @lang('home.index.events.series')
            </a>
        </p>

        <h2>@lang('home.index.events.title')</h2>

        @if ($events->count() == 0)
            <p class="font-italic">@lang('home.index.events.none')</p>
        @else
        @endif

        <ul>
            @foreach ($events->get() as $event)
                <li>
                    <a href="{{ env('ANIMEXX_EVENT_BASE_URL') . $event->external_id }}">
                        {{ $event->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
