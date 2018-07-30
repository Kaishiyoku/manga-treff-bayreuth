@if ($events->count() == 0)
    <p class="font-italic">@lang('home.index.events.none')</p>
@else
    <div class="card-columns card-columns-prominent">
        @foreach ($events->get() as $i => $event)
            @include('home._event_card', ['event' => $event, 'isHighlighted' => $i == 0 && isset($isNextEventHighlighted) && $isNextEventHighlighted])
        @endforeach
    </div>
@endif