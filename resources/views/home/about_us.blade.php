@extends('layouts.app')

@section('content')
    <h1>{{ __('home.about_us.title') }}</h1>

    <div class="prose max-w-none">
        {!! $text !!}
    </div>
@endsection
