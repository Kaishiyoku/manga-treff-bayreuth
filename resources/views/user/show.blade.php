@extends('layouts.app')

@section('content')
    <h1>@lang('user.show.title', ['name' => $user->name])</h1>

    <h2>@lang('validation.attributes.about_me')</h2>

    @if ($user->about_me)
        <div class="prose max-w-none">
            {!! parseMarkdown($user->about_me) !!}
        </div>
    @else
        <div class="italic text-lg text-muted">@lang('user.show.about_me_empty', ['name' => $user->name])</div>
    @endif
@endsection
