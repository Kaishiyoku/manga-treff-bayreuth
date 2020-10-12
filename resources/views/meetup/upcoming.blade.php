@extends('layouts.app')

@section('content')
    <h1>@lang('home.index.meetups.upcoming')</h1>

    <p>
        <a href="{{ route('meetups.past') }}">@lang('home.index.meetups.past')</a>
    </p>

    @include('home._meetup_list', ['meetups' => $upcomingMeetups, 'isNextMeetupHighlighted' => true])
@endsection
