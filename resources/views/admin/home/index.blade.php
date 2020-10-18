@extends('admin.app')

@section('content')
    <h1>@lang('home.admin.index.title')</h1>

    @if ($unverifiedUsers->count() > 0)
        <h2>
            @lang('home.admin.index.unverified_users.title')

            <span class="headline-info">{{ $unverifiedUsers->count() }}</span>
        </h2>

        <div class="card mt-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@lang('validation.attributes.name')</th>
                        <th>@lang('validation.attributes.email')</th>
                        <th class="hidden md:table-cell">@lang('validation.attributes.created_at')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unverifiedUsers as $unverifiedUser)
                        <tr>
                            <td>{{ Html::linkRoute('admin.users.edit', $unverifiedUser->name, $unverifiedUser, ['class' => 'link']) }}</td>
                            <td>{{ $unverifiedUser->email }}</td>
                            <td class="hidden md:table-cell">{{ $unverifiedUser->created_at->format(__('date.datetime')) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h2>@lang('home.admin.index.site_visits.title')</h2>

    <div>
        @lang('home.admin.index.site_visits.todays_number_of_site_visits'): {{ $siteVisits->get(now()->toDateString())->count() }}
    </div>

    <div class="card mt-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="w-40">@lang('home.admin.index.date')</th>
                    <th>@lang('home.admin.index.site_visits.number_of_site_visits')</th>
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

    <h2>@lang('home.admin.index.page_clicks.title')</h2>

    <div class="card">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="w-40">@lang('home.admin.index.date')</th>
                    <th>@lang('home.admin.index.page_clicks.route')</th>
                    <th>@lang('home.admin.index.page_clicks.number_of_clicks')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pageClicks as $date => $pageClickContainer)
                    <tr>
                        <td colspan="3">{{ \Carbon\Carbon::parse($date)->format(__('date.date')) }}</td>
                    </tr>

                    @foreach ($pageClickContainer->groupBy('route') as $route => $pageClicks)
                        <tr>
                            <td></td>
                            <td>{{ $route }}</td>
                            <td>{{ $pageClicks->count() }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
