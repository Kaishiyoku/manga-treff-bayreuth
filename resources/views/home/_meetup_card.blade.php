<div class="card mb-5">
    <div class="flex items-center text-xl px-5 py-3 {{ isset($isHighlighted) && $isHighlighted ? 'bg-pink-600 text-white' : null }}">
        <div class="flex-grow">{{ $meetup->date_start->format(__('date.datetime')) }}</div>

        <a href="{{ route('meetups.show', $meetup) }}" class="btn btn-outline-{{ isset($isHighlighted) && $isHighlighted ? 'white' : 'black' }} btn-sm">
            <i class="fas fa-info"></i>

            @lang('common.details')
        </a>
    </div>
    <div class="p-5">
        <div class="text-muted text-sm">
            @lang('validation.attributes.category'): {{ $meetup->meetupType->title }}

            &#8226;

            @lang('validation.attributes.size'): {{ $meetup->attendees }}

            &#8226;

            @lang('validation.attributes.address'): {{ $meetup->getMeetupLocation() }}
        </div>

        <div class="mt-5">
            <a href="https://www.google.com/maps/search/?api=1&query={{ $meetup->getMeetupLocation() }}" class="btn btn-outline-black btn-sm">
                <i class="fas fa-map-marker-alt"></i>

                @lang('home.index.meetups.show_in_google_maps')
            </a>

            <a href="{{ $meetup->getUrl() }}" class="btn btn-outline-black btn-sm">
                <i class="far fa-calendar"></i>

                @lang('common.animexx_event')

                @include('shared._external_icon')
            </a>
        </div>
    </div>
</div>
