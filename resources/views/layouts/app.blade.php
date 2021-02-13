<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Eduardo Coello Blog</title>
        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
        @yield('head')
        <!-- css -->
        <link href="/css/main.css" rel="stylesheet">
        <!-- fontawesome -->
        @yield('fontawesome')
        <!-- modernizr -->
        @yield('modernizr')
        <!-- bootstrap -->
        @yield('bootstrap')
        <!-- tinymce -->
        @yield('tinymce')

    </head>
    <body>
        @auth
        <x-seshbar/>
        @endauth
            <div class="homepage-grid">
                <x-navbar/>
                @yield('content')
            </div> <!-- Homepage grid end -->
    </body>
</html>