@extends('layouts.app')

@section('content')
    <h1>{{ __('profile.edit_password.title') }}</h1>

    {{ html()->form('put', 'profile.update_password')->open() }}
        <div class="mb-8">
            {{ html()->label(__('validation.attributes.current_password'), 'current_password')->class('label') }}

            {{ html()->password('current_password')->attributes(['class' => 'input' . ($errors->has('current_password') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.current_password')])->required() }}

            @if ($errors->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('current_password') }}
                </div>
            @endif
        </div>

        <hr/>

        <div class="mt-6 mb-4">
            {{ html()->label(__('validation.attributes.new_password'), 'new_password')->class('label') }}

            {{ html()->password('new_password')->attributes(['class' => 'input' . ($errors->has('new_password') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.new_password')])->required() }}

            @if ($errors->has('new_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_password') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            {{ html()->label(__('validation.attributes.new_password_confirmation'), 'new_password_confirmation')->class('label') }}

            {{ html()->password('new_password_confirmation')->attributes(['class' => 'input' . ($errors->has('new_password_confirmation') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.new_password_confirmation')])->required() }}

            @if ($errors->has('new_password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_password_confirmation') }}
                </div>
            @endif
        </div>

        {{ html()->button(__('profile.edit_password.submit'), 'submit')->class('btn btn-primary') }}
    {{ html()->form()->close() }}
@endsection
