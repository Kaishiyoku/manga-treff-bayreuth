@extends('admin.app')

@section('content')
    <h1>@lang('event.admin.edit.title', ['name' => $event->name])</h1>

    {{ Form::open(['route' => ['admin.events.update', $event], 'method' => 'put', 'role' => 'form']) }}
        @include('admin.event._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ Form::close() }}
@endsection