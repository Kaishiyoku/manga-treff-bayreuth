@foreach (visitorNoticesForToday()->get() as $visitorNotice)
    @include('shared._visitor_notice')
@endforeach
