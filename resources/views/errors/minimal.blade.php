<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="sticky top-0 z-10 bg-white bg-opacity-60 w-full">
        @yield('system-message')
        @yield('header')
    </div>
    <div class="min-h-screen flex flex-col justify-between">
        <div class="flex-grow flex items-center justify-center">
            <div class=" flex flex-col gap-2 align-middle items-center">
                <h1 class="px-4 text-2xl font-bold tracking-wider">Ups! :( Parece que ha ocurrido un error!
                    (@yield('code'))</h1>
                <p class="px-4 text-md text-gray-800  tracking-wider">Intentalo de nuevo más tarde, ahora puedes <a
                        href="javascript:history.back()" class="underline">volver a la página anterior</a> o a <a href="/" class="underline">la página
                        de inicio</a>.</p>
                        <br><br>
                <div class="ml-4 text-sm text-gray-500 tracking-wider">
                    Error message: @yield('message')
                </div>
            </div>
        </div>
        @yield('footer')
    </div>
</body>

</html>
