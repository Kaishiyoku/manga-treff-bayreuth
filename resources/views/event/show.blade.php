@extends('app')

@section('breadcrumbs')
    @if ($event->isUpcoming())
        {{ Breadcrumbs::render('events.show_upcoming', $event) }}
    @else
        {{ Breadcrumbs::render('events.show_past', $event) }}
    @endif
@endsection

@section('content')
    <h1>@lang('event.show.title', ['date' => $event->date_start->format(__('date.datetime'))])</h1>

    <p>
        @lang('validation.attributes.category'): {{ $event->eventType->title }}

        <br/>

        @lang('validation.attributes.size'): {{ $event->attendees }}

        <br/>

        @lang('validation.attributes.address'): {{ $event->getEventLocation() }}
    </p>

    <p>
        <a href="https://www.google.com/maps/search/?api=1&query={{ $event->getEventLocation() }}" class="btn btn-outline-dark btn-xs">
            <i class="fas fa-map-marker-alt"></i>

            @lang('home.index.events.show_in_google_maps')
        </a>

        <a href="{{ $event->getUrl() }}" class="btn btn-outline-dark btn-xs">
            <i class="far fa-calendar"></i>

            @lang('common.animexx_event')

            @include('shared._external_icon')
        </a>
    </p>

    <hr/>

    <div>
        {!! purifyHtml($event->description) !!}
    </div>
@endsection