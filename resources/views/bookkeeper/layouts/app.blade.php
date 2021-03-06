<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">

    <title>{{ $pageTitle }} &mdash; Bookkeeper</title>

    <meta name="msapplication-config" content="{{ Theme::url('browserconfig.xml') }}">
    <link rel="manifest" href="{{ Theme::url('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ Theme::url('favicon.ico') }}">
    <link rel="icon" sizes="32x32 16x16" href="{{ Theme::url('favicon.ico') }}">
    <link rel="mask-icon" color="#263a8a" href="{{ Theme::url('safari-pinned-tab.svg') }}">

    <!-- Styles -->
    {!! Theme::css('css/app.css') !!}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    @yield('styles')

</head>
<body class="body">
    <div id="app" class="app container">
        @php
            $currentUser = auth()->user();
            $currentSection = isset($currentSection) ? $currentSection : null;
        @endphp

        @include('partials.navigation')

        <div class="flash-container">
            <div class="container">
                <div class="columns is-tablet">
                    <div class="column is-one-third-tablet is-offset-8-tablet is-quarter-desktop is-offset-9-desktop">
                        @if($errors->any())
                            <div class="notification is-danger">
                                <button class="delete"></button>
                                <span class="flash-text">{{ __('general.error_saving') }}</span>
                            </div>
                        @endif
                        @foreach (session('flash_notification', collect())->toArray() as $message)
                            <div class="notification is-{{ $message['level'] }}">
                                <button class="delete"></button>
                                <span class="flash-text">{{ $message['message'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="main-content__head">
                <div class="breadcrumbs">
                    <a href="{{ route('bookkeeper.overview') }}" class="breadcrumbs__crumb">BOOKKEEPER</a>
                    @yield('breadcrumbs')
                </div>
                <h1 class="main-content__heading">{{ $pageTitle }}</h1>
            </div>
            @yield('content')
        </div>

        <footer class="footer is-transparent">
            <div class="is-clearfix">
                <div class="footer__inner is-pulled-right">
                    <a href="https://github.com/umomega/bookkeeper" target="_blank" class="footer__link">
                        {!! Theme::img('img/bookkeeper-logo-dark.svg') !!}
                    </a><a href="http://umomega.com" target="_blank" class="footer__link">
                        {!! Theme::img('img/umomega-logo-dark.svg') !!}
                    </a>
                </div>
            </div>
        </footer>

    </div>

    <div class="modal" id="deleteModal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head is-danger">
                <p class="modal-card-title">{{ __('general.delete') }}</p>
                <button class="delete is-dismiss" aria-label="close"></button>
            </header>
            <section class="modal-card-body modal-card-body--padded">
                <p id="deleteMessage"></p>
            </section>
            <div class="modal-buttons">
                <form class="modal-form" action="#" method="post" id="deleteForm">
                    @csrf
                    @method('delete')
                    <button class="button is-primary" type="submit">{{ __('general.confirm') }}</button>
                </form><button class="button is-dismiss">{{ __('general.dismiss') }}</button>
            </div>
        </div>
    </div>

    @stack('modules')

    <script type="text/javascript">
        window.locale = '{{ config('app.locale') }}';
    </script>
    <!-- Scripts -->
    {!! Theme::js('js/app.js') !!}


    @stack('scripts')

</body>
</html>
