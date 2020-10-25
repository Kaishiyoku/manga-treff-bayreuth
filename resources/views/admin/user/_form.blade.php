<div class="mb-4">
    {{ html()->label(__('validation.attributes.name'), 'name')->class('label') }}

    {{ html()->text('name', old('name', $user->name))->attributes(['class' => 'input' . ($errors->has('name') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.name')]) }}

    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.email'), 'email')->class('label') }}

    {{ html()->email('email', old('email', $user->email))->attributes(['class' => 'input' . ($errors->has('email') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.email')])->required() }}

    @if ($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.is_admin'), 'is_admin')->class('label') }}

    {{ html()->select('is_admin', getBooleanInputList(), old('is_admin', $user->is_admin))->class('input' . ($errors->has('is_admin') ? ' has-error' : '')) }}

    @if ($errors->has('is_admin'))
        <div class="invalid-feedback">
            {{ $errors->first('is_admin') }}
        </div>
    @endif
</div>

@if (!$isForCreate)
    <div class="mb-4">
        {{ html()->label(__('user.admin.is_email_verified'), 'is_email_verified')->class('label') }}

        {{ html()->select('is_email_verified', getBooleanInputList(), old('is_email_verified', $isEmailVerified ?? null))->class('input' . ($errors->has('is_email_verified') ? ' has-error' : '')) }}

        @if ($errors->has('is_email_verified'))
            <div class="invalid-feedback">
                {{ $errors->first('is_email_verified') }}
            </div>
        @endif
    </div>
@endif

<div class="mb-4">
    {{ html()->label(__('validation.attributes.is_member'), 'is_member')->class('label') }}

    {{ html()->select('is_member', getBooleanInputList(), old('is_member', $user->is_member))->class('input' . ($errors->has('is_member') ? ' has-error' : '')) }}

    @if ($errors->has('is_member'))
        <div class="invalid-feedback">
            {{ $errors->first('is_member') }}
        </div>
    @endif
</div>

<div class="mb-4">
    {{ html()->label(__('validation.attributes.password'), 'password')->class('label') }}

    {{ html()->password('password')->attributes(['class' => 'input' . ($errors->has('password') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.password')])->required($isForCreate) }}

    @if (!$isForCreate)
        <div class="text-sm text-muted pt-1">@lang('user.admin.edit.password_help')</div>
    @endif

    @if ($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>

{{ html()->button($submitTitle, 'submit')->class('btn btn-primary') }}
