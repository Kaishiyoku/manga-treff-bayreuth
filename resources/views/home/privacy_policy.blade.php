@extends('layouts.app')

@section('content')
    <h1>@lang('home.privacy_policy.title')</h1>

    <div class="prose max-w-none">
        {!! __('home.privacy_policy.text') !!}
    </div>
@endsection
