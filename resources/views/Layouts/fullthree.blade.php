<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    @vite('resources/css/app.css')
    <style>
        body {
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .transition-transform {
            transition-property: transform;
            transition-duration: 2s;
            /* Puedes ajustar la duración según tus preferencias */
            transition-timing-function: ease-in-out;
            /* También puedes ajustar la función de temporización */
        }

        .translate-x-full {
            transform: translateX(100%);
        }

        .translate-x-0 {
            transform: translateX(0);
        }
    </style>
</head>

<body>

    @php
        use App\Models\Messages\Chat;
        use App\Models\Messages\ChatRequest;
        use App\Models\Particular;
        use App\Models\User;
        use App\Models\InmuebleImage;
    @endphp

    @yield('system-message')

    <div class="min-h-screen w-screen flex flex-col justify-start">
        <div class="sticky top-0 z-10 bg-white w-screen">
            @yield('header')
        </div>
        <div class="grid lg:grid-cols-4 grid-cols-1">
            @if (isset($display_id))
                @if ($display_id === 'request')
                    @if (isset($request_id))
                        <div class="lg:col-start-1 w-auto lg:border-r lg:border-gray-200 hidden lg:block">
                        @else
                            <div class="lg:col-start-1 w-auto lg:border-r lg:border-gray-200  lg:block">
                    @endif
                @else
                    <div class="lg:col-start-1 w-auto lg:border-r lg:border-gray-200 hidden lg:block">
                @endif
            @else
                <div class="col-start-1 w-full lg:border-r lg:border-gray-200">
            @endif
            <div class=" flex justify-between items-end">
                <h1 class="text-xl font-bold p-4 pl-6">Mensajes</h1>
                @if (isset($display_id) && $display_id == 'request')
                    <a href="/messages" class="hover:cursor-pointer flex hover:underline">
                        <div>
                            <div class="p-4">
                                <p class="text-md font-semibold">Volver
                                </p>
                            </div>
                        </div>
                    </a>
            </div>
            <div style="max-height: calc(100vh - 4rem); min-height: calc(100vh - 13rem);"
                class="p-2 overflow-y-auto flex flex-col">
                @yield('chats')
            </div>
        @else
            <a href="/messages/request" class="hover:cursor-pointer flex hover:underline">
                <div>
                    <div class="p-4">
                        <p class="text-md font-semibold">Solicitudes
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
        </div>
        <div style="max-height: calc(100vh - 4rem); min-height: calc(100vh - 13rem);"
            class="p-2 overflow-y-auto flex flex-col">
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
            <div class="col-start-1 lg:col-start-2 w-auto border-r border-gray-200 col-span-2">
                <div class=" flex justify-between " style="backdrop-filter: blur(8px);">
                    <a href="/messages" class="p-4 items-center cursor-pointer lg:hidden" id="mobileBackButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                    <h1 class="text-xl font-medium p-4 pl-6">
                        {{ Chat::getChatName($display_id, Auth::user()->id) }}
                    </h1>
                    <div class="p-4 items-center cursor-pointer lg:hidden" id="mobileInfoButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </div>
                </div>

                <div class="overflow-y-auto justify-end h-screen relative">
                    <div class="container h-full" style="max-height: calc(100% - 13rem);">
                        <div role="status" id="status" class="absolute top-1/4 right-1/2 z-10">
                            <svg aria-hidden="true"
                                class="w-6 h-6 text-gray-100 animate-spin dark:text-gray-300 fill-gray-950"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        @yield('content')
                    </div>
                    <div
                        class="fixed bottom-0 flex flex-row items-center h-16 bg-white w-full lg:w-1/2   py-6 px-4 lg:px-12 ">
                        <div class="hidden absolute bottom-16  mb-3 lg:ml-3 rounded-md left-0 mt-1 w-48 bg-white overflow-hidden shadow-md z-20"
                            id="dropdown-file">
                            <!-- Opciones del menú -->
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="flex gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <p>Imagen</p>
                                    </div>
                                </a>
                                <button id="dropdown-file-document"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                    <div class="flex gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        <p>Documento</p>
                                    </div>
                                </button>
                                <button id="dropdown-file-contract"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                    <div class="flex gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        <p>Contrato</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div id="showFileButton">
                            <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="#be185d" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                    </path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex-grow ml-4">
                            <div class="relative w-full">
                                <input type="text" placeholder="Escribe un mensaje" id="messageTextInput"
                                    class="flex w-full  rounded-xl focus:outline-none bg-gray-100 border-none pl-4 h-10" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <button class="flex items-center justify-center text-gray-400 hover:text-gray-600"
                                id="sendMessageButton">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="#be185d" class="w-6 h-6">
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

            <div class="bg-white lg:block lg:col-start-4 w-full lg:w-auto h-full transition-transform transform duration-500 ease-in-out"
                id="details-column">
                <div class=" flex justify-between">
                    <div class="flex p-4 items-center gap-2 justify-start align-middle">
                        <button class="flex items-center cursor-pointer lg:hidden" id="mobileCloseInfoButton">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <h1 class="text-xl font-medium">Detalles
                        </h1>
                    </div>

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
    @if (isset($display_id) && $display_id === 'request')
        @if (isset($request_id) && ChatRequest::getRequestIdFromDisplayId($request_id))
            @php
                $showableName = ChatRequest::getShowableName($request_id);
            @endphp
            <div class="col-start-2 w-auto border-r border-gray-200 col-span-2">
                <div class="border-b border-gray-200 flex justify-between">
                    <a href="/messages/request" class="p-4 items-center cursor-pointer lg:hidden"
                        id="mobileBackButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                    <h1 class="text-xl font-medium p-4 pl-6">
                        {{ $showableName }}
                    </h1>
                    <div class="p-4 items-center cursor-pointer hidden">

                    </div>
                </div>
                <div class="overflow-y-auto justify-end h-screen relative">
                    <div class="container h-screen" style="min-height: calc(100% - 26rem);">
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
                                    class="bg-gray-100  px-4 py-2 rounded-md hover:bg-gray-200 ">
                                    Aceptar
                                </button>

                                <button id="declineRequestButton"
                                    class="bg-gray-100  px-4 py-2 rounded-md hover:bg-red-500 ">
                                    Rechazar
                                </button>
                                <button id="reportRequestButton"
                                    class="bg-gray-100  px-4 py-2 rounded-md hover:bg-red-500 ">
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
            <div class="col-start-4 w-auto hidden">
                <div class=" flex justify-between">
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
    <script>
        const mobileInfoButton = document.getElementById('mobileInfoButton');
        const mobileCloseInfoButton = document.getElementById('mobileCloseInfoButton');
        const detailsColumn = document.getElementById('details-column');

        mobileInfoButton.addEventListener('click', function() {
            detailsColumn.classList.toggle('fixed');
            if (!detailsColumn.classList.contains('hidden')) {
                detailsColumn.classList.remove('translate-x-full');
                detailsColumn.classList.add('translate-x-0');
            } else {
                detailsColumn.classList.remove('translate-x-0');
                detailsColumn.classList.add('translate-x-full');
            }
        });

        mobileCloseInfoButton.addEventListener('click', function() {
            detailsColumn.classList.toggle('fixed');
            if (!detailsColumn.classList.contains('hidden')) {
                detailsColumn.classList.remove('translate-x-full');
                detailsColumn.classList.add('translate-x-0');
            } else {
                detailsColumn.classList.remove('translate-x-0');
                detailsColumn.classList.add('translate-x-full');
            }
        });
    </script>

    @if (isset($display_id))
        <script type="module">
            import {
                initializeApp
            } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";

            const firebaseConfig = {
                apiKey: "AIzaSyBXAZNMzXi98I6AXiPjloU_ohYAx7VslzA",
                authDomain: "renthub-es.firebaseapp.com",
                databaseURL: "https://renthub-es-default-rtdb.europe-west1.firebasedatabase.app",
                projectId: "renthub-es",
                storageBucket: "renthub-es.appspot.com",
                messagingSenderId: "312435357069",
                appId: "1:312435357069:web:9280831087458a7fe6f9c4"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);

            import {
                getDatabase,
                ref,
                child,
                get,
                set,
                update,
                remove,
                onValue
            } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-database.js";

            document.addEventListener('DOMContentLoaded', () => {
                const db = getDatabase();

                const sendMessageButton = document.getElementById('sendMessageButton');
                const messageTextInput = document.getElementById('messageTextInput');
                const userId = "{{ Auth::user()->id }}";

                function getRandomId() {
                    return Date.now().toString() + Math.floor(Math.random() * 1000);
                }


                sendMessageButton.addEventListener('click', function() {
                    if (messageTextInput.value != "") {
                        var messageId = getRandomId();
                        set(ref(db, 'Messages/{{ $display_id }}/' + messageId), {
                            id: messageId,
                            user_id: userId,
                            chat_id: "{{ $display_id }}",
                            answer_to: 'none',
                            type: 'text',
                            text: messageTextInput.value,
                            file_type: 'none',
                            file_url: 'none',
                            created_at: "{{ time() }}",
                            updated_at: "{{ time() }}",
                        }).then(() => {
                            messageTextInput.value = "";
                        }).catch((error) => {
                            console.error("Error sending message: ", error);
                        });
                    }

                });
                var sendDocumentMessageButtons = document.querySelectorAll('.sendDocumentMessage');

                sendDocumentMessageButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        var displayId = this.getAttribute('data-text');
                        sendDocumentMessage(displayId);
                    });
                });

                function sendDocumentMessage(text) {
                    var messageId = getRandomId();
                    set(ref(db, 'Messages/{{ $display_id }}/' + messageId), {
                        id: messageId,
                        user_id: userId,
                        chat_id: "{{ $display_id }}",
                        answer_to: 'none',
                        type: 'doc',
                        text: text,
                        file_type: 'none',
                        file_url: 'none',
                        created_at: "{{ time() }}",
                        updated_at: "{{ time() }}",
                    }).then(() => {
                        var docDisplay = document.getElementById('documentsDisplay');
                        docDisplay.classList.toggle('hidden')
                    }).catch((error) => {
                        console.error("Error sending message: ", error);
                    });
                }

                var sendContractMessageButtons = document.querySelectorAll('.sendContractMessage');

                sendContractMessageButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        var contractId = this.getAttribute('data-contractId');
                        var sender = this.getAttribute('data-sender');
                        var receiver = this.getAttribute('data-receiver');
                        sendContractMessage(contractId, sender, receiver);
                    });
                });

                function sendContractMessage(contractId, sender, receiver) {
                    fetch('/management/contract/request/new', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                            },
                            body: JSON.stringify({
                                'contract_id': contractId,
                                'sender_id': sender,
                                'receiver_id': receiver
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            var messageId = getRandomId();
                            set(ref(db, 'Messages/{{ $display_id }}/' + messageId), {
                                id: messageId,
                                user_id: userId,
                                chat_id: "{{ $display_id }}",
                                answer_to: 'none',
                                type: 'contract',
                                text: data.data,
                                file_type: 'none',
                                file_url: 'none',
                                created_at: "{{ time() }}",
                                updated_at: "{{ time() }}",
                            }).then(() => {
                                var contractDisplay = document.getElementById('contractsDisplay');
                                contractDisplay.classList.toggle('hidden')
                            }).catch((error) => {
                                console.error("Error sending message: ", error);
                            });

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }

                const messagesListener = ref(db, 'Messages/{{ $display_id }}');
                onValue(messagesListener, (snapshot) => {
                    var status = document.getElementById('status');
                    var displayMessages = document.getElementById('data-container');
                    while (displayMessages.firstChild) {
                        displayMessages.removeChild(displayMessages.firstChild);
                    }

                    if (snapshot.exists()) {
                        snapshot.forEach(element => {
                            if (element.val().type === 'text') {
                                formatTextMessage(element);
                            } else if (element.val().type === 'image') {
                                formatImageMessage(element);
                            } else if (element.val().type === 'doc') {
                                formatDocumentMessage(element);
                            } else if (element.val().type === 'contract') {
                                formatContractMessage(element);
                            }
                            status.classList.add('hidden');

                        });
                        const dataContainer = document.getElementById('data-container')
                        var lastChild = dataContainer.lastChild;

                        function formatTimestamp(timestamp) {
                            // Convertir el timestamp a una cadena de fecha legible
                            var date = new Date(timestamp);
                            return date.toLocaleString(); // Puedes ajustar el formato según tus preferencias
                        }

                    } else {
                        console.log("No data available");
                    }
                });
            });
        </script>
        <script>
            function formatTextMessage(element) {
                var displayMessages = document.getElementById('data-container');
                var container = document.createElement('div');
                container.classList.add('rounded-lg', 'px-4', 'py-2', 'mb-1', 'max-w-lg',
                    'break-words');

                if (element.val().user_id === "{{ Auth::user()->id }}") {
                    container.classList.add('bg-gray-700', 'text-white', 'self-end', 'flex', 'flex-col',
                        'items-end');
                } else {
                    container.classList.add('bg-gray-300', 'text-black', 'self-start', 'flex',
                        'flex-col', 'items-start');
                }

                var text = document.createElement('p');
                text.textContent = element.val().text;

                var createdAt = document.createElement('small');
                createdAt.classList.add('text-xs', 'text-gray-500')
                var createdAtDate = new Date(element.val().created_at * 1000);
                createdAt.textContent =
                    `${createdAtDate.getHours()}:${(createdAtDate.getMinutes() < 10 ? '0' : '') + createdAtDate.getMinutes()}`; // Formato HH:mm

                container.appendChild(text);
                container.appendChild(createdAt);
                displayMessages.appendChild(container);
            }

            function formatImageMessage(element) {
                var displayMessages = document.getElementById('data-container');
                var container = document.createElement('div');
                container.classList.add('relative', 'rounded-lg', 'mb-1', 'max-w-lg', 'break-words');

                if (element.val().user_id === "{{ Auth::user()->id }}") {
                    container.classList.add('bg-gray-700', 'text-white', 'self-end', 'flex', 'flex-col', 'items-end');
                } else {
                    container.classList.add('bg-gray-300', 'text-black', 'self-start', 'flex', 'flex-col', 'items-start');
                }

                var img = document.createElement('img');
                img.src = element.val().file_url;
                img.alt = "Imagen del mensaje";
                img.classList.add('w-full', 'h-auto', 'max-w-full', 'object-cover', 'rounded-md',
                    'cursor-pointer'); 

                var createdAt = document.createElement('small');
                if (element.val().user_id === "{{ Auth::user()->id }}") {
                    createdAt.classList.add('text-xs', 'text-gray-500', 'absolute', 'bottom-0', 'right-0', 'bg-gray-800',
                        'text-white',
                        'px-2', 'py-1', 'rounded-lg', 'm-2');
                } else {
                    createdAt.classList.add('text-xs', 'text-gray-500', 'absolute', 'bottom-0', 'left-0', 'bg-gray-800',
                        'text-white',
                        'px-2', 'py-1', 'rounded-lg', 'm-2');
                }

                var createdAtDate = new Date(element.val().created_at * 1000);
                createdAt.textContent =
                    `${createdAtDate.getHours()}:${(createdAtDate.getMinutes() < 10 ? '0' : '') + createdAtDate.getMinutes()}`; // Formato HH:mm

                container.appendChild(img);
                container.appendChild(createdAt);
                displayMessages.appendChild(container);
            }

            function formatDocumentMessage(element) {
                fetch('/docs/' + element.val().text + '/data', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        setChatInfoDocs(element, data);
                        var displayMessages = document.getElementById('data-container');
                        var container = document.createElement('div');
                        container.classList.add('rounded-lg', 'px-4', 'py-2', 'mb-1', 'max-w-lg', 'break-words', 'relative',
                            'flex', 'flex-col');

                        if (element.val().user_id === "{{ Auth::user()->id }}") {
                            container.classList.add('bg-gray-700', 'text-white', 'self-end', 'items-end');
                        } else {
                            container.classList.add('bg-gray-300', 'text-black', 'self-start', 'items-start');
                        }

                        // Crear y añadir un encabezado para indicar que es un documento
                        var docHeader = document.createElement('div');
                        docHeader.textContent = 'Documento de RêntHûb.es';
                        docHeader.classList.add('text-sm', 'font-bold', 'mb-2', 'text-indigo-500');

                        var title = document.createElement('p');
                        title.textContent = data.data.title;
                        title.classList.add('font-bold', 'text-end');

                        var content = document.createElement('p');
                        content.textContent = data.data.content;
                        content.classList.add('line-clamp-3', 'overflow-hidden', 'text-ellipsis', 'text-xs');

                        var createdAt = document.createElement('small');
                        createdAt.classList.add('text-xs', 'text-gray-500');
                        var createdAtDate = new Date(element.val().created_at * 1000);
                        createdAt.textContent =
                            `${createdAtDate.getHours()}:${(createdAtDate.getMinutes() < 10 ? '0' : '') + createdAtDate.getMinutes()}`; // Formato HH:mm

                        var openDoc = document.createElement('a');
                        openDoc.href = '/docs/' + element.val().text;
                        openDoc.classList.add('w-auto', 'text-md', 'bg-gray-100', 'hover:bg-gray-200', 'rounded-md', 'px-2',
                            'py-1', 'mt-2', 'text-black');
                        openDoc.textContent = 'Ver documento completo';
                        openDoc.target = "_blank";

                        // Asegurar que el contenedor mantenga la hora sobre el contenido
                        container.appendChild(docHeader); // Añadir el encabezado al contenedor
                        container.appendChild(title);
                        container.appendChild(content);
                        container.appendChild(openDoc)
                        container.appendChild(createdAt);

                        displayMessages.appendChild(container);

                        // Desplazar al último mensaje automáticamente
                        displayMessages.scrollTop = displayMessages.scrollHeight;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            function formatContractMessage(element) {
                fetch('/management/contract/request/' + element.val().text + '/data', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        //setChatInfoDocs(element, data);
                        var displayMessages = document.getElementById('data-container');
                        var container = document.createElement('div');
                        container.classList.add('rounded-lg', 'px-4', 'py-2', 'mb-1', 'max-w-lg', 'break-words', 'relative',
                            'flex', 'flex-col');

                        if (element.val().user_id === "{{ Auth::user()->id }}") {
                            container.classList.add('bg-gray-700', 'text-white', 'self-end', 'items-end');
                        } else {
                            container.classList.add('bg-gray-100', 'text-black', 'self-start', 'items-start');
                        }

                        // Crear y añadir un encabezado para indicar que es un documento
                        var docHeader = document.createElement('div');
                        docHeader.textContent = 'Solicitud de contrato';
                        docHeader.classList.add('text-sm', 'font-bold', 'mb-2', 'text-indigo-500');

                        var title = document.createElement('p');
                        title.textContent = 'Título: ' + data.contractData.display_name;
                        title.classList.add('font-bold', 'text-end');

                        var content = document.createElement('p');
                        content.textContent = 'Categoría: ' + data.contractData.category;
                        content.classList.add('line-clamp-3', 'overflow-hidden', 'text-ellipsis', 'text-xs');

                        var requestId = document.createElement('p');
                        requestId.textContent = 'ID: ' + data.requestData.display_id;
                        requestId.classList.add('line-clamp-3', 'overflow-hidden', 'text-ellipsis', 'text-xs');

                        var createdAt = document.createElement('small');
                        createdAt.classList.add('text-xs', 'text-gray-500');
                        var createdAtDate = new Date(element.val().created_at * 1000);
                        createdAt.textContent =
                            `${createdAtDate.getHours()}:${(createdAtDate.getMinutes() < 10 ? '0' : '') + createdAtDate.getMinutes()}`; // Formato HH:mm


                        var estado = document.createElement('p');

                        if (data.requestData.status === 'pending') {
                            estado.classList.add('font-semibold', 'text-end', 'text-yellow-500');
                            estado.textContent = 'Estado: Pendiente';
                        } else if (data.requestData.status === 'accept') {
                            estado.classList.add('font-semibold', 'text-end', 'text-green-500');
                            estado.textContent = 'Estado: Aceptada';
                        } else if (data.requestData.status === 'decline') {
                            estado.classList.add('font-semibold', 'text-end', 'text-red-500');
                            estado.textContent = 'Estado: Rechazada';
                        }

                        container.appendChild(docHeader);
                        container.appendChild(title);
                        container.appendChild(content);
                        container.appendChild(requestId);
                        container.appendChild(estado);
                        if (element.val().user_id != "{{ Auth::user()->id }}") {
                            var openDoc = document.createElement('a');
                            openDoc.href = '/management/contract/' + element.val().text + '/request';
                            openDoc.classList.add('w-auto', 'text-md', 'bg-gray-200', 'hover:bg-gray-300', 'rounded-md',
                                'px-2',
                                'py-1', 'mt-2', 'text-black');
                            openDoc.textContent = 'Ver solicitud';
                            openDoc.target = "_blank";
                            container.appendChild(openDoc);
                        }

                        container.appendChild(createdAt);

                        displayMessages.appendChild(container);

                        // Desplazar al último mensaje automáticamente
                        //displayMessages.scrollTop = displayMessages.scrollHeight;

                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        </script>
    @endif

</body>

</html>
