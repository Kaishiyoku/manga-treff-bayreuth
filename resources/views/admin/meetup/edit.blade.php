@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.edit.title', ['name' => $meetup->name])</h1>

    {{ Form::open(['route' => ['admin.meetups.update', $meetup], 'method' => 'put', 'role' => 'form']) }}
        @include('admin.meetup._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ Form::close() }}
@endsection