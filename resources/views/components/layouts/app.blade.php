<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{env('APP_NAME')}} - {{Request::path()}}</title>
        <!-- FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <!-- STYLES -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- SCRIPTS -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="min-h-screen bg-gradient-to-b from-[#c2d0e5] p-2">
        {{ $slot }}
    </body>
</html>
