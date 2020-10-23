@extends('admin.app')

@section('content')
    <h1>@lang('visitor_notice.admin.create.title')</h1>

    {{ html()->form('post', route('admin.visitor_notices.store'))->open() }}
        @include('admin.visitor_notice._form', ['submitTitle' => __('common.create'), 'isForCreate' => true])
    {{ html()->form()->close() }}
@endsection
