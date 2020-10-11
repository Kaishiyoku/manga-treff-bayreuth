@extends('app')

@section('content')
    <h1>{{ __('home.contact.title') }}</h1>

    {{ Form::open(['route' => 'home.send_contact_form', 'method' => 'post', 'role' => 'form']) }}
        <div class="form-group">
            {{ Form::label('email', __('validation.attributes.email'), ['class' => 'col-md-12 control-label']) }}

            <div class="col-md-12">
                {{ Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('fullname', __('validation.attributes.fullname'), ['class' => 'col-md-12 control-label']) }}

            <div class="col-md-12">
                {{ Form::text('fullname', old('fullname'), ['class' => 'form-control' . ($errors->has('fullname') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('fullname'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fullname') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('content', __('validation.attributes.content'), ['class' => 'col-md-12 control-label']) }}

            <div class="col-md-12">
                {{ Form::textarea('content', old('content'), ['class' => 'form-control' . ($errors->has('content') ? ' is-invalid' : ''), 'required' => true]) }}

                @if ($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                {{ Form::button(__('common.send'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
@endsection
