<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    @yield('head')
    <!-- css -->
    <link href="/css/main.css" rel="stylesheet">
    <!-- tinymce -->
    @yield('tinymce')
    <!-- tailwind -->
    @yield('tailwind')
    <!-- fontawesome -->
    @yield('fontawesome')
</head>
<body>

    <div>
        @yield('content')
    </div>

</body>
</html>

