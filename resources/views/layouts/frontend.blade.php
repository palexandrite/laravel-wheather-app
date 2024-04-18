<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Demo Laravel</title>

        <!-- Styles -->
        @vite(['resources/css/app.scss'])

    </head>
    <body class="flex justify-center items-center h-screen">

        <div class="flex justify-center items-center bg-fuchsia-100 h-24 w-24">
            @yield('content')
        </div>

        {{-- Scripts --}}
        @viteReactRefresh
        @vite(['resources/js/app.js'])
        @stack('js')


        {{-- <div class="{{ app()->isLocal() ? 'debug-tailwind-screens' : '' }}"></div> --}}
    </body>
</html>
