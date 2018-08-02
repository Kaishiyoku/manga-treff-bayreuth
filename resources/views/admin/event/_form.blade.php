<div class="form-group row">
    {{ Form::label('date', __('validation.attributes.date'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('date', old('date', $event->date->format(__('date.short'))), ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('date'))
            <div class="invalid-feedback">
                {{ $errors->first('date') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-10 ml-md-auto">
        {{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
</div>