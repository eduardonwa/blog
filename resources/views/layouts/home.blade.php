<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/main.css" rel="stylesheet">
    @yield('tinymce')
    @yield('fontawesome')
    <title>Admin</title>
</head>
<body>
    
    <div class="dashboard-grid">
        <x-dashbar />
        
        <div class="utilities">
            @yield('content')
        </div>
    </div> <!-- Dashboard end -->

</body>
</html>