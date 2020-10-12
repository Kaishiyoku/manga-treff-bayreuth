@if ($meetups->count() == 0)
    <p class="text-lg italic">@lang('home.index.meetups.none')</p>
@else
    <div class="grid grid-cols-2 gap-4">
        @foreach ($meetups->get() as $i => $meetup)
            @include('home._meetup_card', ['meetup' => $meetup, 'isHighlighted' => $i == 0 && isset($isNextMeetupHighlighted) && $isNextMeetupHighlighted])
        @endforeach
    </div>
@endif
