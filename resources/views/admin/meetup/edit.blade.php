@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.edit.title', ['name' => $meetup->name])</h1>

    {{ html()->form('put', route('admin.meetups.update', $meetup))->open() }}
        @include('admin.meetup._form', ['submitTitle' => __('common.update'), 'isForCreate' => false])
    {{ html()->form()->close() }}
@endsection
