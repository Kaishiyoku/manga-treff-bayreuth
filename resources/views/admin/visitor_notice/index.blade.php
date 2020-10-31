@extends('admin.app')

@section('content')
    <h1>@lang('visitor_notice.admin.index.title')</h1>

    <div class="pb-5">
        {{ html()->a(route('admin.visitor_notices.create'), __('visitor_notice.admin.index.new_visitor_notice'))->class('btn btn-primary') }}
    </div>

    <div class="italic text-lg text-gray-700 py-5">
        {{ trans_choice('visitor_notice.admin.index.current_number_of_visitor_notices_being_displayed', $activeVisitorNotices->count()) }}
    </div>

    <h2>@lang('visitor_notice.admin.index.future_visitor_notices')</h2>

    @include('admin.visitor_notice._visitor_notices_table', ['visitorNotices' => $futureVisitorNotices])

    <h2 class="pt-5">@lang('visitor_notice.admin.index.active_visitor_notices')</h2>

    @include('admin.visitor_notice._visitor_notices_table', ['visitorNotices' => $activeVisitorNotices])

    <h2 class="pt-5">@lang('visitor_notice.admin.index.past_visitor_notices')</h2>

    @include('admin.visitor_notice._visitor_notices_table', ['visitorNotices' => $pastVisitorNotices])
@endsection
