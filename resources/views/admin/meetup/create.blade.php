@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.create.title')</h1>

    {{ html()->form('post', route('admin.meetups.store'))->open() }}
        @include('admin.meetup._form', ['submitTitle' => __('common.update'), 'isForCreate' => true])
    {{ html()->form()->close() }}
@endsection
