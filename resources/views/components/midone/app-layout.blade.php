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
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="main">
        @include('layouts.global-shared.top-bar-component')
        <div class="wrapper">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                @include('layouts.global-shared.side-bar-component')
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content">
                    {{ $slot }}
                </div>
                <!-- END: Content -->
            </div>
        </div>
        @include('components.midone.shared.dark-mode-switcher')
        @include('components.midone.shared.main-color-switcher')

        @livewireScripts
        <script>
            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message,
                event.detail.title ?? ''), toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
            });
        </script>
        <script type="module">
            $(document).on('click', '.destroy', function() {
                if(confirm('Apakah anda yakin?') ) {
                    $('#destroy-form').attr('action',$(this).data('href'));
                    $('#destroy-form').submit();
                }
            });
        </script>
            <form id='destroy-form' method='POST'>
                @csrf
                @method('DELETE')
            </form>
        @yield('script')
    </body>
</html>

