<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ env('APP_NAME') }}</title>

    {!! Html::style('css/app.css') !!}

    {!! Html::script('js/app.js') !!}
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">{{ env('APP_NAME') }}</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {!! Menu::render() !!}

            @if (auth()->check())
                {!! Menu::render('auth_logged_in') !!}

                @include('shared._logout_navbar')
            @else
                {!! Menu::render('auth_public') !!}
            @endif
        </div>
    </div>
</nav>

<div class="container">
    @include('flash::message')

    @yield('content')
</div>

<footer class="small">
    <div class="container">
        {{ Html::linkRoute('home.show_contact_form', __('common.contact')) }}
        &#8226;
        {{ Html::linkRoute('home.imprint', __('common.imprint')) }}
        &#8226;
        {{ Html::linkRoute('home.privacy_policy', __('common.privacy_policy')) }}
    </div>
</footer>

</body>
</html>
