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

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.upcoming') }}">Kommende Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.past') }}">Vergangene Events</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


@yield('content')

</body>
</html>
