<div class="pb-5">
    @foreach (visitorNoticesForToday()->get() as $visitorNotice)
        @include('shared._visitor_notice')
    @endforeach
</div>
