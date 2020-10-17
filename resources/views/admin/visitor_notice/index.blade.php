@extends('admin.app')

@section('content')
    <h1>@lang('visitor_notice.admin.index.title')</h1>

    <div class="pb-5">
        {{ Html::linkRoute('admin.visitor_notices.create', __('visitor_notice.admin.index.new_visitor_notice'), [], ['class' => 'btn btn-primary']) }}
    </div>

    @if ($visitorNotices->get()->count() === 0)
        @include('shared._no_entries_yet')
    @else
        <div class="italic text-lg text-gray-700 py-5">
            {{ trans_choice('visitor_notice.admin.index.current_number_of_visitor_notices_being_displayed', visitorNoticesForToday()->count()) }}
        </div>

        <div class="card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@lang('validation.attributes.starting_at')</th>
                        <th>@lang('validation.attributes.ending_at')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitorNotices->get() as $visitorNotice)
                        <tr>
                            <td>{{ $visitorNotice->starting_at->format(__('date.date')) }}</td>
                            <td>{{ $visitorNotice->ending_at->format(__('date.date')) }}</td>
                            <td class="text-right">
                                @include('shared._delete_link', ['route' => ['admin.visitor_notices.destroy', $visitorNotice]])
                                {{ Html::linkRoute('admin.visitor_notices.edit', __('common.edit'), $visitorNotice, ['class' => 'btn btn-sm btn-black']) }}
                                {{ Html::linkRoute('admin.visitor_notices.show', __('common.show'), $visitorNotice, ['class' => 'btn btn-sm btn-black']) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
