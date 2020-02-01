@extends('admin.app')

@section('content')
    <h1>@lang('meetup.admin.index.title')</h1>

    <p>
        {{ Html::linkRoute('admin.meetups.create', __('meetup.admin.index.new_meetup'), null, ['class' => 'btn btn-outline-primary']) }}
    </p>

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
                <th>@lang('validation.attributes.is_manually_added')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($meetups->get() as $meetup)
                    <tr class="{{ $meetup->is_manually_added ? 'bg-info' : '' }}">
                        <td>{{ $meetup->name }}</td>
                        <td>{{ $meetup->date_start->format(__('date.datetime')) }}</td>
                        <td>{{ $meetup->date_end->format(__('date.datetime')) }}</td>
                        <td>
                            @if ($meetup->is_manually_added)
                                /
                            @else
                                {{ Html::link($meetup->getUrl(), $meetup->external_id) }}
                            @endif
                        </td>
                        <td>{{ formatBoolean($meetup->is_manually_added) }}</td>
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
