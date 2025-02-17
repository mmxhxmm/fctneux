<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div style="background-image: url('../images/op2.png'); background-size: cover; background-position: center;"
        class="min-h-screen object-position flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="flex items-center justify-center">
                <p class="font-roboto text-[30px] text-white text-bold mr-4 font-extrabold">¡Bienvenido a </p>
                    <img src="{{ asset('images/CEACFP_Logo.png') }}" class="w-[150px] flex items-center justify-center">
                <p class="font-roboto text-white text-bold text-xl text-[45px] font-extrabold">!</p>                
            </div> 
            <div class="flex items-center justify-center mt-[-30px]">

                <p class="text-[100px] text-white font-hammersmith">FCT</p>
                <p class="text-[100px] text-[#FF8300] font-hammersmith">Nexus</p>

            </div>

            <div class="w-[400px] h-[275px] sm:max-w-md mt-6 px-6 py-4 bg-black bg-opacity-60 dark:bg-gray-800 
            shadow-md overflow-hidden"> <!--clip-path-[polygon(0%_0%,100%_0%,100%_80%,0%_100%)] -->
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
