<div class="mb-4">
    {{ Form::label('title', __('validation.attributes.title'), ['class' => 'label']) }}

    {{ Form::text('title', old('name', $visitorNotice->title), ['class' => 'input' . ($errors->has('title') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.title')]) }}

    @if ($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('content', __('validation.attributes.content'), ['class' => 'label label-required']) }}

    {{ Form::textarea('content', old('content', $visitorNotice->content), ['class' => 'input' . ($errors->has('content') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.content')]) }}

    @if ($errors->has('content'))
        <div class="invalid-feedback">
            {{ $errors->first('content') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('starting_at', __('validation.attributes.starting_at'), ['class' => 'label label-required']) }}

    {{ Form::date('starting_at', old('starting_at', $visitorNotice->starting_at), ['class' => 'input' . ($errors->has('starting_at') ? ' has-error' : ''), 'required' => true]) }}

    @if ($errors->has('starting_at'))
        <div class="invalid-feedback">
            {{ $errors->first('starting_at') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('ending_at', __('validation.attributes.ending_at'), ['class' => 'label label-required']) }}

    {{ Form::date('ending_at', old('ending_at', $visitorNotice->ending_at), ['class' => 'input' . ($errors->has('ending_at') ? ' has-error' : ''), 'required' => true]) }}

    @if ($errors->has('ending_at'))
        <div class="invalid-feedback">
            {{ $errors->first('ending_at') }}
        </div>
    @endif
</div>

{{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
