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
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
                        <span class="text-white text-lg ml-3">
                            {{ config('app.name') }}
                        </span>
                    </a>
                    <div class="my-auto">
                        <img alt="" class="-intro-x w-1/2 -mt-16" src="{{ asset('build/assets/images/illustration.svg') }}">
                        {{-- <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign in to your account.</div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div> --}}
                    </div>
                </div>
                {{ $slot }}
            </div>

        </div>
		@include('components.midone.shared.dark-mode-switcher')
		@include('components.midone.shared.main-color-switcher')

		<!-- BEGIN: JS Assets-->
		<!-- END: JS Assets-->

		@yield('script')
	</body>
</html>
