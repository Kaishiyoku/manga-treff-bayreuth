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

    @include('shared._javascript_config')
</head>
<body class="bg-gray-50">
    <div id="app">
        <div class="mb-6 bg-pink-600 shadow">
            <div class="container lg:px-20 mx-auto">
                <div class="lg:flex lg:items-center">
                    <div class="flex justify-between items-center">
                        <div class="text-white text-xl mr-2 ml-2 md:ml-0 py-2"><a href="{{ URL::route('home.index') }}">{{ config('app.name', 'Laravel') }}</a></div>

                        <button class="lg:hidden py-4 px-6 text-xl transition-all duration-200 text-white text-opacity-50 hover:text-white hover:bg-pink-900 hover:bg-opacity-25" data-navbar-control>
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>

                    <div class="flex flex-grow flex-col lg:flex-row lg:justify-between transition-all duration-500 hidden overflow-hidden" data-navbar-content>
                        <div>
                            {!! \LaravelMenu::render() !!}
                        </div>

                        <div class="flex flex-col lg:flex-row">
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
        {{ html()->a(route('home.show_contact_form'), __('common.contact'))->class('link') }}
        &#8226;
        {{ html()->a(route('home.imprint'), __('common.imprint'))->class('link') }}
        &#8226;
        {{ html()->a(route('home.privacy_policy'), __('common.privacy_policy'))->class('link') }}
        &#8226;
        {{ html()->a(route('users.index'), __('user.index.title'))->class('link') }}
    </div>

    @include('shared._google_analytics')
</body>
</html>
