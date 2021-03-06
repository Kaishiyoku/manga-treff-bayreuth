@extends('admin.app')

@section('content')
    <h1>
        @lang('visitor_notice.admin.show.title')

        <span class="headline-info">
            {{ $visitorNotice->starting_at->format(__('date.date')) }}
            -
            {{ $visitorNotice->ending_at->format(__('date.date')) }}
        </span>
    </h1>

    <div class="pb-5">
        @include('shared._delete_link', ['route' => route('admin.visitor_notices.destroy', $visitorNotice)])
        {{ html()->a(route('admin.visitor_notices.edit'), __('common.edit'))->class('btn btn-sm btn-black') }}
    </div>

    @include('shared._visitor_notice')
@endsection
