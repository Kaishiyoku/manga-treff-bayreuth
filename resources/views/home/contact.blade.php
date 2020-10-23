@extends('layouts.app')

@section('content')
    <h1>{{ __('home.contact.title') }}</h1>

    {{ html()->form('post', route('home.send_contact_form'))->open() }}
        <div class="mb-4">
            {{ html()->label(__('validation.attributes.email'), 'email')->class('label') }}

            {{ html()->email('email', old('email'))->attributes(['class' => 'input' . ($errors->has('email') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.email')]) }}

            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            {{ html()->label(__('validation.attributes.fullname'), 'fullname')->class('label') }}

            {{ html()->text('fullname', old('fullname'))->attributes(['class' => 'input' . ($errors->has('fullname') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.fullname')]) }}

            @if ($errors->has('fullname'))
                <div class="invalid-feedback">
                    {{ $errors->first('fullname') }}
                </div>
            @endif
        </div>

        <div class="mb-4">
            {{ html()->label(__('validation.attributes.content'), 'content')->class('label') }}

            {{ html()->textarea('content', old('content'))->attributes(['class' => 'input' . ($errors->has('content') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.content')]) }}

            @if ($errors->has('content'))
                <div class="invalid-feedback">
                    {{ $errors->first('content') }}
                </div>
            @endif
        </div>

        {{ html()->button(__('common.send'), 'submit')->class('btn btn-primary') }}
    {{ html()->form()->close() }}
@endsection
