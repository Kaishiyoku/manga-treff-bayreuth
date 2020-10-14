<div class="card">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>@lang('validation.attributes.name')</th>
                <th>@lang('validation.attributes.date_start')</th>
                <th>@lang('validation.attributes.date_end')</th>
                <th>@lang('meetup.admin.index.animexx_event')</th>
                <th>@lang('validation.attributes.is_manually_added')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meetups->get() as $meetup)
                <tr class="{{ $meetup->is_manually_added ? 'bg-info' : '' }}">
                    <td>{{ $meetup->name }}</td>
                    <td>{{ $meetup->date_start->format(__('date.datetime')) }}</td>
                    <td>{{ $meetup->date_end->format(__('date.datetime')) }}</td>
                    <td>
                        @if ($meetup->is_manually_added)
                            /
                        @else
                            {{ Html::link($meetup->getUrl(), $meetup->external_id, ['class' => 'link']) }}
                        @endif
                    </td>
                    <td>{{ formatBoolean($meetup->is_manually_added) }}</td>
                    <td class="text-right">
                        @include('shared._delete_link', ['route' => ['admin.meetups.destroy', $meetup]])

                        {{ Html::linkRoute('admin.meetups.edit', __('common.edit'), $meetup, ['class' => 'btn btn-sm btn-black']) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
