@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.create.title')</h1>

    {{ html()->form('post', route('admin.users.store'))->open() }}
        @include('admin.user._form', ['submitTitle' => __('common.create'), 'isForCreate' => true])
    {{ html()->form()->close() }}
@endsection
