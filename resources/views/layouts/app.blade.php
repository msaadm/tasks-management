<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <style>
        {!! Vite::content('resources/css/app.css') !!}
    </style>
    @stack('styles')
    <title>Tasks Management</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 text-center mb-3">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <main class="col-8">
            @yield('content')
        </main>
    </div>
</div>
<script>
    {!! Vite::content('resources/js/app.js') !!}
</script>
@stack('scripts')
</body>
</html>
