@extends('layouts.app')

@section('title', __('passwords.form.title'))

@section('content')
    <div class="mx-auto w-full max-w-sm bg-white shadow-md rounded text-left">
        <div class="text-xl pb-4 text-gray-600 bg-gray-100 pt-4 pl-8">@lang('auth.reset.title')</div>

        {{ html()->form('post', url('/password/email'))->class('px-8 pt-6 pb-8 mb-4')->open() }}
            {{ html()->label(__('validation.attributes.email'), 'email')->class('label') }}

            <div class="mb-4">
                {{ html()->email('email', old('email'))->attributes(['class' => 'input' . ($errors->has('email') ? ' has-error' : ''), 'required' => true, 'autofocus' => 'true', 'placeholder' => __('validation.attributes.email')]) }}

                @if ($errors->has('email'))
                    <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="flex items-center justify-between pt-4">
                {{ html()->button(__('auth.reset.submit'), 'submit')->class('btn btn-primary') }}
            </div>
        {{ html()->form()->close() }}
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#email').focus();
        });
    </script>
@endsection
