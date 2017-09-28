<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--<link href="{{ asset('vendor/api_doc/css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('vendor/api_doc/css/bulma.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container is-fluid">
        {{-- Nav Bar --}}
        @include('api_doc::layouts.includes.nav_bar')

        <div class="columns">
            {{-- Menu --}}
            @include('api_doc::layouts.includes.menu')


            @yield('content')
        </div>
    </div>


    <!-- Scripts -->
    {{--<script src="{{ asset('vendor/api_doc/js/bootstrap.min.js') }}"></script>--}}
</body>
</html>
