@extends('layouts.app')

@section('content')
    <h1>@lang('home.index.meetups.past')</h1>

    <p>
        <a href="{{ route('meetups.upcoming') }}">@lang('home.index.meetups.upcoming')</a>
    </p>

    @include('home._meetup_list', ['meetups' => $pastMeetups])
@endsection
