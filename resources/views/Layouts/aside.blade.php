<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body>
    @yield('system-message')
    
    <div class="min-h-screen flex flex-col justify-between">
        <div class="sticky top-0 z-10 bg-white bg-opacity-30 w-full">
            @yield('header')
        </div>
        <div class="container mx-auto">
            @yield('aside')
            @yield('content')
        </div>
        @yield('footer')
    </div>
</body>

</html>