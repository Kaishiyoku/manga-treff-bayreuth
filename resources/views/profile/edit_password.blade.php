@extends('layouts.app')

@section('content')
    <h1>{{ __('profile.edit_password.title') }}</h1>

    {{ Form::open(['route' => 'profile.update_password', 'method' => 'put', 'role' => 'form']) }}
        <div class="mb-8">
            {{ Form::label('current_password', __('validation.attributes.current_password'), ['class' => 'label']) }}

            {{ Form::password('current_password', ['class' => 'input' . ($errors->has('current_password') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.current_password')]) }}

            @if ($errors->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('current_password') }}
                </div>
            @endif
        </div>

        <hr/>

        <div class="mt-6 mb-4">
            {{ Form::label('new_password', __('validation.attributes.new_password'), ['class' => 'label']) }}

            {{ Form::password('new_password', ['class' => 'input' . ($errors->has('new_password') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.new_password')]) }}

            @if ($errors->has('new_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_password') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            {{ Form::label('new_password_confirmation', __('validation.attributes.new_password_confirmation'), ['class' => 'label']) }}

            {{ Form::password('new_password_confirmation', ['class' => 'input' . ($errors->has('new_password_confirmation') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.new_password_confirmation')]) }}

            @if ($errors->has('new_password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_password_confirmation') }}
                </div>
            @endif
        </div>

        {{ Form::button(__('profile.edit_password.submit'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
