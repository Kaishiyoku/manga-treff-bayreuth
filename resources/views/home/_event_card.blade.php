<div class="card {{ isset($isHighlighted) && $isHighlighted ? 'border-primary' : null }}">
    <div class="card-body">
        <h5 class="card-title">{{ $event->date->format(__('date.short')) }}</h5>

        <p class="card-text text-muted small">
            @lang('validation.attributes.category'): {{ $event->category }},
            @lang('validation.attributes.size'): {{ $event->size }}
            <br/>
            @lang('validation.attributes.address'): {{ $event->address }}

            &#8226;

            <a href="https://www.google.com/maps/search/?api=1&query={{ $event->address }}">
                @lang('home.index.events.show_in_google_maps')
            </a>
        </p>

        <div class="card-text mb-3">
            <div class="mb-1">
                {!! truncateHtml(purifyHtml($event->description), 20) !!}
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