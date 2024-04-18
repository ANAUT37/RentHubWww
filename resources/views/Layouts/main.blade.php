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
    <div class="sticky top-0 z-10 bg-white bg-opacity-60 w-full">
        @yield('system-message')
        @yield('header')
        @yield('categories')
    </div>
    <div class="min-h-screen flex flex-col justify-between">
        <div class="container mx-auto">
            @yield('content')
        </div>
        @yield('footer')
    </div>
</body>

</html>