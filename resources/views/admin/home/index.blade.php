@extends('admin.app')

@section('content')
    <h1>@lang('home.admin.index.title')</h1>

    <div>
        @lang('home.admin.index.todays_number_of_site_visits'): {{ $siteVisits->get(now()->toDateString())->count() }}
    </div>

    <div class="card mt-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="w-40">@lang('home.admin.index.date')</th>
                    <th>@lang('home.admin.index.number_of_site_visits')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siteVisits as $date => $siteVisitContainer)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($date)->format(__('date.date')) }}</td>
                        <td>{{ $siteVisitContainer->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
