@extends('layouts.app')

@section('content')
    <h1>@lang('home.index.meetups.past')</h1>

    <div class="mb-5">
        <a href="{{ route('meetups.upcoming') }}" class="link">@lang('home.index.meetups.upcoming')</a>
    </div>

    @include('home._meetup_list', ['meetups' => $pastMeetups])
@endsection
