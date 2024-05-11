<!DOCTYPE html>
<html dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> @yield('title') </title>
        <link rel="stylesheet" href="{{ asset('css/indexStyles.css') }}">
    </head>
    <body>
        @include('layout.header')
        <main>
            @yield('content')            
        </main>
        @include('layout.footer')
    </body>
</html>