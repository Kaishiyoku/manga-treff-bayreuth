@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.index.title')</h1>

    <div class="pb-5">
        {{ Html::linkRoute('admin.meetups.create', __('meetup.admin.index.new_meetup'), null, ['class' => 'btn btn-primary']) }}
    </div>

    @if ($meetups->get()->count() == 0)
        @include('shared._no_entries_yet')
    @else
        <div class="hidden md:block">
            @include('admin.meetup._index_table')
        </div>

        <div class="md:hidden">
            @include('admin.meetup._index_list')
        </div>
    @endif
@endsection
