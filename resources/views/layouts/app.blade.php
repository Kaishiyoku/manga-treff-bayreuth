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
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-900 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    {!! LaravelMenu::render() !!}

                    @if (auth()->check())
                        {!! LaravelMenu::render('auth_logged_in') !!}

                        @include('shared._logout_navbar')
                    @else
                        {!! LaravelMenu::render('auth_public') !!}
                    @endif
                </nav>
            </div>
        </header>

        @include('flash::message')

        @yield('breadcrumbs')

        @yield('content')
    </div>

    <footer class="small">
        <div class="container">
            v{{ env('APP_VERSION') }}
            &#8226;
            {{ Html::linkRoute('home.show_contact_form', __('common.contact')) }}
            &#8226;
            {{ Html::linkRoute('home.imprint', __('common.imprint')) }}
            &#8226;
            {{ Html::linkRoute('home.privacy_policy', __('common.privacy_policy')) }}
        </div>
    </footer>
</body>
</html>
