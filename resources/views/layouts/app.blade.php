<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        @if(request()->routeIs('empresa-form-1') || request()->routeIs('empresa-form-2') ||request()->routeIs('empresa-form-3'))
            <!-- @vite('resources/js/formEmpresa.js') -->
        @endif
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            [data-aos] {
                transition-timing-function: ease-in !important;
            }
        </style>

    </head>
    <body class="antialiased">
        <!-- Dummy script to load css before layout -->
        <script>0</script>
        <div class="min-h-screen ">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-primary  shadow">
                    <div class="max-w-7xl text-white mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="overflow-hidden">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <!-- The page content has to fill up most of the screen to be shown on the bottom  -->
            <!-- TODO: Make it not appear in error screens -->
            @include('layouts.footer')
        </div>
        <!-- In your <head> -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 700,
                easing: 'ease-in',
                once: true,
                mirror: false // <-- importante para permitir animación al hacer scroll up
            });
        </script>


    </body>
</html>
