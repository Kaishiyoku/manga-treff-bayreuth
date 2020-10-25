<div class="mb-4">
    {{ html()->label(__('validation.attributes.title'), 'title')->class('label') }}

    {{ html()->text('title', old('name', $visitorNotice->title))->attributes(['class' => 'input' . ($errors->has('title') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.title')]) }}

    @if ($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.content'), 'content')->class('label label-required') }}

    {{ html()->textarea('content', old('content', $visitorNotice->content))->attributes(['class' => 'input' . ($errors->has('content') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.content')])->required() }}

    @if ($errors->has('content'))
        <div class="invalid-feedback">
            {{ $errors->first('content') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.starting_at'), 'starting_at')->class('label label-required') }}

    {{ html()->date('starting_at', old('starting_at', $visitorNotice->starting_at))->attributes(['class' => 'input' . ($errors->has('starting_at') ? ' has-error' : '')])->required() }}

    @if ($errors->has('starting_at'))
        <div class="invalid-feedback">
            {{ $errors->first('starting_at') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.ending_at'), 'ending_at')->class('label label-required') }}

    {{ html()->date('ending_at', old('ending_at', $visitorNotice->ending_at))->attributes(['class' => 'input' . ($errors->has('ending_at') ? ' has-error' : '')])->required() }}

    @if ($errors->has('ending_at'))
        <div class="invalid-feedback">
            {{ $errors->first('ending_at') }}
        </div>
    @endif
</div>

{{ html()->button($submitTitle, 'submit')->class('btn btn-primary') }}
