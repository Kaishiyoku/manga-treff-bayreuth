@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.edit.title', ['name' => $user->name])</h1>

    {{ Form::open(['route' => ['admin.users.update', $user], 'method' => 'put', 'role' => 'form']) }}
        @include('admin.user._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ Form::close() }}
@endsection