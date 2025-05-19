<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>

    @php
        $background = settings('apppPackground');
    @endphp

    <body style="
        background-color: #f3f4f6;
        background-size: cover;
        background-position: center;
        {{ $background
            ? "background-image: url('$background');"
            : 'background-color: #f3f4f6;' }}
    ">
        <div class="font-sans antialiased">
            {{ $slot }}
        </div>
        @livewireScripts
    </body>

</html>
