<div class="form-group row">
    {{ Form::label('name', __('validation.attributes.name'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::text('name', old('name', $user->name), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('email', __('validation.attributes.email'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::email('email', old('email', $user->email), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => true]) }}

        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('is_admin', __('validation.attributes.is_admin'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-2">
        {{ Form::select('is_admin', __('common.lists.boolean'), old('is_admin', $user->is_admin), ['class' => 'form-control' . ($errors->has('is_admin') ? ' is-invalid' : '')]) }}

        @if ($errors->has('is_admin'))
            <div class="invalid-feedback">
                {{ $errors->first('is_admin') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    {{ Form::label('password', __('validation.attributes.password'), ['class' => 'col-lg-2 col-form-label']) }}

    <div class="col-lg-3">
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'required' => $isForCreate]) }}

        @if (!$isForCreate)
            <small class="form-text text-muted">@lang('user.admin.edit.password_help')</small>
        @endif

        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-10 ml-md-auto">
        {{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
</div>