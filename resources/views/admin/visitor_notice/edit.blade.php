@extends('admin.app')

@section('content')
    <h1>@lang('visitor_notice.admin.edit.title')</h1>

    {{ html()->form('put', route('admin.visitor_notices.update', $visitorNotice))->open() }}
        @include('admin.visitor_notice._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ html()->form()->close() }}
@endsection
