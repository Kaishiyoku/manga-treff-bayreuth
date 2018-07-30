@extends('app')

@section('content')
    <div class="container">
        <h1>{{ trans('home.privacy_policy.title') }}</h1>

        {!! trans('home.privacy_policy.text') !!}
    </div>
@endsection