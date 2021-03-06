@extends('layouts.app')

@section('breadcrumbs')
    @include('shared._visitor_notices')

    @if ($meetup->isUpcoming())
        {{ Breadcrumbs::render('meetups.show_upcoming', $meetup) }}
    @else
        {{ Breadcrumbs::render('meetups.show_past', $meetup) }}
    @endif
@endsection

@section('content')
    <div class="card">
        <div class="text-xl px-5 py-3 {{ classNames($meetup->is_manually_added ? null : $classNames ?? null, ['bg-gray-300' => empty($classNames) && !$meetup->is_manually_added, 'bg-teal-500 text-white' => $meetup->is_manually_added]) }}">
            {{ $meetup->name }}
            &ndash;
            {{ $meetup->date_start->format(__('date.datetime')) }}
        </div>

        <div class="p-5">
            <div class="mb-5 text-sm">
                @lang('validation.attributes.category'): {{ $meetup->meetupType->name }}

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

                @if (!$meetup->is_manually_added)
                    <a href="{{ $meetup->getUrl() }}" class="btn btn-outline-black btn-sm mb-3">
                        <i class="far fa-calendar"></i>

                        @lang('common.animexx_event')

                        @include('shared._external_icon')
                    </a>
                @endif

                <a href="#registrations" class="btn btn-outline-black btn-sm mb-3">
                    <i class="fas fa-user-friends"></i>

                    {{ trans_choice('meetup.show.registration.title', $meetup->is_manually_added ? $meetupUserRegistrations->count() : count($meetup->animexx_data['user_registrations'])) }}
                </a>
            </div>

            <hr/>

            <div class="mt-5 mb-5 prose max-w-none">
                @if ($meetup->is_manually_added)
                    {!! parseMarkdown(cleanHtml($meetup->description)) !!}
                @else
                    {!! cleanHtml($meetup->description) !!}
                @endif
            </div>

            <hr/>

            <a id="registrations"></a>

            @include('meetup._registrations')
        </div>
    </div>
@endsection
