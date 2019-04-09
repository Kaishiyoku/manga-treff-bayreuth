@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.index.title')</h1>

    @if ($meetups->get()->count() == 0)
        @include('shared._no_entries_yet')
    @else
        <table class="table table-sm table-striped">
            <thead>
            <tr>
                <th>@lang('validation.attributes.name')</th>
                <th>@lang('validation.attributes.date_start')</th>
                <th>@lang('validation.attributes.date_end')</th>
                <th>@lang('meetup.admin.index.animexx_event')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($meetups->get() as $meetup)
                    <tr>
                        <td>{{ $meetup->name }}</td>
                        <td>{{ $meetup->date_start->format(__('date.datetime')) }}</td>
                        <td>{{ $meetup->date_end->format(__('date.datetime')) }}</td>
                        <td>
                            {{ Html::link($meetup->getUrl(), $meetup->external_id) }}
                        </td>
                        <td class="text-right">
                            @include('shared._delete_link', ['route' => ['admin.meetups.destroy', $meetup]])

                            {{ Html::linkRoute('admin.meetups.edit', __('common.edit'), [$meetup]) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection