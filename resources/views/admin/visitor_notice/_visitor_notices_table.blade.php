@if ($visitorNotices->count() === 0)
    @include('shared._no_entries_yet')
@else
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
                @foreach ($visitorNotices as $visitorNotice)
                    <tr>
                        <td>{{ $visitorNotice->starting_at->format(__('date.date')) }}</td>
                        <td>{{ $visitorNotice->ending_at->format(__('date.date')) }}</td>
                        <td class="text-right">
                            @include('shared._delete_link', ['route' => route('admin.visitor_notices.destroy', $visitorNotice)])

                            {{ html()->a(route('admin.visitor_notices.edit', $visitorNotice), __('common.edit'))->class('btn btn-sm btn-black') }}
                            {{ html()->a(route('admin.visitor_notices.show', $visitorNotice), __('common.show'))->class('btn btn-sm btn-black') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
