@extends('layouts.app')

@section('content')
    <h1>{{ __('profile.edit.title') }}</h1>

    {{ Form::open(['route' => 'profile.update', 'method' => 'put', 'role' => 'form']) }}
        <div class="mb-8">
            {{ Form::label('about_me', __('validation.attributes.about_me'), ['class' => 'label']) }}

            {{ Form::textarea('about_me', old('about_me', $user->about_me), ['class' => 'input' . ($errors->has('about_me') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.about_me'), 'rows' => 15]) }}

            @if ($errors->has('about_me'))
                <div class="invalid-feedback">
                    {{ $errors->first('about_me') }}
                </div>
            @endif
        </div>

        {{ Form::button(__('common.update'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
