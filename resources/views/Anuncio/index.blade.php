@extends('Layouts.anuncio')
@section('title', 'RêntHûb.es | Anuncio')
@section('system-message')
@endsection
@section('header')
    @include('Headers.header_manager')
@endsection
@section('gallery')
    <div class="w-full h-screen fixed hidden inset-0 bg-white">

    </div>
@endsection
@section('content')
    @php
        use App\Models\User;
        use App\Models\InmuebleImage;
    @endphp
    <div
        class="max-w-7xl mx-auto flex flex-wrap justify-between items-start flex-row lg:flex-row sm:flex-col sm:align-middle mt-4">
        <div>
            <div class="relative gap-2 grid lg:grid-cols-2 sm:grid-cols-1">
                <div class="relative h-full" onclick="openInThisPic(0)">
                    <img class="h-full w-full lg:rounded-l-lg object-cover"
                        src="{{ InmuebleImage::getImageFromUrl($listOfImages[0]->url_image) }}" alt="">
                    <div class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 rounded-l-lg"></div>
                </div>
                <div class="lg:grid grid-cols-2 gap-2 lg:block hidden">
                    @if (isset($listOfImages[1]))
                        <div class="relative  col-span-1 row-span-1" onclick="openInThisPic(1)">
                            <img class="h-full w-full object-cover"
                                src="{{ InmuebleImage::getImageFromUrl($listOfImages[1]->url_image) }}" alt="">
                            <div
                                class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 transition-opacity ">
                            </div>
                        </div>
                    @endif
                    @if (isset($listOfImages[2]))
                        <div class="relative  col-span-1 row-span-1" onclick="openInThisPic(2)">
                            <img class="h-full w-full object-cover"
                                src="{{ InmuebleImage::getImageFromUrl($listOfImages[2]->url_image) }}" alt="">
                            <div
                                class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 transition-opacity ">
                            </div>
                        </div>
                    @endif
                    @if (isset($listOfImages[3]))
                        <div class="relative  col-span-1 row-span-1" onclick="openInThisPic(3)">
                            <img class="h-full w-full object-cover"
                                src="{{ InmuebleImage::getImageFromUrl($listOfImages[3]->url_image) }}" alt="">
                            <div
                                class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 transition-opacity ">
                            </div>
                        </div>
                    @endif
                    @if (isset($listOfImages[4]))
                        <div class="relative  col-span-1 row-span-1" onclick="openInThisPic(4)">
                            <img class="h-full w-full object-cover"
                                src="{{ InmuebleImage::getImageFromUrl($listOfImages[4]->url_image) }}" alt="">
                            <div
                                class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 transition-opacity ">
                            </div>
                        </div>
                    @endif
                </div>
                <div id="imageGalleryButtonOpen"
                    class="absolute bottom-5 right-5 bg-gray-100 text-gray-950 mt-2 flex gap-2  px-4 py-1 rounded-md hover:bg-gray-200  focus:outline-none cursor-pointer">
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <button>Ver galería completa</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mx-2 lg:w-8/12 flex flex-col align-middle lg:mx-auto">
            <div class="py-4 flex justify-between w-full px-2 lg:px-0">
                <div>
                    <h1 class="lg:text-2xl font-bold text-gray-950">{{ $anuncioData->title }}</h1>
                    <p class="lg:text-2xl font-bold text-gray-700">{{ucfirst($inmuebleData->category)}} en {{ $inmuebleData->address }}</p>
                </div>
                @if (!Auth::check())
                    <div class="text-end gap-2">
                        <p class="lg:text-2xl font-bold text-gray-950">{{ $anuncioData->price }}€/mes</p>
                        <button id="contactButton"
                            class="bg-pink-700  text-white mt-2 flex gap-2  px-4 py-2 rounded-md hover:bg-gray-200 e focus:outline-none cursor-pointer items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                            </svg>
                            Ponerme en contacto
                        </button>
                    </div>
                @endif
                @if (Auth::check())
                    @if ($owner->id != Auth::user()->id)
                        <div class="text-end gap-2">
                            <p class="lg:text-2xl font-bold text-gray-950">{{ $anuncioData->price }}€/mes</p>
                            <button id="contactButton"
                                class="bg-pink-700  text-white mt-2   flex gap-2  px-4 py-2 rounded-md hover:bg-gray-200 e focus:outline-none cursor-pointer items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                </svg>
                                Ponerme en contacto
                            </button>
                        </div>
                    @endif
                @endif
            </div>
            <div class="flex justify-between flex-col sm:flex-row mb-2">
                <div class="flex justify-center gap-2">
                    <button id="favButton"
                        class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                        py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">
                        <?php if($isFaved === 0): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        Guardar
                        <?php else: ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        Guardado
                        <?php endif; ?>
                    </button>
                    <script>
                        var favButton = document.getElementById('favButton');
                        var isFaved = {{ $isFaved }};
                        favButton.addEventListener('click', function() {
                            if (isFaved === 0) {
                                favButton.innerHTML =
                                    `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" /></svg><span>Guardado</span>`;
                                fetch('/anuncio/fav/{{ $anuncioData->id }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        isFaved: 1
                                    })
                                });
                            } else {
                                favButton.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                <span>Guardar</span>`;
                                fetch('/anuncio/fav/{{ $anuncioData->id }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        isFaved: 0
                                    })
                                });
                            }
                            isFaved = 1 - isFaved;
                        });
                    </script>
                    <button id="shareButtonTop"
                        class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                        py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                        Compartir</button>
                </div>
            </div>
            <div class="px-2 lg:px-0 w-full">
                <p class="text-sm lg:text-md text-gray-700">Información del propietario</p>
                <a href="/user/{{ $owner->display_id }}"
                    class="w-full mt-1 hover:bg-gray-100 hover:cursor-pointer flex lg:flex-row flex-col justify-between items-start lg:items-center rounded-lg">
                    <div class="flex items-center">
                        <div class="px-1 ml-4">
                            <img class="profile-button rounded-full h-10 w-10 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                                src="{{ User::getProfilePic($owner->profile_pic_url) }}" alt="">
                        </div>
                        <div>
                            <div class="max-w-lg p-4 rounded-lg ">
                                <p class="text-lg text-gray-950">{{ $ownerTyped->name }} {{ $ownerTyped->surname }}
                                    @if (Auth::check())
                                        @if ($owner->id === Auth::user()->id)
                                            (Tú)
                                        @endif
                                    @endif

                                </p>
                                <p class="text-md text-gray-700">Particular</p>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="mt-2 border-t border-gray-200 pt-2">
                    <p class="text-sm lg:text-md mb-2 text-gray-700">Información del inmueble</p>
                    <p>{{ $anuncioData->description }}
                    </p>
                    <p class="lg:text-2xl font-bold text-gray-700 mt-2 mb-1">Características</p>

                    @if (count($inmuebleCaracteristicas) > 0)
                        <div class="grid lg:grid-cols-8 grid-cols-4 md:grid-cols-6 mt-4 mb-8 gap-4 ">
                            @foreach ($inmuebleCaracteristicas as $item)
                                <div class="flex flex-col items-center w-auto">
                                    @if ($item['icon'] != null)
                                        {!! $item['icon'] !!}
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                        </svg>
                                    @endif
                                    <p class="text-sm lg:text-md text-gray-700">{{ $item['label'] }}</p>
                                    <p class="text-md text-gray-950 ">{{ ucfirst($item['value']) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="w-full pb-4">No se han encontrado resultados</p>
                    @endif


                    <p class="lg:text-2xl font-bold text-gray-700 mt-2 mb-1">Localización</p>
                    <p>{{ $inmuebleData->address }}</p>
                    <div id="mapContainer" class="w-full h-96 bg-slate-50 rounded-lg mt-2 relative">
                        <div role="status" id="status" class="absolute inset-0 flex items-center justify-center z-0">
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
                    </div>
                    <br>
                    <div class="flex justify-between">
                        <div class="flex gap-2">
                            <button
                                class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                                py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                Guardar</button>
                            <button id="shareButton"
                                class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                                py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                </svg>
                                Compartir</button>
                        </div>
                        <div>
                            <button
                                class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                                py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                </svg>

                                Reportar
                            </button>
                        </div>
                    </div>
                    <br><br>
                    <p class="lg:text-2xl font-bold text-gray-700 mt-2 mb-1">También podria interesarte...</p>
                    <div id="shareDisplay"
                        class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
                        <div id="shareDisplayBackdrop"
                            class="fixed hidden top-0 left-0 w-full h-full bg-black opacity-50"></div>
                        <div id="documentSelectorDisplay"
                            class="bg-gray-100 lg:w-2/6 h-auto mx-auto w-5/6 rounded-md border border-gray-200"
                            style="backdrop-filter: blur(10px);">
                            <div class="p-6 flex flex-col h-full justify-between">
                                <p class="text-xl font-bold">Compartir este anuncio</p>
                                <div class="flex gap-8 flex-wrap justify-center  p-4">
                                    <button id="shareFacebook"
                                        class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                        </svg>
                                        Facebook
                                    </button>
                                    <button id="shareWhatsApp"
                                        class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                            <path
                                                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                        </svg>
                                        WhatsApp
                                    </button>
                                    <button id="shareMail"
                                        class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                        </svg>
                                        Email
                                    </button>
                                    <button id="shareTwitter"
                                        class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                            <path
                                                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                                        </svg>
                                        Twitter
                                    </button>
                                </div>
                                <div id="qrcode" class="w-full flex justify-center flex-col items-center gap-2 p-4">
                                    <p class="text-lg font-bold">Código QR</p>
                                </div>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
                                <script type="text/javascript">
                                    var currentUrl = window.location.href;
                                    new QRCode(document.getElementById("qrcode"), currentUrl);
                                </script>

                            </div>
                        </div>
                    </div>
                    <div id="imageGalleryDisplay"
                        class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center z-30 hidden">
                        <div id="imageGalleryBackdrop"
                            class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden">
                        </div>
                        <div class="w-full h-screen pt-20">
                            <div id="documentSelectorDisplay"
                                class="bg-white w-full h-full mx-auto rounded-md flex justify-center"
                                style="backdrop-filter: blur(10px);">
                                <div class="w-full h-full flex justify-center">
                                    <div class="w-full lg:w-3/5 p-4 flex items-center flex-col">
                                        <div class="w-full flex justify-between items-center">
                                            <p class="block text-start text-xl font-bold mb-2">Galería de imágenes</p>
                                            <div id="imageGalleryButtonClose" class="cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-10">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="flex items-center flex-col h-full w-full">
                                            <div
                                                class="mb-4 w-full h-2/6 md:h-4/6 flex flex-col justify-center items-center ">
                                                <img id="largeImage"
                                                    class="min-w-full min-h-full h-full object-cover rounded-lg "
                                                    src="{{ InmuebleImage::getImageFromUrl($listOfImages[0]->url_image) }}"
                                                    alt="">
                                                <div class="flex justify-center w-full py-1 gap-1 items-center">
                                                    <button id="prevImage"
                                                        class="h-10 w-10 bg-gray-100 hover:bg-gray-200 p-2 rounded-full focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </button>
                                                    <span id="countImage"></span>
                                                    <button id="nextImage"
                                                        class="h-10 w-10 bg-gray-100 hover:bg-gray-200 p-2 rounded-full focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="overflow-x-auto w-full">
                                                <div id="galleryDisplay" class="flex space-x-4">
                                                    @foreach ($listOfImages as $item)
                                                        <div
                                                            class="thumbnail relative flex-shrink-0 w-32 h-24 cursor-pointer">
                                                            <img class="w-full h-full object-cover rounded-lg"
                                                                src="{{ InmuebleImage::getImageFromUrl($item->url_image) }}"
                                                                alt="">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        const imageGalleryButtonOpen = document.getElementById('imageGalleryButtonOpen');
                        const imageGalleryButtonClose = document.getElementById('imageGalleryButtonClose');
                        const imageGalleryDisplay = document.getElementById('imageGalleryDisplay');
                        const imageGalleryBackdrop = document.getElementById('imageGalleryBackdrop');

                        imageGalleryButtonOpen.addEventListener('click', function() {
                            imageGalleryDisplay.classList.toggle('hidden')
                            imageGalleryBackdrop.classList.toggle('hidden')
                        })
                        imageGalleryButtonClose.addEventListener('click', function() {
                            imageGalleryDisplay.classList.toggle('hidden')
                            imageGalleryBackdrop.classList.toggle('hidden')
                        })
                    </script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Seleccionar todas las imágenes pequeñas y la imagen grande
                            const thumbnails = document.querySelectorAll('#galleryDisplay .thumbnail img');
                            const largeImage = document.getElementById('largeImage');
                            const labelTotal = document.getElementById('countImage')
                            let currentIndex = 0;

                            const imageTotal = thumbnails.length;
                            labelTotal.textContent = "1/" + imageTotal;
                            // Actualizar la imagen grande con la imagen de la miniatura en el índice actual
                            function updateLargeImage() {
                                largeImage.src = thumbnails[currentIndex].src;
                            }

                            // Añadir evento de clic a cada imagen pequeña
                            thumbnails.forEach((thumbnail, index) => {
                                thumbnail.addEventListener('click', () => {
                                    currentIndex = index;
                                    labelTotal.textContent = (currentIndex + 1) + "/" + imageTotal;
                                    updateLargeImage();
                                });
                            });

                            // Navegación a la imagen anterior
                            document.getElementById('prevImage').addEventListener('click', () => {
                                currentIndex = (currentIndex > 0) ? currentIndex - 1 : thumbnails.length - 1;
                                labelTotal.textContent = (currentIndex + 1) + "/" + imageTotal;
                                updateLargeImage();
                            });

                            // Navegación a la imagen siguiente
                            document.getElementById('nextImage').addEventListener('click', () => {
                                currentIndex = (currentIndex < thumbnails.length - 1) ? currentIndex + 1 : 0;
                                labelTotal.textContent = (currentIndex + 1) + "/" + imageTotal;
                                updateLargeImage();
                            });


                        });

                        function openInThisPic(index) {

                            const thumbnails = document.querySelectorAll('#galleryDisplay .thumbnail img');
                            const largeImage = document.getElementById('largeImage');
                            const labelTotal = document.getElementById('countImage')
                            const imageTotal = thumbnails.length;

                            imageGalleryDisplay.classList.toggle('hidden')
                            imageGalleryBackdrop.classList.toggle('hidden')
                            labelTotal.textContent = (index + 1) + "/" + imageTotal;
                            currentIndex = index;
                            updateLargeImage();

                            function updateLargeImage() {
                                largeImage.src = thumbnails[currentIndex].src;
                            }
                        }
                    </script>
                    <div id="contactDisplay"
                        class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
                        <div id="contactDisplayBackdrop"
                            class="fixed hidden top-0 left-0 w-full h-full bg-black opacity-50">
                        </div>
                        <div id="documentSelectorDisplay"
                            class="bg-gray-100 lg:w-2/6 lg:h-auto h-auto mx-auto w-5/6 rounded-md border border-gray-200"
                            style="backdrop-filter: blur(10px);">
                            @if (Auth::check())
                                <div class="p-4 flex flex-col h-auto justify-between gap-2">
                                    <p class="text-xl font-bold">Contactar</p>
                                    <div class="w-full h-auto flex flex-col justify-start gap-2">
                                        <p class="text-sm">Se enviará una solicitud de mensaje al propietario del inmueble
                                        </p>
                                        <form action="/messages/request/new" method="POST" enctype="multipart/form-data"
                                            class="flex flex-col gap-2">
                                            @csrf
                                            <input type="text" id="contactMessage" name="contactMessage"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                placeholder="Mensaje" required>
                                            <input type="text" value="{{ $anuncioData->id }}" name="contactAnuncio"
                                                hidden>
                                            <input type="text" value="{{ $anuncioData->user_id }}"
                                                name="contactReceiver" hidden>
                                            <div class="flex justify-end">
                                                <input id="step3" type="submit" value="Enviar"
                                                    class="next hover:bg-gray-300  cursor-pointer bg-gray-200 px-6 w-auto py-2 rounded-md  focus:outline-none "></input>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="p-6 flex flex-col h-full justify-between">
                                    <p class="text-xl font-bold">Contactar</p>
                                    <div class="w-full h-full flex flex-col justify-start gap-2 ">
                                        <p class="text-sm">Para contactar con <b>{{ $ownerTyped->name }}
                                                {{ $ownerTyped->surname }}</b> debes tener una cuenta.</p>
                                        <div class="flex w-full justify-center items-center p-4 gap-2">
                                            <a href="/login"
                                                class="px-4 py-2 w-auto bg-gray-200 hover:bg-gray-300 rounded-md">Iniciar
                                                sesión</a>
                                            <a href="/login"
                                                class="px-4 py-2 w-auto bg-gray-200 hover:bg-gray-300 rounded-md">Registrarme</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
    </script>

    <script src="https://media.renthub.es/js/anuncioShareFunctions.js"></script>
    <script src="https://media.renthub.es/js/anuncioContactFunctions.js"></script>
    <br><br><br>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
