@foreach ($meetups->get() as $meetup)
    <div class="card mb-5">
        <div class="text-xl px-3 pt-3">
            {{ $meetup->name }}
        </div>

        <div class="p-3">
            <div class="flex">
                <div class="w-2/5">@lang('validation.attributes.date_start'):</div>
                <div>{{ $meetup->date_start->format(__('date.datetime')) }}</div>
            </div>
            <div class="flex">
                <div class="w-2/5">@lang('validation.attributes.date_end'):</div>
                <div>{{ $meetup->date_end->format(__('date.datetime')) }}</div>
            </div>
            <div class="flex">
                <div class="w-2/5">@lang('meetup.admin.index.animexx_event'):</div>
                <div>
                    @if ($meetup->is_manually_added)
                        /
                    @else
                        {{ Html::link($meetup->getUrl(), $meetup->external_id, ['class' => 'link']) }}
                    @endif
                </div>
            </div>
            <div class="flex">
                <div class="w-2/5">@lang('validation.attributes.is_manually_added'):</div>
                <div>{{ formatBoolean($meetup->is_manually_added) }}</div>
            </div>

            <div class="mt-5">
                @include('shared._delete_link', ['route' => ['admin.meetups.destroy', $meetup]])
                {{ Html::linkRoute('admin.meetups.edit', __('common.edit'), $meetup, ['class' => 'btn btn-sm btn-black']) }}
            </div>
        </div>
    </div>
@endforeach
