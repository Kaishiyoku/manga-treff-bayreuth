<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {!! Html::style('css/app.css') !!}
    {!! Html::style('css/fonts.css') !!}

    {!! Html::script('js/app.js') !!}

    @include('shared._favicon')

    @include('shared._javascript_config')
</head>
<body class="bg-gray-100">
    <div id="app">
        <div class="mb-6 bg-pink-600 shadow">
            <div class="container lg:px-20 mx-auto">
                <div class="md:flex md:items-center">
                    <div class="flex items-center py-3 md:py-0">
                        <div class="text-white text-xl mr-2 ml-2 md:ml-0"><a href="{{ URL::route('home.index') }}">{{ config('app.name', 'Laravel') }}</a></div>
                    </div>

                    <div class="sm:flex sm:flex-grow sm:justify-between">
                        {!! \LaravelMenu::render() !!}

                        <div class="flex">
                            @if (auth()->check())
                                {!! LaravelMenu::render('auth_logged_in') !!}

                                @include('shared._logout_navbar')
                            @else
                                {!! LaravelMenu::render('auth_public') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container px-4 lg:px-20 mx-auto">
            @if (session('resent'))
                <div class="alert alert-success"
                     role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            @if (session('verified'))
                <div class="alert alert-success">
                    @lang('Your email address has been verified.')
                </div>
            @endif

            @include('flash::message')

            <div class="pb-5">
                @yield('breadcrumbs')
            </div>

            @yield('content')
        </div>
    </div>

    <div class="container px-4 lg:px-20 mx-auto mt-20 mb-12 text-gray-600 text-sm">
        v{{ config('site.app_version') }}
        &#8226;
        {{ Html::linkRoute('home.show_contact_form', __('common.contact'), null, ['class' => 'link']) }}
        &#8226;
        {{ Html::linkRoute('home.imprint', __('common.imprint'), null, ['class' => 'link']) }}
        &#8226;
        {{ Html::linkRoute('home.privacy_policy', __('common.privacy_policy'), null, ['class' => 'link']) }}
        &#8226;
        {{ Html::linkRoute('users.index', __('user.index.title'), null, ['class' => 'link']) }}
    </div>

    @include('shared._google_analytics')
</body>
</html>
