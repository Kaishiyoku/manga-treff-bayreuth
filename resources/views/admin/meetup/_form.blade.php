<div class="mb-4">
    {{ Form::label('name', __('validation.attributes.name'), ['class' => 'label']) }}

    {{ Form::text('name', old('name', $meetup->name), ['class' => 'input' . ($errors->has('name') ? ' has-error' : ''), 'required' => true, 'disabled' => !$meetup->is_manually_added, 'placeholder' => __('validation.attributes.name')]) }}

    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('attendees', __('validation.attributes.attendees'), ['class' => 'label']) }}

    {{ Form::text('attendees', old('attendees', $meetup->attendees), ['class' => 'input' . ($errors->has('attendees') ? ' has-error' : ''), 'disabled' => !$meetup->is_manually_added, 'palceholder' => __('validation.attributes.attendees')]) }}

    @if ($errors->has('attendees'))
        <div class="invalid-feedback">
            {{ $errors->first('attendees') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('meetup_type_external_id', __('validation.attributes.meetup_type_external_id'), ['class' => 'label']) }}

    {{ Form::select('meetup_type_external_id', $meetupTypes, old('meetup_type_external_id', $meetup->meetup_type_external_id), ['class' => 'input' . ($errors->has('meetup_type_external_id') ? ' has-error' : ''), 'disabled' => !$meetup->is_manually_added]) }}

    @if ($errors->has('meetup_type_external_id'))
        <div class="invalid-feedback">
            {{ $errors->first('meetup_type_external_id') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('date_start', __('validation.attributes.date_start'), ['class' => 'label']) }}

    {{ Form::text('date_start', old('date_start', $meetup->date_start->format(__('date.short'))), ['class' => 'input' . ($errors->has('date_start') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.date_start')]) }}

    @if ($errors->has('date_start'))
        <div class="invalid-feedback">
            {{ $errors->first('date_start') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('time_start', __('validation.attributes.time_start'), ['class' => 'label']) }}

    {{ Form::time('time_start', old('time_start', $meetup->date_start->format(__('date.time'))), ['class' => 'input' . ($errors->has('time_start') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.time_start')]) }}

    @if ($errors->has('time_start'))
        <div class="invalid-feedback">
            {{ $errors->first('time_start') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('date_end', __('validation.attributes.date_end'), ['class' => 'label']) }}

    {{ Form::text('date_end', old('date_end', $meetup->date_end->format(__('date.short'))), ['class' => 'input' . ($errors->has('date_end') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.date_end')]) }}

    @if ($errors->has('date_end'))
        <div class="invalid-feedback">
            {{ $errors->first('date_end') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('time_end', __('validation.attributes.time_end'), ['class' => 'label']) }}

    {{ Form::time('time_end', old('time_end', $meetup->date_end->format(__('date.time'))), ['class' => 'input' . ($errors->has('time_end') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.time_end')]) }}

    @if ($errors->has('time_end'))
        <div class="invalid-feedback">
            {{ $errors->first('time_end') }}
        </div>
    @endif
</div>

<hr/>

<div class="mb-4">
    {{ Form::label('country', __('validation.attributes.country'), ['class' => 'label']) }}

    {{ Form::text('country', old('country', $meetup->country), ['class' => 'input' . ($errors->has('country') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.country')]) }}

    @if ($errors->has('country'))
        <div class="invalid-feedback">
            {{ $errors->first('country') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('state', __('validation.attributes.state'), ['class' => 'label']) }}

    {{ Form::text('state', old('state', $meetup->state), ['class' => 'input' . ($errors->has('state') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.state')]) }}

    @if ($errors->has('state'))
        <div class="invalid-feedback">
            {{ $errors->first('state') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('address', __('validation.attributes.address'), ['class' => 'label']) }}

    {{ Form::text('address', old('address', $meetup->address), ['class' => 'input' . ($errors->has('address') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.address')]) }}

    @if ($errors->has('address'))
        <div class="invalid-feedback">
            {{ $errors->first('address') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('zip', __('validation.attributes.zip'), ['class' => 'label']) }}

    {{ Form::text('zip', old('zip', $meetup->zip), ['class' => 'input' . ($errors->has('zip') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.zip')]) }}

    @if ($errors->has('zip'))
        <div class="invalid-feedback">
            {{ $errors->first('zip') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('city', __('validation.attributes.city'), ['class' => 'label']) }}

    {{ Form::text('city', old('city', $meetup->city), ['class' => 'input' . ($errors->has('city') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.city')]) }}

    @if ($errors->has('city'))
        <div class="invalid-feedback">
            {{ $errors->first('city') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('intro', __('validation.attributes.intro'), ['class' => 'label']) }}

    {{ Form::textarea('intro', old('intro', $meetup->intro), ['class' => 'input' . ($errors->has('intro') ? ' has-error' : ''), 'required' => true, 'rows' => 5, 'placeholder' => __('validation.attributes.intro')]) }}

    @if ($errors->has('intro'))
        <div class="invalid-feedback">
            {{ $errors->first('intro') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('description', __('validation.attributes.description'), ['class' => 'label']) }}

    {{ Form::textarea('description', old('description', $meetup->description), ['class' => 'input' . ($errors->has('description') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.description')]) }}

    @if ($errors->has('description'))
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    @endif
</div>

{{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
