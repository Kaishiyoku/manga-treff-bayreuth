@extends('admin.app')

@section('content')
    <h1>@lang('event.admin.index.title')</h1>

    @if ($events->get()->count() == 0)
        @include('shared._no_entries_yet')
    @else
        <table class="table table-sm table-striped">
            <thead>
            <tr>
                <th>@lang('validation.attributes.name')</th>
                <th>@lang('validation.attributes.date_start')</th>
                <th>@lang('validation.attributes.date_end')</th>
                <th>@lang('event.admin.index.animexx_event')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($events->get() as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date_start->format(__('date.datetime')) }}</td>
                        <td>{{ $event->date_end->format(__('date.datetime')) }}</td>
                        <td>
                            {{ Html::link($event->getUrl(), $event->external_id) }}
                        </td>
                        <td class="text-right">
                            @include('shared._delete_link', ['route' => ['admin.events.destroy', $event]])

                            {{ Html::linkRoute('admin.events.edit', __('common.edit'), [$event]) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection