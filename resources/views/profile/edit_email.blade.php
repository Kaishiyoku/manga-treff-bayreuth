@extends('layouts.app')

@section('content')
    <h1>{{ __('profile.edit_email.title') }}</h1>

    {{ html()->form('put', route('profile.update_email'))->open() }}
        <div class="mb-8">
            {{ html()->label(__('validation.attributes.current_email'), 'current_email')->class('label') }}

            {{ html()->email('current_email')->attributes(['class' => 'input' . ($errors->has('current_email') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.current_email')]) }}

            @if ($errors->has('current_email'))
                <div class="invalid-feedback">
                    {{ $errors->first('current_email') }}
                </div>
            @endif
        </div>

        <hr/>

        <div class="mt-6 mb-4">
            {{ html()->label(__('validation.attributes.new_email'), 'new_email')->class('label') }}

            {{ html()->email('new_email', old('new_email'))->attributes(['class' => 'input' . ($errors->has('new_email') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.new_email')]) }}

            @if ($errors->has('new_email'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_email') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            {{ html()->label(__('validation.attributes.new_email_confirmation'), 'new_email_confirmation')->class('label') }}

            {{ html()->email('new_email_confirmation')->attributes(['class' => 'input' . ($errors->has('new_email_confirmation') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.new_email_confirmation')]) }}

            @if ($errors->has('new_email_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('new_email_confirmation') }}
                </div>
            @endif
        </div>

        {{ html()->button(__('profile.edit_email.submit'), 'submit')->class('btn btn-primary') }}
    {{ html()->form()->close() }}
@endsection
