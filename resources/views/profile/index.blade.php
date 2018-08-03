@extends('app')

@section('content')
    <h1>@lang('profile.index.title')</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>@lang('common.general')</h2>

            <div class="row">
                <div class="col-md-6">
                    @lang('profile.index.registered_at'):
                </div>

                <div class="col-md-6">
                    {{ $user->created_at->format(__('date.datetime')) }}
                </div>
            </div>
        </div>
    </div>
@endsection