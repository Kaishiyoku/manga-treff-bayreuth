@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.index.title')</h1>

    <div class="pb-5">
        {{ Html::linkRoute('admin.meetups.create', __('meetup.admin.index.new_meetup'), null, ['class' => 'btn btn-primary']) }}
    </div>

    <div class="text-right">
        <span class="border-l-4 border-teal-500 pl-2 mt-5">= @lang('meetup.admin.index.is_manually_added')</span>
    </div>

    @if ($upcomingMeetups->count() === 0 && $pastMeetups->count())
        @include('shared._no_entries_yet')
    @else
        <h2>@lang('home.index.meetups.upcoming')</h2>

        <div class="hidden md:block">
            @include('admin.meetup._index_table', ['meetups' => $upcomingMeetups])
        </div>

        <div class="md:hidden">
            @include('admin.meetup._index_list', ['meetups' => $upcomingMeetups])
        </div>

        <h2 class="pt-5">@lang('home.index.meetups.past')</h2>

        <div class="hidden md:block">
            @include('admin.meetup._index_table', ['meetups' => $pastMeetups])
        </div>

        <div class="md:hidden">
            @include('admin.meetup._index_list', ['meetups' => $pastMeetups])
        </div>
    @endif
@endsection
