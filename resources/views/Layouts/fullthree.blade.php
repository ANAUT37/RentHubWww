<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @vite('resources/css/app.css')
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>

    @php
        use App\Models\Messages\Chat;
        use App\Models\Messages\ChatRequest;
        use App\Models\Particular;
        use App\Models\User;
    @endphp
    @yield('system-message')

    <div class="min-h-screen w-screen flex flex-col justify-start">
        <div class="sticky top-0 z-10 bg-white w-screen">
            @yield('header')
        </div>
        <div class="grid grid-cols-4">
            <div class="col-start-1 w-auto border-r border-gray-200">
                <div class="border-b border-gray-200 ">
                    <h1 class="text-xl font-medium text- p-4 pl-6">Conversaciones</h1>
                </div>
                @if (isset($display_id) && $display_id == 'request')
                    <a href="/messages"
                        class="w-100 hover:bg-gray-100 hover:cursor-pointer flex border-b border-gray-200">
                        <div class="py-4 pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                            </svg>

                        </div>
                        <div>
                            <div class="max-w-lg p-4 rounded-lg ">
                                <p class="text-lg"><b>Volver a tu bandeja de entrada</b>
                                </p>
                            </div>
                        </div>
                    </a>
                    <div style="max-height: calc(100vh - 4rem); min-height: calc(100vh - 13rem);"
                        class="p-4 overflow-y-auto ">
                        @yield('chats')
                    </div>
                @else
                    <a href="/messages/request"
                        class="w-100 hover:bg-gray-100 hover:cursor-pointer flex border-b border-gray-200">
                        <div class="py-4 pl-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H6.911a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="max-w-lg p-4 rounded-lg ">
                                <p class="text-lg"><b>Solicitudes de mensaje</b>
                                    @php
                                        $countUnseenRequest = count(ChatRequest::getUserChatRequest(Auth::user()->id));
                                    @endphp
                                    @if ($countUnseenRequest > 0)
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-semibold leading-none text-white bg-red-600 rounded-full">{{ $countUnseenRequest }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                    <div style="max-height: calc(100vh - 4rem); min-height: calc(100vh - 13rem);"
                        class="p-4 overflow-y-auto ">
                        @yield('chats')
                    </div>
                @endif

            </div>
            @if (isset($display_id) && $display_id != 'request')
                @if (Chat::getChatIdFromDisplayId($display_id))
                    <script>
                        var pusher = new Pusher('2da69295122dd7e611a3', {
                            cluster: 'eu'
                        });
                        var channel = pusher.subscribe('my-channel');
                        channel.bind('cha', function(data) {
                            alert(JSON.stringify(data));
                        });
                    </script>
                    <div class="col-start-2 w-auto border-r border-gray-200 col-span-2">
                        <div class="border-b border-gray-200 flex justify-between">
                            <h1 class="text-xl font-medium p-4 pl-6">
                                {{ Chat::getShowableName($chat->id, Auth::user()->id) }}
                            </h1>
                        </div>
                        <div class="overflow-y-auto justify-end h-screen relative">
                            <div class="container h-full" style="max-height: calc(100% - 13rem);">
                                @yield('content')
                            </div>
                            <div
                                class="flex flex-row items-center h-16 bg-white w-full border-t border-gray-200 py-6 px-12 relative">
                                <div class="hidden absolute bottom-16 border mb-3 ml-3 border-gray-200 rounded-md left-0 mt-1 w-48 bg-white overflow-hidden shadow-md z-20"
                                    id="dropdown-file">
                                    <!-- Opciones del menú -->
                                    <div class="py-1">
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <div class="flex gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                                <p>Imagen</p>
                                            </div>
                                        </a>
                                        <button id="dropdown-file-document"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                            <div class="flex gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                <p>Documento</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <div id="showFileButton">
                                    <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex-grow ml-4">
                                    <div class="relative w-full">
                                        <input type="text" placeholder="Escribe un mensaje"
                                            class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" />
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const profileButton = document.getElementById('showFileButton');
                            const dropdownMenu = document.getElementById('dropdown-file');

                            profileButton.addEventListener('click', function() {
                                dropdownMenu.classList.toggle('hidden');
                            });

                            document.addEventListener('click', function(event) {
                                const isClickInside = profileButton.contains(event.target) || dropdownMenu.contains(event
                                    .target);
                                if (!isClickInside) {
                                    dropdownMenu.classList.add('hidden');
                                }
                            });
                        });
                    </script>

                    <div class="col-start-4 w-auto">
                        <div class="border-b border-gray-200 flex justify-between">
                            <h1 class="text-xl font-medium p-4 pl-6">Detalles
                            </h1>
                            <button>
                                <div class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg mr-2">
                                    <div>
                                        <div class="max-w-lg p-2" id="toggleChatInfo">
                                            <p class="text-md">Info. del anuncio</p>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div style="max-height: calc(100vh - 4rem);" class="overflow-y-auto px-6">
                            @yield('info')
                        </div>

                    </div>
                @endif
            @endif
            @if (isset($display_id) && $display_id == 'request')
                @if (isset($request_id) && ChatRequest::getRequestIdFromDisplayId($request_id))
                    @php
                        $showableName = ChatRequest::getShowableName($request_id);
                    @endphp
                    <div class="col-start-2 w-auto border-r border-gray-200 col-span-2">
                        <div class="border-b border-gray-200 flex justify-between">
                            <h1 class="text-xl font-medium p-4 pl-6">
                                {{ $showableName }}
                            </h1>
                        </div>
                        <div class="overflow-y-auto justify-end h-screen relative">
                            <div class="container h-screen" style="max-height: calc(100% - 26rem);">
                                @yield('content')
                            </div>
                            <div class="h-44 bg-white w-full border-t border-gray-200 py-6 px-12 relative">
                                <div class="flex flex-col p-4">
                                    <p class="text-lg">¿Quieres aceptar la solicitud de mensaje de
                                        <b>{{ $showableName }}</b>?
                                    </p>
                                    <p class="text-sm text-gray-600">Hasta que no aceptes la solicitud,
                                        {{ $showableName }} no podrá
                                        comunicarse
                                        contigo ni obtener ningún tipo de información personal sobre ti. Recuerda que es
                                        importante mantener la privacidad y seguridad de tus datos antes de aceptar
                                        cualquier solicitud de comunicación.</p>
                                    <div class="flex justify-center p-5 gap-4">
                                        <button id="acceptRequestButton"
                                            class=" bg-white border border-gray-300 text-black px-3 py-1 rounded-md hover:bg-gray-600 hover:text-white hover:border-gray-600">
                                            Aceptar
                                        </button>

                                        <button id="declineRequestButton"
                                            class="bg-white border text-red-500 border-red-500  px-3 py-1 rounded-md  hover:bg-red-600 hover:text-white hover:border-gray-600">
                                            Rechazar
                                        </button>
                                        <button id="reportRequestButton"
                                            class="bg-white border text-red-500 border-red-500  px-3 py-1 rounded-md  hover:bg-red-600 hover:text-white hover:border-gray-600">
                                            Denunciar
                                        </button>
                                        <script>
                                            const acceptRequestButton = document.getElementById('acceptRequestButton');
                                            const declineRequestButton = document.getElementById('declineRequestButton');
                                            acceptRequestButton.addEventListener('click', function() {
                                                const requestId = '{{ $request_id }}'; // Obtener el ID de la solicitud desde Blade
                                                window.location.href = `/messages/request/${requestId}/accept`;
                                            });
                                            declineRequestButton.addEventListener('click', function() {
                                                const requestId = '{{ $request_id }}'; // Obtener el ID de la solicitud desde Blade
                                                window.location.href = `/messages/request/${requestId}/decline`;
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-start-4 w-auto">
                        <div class="border-b border-gray-200 flex justify-between">
                            <h1 class="text-xl font-medium p-4 pl-6">Detalles
                            </h1>
                            <button>
                                <div class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg mr-2">
                                    <div>
                                        <div class="max-w-lg p-2" id="toggleChatInfo">
                                            <p class="text-md">Info. del anuncio</p>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div style="max-height: calc(100vh - 4rem);" class="overflow-y-auto px-6">
                            @yield('info')
                        </div>
                    </div>
                @endif
            @endif
        </div>
        @yield('footer')
    </div>
</body>

</html>
