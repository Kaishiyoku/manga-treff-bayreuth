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

        @if (auth()->check())
            <span class="navbar-text">
                @lang('common.logged_in_as', ['name' => auth()->user()->name])
            </span>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-submit="#logout-form">
                        @lang('common.logout')
                    </a>

                    {{ Form::open(['route' => 'logout', 'method' => 'post', 'id' => 'logout-form', 'style' => 'display: none;']) }}
                    {{ Form::close() }}
                </li>
            </ul>
        @endif
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
        &#8226;
        {{ Html::linkRoute('login', __('common.login')) }}
    </div>
</footer>

</body>
</html>
