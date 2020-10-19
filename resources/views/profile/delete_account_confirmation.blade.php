@extends('layouts.app')

@section('content')
    <h1>@lang('profile.delete_account.title')</h1>

    <div class="alert alert-danger">
        @lang('profile.delete_account.confirmation_text')
    </div>

    @include('shared._delete_link', ['route' => 'profile.delete', 'title' => __('profile.delete_account.submit'), 'class' => 'btn btn-danger'])

    {{ Html::linkRoute('profile.index', __('common.cancel'), null, ['class' => 'btn btn-black']) }}
@endsection
