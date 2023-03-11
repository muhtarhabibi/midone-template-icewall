<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('build/assets/images/logo.svg') }}" rel="shortcut icon">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        @yield('head')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    {{ $slot }}
</html>
