@extends('admin.app')

@section('content')
    <h1>@lang('user.admin.index.title')</h1>

    <div class="pb-5">
        {{ Html::linkRoute('admin.users.create', __('user.admin.index.new_user'), [], ['class' => 'btn btn-primary']) }}
    </div>

    @if ($users->get()->count() === 0)
        @include('shared._no_entries_yet')
    @else
        <div class="card">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>@lang('validation.attributes.name')</th>
                    <th>@lang('validation.attributes.is_admin')</th>
                    <th>@lang('validation.attributes.created_at')</th>
                    <th>@lang('validation.attributes.updated_at')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users->get() as $user)
                        @if ($user->is_active)
                            <tr>
                        @else
                            <tr class="warning">
                        @endif
                            <td>{{ $user->name }}</td>
                            <td>{{ formatBoolean($user->is_admin) }}</td>
                            <td>{{ $user->created_at->format(__('date.datetime')) }}</td>
                            <td>{{ $user->updated_at->format(__('date.datetime')) }}</td>
                            <td>
                                @include('shared._delete_link', ['route' => ['admin.users.destroy', $user->id]])
                                {{ Html::linkRoute('admin.users.edit', __('common.edit'), $user, ['class' => 'btn btn-sm btn-black']) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
