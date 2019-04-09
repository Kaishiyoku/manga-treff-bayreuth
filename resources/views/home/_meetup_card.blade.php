<div class="card shadow-sm">
    <h5 class="card-header {{ isset($isHighlighted) && $isHighlighted ? 'bg-primary text-white' : null }}">
        {{ $meetup->date_start->format(__('date.datetime')) }}

        <span class="float-right">
            <a href="{{ route('meetups.show', $meetup) }}" class="btn btn-outline-{{ isset($isHighlighted) && $isHighlighted ? 'light' : 'dark' }} btn-xs m-0">
                <i class="fas fa-info"></i>

                @lang('common.details')
            </a>
        </span>
    </h5>
    <div class="card-body">
        <p class="card-text text-muted small">
            @lang('validation.attributes.category'): {{ $meetup->meetupType->title }}

            &#8226;

            @lang('validation.attributes.size'): {{ $meetup->attendees }}

            &#8226;

            @lang('validation.attributes.address'): {{ $meetup->getMeetupLocation() }}
        </p>

        <p class="card-text">
            <a href="https://www.google.com/maps/search/?api=1&query={{ $meetup->getMeetupLocation() }}" class="btn btn-outline-dark btn-xs">
                <i class="fas fa-map-marker-alt"></i>

                @lang('home.index.meetups.show_in_google_maps')
            </a>

            <a href="{{ $meetup->getUrl() }}" class="btn btn-outline-dark btn-xs">
                <i class="far fa-calendar"></i>

                @lang('common.animexx_event')

                @include('shared._external_icon')
            </a>
        </p>
    </div>
</div>