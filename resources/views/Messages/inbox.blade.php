@extends('Layouts.fullthree')
@section('title', 'RêntHûb.es | Messages')
@section('header')
    @include('Headers.header_manager')
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
                    class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg
            @if (isset($request_id)) @if ($request_id == $chat->display_id)
                bg-gray-100 @endif
            @endif
            ">
                    <div class="p-4">
                        <img class="profile-button rounded-full h-16 w-auto flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                            src="{{ App\Models\User::getProfilePic(Auth::user()->id) }}" alt="">
                    </div>
                    <div>
                        <div class="max-w-lg p-4 rounded-lg ">
                            <p class="text-xl"><b>{{ Particular::getParticularName($chat->sender_id) }}</b></p>
                            <p class="text-xl">{{ $chat->anuncio_id }}</p>
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
                    class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg
                    @if (isset($display_id)) @if ($display_id == $chat->display_id)
                        bg-gray-100 @endif
                    @endif
                    ">
                    <div class="p-4">
                        <img class="profile-button rounded-full h-16 w-auto flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                            src="{{ App\Models\User::getProfilePic(Auth::user()->id) }}" alt="">
                    </div>
                    <div>
                        <div class="max-w-lg p-4 rounded-lg ">
                            <p class="text-xl"><b>{{ Chat::getShowableName($chat->id, Auth::user()->id) }}</b></p>
                            <p class="text-xl">{{ $chat->anuncio_id }}</p>
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
            <div id="chatDisplay" class="container flex flex-col-reverse flex-grow overflow-x-auto px-10">
                <div class="p-2 flex justify-start gap-2">
                    <img class="profile-button rounded-full h-10 w-auto flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                        src="{{ App\Models\User::getProfilePic(Auth::user()->id) }}" alt="">
                    <div class="bg-gray-100 rounded-md p-2">
                        <div class="font-bold">
                            Pablo
                        </div>
                        <div>
                            Lorem ipsum dolor sit amet
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col-reverse justify-end  overflow-y-auto mx-0"
                style="margin-bottom: 4rem; max-height: calc(100% - 13rem);">
                <div id="chatDisplay" class="container flex flex-col-reverse flex-grow overflow-x-auto px-10">
                    <div class="p-2 flex justify-start gap-2">
                        <img class="profile-button rounded-full h-10 w-auto flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                            src="{{ App\Models\User::getProfilePic(Auth::user()->id) }}" alt="">
                        <div class="bg-gray-100 rounded-md p-2">
                            <div class="font-bold">
                                Pablo
                            </div>
                            <div>
                                Lorem ipsum dolor sit amet
                            </div>
                        </div>
                    </div>
                </div>
                <div id="documentsDisplay" class="w-full h-full flex justify-center items-center z-30 hidden">
                    <div id="documentSelectorDisplay"
                        class="absolute z-30 bg-gray-100 w-3/4 h-3/4 top-0 mt-3 rounded-md border border-gray-200"
                        style="backdrop-filter: blur(10px);">
                        <div class="p-6 flex flex-col justify-between h-full">
                            <p class="text-xl font-bold">Documentos</p>
                            <div>

                            </div>
                            <div class="flex justify-end">
                                <button
                                    class="bg-white border border-gray-300 text-black px-3 py-1 rounded-md  hover:bg-gray-600 hover:text-white hover:border-gray-600">Enviar</button>
                            </div>
                        </div>

                    </div>
                    <div id="documentsDisplayBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 z-20">
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
                <div id="chat-info-files " class="p-4">
                    <p class="text-sm text-gray-500">Creado en</p>
                </div>
            </div>
            <br>
            <div class="border p-4 border-gray-200 rounded-lg">
                <p class="text-xl"><b>Archivos</b></p>
                <p class="text-sm text-gray-500">Documentos, imágenes, etc.</p>
                <div id="chat-info-files " class="p-4">
                    <p class="text-sm text-gray-500 text-center italic">Sin resultados</p>
                </div>
            </div>
            <br>
            <div class="border p-4 border-gray-200 rounded-lg">
                <p class="text-xl"><b>Eventos</b></p>
                <p class="text-sm text-gray-500">Notificaciones referentes a esta conversación</p>
                <div id="chat-info-events " class="p-4">
                    <p class="text-sm text-gray-500 text-center italic">Sin resultados</p>
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
                            $userData = Particular::getParticularData($id);
                        @endphp
                        <div class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg">
                            <div class="p-4">
                                <img class="profile-button rounded-full h-10 w-auto flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                                    src="{{ App\Models\User::getProfilePic(Auth::user()->id) }}" alt="">
                            </div>
                            <div>
                                <div class="max-w-lg p-4 rounded-lg ">
                                    <p class="text-lg"><b>{{ $userData->name }} {{ $userData->surname }}
                                            @php
                                                if ($userData->user_id === Auth::user()->id) {
                                                    echo '(Tú)';
                                                }
                                            @endphp
                                        </b></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="anuncio-info" class="pt-2">
            info del anuncio
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleChatInfo = document.getElementById('toggleChatInfo');
                const infoDisplay = document.getElementById('chat-info');
                const anuncioDisplay = document.getElementById('anuncio-info');
                const documentsDisplay = document.getElementById('documentsDisplay');
                const toggleDocumentButton = document.getElementById('dropdown-file-document');

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

                const documentsDisplayBackdrop = document.getElementById('documentsDisplayBackdrop');
                documentsDisplayBackdrop.addEventListener('click', function() {
                    documentsDisplay.classList.add('hidden');
                });
            });
        </script>
    @endif
    @if (isset($display_id) && $display_id == 'request')

    @endif
@endsection
