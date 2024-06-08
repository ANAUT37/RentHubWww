@extends('Layouts.search')
@section('title', 'RêntHûb.es | Search')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('top')
    <style>
        body.lock-scroll {
            overflow: hidden;
        }

        .custom-info-window {
            background-color: #ffffff;
            color: #000000;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .custom-info-window h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .custom-info-window p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
    </style>
    <div class="sticky container mx-auto px-4 " style="backdrop-filter: blur(8px);">
        <div class="container lg:w-2/3 mx-auto  border-b-gray-200 border-b pb-4">
            <h1 class="lg:text-xl mb-2">Resultados de <b>{{ ucfirst($category) }}</b> en <b>{{ ucfirst($location) }}</b></h1>
            <div class="lg:flex sm:justify-between lg:items-center overflow-x-auto flex flex-row gap-4">
                <div class="flex gap-1">
                    <button
                        class="text-center flex gap-1 hover:cursor-pointer bg-gray-100 px-3 w-auto
                        py-2 rounded-md hover:bg-gray-200  focus:outline-none "
                        id="filtersButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                        Filtros
                    </button>
                    <select name="order" id="orderInput"
                        class="text-center flex gap-1 hover:cursor-pointer bg-gray-100 border-none w-40
                        py-2 rounded-md hover:bg-gray-200  focus:outline-none ">
                        <option value="none" selected>Relevancia</option>
                        <option value="pisos">Más visitados</option>
                        <option value="locales">Precio menor</option>
                        <option value="compartir">Precio mayor</option>
                    </select>
                </div>
                <div class="flex gap-1">
                    <button id="followedButton"
                        class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                            py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">
                        <?php if($isFollowed === 0): ?>
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
                    <button id="showMap"
                        class="text-center flex gap-1 hover:cursor-pointer bg-gray-100 px-3 w-auto
                             py-2 rounded-md hover:bg-gray-200 focus:outline-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>
                        Mapa
                    </button>
                </div>
            </div>

        </div>

    @endsection
    @section('map')
        <div class="w-full h-screen pt-2 hidden fixed inset-0 overflow-hidden bottom-50 transition ease-in-out delay-150"
            style="backdrop-filter: blur(8px); background-color: rgba(255, 255, 255, 0.438);" id="mapDisplay">
            <div class="absolute top-4 left-0 z-10  w-full">
                <div class="container flex flex-col lg:flex-row h-full gap-2 justify-between w-full px-2">
                    <h1 class="bg-white text-gray-950 px-4 py-2 rounded-md">Resultados de <b>{{ ucfirst($category) }}</b> en
                        <b>{{ ucfirst($location) }}</b>
                    </h1>
                    <div class="flex gap-2">
                        <div id="zoomOutInner"
                            class="text-center bg-gray-950 flex gap-1 hover:cursor-pointer text-white px-3 w-auto
                            py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>

                        </div>
                        <div id="zoomInInner"
                            class="text-center  bg-gray-950 flex gap-1 hover:cursor-pointer text-white px-3 w-auto
                            py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <div id="showMapInner"
                            class="text-center bg-gray-950 flex gap-1 hover:cursor-pointer text-white px-3 w-auto
                            py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            Cerrar Mapa
                        </div>
                    </div>
                </div>
            </div>
            <div role="status" id="statusMap" class="absolute top-1/2 right-1/2 z-10">
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
            <div class="h-full w-full rounded-t-md" id="mapContainer"></div>
        </div>
        <script src="https://media.renthub.es/js/mapButtons.js"></script>
    @endsection
    @section('content')
        <div class=" flex-col gap-4 w-5/6 lg:w-2/3 mx-auto pt-2 flex justify-center mb-4 z-10">
            <div id="anuncios-container" class="gap-2">

            </div>
            <div id="statusSearch" class="text-center flex justify-center mt-3">
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
            <p class="lg:text-2xl font-bold text-gray-700 mt-2 mb-1">También podria interesarte...</p>
        </div>
        <div id="filtersDisplay" class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
            <div id="filtersDisplayBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
            <div id="documentSelectorDisplay"
                class="bg-gray-100 lg:w-2/6 h-5/6 mx-auto w-5/6 rounded-md border border-gray-200 flex justify-between flex-col"
                style="backdrop-filter: blur(10px);">
                <div class="p-6 flex flex-col h-auto border-b border-gray-200 justify-start gap-2">
                    <div class="flex gap-2 items-center">
                        <p class="text-xl font-bold">Filtros</p>
                    </div>
                </div>
                <div class="flex w-full h-full overflow-y-auto p-4 flex-col gap-4">
                    <div class="w-full">
                        <p class="text-xl font-bold">Precio</p>
                        <div class="w-full flex gap-6 p-4">
                            <div class="flex flex-col w-1/2 gap-2">
                                <p class="text-sm font-bold">Mínimo</p>
                                <select class="w-full flex rounded-md" id="filterPriceMin">
                                    <option value="none">Indiferente</option>
                                    <option value="50">50€</option>
                                    <option value="100">100€</option>
                                    <option value="150">150€</option>
                                    <option value="200">200€</option>
                                    <option value="250">250€</option>
                                    <option value="300">300€</option>
                                    <option value="350">350€</option>
                                    <option value="400">400€</option>
                                    <option value="450">450€</option>
                                    <option value="500">500€</option>
                                    <option value="550">550€</option>
                                    <option value="600">600€</option>
                                    <option value="650">650€</option>
                                    <option value="700">700€</option>
                                    <option value="750">750€</option>
                                    <option value="800">800€</option>
                                    <option value="850">850€</option>
                                    <option value="900">900€</option>
                                    <option value="950">950€</option>
                                    <option value="1000">1000€</option>
                                    <option value="1050">1050€</option>
                                    <option value="1100">1100€</option>
                                    <option value="1150">1150€</option>
                                    <option value="1200">1200€</option>
                                </select>
                            </div>
                            <div class="flex flex-col w-1/2 gap-2">
                                <p class="text-sm font-bold">Máximo</p>
                                <select class="w-full flex rounded-md" id="filterPriceMax">
                                    <option value="none">Indiferente</option>
                                    <option value="50">50€</option>
                                    <option value="100">100€</option>
                                    <option value="150">150€</option>
                                    <option value="200">200€</option>
                                    <option value="250">250€</option>
                                    <option value="300">300€</option>
                                    <option value="350">350€</option>
                                    <option value="400">400€</option>
                                    <option value="450">450€</option>
                                    <option value="500">500€</option>
                                    <option value="550">550€</option>
                                    <option value="600">600€</option>
                                    <option value="650">650€</option>
                                    <option value="700">700€</option>
                                    <option value="750">750€</option>
                                    <option value="800">800€</option>
                                    <option value="850">850€</option>
                                    <option value="900">900€</option>
                                    <option value="950">950€</option>
                                    <option value="1000">1000€</option>
                                    <option value="1050">1050€</option>
                                    <option value="1100">1100€</option>
                                    <option value="1150">1150€</option>
                                    <option value="1200">1200€</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="text-xl font-bold">Fecha de publicación</p>
                        <div class="flex flex-col gap-4 p-4">
                            <div class="flex items-center gap-2">
                                <input type="radio" id="filterCreatedNone" name="created_at" value="none" checked>
                                <label for="filterCreatedNone" class="text-sm font-bold">Indiferente</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="radio" id="filterCreatedDay" name="created_at" value="day">
                                <label for="filterCreatedDay" class="text-sm font-bold">Últimas 24 horas</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="radio" id="filterCreatedWeek" name="created_at" value="week">
                                <label for="filterCreatedWeek" class="text-sm font-bold">Última semana</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="radio" id="filterCreatedMonth" name="created_at" value="month">
                                <label for="filterCreatedMonth" class="text-sm font-bold">Última mes</label>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="text-xl font-bold">Superficie</p>
                        <div class="w-full flex gap-6 p-4">
                            <div class="flex flex-col w-1/2 gap-2">
                                <p class="text-sm font-bold">Mínima</p>
                                <select id="filterMetersMin" class="w-full flex rounded-md" disabled>
                                    <option value="none">Indiferente</option>
                                    <option value="50">50m²</option>
                                    <option value="75">75m²</option>
                                    <option value="100">100m²</option>
                                    <option value="125">125m²</option>
                                    <option value="150">150m²</option>
                                    <option value="175">175m²</option>
                                    <option value="200">200m²</option>
                                    <option value="225">225m²</option>
                                    <option value="250">250m²</option>
                                    <option value="275">275m²</option>
                                    <option value="300">300m²</option>
                                    <option value="325">325m²</option>
                                    <option value="350">350m²</option>
                                    <option value="375">375m²</option>
                                    <option value="400">400m²</option>
                                    <option value="425">425m²</option>
                                    <option value="450">450m²</option>
                                    <option value="475">475m²</option>
                                    <option value="500">500m²</option>
                                    <option value="550">550m²</option>
                                    <option value="600">600m²</option>
                                    <option value="650">650m²</option>
                                    <option value="700">700m²</option>
                                    <option value="750">750m²</option>
                                    <option value="800">800m²</option>
                                    <option value="850">850m²</option>
                                    <option value="900">900m²</option>
                                    <option value="950">950m²</option>
                                    <option value="1000">1000m²</option>
                                </select>
                            </div>
                            <div class="flex flex-col w-1/2 gap-2">
                                <p class="text-sm font-bold">Máxima</p>
                                <select id="filterMetersMax" class="w-full flex rounded-md" disabled>
                                    <option value="none">Indiferente</option>
                                    <option value="50">50m²</option>
                                    <option value="75">75m²</option>
                                    <option value="100">100m²</option>
                                    <option value="125">125m²</option>
                                    <option value="150">150m²</option>
                                    <option value="175">175m²</option>
                                    <option value="200">200m²</option>
                                    <option value="225">225m²</option>
                                    <option value="250">250m²</option>
                                    <option value="275">275m²</option>
                                    <option value="300">300m²</option>
                                    <option value="325">325m²</option>
                                    <option value="350">350m²</option>
                                    <option value="375">375m²</option>
                                    <option value="400">400m²</option>
                                    <option value="425">425m²</option>
                                    <option value="450">450m²</option>
                                    <option value="475">475m²</option>
                                    <option value="500">500m²</option>
                                    <option value="550">550m²</option>
                                    <option value="600">600m²</option>
                                    <option value="650">650m²</option>
                                    <option value="700">700m²</option>
                                    <option value="750">750m²</option>
                                    <option value="800">800m²</option>
                                    <option value="850">850m²</option>
                                    <option value="900">900m²</option>
                                    <option value="950">950m²</option>
                                    <option value="1000">1000m²</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <p class="text-xl font-bold">Distancia</p>
                        <div class="w-full flex gap-6 p-4">
                            <div class="flex flex-col w-1/2 gap-2">
                                <p class="text-sm font-bold">Establece un rango de distancia</p>
                                <select class="w-full flex rounded-md" id="filterDistance">
                                    <option value="none">Indiferente</option>
                                    <option value="0.00455">1km</option>
                                    <option value="0.00909">2km</option>
                                    <option value="0.0227">5km</option>
                                    <option value="0.0455">10km</option>
                                    <option value="0.0909">20km</option>
                                    <option value="0.227">50km</option>
                                    <option value="0.455">100km</option>
                                    <option value="0.909">200km</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 flex flex-col h-auto border-t border-gray-200 justify-start gap-2">
                    <div class="flex gap-2 items-center justify-end">
                        <Button id="applyFiltersButton"
                            class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                        py-2 rounded-md border border-gray-200 hover:bg-gray-600 hover:text-white focus:outline-none ">Aplicar</Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var followedButton = document.getElementById('followedButton');
        var isFollowed = {{ $isFollowed }};
        followedButton.addEventListener('click', function() {
            console.log('enter')
            if (isFollowed === 0) {
                followedButton.innerHTML =
                    `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" /></svg><span>Guardado</span>`;
                fetch('/search/follow', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        isFollowed: 1,
                        category: '{{ $category }}',
                        address: '{{ $location }}',
                    })
                }).then(data => {
                    console.log(data)
                }).catch(error => {
                    console.error('saving went wrong:', error);
                });
            } else {
                followedButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
                <span>Guardar</span>`;
                fetch('/search/follow', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        isFollowed: 0,
                        category: '{{ $category }}',
                        address: '{{ $location }}',
                    })
                }).then(data => {
                    console.log(data)
                }).catch(error => {
                    console.error('saving went wrong:', error);
                });
            }
            isFollowed = 1 - isFollowed;

        });
    </script>
    <script>
        var option = "{{ $location }}";
        var category = "{{ $category }}";
    </script>
    <script src="https://media.renthub.es/js/searchManager.js" async></script>
    <script src="https://media.renthub.es/js/bigPictureFilters.js"></script>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
