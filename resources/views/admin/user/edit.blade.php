@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.edit.title', ['name' => $user->name])</h1>

    {{ html()->form('put', route('admin.users.update', $user))->open() }}
        @include('admin.user._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ html()->form()->close() }}
@endsection
