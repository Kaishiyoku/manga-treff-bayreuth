@extends('admin.app')

@section('content')
    <h1>@lang('visitor_notice.admin.edit.title')</h1>

    {{ Form::open(['route' => ['admin.visitor_notices.update', $visitorNotice], 'method' => 'put', 'role' => 'form']) }}
        @include('admin.visitor_notice._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ Form::close() }}
@endsection
