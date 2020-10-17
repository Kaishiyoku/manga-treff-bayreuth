@extends('layouts.app')

@section('content')
    <h1>{{ __('home.contact.title') }}</h1>

    {{ Form::open(['route' => 'home.send_contact_form', 'method' => 'post', 'role' => 'form']) }}
        <div class="mb-4">
            {{ Form::label('email', __('validation.attributes.email'), ['class' => 'label']) }}

            {{ Form::email('email', old('email'), ['class' => 'input' . ($errors->has('email') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.email')]) }}

            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            {{ Form::label('fullname', __('validation.attributes.fullname'), ['class' => 'label']) }}

            {{ Form::text('fullname', old('fullname'), ['class' => 'input' . ($errors->has('fullname') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.fullname')]) }}

            @if ($errors->has('fullname'))
                <div class="invalid-feedback">
                    {{ $errors->first('fullname') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            {{ Form::label('content', __('validation.attributes.content'), ['class' => 'label']) }}

            {{ Form::textarea('content', old('content'), ['class' => 'input' . ($errors->has('content') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.content')]) }}

            @if ($errors->has('content'))
                <div class="invalid-feedback">
                    {{ $errors->first('content') }}
                </div>
            @endif
        </div>

        {{ Form::button(__('common.send'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
