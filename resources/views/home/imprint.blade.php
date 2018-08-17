@extends('app')

@section('content')
    <h1>@lang('home.imprint.title')</h1>

    <address>
        <strong>@lang('home.imprint.name')</strong><br/>
        @lang('home.imprint.city')<br/>
        @lang('home.imprint.street')<br/>
        @lang('home.imprint.country')<br/>
        ä@lang('home.imprint.email')
    </address>

    <h2>@lang('home.imprint.disclaimer.title')</h2>

    {!! __('home.imprint.disclaimer.text') !!}
@endsection