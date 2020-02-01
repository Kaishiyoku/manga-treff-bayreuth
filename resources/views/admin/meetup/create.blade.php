@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.create.title')</h1>

    {{ Form::open(['route' => 'admin.meetups.store', 'method' => 'post', 'role' => 'form']) }}
        @include('admin.meetup._form', ['submitTitle' => __('common.update'), 'isForCreate' => true])
    {{ Form::close() }}
@endsection
