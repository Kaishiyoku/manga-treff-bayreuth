@extends('layouts.app')

@section('content')
    <h1>@lang('home.imprint.title')</h1>

    <address class="not-italic">
        <strong>@lang('home.imprint.name')</strong><br/>
        @lang('home.imprint.city')<br/>
        @lang('home.imprint.street')<br/>
        @lang('home.imprint.country')<br/>
        @lang('home.imprint.email')
    </address>

    <h2>@lang('home.imprint.disclaimer.title')</h2>

    <div class="prose max-w-none">
        {!! __('home.imprint.disclaimer.text') !!}
    </div>
@endsection
