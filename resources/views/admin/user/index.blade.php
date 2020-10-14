@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.index.title')</h1>

    <div class="pb-5">
        {{ Html::linkRoute('admin.users.create', __('user.admin.index.new_user'), [], ['class' => 'btn btn-primary']) }}
    </div>

    @if ($users->get()->count() === 0)
        @include('shared._no_entries_yet')
    @else
        <div class="hidden md:block">
            @include('admin.user._index_table')
        </div>

        <div class="md:hidden">
            @include('admin.user._index_list')
        </div>
    @endif
@endsection
