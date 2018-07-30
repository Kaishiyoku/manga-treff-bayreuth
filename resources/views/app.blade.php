<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ env('APP_NAME') }}</title>

    {!! Html::style('css/app.css') !!}

    {!! Html::script('js/app.js') !!}

    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">{{ env('APP_NAME') }}</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {!! Menu::render() !!}
    </div>
</nav>

<div class="container">
    @include('flash::message')

    @yield('content')
</div>

<footer class="small">
    <div class="container">
        <a href="{{ route('home.show_contact_form') }}">@lang('common.contact')</a>
        &#8226;
        <a href="{{ route('home.imprint') }}">@lang('common.imprint')</a>
        &#8226;
        <a href="{{ route('home.privacy_policy') }}">@lang('common.privacy_policy')</a>
    </div>
</footer>

</body>
</html>
