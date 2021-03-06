@extends('layouts.app')

@section('content')
    @include('shared._visitor_notices')

    <h1>@lang('home.index.meetups.upcoming')</h1>

    <div class="mb-5">
        <a href="{{ route('meetups.past') }}" class="link">@lang('home.index.meetups.past')</a>
    </div>

    @if ($firstUpcomingMeetup)
        @include('home._meetup_card', ['meetup' => $firstUpcomingMeetup, 'classNames' => 'bg-pink-600 text-white'])
    @endif

    @include('home._meetup_list', ['meetups' => $upcomingMeetups, 'isNextMeetupHighlighted' => true])
@endsection
