@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.edit.title', ['name' => $user->name])</h1>

    {{ Form::open(['route' => ['admin.users.update', $user], 'method' => 'put', 'files' => true, 'role' => 'form']) }}
        @include('admin.user._form', ['submitTitle' => trans('common.update'), 'isForCreate' => false])
    {{ Form::close() }}
@endsection