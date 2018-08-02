@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.create.title')</h1>

    {{ Form::open(['route' => 'admin.users.store', 'method' => 'post', 'role' => 'form']) }}
        @include('admin.user._form', ['submitTitle' => __('common.create'), 'isForCreate' => true])
    {{ Form::close() }}
@endsection