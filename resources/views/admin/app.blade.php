<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>

    @include('shared._favicon')
</head>
<body class="bg-gray-100">
<div id="app">
    <div class="mb-6 bg-gray-900 shadow">
        <div class="container lg:px-20 mx-auto">
            <div class="md:flex md:items-center">
                <div class="flex items-center py-3 md:py-0">
                    <div class="text-white text-xl mr-2 ml-2 md:ml-0"><a href="{{ URL::route('home.index') }}">{{ config('app.name', 'Laravel') }}</a></div>
                </div>

                <div class="sm:flex sm:flex-grow sm:justify-between">
                    {!! \LaravelMenu::render('admin') !!}

                    @if (auth()->check())
                        <div class="flex nav-dark">
                            @include('shared._logout_navbar')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 lg:px-20 mx-auto">
        @include('flash::message')

        @yield('breadcrumbs')

        @yield('content')
    </div>
</div>

<div class="container px-4 lg:px-20 mx-auto mt-20 mb-12 text-gray-600 text-sm">
    v{{ config('site.app_version') }}
    &#8226;
    {{ html()->a(route('home.show_contact_form'), __('common.contact'))->class('link') }}
    &#8226;
    {{ html()->a(route('home.imprint'), __('common.imprint'))->class('link') }}
    &#8226;
    {{ html()->a(route('home.privacy_policy'), __('common.privacy_policy'))->class('link') }}
</div>
</body>
</html>
