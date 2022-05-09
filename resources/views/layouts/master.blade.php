<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coding challenge</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>

<body class="h-100">

<div id="app" class="d-flex flex-column h-100">

    @include('layouts.partials.header')

    <main role="main" class="flex-shrink-0 mb-4">
        <b-container>
            @yield('content')
        </b-container>
    </main>

    @include('layouts.partials.footer')

</div>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
