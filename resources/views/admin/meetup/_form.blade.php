<div class="mb-4">
    {{ html()->label(__('validation.attributes.name'), 'name')->class('label') }}

    {{ html()->text('name', old('name', $meetup->name))->attributes(['class' => 'input' . ($errors->has('name') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.name')])->readonly(!$meetup->is_manually_added)->required() }}

    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.attendees'), 'attendees')->class('label') }}

    {{ html()->text('attendees', old('attendees', $meetup->attendees))->attributes(['class' => 'input' . ($errors->has('attendees') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.attendees')])->readonly(!$meetup->is_manually_added) }}

    @if ($errors->has('attendees'))
        <div class="invalid-feedback">
            {{ $errors->first('attendees') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.meetup_type_external_id'), 'meetup_type_external_id')->class('label') }}

    {{ html()->select($meetup->is_manually_added || $isForCreate ? 'meetup_type_external_id' : '_meetup_type_external_id', $meetupTypes, old('meetup_type_external_id', $meetup->meetup_type_external_id))->attributes(['class' => 'input' . ($errors->has('meetup_type_external_id') ? ' has-error' : '')])->disabled(!$meetup->is_manually_added) }}

    @if (!$meetup->is_manually_added && !$isForCreate)
        {{ html()->hidden('meetup_type_external_id', $meetup->meetup_type_external_id) }}
    @endif

    @if ($errors->has('meetup_type_external_id'))
        <div class="invalid-feedback">
            {{ $errors->first('meetup_type_external_id') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.date_start'), 'date_start')->class('label') }}

    {{ html()->date('date_start', old('date_start', $meetup->date_start->format(__('date.short'))))->attributes(['class' => 'input' . ($errors->has('date_start') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.date_start')])->required() }}

    @if ($errors->has('date_start'))
        <div class="invalid-feedback">
            {{ $errors->first('date_start') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.time_start'), 'time_start')->class('label') }}

    {{ html()->time('time_start', old('time_start', $meetup->date_start->format(__('date.time'))))->attributes(['class' => 'input' . ($errors->has('time_start') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.time_start')])->required() }}

    @if ($errors->has('time_start'))
        <div class="invalid-feedback">
            {{ $errors->first('time_start') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.date_end'), 'date_end')->class('label') }}

    {{ html()->date('date_end', old('date_end', $meetup->date_end->format(__('date.short'))))->attributes(['class' => 'input' . ($errors->has('date_end') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.date_end')])->required() }}

    @if ($errors->has('date_end'))
        <div class="invalid-feedback">
            {{ $errors->first('date_end') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.time_end'), 'time_end')->class('label') }}

    {{ html()->time('time_end', old('time_end', $meetup->date_end->format(__('date.time'))))->attributes(['class' => 'input' . ($errors->has('time_end') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.time_end')])->required() }}

    @if ($errors->has('time_end'))
        <div class="invalid-feedback">
            {{ $errors->first('time_end') }}
        </div>
    @endif
</div>

<hr/>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.country'), 'country')->class('label') }}

    {{ html()->text('country', old('country', $meetup->country))->attributes(['class' => 'input' . ($errors->has('country') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.country')])->required() }}

    @if ($errors->has('country'))
        <div class="invalid-feedback">
            {{ $errors->first('country') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.state'), 'state')->class('label') }}

    {{ html()->text('state', old('state', $meetup->state))->attributes(['class' => 'input' . ($errors->has('state') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.state')])->required() }}

    @if ($errors->has('state'))
        <div class="invalid-feedback">
            {{ $errors->first('state') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.address'), 'address')->class('label') }}

    {{ html()->text('address', old('address', $meetup->address))->attributes(['class' => 'input' . ($errors->has('address') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.address')])->required() }}

    @if ($errors->has('address'))
        <div class="invalid-feedback">
            {{ $errors->first('address') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.zip'), 'zip')->class('label') }}

    {{ html()->text('zip', old('zip', $meetup->zip))->attributes(['class' => 'input' . ($errors->has('zip') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.zip')])->required() }}

    @if ($errors->has('zip'))
        <div class="invalid-feedback">
            {{ $errors->first('zip') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.city'), 'city')->class('label') }}

    {{ html()->text('city', old('city', $meetup->city))->attributes(['class' => 'input' . ($errors->has('city') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.city')])->required() }}

    @if ($errors->has('city'))
        <div class="invalid-feedback">
            {{ $errors->first('city') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.intro'), 'intro')->class('label') }}

    {{ html()->textarea('intro', old('intro', $meetup->intro))->attributes(['class' => 'input' . ($errors->has('intro') ? ' has-error' : ''), 'rows' => 5, 'placeholder' => __('validation.attributes.intro')])->required() }}

    @if ($errors->has('intro'))
        <div class="invalid-feedback">
            {{ $errors->first('intro') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.description'), 'description')->class('label') }}

    {{ html()->textarea('description', old('description', $meetup->description))->attributes(['class' => 'input' . ($errors->has('description') ? ' has-error' : ''), 'rows' => 10, 'placeholder' => __('validation.attributes.description')])->required() }}

    @if ($errors->has('description'))
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    @endif
</div>

{{ html()->button($submitTitle, 'submit')->class('btn btn-primary') }}
