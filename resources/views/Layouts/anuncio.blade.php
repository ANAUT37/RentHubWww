<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    @vite('resources/css/app.css')
</head>

<body>
    @yield('system-message')
    <div class="min-h-screen flex flex-col justify-between">
        @yield('system-message')
        <div class="sticky top-0 z-10 bg-white bg-opacity-30 w-full gap-0">
            <div class="sticky top-0 z-40">
                @yield('header')
            </div>
            @yield('gallery')
        </div>
        <div class="min-h-screen">
            <div class="container mx-auto">
                @yield('content')
            </div>
        </div>
    </div>
    @yield('footer')
    </div>
</body>

</html>
