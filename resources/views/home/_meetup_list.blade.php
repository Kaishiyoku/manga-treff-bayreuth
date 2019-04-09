@if ($meetups->count() == 0)
    <p class="font-italic">@lang('home.index.meetups.none')</p>
@else
    <div class="card-columns card-columns-prominent">
        @foreach ($meetups->get() as $i => $meetup)
            @include('home._meetup_card', ['meetup' => $meetup, 'isHighlighted' => $i == 0 && isset($isNextMeetupHighlighted) && $isNextMeetupHighlighted])
        @endforeach
    </div>
@endif