@extends('admin.app')

@section('content')
    <h1>@lang('event.admin.edit.title', ['date' => $event->date->format(__('date.short'))])</h1>

    {{ Form::open(['route' => ['admin.events.update', $event], 'method' => 'put', 'role' => 'form']) }}
        @include('admin.event._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ Form::close() }}
@endsection