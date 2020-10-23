@extends('layouts.app')

@section('content')
    <div class="mx-auto w-full max-w-sm bg-white shadow-md rounded text-left">
        <div class="text-xl pb-4 text-gray-600 bg-gray-100 pt-4 pl-8">@lang('auth.reset.title')</div>

        {{ html()->form('post', route('password.update'))->class('px-8 pt-6 pb-8 mb-4')->open() }}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-4">
                {{ html()->label(__('validation.attributes.email'), 'label')->class('label') }}

                {{ html()->email('email', old('email'))->attributes(['class' => 'input' . ($errors->has('email') ? ' has-error' : ''), 'required' => true, 'autofocus' => 'true', 'placeholder' => __('validation.attributes.email')]) }}

                @if ($errors->has('email'))
                    <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="mb-4">
                {{ html()->label(__('validation.attributes.password'), 'password')->class('label') }}

                {{ html()->password('password')->attributes(['class' => 'input' . ($errors->has('password') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.password')]) }}

                @if ($errors->has('password'))
                    <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="mb-4">
                {{ html()->label(__('validation.attributes.password_confirmation'), 'password_confirmation')->class('label') }}

                {{ html()->password('password_confirmation')->attributes(['class' => 'input' . ($errors->has('password_confirmation') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.password_confirmation')]) }}

                @if ($errors->has('password_confirmation'))
                    <p class="invalid-feedback">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <div class="flex items-center justify-between pt-4">
                {{ html()->button(__('auth.reset.request.submit'), 'submit')->class('btn btn-primary') }}
            </div>
        {{ html()->form()->close() }}
    </div>
@endsection
