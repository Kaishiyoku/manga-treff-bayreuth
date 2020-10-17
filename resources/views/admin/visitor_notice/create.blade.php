@extends('admin.app')

@section('content')
    <h1>@lang('visitor_notice.admin.create.title')</h1>

    {{ Form::open(['route' => 'admin.visitor_notices.store', 'method' => 'post', 'role' => 'form']) }}
        @include('admin.visitor_notice._form', ['submitTitle' => __('common.create'), 'isForCreate' => true])
    {{ Form::close() }}
@endsection
