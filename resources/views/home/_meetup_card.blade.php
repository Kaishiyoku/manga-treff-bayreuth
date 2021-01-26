<div class="card mb-5">
    <div class="text-xl px-5 py-3 {{ classNames($meetup->is_manually_added ? null : $classNames ?? null, ['bg-gray-100' => empty($classNames) && !$meetup->is_manually_added, 'bg-teal-500 text-white' => $meetup->is_manually_added]) }}">
        {{ $meetup->name }}
        &ndash;
        {{ $meetup->date_start->format(__('date.datetime')) }}
    </div>
    <div class="p-5">
        <div class="text-muted text-sm">
            @lang('validation.attributes.category'): {{ $meetup->meetupType->name }}

            &#8226;

            @lang('validation.attributes.size'): {{ $meetup->attendees }}

            &#8226;

            @lang('validation.attributes.address'): {{ $meetup->getMeetupLocation() }}
        </div>

        <div class="mt-5">
            @if ($meetup->is_manually_added)
                {!! parseMarkdown(cleanHtml($meetup->intro)) !!}
            @else
                {!! cleanHtml($meetup->intro) !!}
            @endif
        </div>

        <div class="sm:flex sm:justify-between mt-5">
            <div class="mb-3 md:mb-0">
                <a href="{{ route('meetups.show', $meetup) }}" class="btn btn-sm btn-black w-full sm:w-auto">
                    <i class="fas fa-info"></i>

                    @lang('common.details')
                </a>
            </div>

            <div>
                <a href="https://www.google.com/maps/search/?api=1&query={{ $meetup->getMeetupLocation() }}" class="btn btn-sm btn-outline-black mb-3 w-full sm:w-auto">
                    <i class="fas fa-map-marker-alt"></i>

                    @lang('home.index.meetups.show_in_google_maps')
                </a>

                @if (!$meetup->is_manually_added)
                    <a href="{{ $meetup->getUrl() }}" class="btn btn-sm btn-outline-black mb-3 w-full sm:w-auto">
                        <i class="far fa-calendar"></i>

                        @lang('common.animexx_event')

                        @include('shared._external_icon')
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
