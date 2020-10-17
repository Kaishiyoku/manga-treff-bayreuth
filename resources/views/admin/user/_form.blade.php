<div class="mb-4">
    {{ Form::label('name', __('validation.attributes.name'), ['class' => 'label']) }}

    {{ Form::text('name', old('name', $user->name), ['class' => 'input' . ($errors->has('name') ? ' has-error' : ''), 'required' => false, 'placeholder' => __('validation.attributes.name')]) }}

    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('email', __('validation.attributes.email'), ['class' => 'label']) }}

    {{ Form::email('email', old('email', $user->email), ['class' => 'input' . ($errors->has('email') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.email')]) }}

    @if ($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ Form::label('is_admin', __('validation.attributes.is_admin'), ['class' => 'label']) }}

    {{ Form::select('is_admin', __('common.lists.boolean'), old('is_admin', $user->is_admin), ['class' => 'input' . ($errors->has('is_admin') ? ' has-error' : '')]) }}

    @if ($errors->has('is_admin'))
        <div class="invalid-feedback">
            {{ $errors->first('is_admin') }}
        </div>
    @endif
</div>

@if (!$isForCreate)
    <div class="mb-4">
        {{ Form::label('is_email_verified', __('user.admin.is_email_verified'), ['class' => 'label']) }}

        {{ Form::select('is_email_verified', __('common.lists.boolean'), old('is_email_verified', $isEmailVerified ?? null), ['class' => 'input' . ($errors->has('is_email_verified') ? ' has-error' : '')]) }}

        @if ($errors->has('is_email_verified'))
            <div class="invalid-feedback">
                {{ $errors->first('is_admin') }}
            </div>
        @endif
    </div>
@endif

<div class="mb-4">
    {{ Form::label('password', __('validation.attributes.password'), ['class' => 'label']) }}

    {{ Form::password('password', ['class' => 'input' . ($errors->has('password') ? ' has-error' : ''), 'required' => $isForCreate, 'placeholder' => __('validation.attributes.password')]) }}

    @if (!$isForCreate)
        <div class="text-sm text-muted pt-1">@lang('user.admin.edit.password_help')</div>
    @endif

    @if ($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>

{{ Form::button($submitTitle, ['type' => 'submit', 'class' => 'btn btn-primary']) }}
