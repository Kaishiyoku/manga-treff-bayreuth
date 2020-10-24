<div class="card">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>@lang('validation.attributes.name')</th>
                <th>@lang('validation.attributes.date_start')</th>
                <th>@lang('validation.attributes.date_end')</th>
                <th>@lang('meetup.admin.index.animexx_event')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meetups->get() as $meetup)
                <tr class="border-l-8 {{ $meetup->is_manually_added ? 'border-teal-500' : 'border-transparent' }}">
                    <td>{{ $meetup->name }}</td>
                    <td>{{ $meetup->date_start->format(__('date.datetime')) }}</td>
                    <td>{{ $meetup->date_end->format(__('date.datetime')) }}</td>
                    <td>
                        @if ($meetup->is_manually_added)
                            /
                        @else
                            {{ html()->a($meetup->getUrl(), (string)$meetup->external_id)->class('link') }}
                        @endif
                    </td>
                    <td class="text-right">
                        @include('shared._delete_link', ['route' => route('admin.meetups.destroy', $meetup)])

                        {{ html()->a(route('admin.meetups.edit', $meetup), __('common.edit'))->class('btn btn-sm btn-black') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
