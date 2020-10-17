<div class="alert alert-info">
    @if ($visitorNotice->title)
        <div class="text-lg font-bold pb-2">{{ $visitorNotice->title }}</div>
    @endif

    {!! parseMarkdown($visitorNotice->content) !!}
</div>
