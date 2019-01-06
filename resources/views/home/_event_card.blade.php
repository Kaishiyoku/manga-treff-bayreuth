<div class="card {{ isset($isHighlighted) && $isHighlighted ? 'border-primary' : null }}">
    <div class="card-body">
        <h5 class="card-title">{{ $event->date_start->format(__('date.datetime')) }}</h5>

        <p class="card-text text-muted small">
            @lang('validation.attributes.category'): {{ $event->eventType->title }},
            @lang('validation.attributes.size'): {{ $event->attendees }}
            <br/>
            @lang('validation.attributes.address'): {{ $event->getEventLocation() }}

            &#8226;

            <a href="https://www.google.com/maps/search/?api=1&query={{ $event->getEventLocation() }}">
                @lang('home.index.events.show_in_google_maps')
            </a>
        </p>

        <div class="card-text mb-3">
            <div class="mb-1">
                {!! truncateHtml(purifyHtml($event->intro), 20) !!}
            </div>

            <a href="#" data-toggle="collapse" data-target="#collapseExample-{{ $event->external_id }}" aria-expanded="false" aria-controls="collapseExample">
                @lang('common.read_more')
            </a>

            <div class="collapse" id="collapseExample-{{ $event->external_id }}">
                {!! purifyHtml($event->description) !!}
            </div>
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ $event->getUrl() }}" class="btn btn-dark">
            @lang('common.details')
        </a>
    </div>
</div>