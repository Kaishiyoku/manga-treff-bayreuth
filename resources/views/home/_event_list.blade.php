@if ($events->count() == 0)
    <p class="font-italic">@lang('home.index.events.none')</p>
@else
    <ul>
        @foreach ($events->get() as $event)
            <li>
                <a href="{{ $event->getUrl() }}">
                    {{ $event->date->format(__('date.short')) }}
                </a>
            </li>
        @endforeach
    </ul>
@endif