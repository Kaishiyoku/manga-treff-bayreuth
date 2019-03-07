<div class="card shadow-sm">
    <h5 class="card-header {{ isset($isHighlighted) && $isHighlighted ? 'bg-primary text-white' : null }}">
        {{ $event->date_start->format(__('date.datetime')) }}

        <span class="float-right">
            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-{{ isset($isHighlighted) && $isHighlighted ? 'light' : 'dark' }} btn-xs m-0">
                <i class="fas fa-info"></i>

                @lang('common.details')
            </a>
        </span>
    </h5>
    <div class="card-body">
        <p class="card-text text-muted small">
            @lang('validation.attributes.category'): {{ $event->eventType->title }}

            &#8226;

            @lang('validation.attributes.size'): {{ $event->attendees }}

            &#8226;

            @lang('validation.attributes.address'): {{ $event->getEventLocation() }}
        </p>

        <p class="card-text">
            <a href="https://www.google.com/maps/search/?api=1&query={{ $event->getEventLocation() }}" class="btn btn-outline-dark btn-xs">
                <i class="fas fa-map-marker-alt"></i>

                @lang('home.index.events.show_in_google_maps')
            </a>

            <a href="{{ $event->getUrl() }}" class="btn btn-outline-dark btn-xs">
                <i class="far fa-calendar"></i>

                @lang('common.animexx_event')

                @include('shared._external_icon')
            </a>
        </p>
    </div>
</div>