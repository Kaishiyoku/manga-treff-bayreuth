@extends('layouts.app')

@section('content')
    <h1>@lang('home.index.meetups.upcoming')</h1>

    <div class="mb-5">
        <a href="{{ route('meetups.past') }}" class="link">@lang('home.index.meetups.past')</a>
    </div>

    @include('home._meetup_list', ['meetups' => $upcomingMeetups, 'isNextMeetupHighlighted' => true])
@endsection
