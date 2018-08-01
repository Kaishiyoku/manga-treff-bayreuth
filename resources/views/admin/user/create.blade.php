@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.create.title')</h1>

    {{ Form::open(['route' => 'admin.users.store', 'method' => 'post', 'files' => true, 'role' => 'form']) }}
        @include('admin.user._form', ['submitTitle' => trans('common.create'), 'isForCreate' => true])
    {{ Form::close() }}
@endsection