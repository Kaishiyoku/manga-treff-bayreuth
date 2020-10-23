@extends('layouts.app')

@section('content')
    <div class="mx-auto w-full max-w-sm bg-white shadow-md rounded text-left">
    <div class="mx-auto w-full max-w-sm bg-white shadow-md rounded text-left">
        <div class="text-xl pb-4 text-gray-600 bg-gray-100 pt-4 pl-8">@lang('auth.login.title')</div>

        {{ html()->form('post', route('login'))->class('px-8 pt-6 pb-8 mb-4')->open() }}
        {{ html()->label(__('validation.attributes.email'), 'email')->class('label') }}

            <div class="mb-4">
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

            <label for="remember" class="label-checkbox">
                {{ html()->checkbox('remember', false, 1)->attributes(['class' => 'checkbox', 'id' => 'remember']) }}
                <span>{{ __('validation.attributes.remember') }}</span>
            </label>

            <div class="flex items-center justify-between pt-4">
                {{ html()->button(__('auth.login.submit'), 'submit')->class('btn btn-primary') }}

                {{ html()->a('/password/reset', __('auth.login.forgot_your_password'))->class('inline-block align-baseline font-bold text-primary hover:text-black transition-all duration-200') }}
            </div>
        {{ html()->form()->close() }}
    </div>
@endsection
