@extends('layouts.app')

@section('breadcrumbs')
    @if ($meetup->isUpcoming())
        {{ Breadcrumbs::render('meetups.show_upcoming', $meetup) }}
    @else
        {{ Breadcrumbs::render('meetups.show_past', $meetup) }}
    @endif
@endsection

@section('content')
    <h1>@lang('meetup.show.title', ['date' => $meetup->date_start->format(__('date.datetime'))])</h1>

    <div class="mb-5 text-sm">
        @lang('validation.attributes.category'): {{ $meetup->meetupType->title }}

        <br/>

        @lang('validation.attributes.size'): {{ $meetup->attendees }}

        <br/>

        @lang('validation.attributes.address'): {{ $meetup->getMeetupLocation() }}
    </div>

    <div class="mb-5">
        <a href="https://www.google.com/maps/search/?api=1&query={{ $meetup->getMeetupLocation() }}" class="btn btn-outline-black btn-sm">
            <i class="fas fa-map-marker-alt"></i>

            @lang('home.index.meetups.show_in_google_maps')
        </a>

        <a href="{{ $meetup->getUrl() }}" class="btn btn-outline-black btn-sm">
            <i class="far fa-calendar"></i>

            @lang('common.animexx_event')

            @include('shared._external_icon')
        </a>
    </div>

    <hr/>

    <div class="mt-4 prose max-w-none">
        {!! cleanHtml($meetup->description) !!}
    </div>
@endsection
