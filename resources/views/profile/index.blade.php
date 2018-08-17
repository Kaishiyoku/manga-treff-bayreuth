@extends('app')

@section('content')
    <h1>@lang('profile.index.title')</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>@lang('common.general')</h2>

            <div class="row">
                <div class="col-md-6">
                    @lang('profile.index.registered_at'):
                </div>

                <div class="col-md-6">
                    {{ $user->created_at->format(__('date.datetime')) }}
                </div>
            </div>

            <h2>@lang('common.security')</h2>

            <p class="lead">
                {!! Html::decode(Html::linkRoute('profile.login_attempts', '<i class="fas fa-shield-alt"></i> ' . __('profile.login_attempts.title'))) !!}
            </p>

            <p class="lead">
                {!! Html::decode(Html::linkRoute('profile.active_sessions', '<i class="fas fa-desktop" aria-hidden="true"></i> ' . __('profile.active_sessions.title'))) !!}
            </p>
        </div>

        <div class="col-md-6">
            <h2>{{ __('profile.index.options') }}</h2>

            <p class="lead p-t-10">
                {!! Html::decode(Html::linkRoute('profile.edit_email', '<i class="fas fa-envelope" aria-hidden="true"></i> ' . __('profile.edit_email.title'))) !!}
            </p>

            <p class="lead">
                {!! Html::decode(Html::linkRoute('profile.edit_password', '<i class="fas fa-key" aria-hidden="true"></i> ' . __('profile.edit_password.title'))) !!}
            </p>
        </div>
    </div>
@endsection