@extends('app')

@section('title', trans('home.imprint.title'))

@section('content')
    <div class="container">
        <h1>{{ trans('home.imprint.title') }}</h1>

        <address>
            <strong>{{ trans('home.imprint.name') }}</strong><br/>
            {{ trans('home.imprint.city') }}<br/>
            {{ trans('home.imprint.street') }}<br/>
            {{ trans('home.imprint.country') }}<br/>
            {{ trans('home.imprint.email') }}
        </address>

        <h2>{{ trans('home.imprint.disclaimer.title') }}</h2>

        {!! trans('home.imprint.disclaimer.text') !!}
    </div>
@endsection