<div class="form-group row">
    {{ Form::label('date_start', __('validation.attributes.date_start'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('date_start', old('date_start', $event->date_start->format(__('date.short'))), ['class' => 'form-control' . ($errors->has('date_start') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('date_start'))
            <div class="invalid-feedback">
                {{ $errors->first('date_start') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('time_start', __('validation.attributes.time_start'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('time_start', old('time_start', $event->date_start->format(__('date.time'))), ['class' => 'form-control' . ($errors->has('time_start') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('time_start'))
            <div class="invalid-feedback">
                {{ $errors->first('time_start') }}
            </div>
        @endif
    </div>
</div>

<hr/>

<div class="form-group row">
    {{ Form::label('date_end', __('validation.attributes.date_end'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('date_end', old('date_end', $event->date_end->format(__('date.short'))), ['class' => 'form-control' . ($errors->has('date_end') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('date_end'))
            <div class="invalid-feedback">
                {{ $errors->first('date_end') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('time_end', __('validation.attributes.time_end'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('time_end', old('time_end', $event->date_end->format(__('date.time'))), ['class' => 'form-control' . ($errors->has('time_end') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('time_end'))
            <div class="invalid-feedback">
                {{ $errors->first('time_end') }}
            </div>
        @endif
    </div>
</div>

<hr/>

<div class="form-group row">
    {{ Form::label('country', __('validation.attributes.country'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('country', old('country', $event->country), ['class' => 'form-control' . ($errors->has('country') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('country'))
            <div class="invalid-feedback">
                {{ $errors->first('country') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('state', __('validation.attributes.state'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('state', old('state', $event->state), ['class' => 'form-control' . ($errors->has('state') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('state'))
            <div class="invalid-feedback">
                {{ $errors->first('state') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('address', __('validation.attributes.address'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('address', old('address', $event->address), ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('address'))
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('zip', __('validation.attributes.zip'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('zip', old('zip', $event->zip), ['class' => 'form-control' . ($errors->has('zip') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('zip'))
            <div class="invalid-feedback">
                {{ $errors->first('zip') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('city', __('validation.attributes.city'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('city', old('city', $event->city), ['class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('city'))
            <div class="invalid-feedback">
                {{ $errors->first('city') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('intro', __('validation.attributes.intro'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-10">
        {{ Form::textarea('intro', old('intro', $event->intro), ['class' => 'form-control' . ($errors->has('intro') ? ' is-invalid' : ''), 'required' => true, 'rows' => 5]) }}

        @if ($errors->has('intro'))
            <div class="invalid-feedback">
                {{ $errors->first('intro') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('description', __('validation.attributes.description'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-10">
        {{ Form::textarea('description', old('description', $event->description), ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('description'))
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-10 ml-md-auto">
        {{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
</div>