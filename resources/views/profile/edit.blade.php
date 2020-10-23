@extends('layouts.app')

@section('content')
    <h1>{{ __('profile.edit.title') }}</h1>

    {{ html()->form('put', route('profile.update'))->open() }}
        <div class="mb-8">
            {{ html()->label(__('validation.attributes.about_me'), 'about_me')->class('label') }}

            {{ html()->textarea('about_me', old('about_me', $user->about_me))->attributes(['class' => 'input' . ($errors->has('about_me') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.about_me'), 'rows' => 15]) }}

            @if ($errors->has('about_me'))
                <div class="invalid-feedback">
                    {{ $errors->first('about_me') }}
                </div>
            @endif
        </div>

        {{ html()->button(__('common.update'), 'submit')->class('btn btn-primary') }}
    {{ html()->form()->close() }}
@endsection
