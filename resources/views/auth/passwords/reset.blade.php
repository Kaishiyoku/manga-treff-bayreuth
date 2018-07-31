@extends('app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('auth.reset.title')</div>

                <div class="card-body">
                    {{ Form::open(['route' => 'password.request', 'method' => 'post', 'role' => 'form']) }}
                        {{ Form::hidden('token', $token) }}

                        <div class="form-group row">
                            {{ Form::label('email', __('validation.attributes.email'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::email('email', $email ?? old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => true, 'autofocus' => true]) }}

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password', __('validation.attributes.password'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'required' => true]) }}

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password_confirmation', __('validation.attributes.password_confirmation'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) }}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{ Form::button(__('auth.reset.request.submit'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
