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

@yield('content')

</body>
</html>
