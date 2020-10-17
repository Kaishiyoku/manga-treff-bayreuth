@if ($meetups->count() === 0)
    <p class="text-lg italic">@lang('home.index.meetups.none')</p>
@else
    <div class="lg:grid lg:grid-cols-2 lg:gap-4">
        @foreach ($meetups as $i => $meetup)
            @include('home._meetup_card', ['meetup' => $meetup, 'classNames' => ($i === 0 && isset($isNextMeetupHighlighted) && $isNextMeetupHighlighted) ? 'bg-pink-600 text-white' : ''])
        @endforeach
    </div>
@endif
