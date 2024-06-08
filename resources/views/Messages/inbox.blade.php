@extends('Layouts.fullthree')
@section('title', 'RêntHûb.es | Messages')
@section('header')
    @include('Headers.sessioned_home')
@endsection
<style>
    .rotated {
        transform: rotate(90deg);
    }
</style>
@php
    use App\Models\Messages\Chat;
    use App\Models\Messages\ChatRequest;
    use App\Models\Particular;
    use App\Models\User;
    use App\Models\Anuncio;
    use App\Models\InmuebleImage;
    $particularData = Particular::getParticularData(Auth::user()->id);
@endphp
@section('chats')
    @if (isset($display_id) && $display_id == 'request')
        @php
            $chatRequestAll = ChatRequest::getUserChatRequest(Auth::user()->id);
        @endphp
        @if (count($chatRequestAll) > 0)
            @foreach ($chatRequestAll as $chat)
                <a href="/messages/request/{{ $chat->display_id }}"
                    class="w-full hover:bg-gray-100 hover:cursor-pointer flex rounded-lg
            @if (isset($request_id)) @if ($request_id == $chat->display_id)
                bg-gray-100 @endif
            @endif
            ">
                    <div class="p-2">
                        <img class="profile-button rounded-full h-16 w-16 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                            src="{{ App\Models\User::getProfilePic($chat->sender_id) }}" alt="">
                    </div>
                    <div>
                        <div class="max-w-lg p-2 rounded-lg ">
                            <p class="text-lg font-bold">{{ Particular::getParticularName($chat->sender_id) }}</p>
                            <p class="text-lg">{{ $chat->anuncio_id }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p class="text-sm text-gray-500 text-center italic">Sin resultados</p>
        @endif
    @else
        @php
            $chatAll = Chat::getUserChats(Auth::user()->id);
        @endphp
        @if (count($chatAll) > 0)
            @foreach ($chatAll as $chat)
                <a href="/messages/{{ $chat->display_id }}"
                    class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg justify-start items-center
                    @if (isset($display_id)) @if ($display_id == $chat->display_id)
                        bg-gray-100 @endif
                    @endif
                    ">

                    <div class="p-2">
                        <img class="profile-button rounded-full h-12 lg:h-16 w-12 lg:w-16 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                            @php $userId=Chat::getShowablePic($chat->id, Auth::user()->id); @endphp
                            src="{{ App\Models\User::getProfilePic($userId->profile_pic_url) }}" alt="">
                    </div>
                    <div>
                        <div class="max-w-lg p-2 rounded-lg ">
                            <p class="text-lg font-bold">{{ Chat::getShowableName($chat->id, Auth::user()->id) }}</p>
                            <p class="text-lg">{{ $chat->chat_name }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p class="text-sm text-gray-500 text-center italic">Sin resultados</p>
        @endif
    @endif
@endsection
@section('content')
    @if (isset($display_id) && $display_id == 'request')
        <div class="flex flex-col-reverse justify-end h-auto  overflow-y-auto mx-0"
            style="margin-bottom: 4rem; max-height: calc(100% - 13rem);">
            <div id="chatDisplay" class="container flex flex-col-reverse flex-grow h-full px-10">
                @php
                    if (isset($request_id)) {
                        $chatRequestId = ChatRequest::getRequestIdFromDisplayId($request_id);
                        $chatRequestData = ChatRequest::getDataById($chatRequestId);
                    }
                @endphp
                @if (isset($request_id))
                    <div class="flex flex-col gap-2 mt-20">
                        <div class="flex bg-gray-100 rounded-md p-4 justify-start w-auto  flex-col gap-2">
                            <p class="font-semibold text-gray-700">Mensaje de la solicitud</p>
                            <p class="w-auto text-lg">
                                {{ $chatRequestData->request_text }}
                            </p>
                        </div>

                        <div class="flex justify-end gap-2">
                            @php
                                $senderDisplayId = User::getDisplayId($chatRequestData->sender_id);
                                $anuncioDisplayid = Anuncio::getById($chatRequestData->anuncio_id)
                            @endphp
                            <a href="/user/{{ $senderDisplayId }}" target="_blank"
                                class="px-4 py-2 rounded-md bg-gray-100 hover:bg-gray-200 cursor-pointer">Visitar el
                                perfil</a>
                            <a href="/anuncio/{{ $anuncioDisplayid->display_id }}" target="_blank"
                                class="px-4 py-2 rounded-md bg-gray-100 hover:bg-gray-200 cursor-pointer">Ver el anuncio</a>
                        </div>
                    </div>
                @endif


            </div>
        @else
            <div class="flex flex-col-reverse justify-end  overflow-y-auto mx-0"
                style="margin-bottom: 4rem; overflow-y: auto">
                <div id="data-container"
                    class="container min-h-full flex flex-col flex-grow overflow-y-auto px-10 pt-2 mb-52 gap-2">
                </div>
                <script>
                    // Obtener el contenedor de desplazamiento
                    const scrollContainer = document.getElementById('data-container');

                    // Función para hacer scroll al fondo del contenedor
                    const scrollToBottom = (id) => {
                        const element = document.getElementById(id);
                        element.scrollIntoView({
                            behavior: 'smooth',
                            block: 'end'
                        });
                    }

                    // Hacer scroll al fondo cuando la página se cargue
                    window.addEventListener('load', () => {
                        scrollToBottom('data-container');
                    });
                </script>
                <div id="documentsDisplay"
                    class="fixed top-0 left-0 mt-20 lg:left-1/4 w-full h-full lg:w-1/2 flex justify-center items-center z-30 hidden">
                    <div class="w-full h-full pt-20">
                        <div class="bg-white w-full h-full mx-auto rounded-md flex justify-center"
                            style="backdrop-filter: blur(10px);">
                            <div class="w-full h-full  flex justify-center">
                                <div class="w-full p-4 flex items-center flex-col">
                                    <div class="w-full flex justify-between items-center">
                                        <p class="block text-start text-xl font-bold mb-2">Selector de documentos</p>
                                        <div id="documentsDisplayButtonClose" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-10">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="w-full">
                                        <div class="w-full h-full overflow-y-auto flex flex-col gap-2">
                                            @if (isset($userDocs))
                                                @if (count($userDocs) > 0)
                                                    @foreach ($userDocs as $item)
                                                        <div target="_blank"
                                                            class="rounded-md bg-gray-100 px-4 py-2 flex flex-col  cursor-pointer">
                                                            <p class="font-semibold">{{ $item->title }}</p>
                                                            <p
                                                                class="w-auto overflow-hidden whitespace-nowrap overflow-ellipsis line-clamp-3">
                                                                {{ $item->content }}
                                                            </p>
                                                            <div class="w-full flex justify-end">
                                                                <button data-text="{{ $item->display_id }}"
                                                                    class="sendDocumentMessage bg-gray-200 hover:bg-gray-300 cursor-pointer rounded-md px-4 py-2 mt-2">Enviar</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div
                                                        class="w-full flex-col items-center flex justify-center pt-12 gap-4">
                                                        <p class="">No se han encontrado resultados</p>
                                                        <a href="/docs/?action=new" target="_blank"
                                                            class="bg-gray-100 hover:bg-gray-200 rounded-md px-4 py-2 ">Crear
                                                            documento</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="contractsDisplay"
                class="fixed top-0 left-0 mt-20 lg:left-1/4 w-full h-full lg:w-1/2 flex justify-center items-center z-30 hidden">
                <div class="w-full h-full pt-20">
                    <div class="bg-white w-full h-full mx-auto rounded-md flex justify-center"
                        style="backdrop-filter: blur(10px);">
                        <div class="w-full h-full  flex justify-center">
                            <div class="w-full p-4 flex items-center flex-col">
                                <div class="w-full flex justify-between items-center">
                                    <p class="block text-start text-xl font-bold mb-2">Selector de contratos</p>
                                    <div id="contractsDisplayButtonClose" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-10">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="w-full ">
                                    <p class="text-gray-700 text-sm">Estos son los contratos que tienes creados, pero que no están activos. Para crear uno, hazlo desde tu área de gestión.</p>
                                    <p class="text-gray-700 text-sm">Enviarás una solicitud de contrato. Este podrá ser aceptado o rechazado.</p>
                                </div>
                                <br>
                                <div class="w-full">
                                    <div class="w-full h-full overflow-y-auto flex flex-col gap-2">
                                        @if (isset($contratosData))
                                            @if (count($contratosData) > 0)
                                                @foreach ($contratosData as $item)
                                                    <div target="_blank"
                                                        class="rounded-md bg-gray-100 px-4 py-2 flex flex-col ">
                                                        <p class="font-semibold">Título: {{ Str::ucfirst($item->display_name) }}</p>
                                                        <p class="w-auto overflow-hidden whitespace-nowrap overflow-ellipsis line-clamp-3">
                                                            Categoría: {{ Str::ucfirst($item->category) }}
                                                        </p>
                                                        <p class="w-auto overflow-hidden whitespace-nowrap overflow-ellipsis line-clamp-3">
                                                            ID: {{ Str::ucfirst($item->display_id) }}
                                                        </p>
                                                        <div class="w-full flex justify-end gap-2">
                                                            <a href="/management/contract/{{ $item->display_id }}" target="_blank"
                                                                class=" bg-gray-200 hover:bg-gray-300 cursor-pointer rounded-md px-4 py-2 mt-2">Ver</a>
                                                            <button data-contractId="{{ $item->id }}" data-sender="{{Auth::user()->id}}" data-receiver="{{$otherUserId}}"
                                                                class="sendContractMessage bg-gray-200 hover:bg-gray-300 cursor-pointer rounded-md px-4 py-2 mt-2">Enviar</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div
                                                    class="w-full flex-col items-center flex justify-center pt-12 gap-4">
                                                    <p class="">No se han encontrado resultados</p>
                                                    <a href="/management/contract/new" target="_blank"
                                                        class="bg-gray-100 hover:bg-gray-200 rounded-md px-4 py-2 ">Crear
                                                        contrato</a>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    @endif
@endsection
@section('info')
    @php
        use App\Models\Messages\ChatParticipants;

    @endphp
    @if (isset($display_id) && $display_id != 'request')

        <div id="chat-info" class="hidden pt-6 mb-44">
            <div class="border p-4 border-gray-200 rounded-lg">
                <p class="text-xl"><b>{{ Chat::getShowableName($chat->id, Auth::user()->id) }}</b></p>
                <p class="text-sm text-gray-500">Información general</p>
                <div id=" " class="p-4">
                    <p class="text-sm text-gray-500">Creado en {{ $chat->created_at }}</p>
                </div>
            </div>
            <br>
            <div class="border p-4 border-gray-200 rounded-lg">
                <p class="text-xl"><b>Archivos</b></p>
                <p class="text-sm text-gray-500">Documentos, imágenes, etc.</p>
                <div id="chatInfoFiles" class="py-4 overflow-x-auto flex w-full gap-2">

                </div>
            </div>
            <br>
            <div class="border p-4 border-gray-200 rounded-lg">
                <p class="text-xl"><b>Participantes</b></p>
                <p class="text-sm text-gray-500">Miembros de la conversación</p>
                @php
                    $chatId = Chat::getChatIdFromDisplayId($display_id);
                    $chatParticipantsIds = ChatParticipants::getParticipantsFromChat($chatId);
                @endphp
                <div id="chat-info-participants ">
                    @foreach ($chatParticipantsIds as $id)
                        @php
                            $particularData = Particular::getParticularData($id);
                            $userData = User::getDataById($id);
                        @endphp
                        <div class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg">
                            <div class="p-4">
                                <img class="profile-button rounded-full h-10 w-10 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                                    src="{{ App\Models\User::getProfilePic($userData->profile_pic_url) }}" alt="">
                            </div>
                            <div>
                                <a class="max-w-lg p-4 rounded-lg ">
                                    <p class="text-lg"><b>{{ $particularData->name }} {{ $particularData->surname }}
                                            @php
                                                if ($particularData->user_id === Auth::user()->id) {
                                                    echo '(Tú)';
                                                }
                                            @endphp
                                        </b></p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="anuncio-info" class="pt-2">
            <p class="text-lg font-bold mb-2">Información del anuncio</p>
            <div class="overflow-x-auto w-full">
                <div id="galleryDisplay" class="flex space-x-4">
                    @foreach ($listOfImages as $item)
                        <div class="relative flex-shrink-0 w-32 h-24 cursor-pointer pb-2">
                            <img class="w-full h-full object-cover rounded-lg"
                                src="{{ InmuebleImage::getImageFromUrl($item->url_image) }}" alt="">
                        </div>
                    @endforeach

                </div>
            </div>
            <p class="text-md font-semibold mt-2">{{ $anuncioData->title }}</p>
            <p class="text-md font-semibold text-gray-700">{{ $inmuebleData->address }}</p>
            <p class="text-md font-semibold text-gray-950">{{ $anuncioData->price }}€/mes</p>
            <hr class="mt-1 mb-1">
            <p class="text-sm lg:text-md mb-2 text-gray-700">{{ $anuncioData->description }}</p>
            <div id="mapContainer" class="w-full h-96 bg-slate-50 rounded-lg mt-2 relative">
                <div role="status" id="status" class="absolute inset-0 flex items-center justify-center z-0">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-100 animate-spin dark:text-gray-300 fill-gray-950"
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
            </div>
            <div class="w-full mx auto flex justify-center mt-3 ">
                <a class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md"
                    href="/anuncio/{{ $anuncioData->display_id }}" target="_blank">Ver información completa</a>
            </div>

        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function getCoordinatesFromOption(option, callback) {
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        'address': option
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK && results.length > 0) {
                            var location = results[0].geometry.location;
                            var coordinates = {
                                lat: location.lat(),
                                lng: location.lng()
                            };
                            callback(coordinates);
                        } else {
                            console.error('No se encontraron coordenadas para la opción proporcionada.');
                            callback(null);
                        }
                    });
                }
                getCoordinatesFromOption("{{ $inmuebleData->address }}", function(coordinates) {
                    if (coordinates) {
                        var mapStyles = [{
                                featureType: 'water',
                                elementType: 'geometry',
                                stylers: [{
                                    color: '#D1E9EA'
                                }]
                            },
                            {
                                featureType: 'landscape',
                                elementType: 'geometry',
                                stylers: [{
                                    color: '#F7F7F5'
                                }]
                            },
                            {
                                featureType: 'road',
                                elementType: 'geometry',
                                stylers: [{
                                    color: '#E0E0E0'
                                }]
                            },
                            {
                                featureType: 'poi',
                                elementType: 'geometry',
                                stylers: [{
                                    visibility: 'off'
                                }]
                            },
                            {
                                featureType: 'poi',
                                elementType: 'labels',
                                stylers: [{
                                    visibility: 'off'
                                }]
                            }
                        ];


                        var map = new google.maps.Map(document.getElementById('mapContainer'), {
                            center: coordinates,
                            zoom: 16,
                            styles: mapStyles,
                            disableDefaultUI: true,
                            gestureHandling: "cooperative"
                        });

                        var icon = {
                            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                                '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="40" viewBox="0 0 24 30"><path fill="#2C3E50" d="M12 2C7.31 2 3.74 5.43 3.2 9.998l.001.002c.008.092.019.184.033.276l.008.059C3.4 15.584 12 22 12 22s8.6-6.416 8.748-11.666l.008-.059c.014-.092.025-.184.033-.276l.001-.002C20.26 5.43 16.69 2 12 2zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 2.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/></svg>'
                            ),
                            scaledSize: new google.maps.Size(38, 46),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(12, 30)
                        };

                        var marker = new google.maps.Marker({
                            position: coordinates,
                            map: map,
                            title: 'Ubicación',
                            icon: icon
                        });
                        var infoWindowContent = '{{ $inmuebleData->address }}';

                        var infoWindow = new google.maps.InfoWindow({
                            content: infoWindowContent
                        });
                        marker.addListener('mouseover', function() {
                            infoWindow.open(map, marker);
                        });

                        marker.addListener('mouseout', function() {
                            infoWindow.close();
                        });

                        var statusMap = document.getElementById('statusMap');
                        //statusMap.classList.toggle('hidden');
                    } else {
                        console.log('No se pudieron obtener las coordenadas.');
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleChatInfo = document.getElementById('toggleChatInfo');
                const infoDisplay = document.getElementById('chat-info');
                const anuncioDisplay = document.getElementById('anuncio-info');
                const documentsDisplay = document.getElementById('documentsDisplay');
                const documentsDisplayButtonClose = document.getElementById('documentsDisplayButtonClose');
                const toggleDocumentButton = document.getElementById('dropdown-file-document');

                const contractsDisplay=document.getElementById('contractsDisplay');
                const toggleContractButton = document.getElementById('dropdown-file-contract');
                const contractsDisplayButtonClose = document.getElementById('contractsDisplayButtonClose');

                toggleChatInfo.addEventListener('click', function() {
                    infoDisplay.classList.toggle('hidden');
                    anuncioDisplay.classList.toggle('hidden');

                    if (infoDisplay.classList.contains('hidden')) {
                        toggleChatInfo.textContent = 'Info. del chat';
                    } else {
                        toggleChatInfo.textContent = 'Info. del anuncio';
                    }
                });

                toggleDocumentButton.addEventListener('click', function() {
                    documentsDisplay.classList.toggle('hidden');
                    dropdownMenu.classList.toggle('hidden');

                });


                documentsDisplayButtonClose.addEventListener('click', function() {
                    documentsDisplay.classList.add('hidden');
                });

                toggleContractButton.addEventListener('click',function(){
                    contractsDisplay.classList.toggle('hidden');
                    dropdownMenu.classList.toggle('hidden');
                });
                contractsDisplayButtonClose.addEventListener('click', function() {
                    contractsDisplay.classList.add('hidden');
                });

            });

            function setChatInfoDocs(element, data) {
                var chatInfoFiles = document.getElementById('chatInfoFiles');
                var container = document.createElement('div');
                container.classList.add('rounded-lg', 'px-4', 'py-2', 'mb-1', 'max-w-lg', 'break-words', 'relative', 'flex',
                    'flex-col', 'border', 'border-gray-100', 'justify-between', 'min-w-40');

                var title = document.createElement('p');
                title.textContent = data.data.title;
                title.classList.add('font-bold', );

                var content = document.createElement('p');
                content.textContent = data.data.content;
                content.classList.add('line-clamp-3', 'overflow-hidden', 'text-ellipsis', 'text-xs', 'min-h-20');

                var createdAt = document.createElement('small');
                createdAt.classList.add('text-xs', 'text-gray-500');
                var createdAtDate = new Date(element.val().created_at * 1000);
                createdAt.textContent =
                    `${createdAtDate.getHours()}:${(createdAtDate.getMinutes() < 10 ? '0' : '') + createdAtDate.getMinutes()}`; // Formato HH:mm

                var openDoc = document.createElement('a');
                openDoc.href = '/docs/' + element.val().text;
                openDoc.classList.add('w-auto', 'text-md', 'bg-gray-100', 'hover:bg-gray-200', 'rounded-md', 'px-2', 'py-1',
                    'mt-2', 'text-black');
                openDoc.textContent = 'Ver';
                openDoc.target = "_blank";

                // Asegurar que el contenedor mantenga la hora sobre el contenido
                container.appendChild(title);
                container.appendChild(content);
                container.appendChild(openDoc);
                container.appendChild(createdAt);

                chatInfoFiles.appendChild(container);
            }
        </script>
    @endif

@endsection
