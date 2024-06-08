@extends('Layouts.main')
@section('title', 'RêntHûb.es')
@section('header')
    <div class="sticky">
        @if (Auth::check())
            @include('Headers.sessioned_index')
        @else
            @include('Headers.no_session')
        @endif
    </div>
@endsection
@section('content')
    <style>
        .hide {
            opacity: 0;
            transition: opacity 0.2s ease-out;
        }
    </style>
    @php
        use App\Models\Inmueble;
        use App\Models\InmuebleImage;
    @endphp
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"></style>
    <div class="h-96 relative mt-0">
        <div
            class="absolute z-10 top-2/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full lg:w-auto sm:w-auto lg:flex lg:justify-center">
            <div id="elemento"
                class="flex flex-col mb-4 lg:mb-0 sm:mb-4 w-full p-4 rounded-lg lg:w-auto sm:w-auto bg-white bg-opacity-90"
                style="backdrop-filter: blur(8px);">
                <div class="flex justify-start w-full gap-2 items-center">
                    <p class="text-2xl text-gray-750 font-bold mb-6">Encuentra tu sitio</p>
                </div>

                <div class="flex flex-col lg:flex-row mb-4 lg:mb-0 sm:mb-4">
                    <div class="flex relative mb-2 lg:mb-0">
                        <input id="locationInputInner" type="text" placeholder="Ciudad, barrio, calle..."
                            class="w-full lg:w-96 sm:w-64 px-3 py-2 border bg-transparent border-gray-300 rounded-l-md">
                        <div id="searchResultsInner"
                            class="absolute top-full left-0 w-full bg-transparent border border-gray-300 rounded-l-md z-50 rounded-br-md hidden">
                        </div>
                    </div>
                    <select name="categoryInner" id="categoryInner"
                        class="w-full lg:w-40 sm:w-100 px-2 py-1  bg-transparent border-gray-300">
                        <option value="none" disabled selected hidden required>Categoría</option>
                        <option value="locales">Local</option>
                        <option value="compartir">Compartir</option>
                        <option value="casas">Casa</option>
                        <option value="garajes">Garaje</option>
                        <option value="oficinas">Oficina</option>
                        <option value="trasteros">Trastero</option>
                        <option value="terrenos">Terreno</option>
                    </select>
                    <button id="searchButtonInner"
                        class="bg-pink-700  text-white px-3 py-1 rounded-r-md hover:text-white  hover:bg-gray-600  hover:border-gray-600">Buscar</button>
                </div>
            </div>
        </div>
        <div class="carousel w-full relative">
            <div class="relative h-56 overflow-hidden lg:rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                <div class="carousel-item duration-700 ease-in-out opacity-100 transition-opacity">
                    <img src="https://media.renthub.es/img/system/home-banner-00.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
                <div class="carousel-item hidden duration-700 ease-in-out opacity-0 transition-opacity">
                    <img src="https://media.renthub.es/img/system/home-banner-01.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
                <div class="carousel-item hidden duration-700 ease-in-out opacity-0 transition-opacity">
                    <img src="https://media.renthub.es/img/system/home-banner-02.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover  -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
                <div class="carousel-item hidden duration-700 ease-in-out opacity-0 transition-opacity">
                    <img src="https://media.renthub.es/img/system/home-banner-03.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col min-h-[100dvh]">
        @if (Auth::check())
            <main class="flex-1">
                <section class="w-full lg:pt-16 hidden" id="lastSearchSection">
                    <div class="container  px-4 md:px-6">
                        <p class="text-2xl lg:text-3xl font-bold w-full mb-2">Sigue con tu última búsqueda</p>
                        <div class="mb-2 w-full flex justify-between">
                            <p class="text-xl font-bold  text-gray-700" id="lastSearchLabelAddress"></p>
                            <a class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md w-auto" id="lastSearchLabelSeeMore"
                                href="">Ver más</a>
                        </div>
                        <div class="w-full h-full flex overflow-x-auto justify-start gap-4 pb-4 min-h-80"
                            id="lastSearchContainer">
                            <div role="status" id="lastSearchStatus" class="w-full  z-10 flex justify-center pt-20">
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
                    </div>
                </section>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var lastSearchLabelAddress = document.getElementById('lastSearchLabelAddress');
                        const url = '/history/{{ $userId }}';
                        const requestOptions = {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        };

                        fetch(url, requestOptions)
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('Error en la solicitud');
                                }
                            })
                            .then(data => {
                                if (data.length > 0) {
                                    lastSearchLabelAddress.textContent = data[0].category.charAt(0)
                                        .toUpperCase() + data[0].category.slice(1) + ' en ' + data[0].address;

                                    var lastSearchLabelSeeMore = document.getElementById('lastSearchLabelSeeMore');
                                    lastSearchLabelSeeMore.href = "/search/" + data[0].category + '/' + data[0].address;
                                    var geocoder = new google.maps.Geocoder();
                                    geocoder.geocode({
                                        'address': data[0].address
                                    }, function(results, status) {
                                        if (status == google.maps.GeocoderStatus.OK && results.length > 0) {
                                            var location = results[0].geometry.location;
                                            var coordinates = {
                                                lat: location.lat(),
                                                lng: location.lng()
                                            };
                                            const searchUrl = '/search/' + data[0]
                                                .category + '/' + coordinates.lng + '/' + coordinates.lat + '/0.1/';

                                            fetch(searchUrl)
                                                .then(response => {
                                                    if (!response.ok) {
                                                        throw new Error('Network response was not ok');
                                                    }
                                                    return response.json();
                                                })
                                                .then(dataSearch => {
                                                    if (dataSearch.length > 0) {
                                                        var lastSearchSection = document.getElementById(
                                                            'lastSearchSection');
                                                        lastSearchSection.classList.remove('hidden');

                                                        var lastSearchStatus = document.getElementById(
                                                            'lastSearchStatus');
                                                        lastSearchStatus.classList.add('hidden');

                                                        dataSearch.forEach(item => {
                                                            fetch('/inmueble/' + item[0].inmueble_id +
                                                                    '/get', {
                                                                        method: 'GET',
                                                                        headers: {
                                                                            'Content-Type': 'application/json'
                                                                        }
                                                                    })
                                                                .then(response => {
                                                                    if (!response.ok) {
                                                                        throw new Error(
                                                                            'Network response was not ok'
                                                                        );
                                                                    }
                                                                    return response.json();
                                                                })
                                                                .then(dataInmueble => {
                                                                    const container = document
                                                                        .createElement('a');
                                                                    container.href = "/anuncio/" +
                                                                        item[0].display_id;
                                                                    container.target = "_blank";
                                                                    container.classList.add('w-64',
                                                                        'min-w-64', 'min-h-64',
                                                                        'h-auto',
                                                                        'hover:bg-gray-100',
                                                                        'rounded-md',
                                                                        'cursor-pointer');

                                                                    const imageContainer = document
                                                                        .createElement('div');
                                                                    imageContainer.classList.add(
                                                                        'max-h-1/2', 'w-full',
                                                                        'rounded-md');

                                                                    const image = document
                                                                        .createElement('img');
                                                                    image.classList.add(
                                                                        'object-cover',
                                                                        'rounded-md',
                                                                        'max-h-32', 'min-h-32',
                                                                        'w-full');
                                                                    image.src =
                                                                        dataInmueble
                                                                        .inmuebleImagesUrls[0];
                                                                    image.alt = '';
                                                                    imageContainer.appendChild(
                                                                        image);

                                                                    const descriptionContainer =
                                                                        document.createElement(
                                                                            'div');
                                                                    descriptionContainer.classList
                                                                        .add('max-h-1/2', 'w-full',
                                                                            'rounded-b-md', 'px-4',
                                                                            'py-2', 'flex',
                                                                            'flex-col',
                                                                            'justify-beetwen');

                                                                    const price = document
                                                                        .createElement('p');
                                                                    price.classList.add('text-xl',
                                                                        'font-semibold',
                                                                        'h-full');
                                                                    price.textContent = item[0]
                                                                        .price + '€/mes';

                                                                    const description = document
                                                                        .createElement('p');
                                                                    description.classList.add(
                                                                        'text-gray-700');
                                                                    description.textContent = item[
                                                                            0].category.charAt(0)
                                                                        .toUpperCase() + item[0]
                                                                        .category.slice(1) +
                                                                        " en " + dataInmueble
                                                                        .inmueble
                                                                        .address;

                                                                    const hr = document
                                                                        .createElement('hr');
                                                                    hr.classList.add('my-1');

                                                                    const title = document
                                                                        .createElement('p');
                                                                    title.textContent = item[0]
                                                                        .title;

                                                                    descriptionContainer
                                                                        .appendChild(price);
                                                                    descriptionContainer
                                                                        .appendChild(description);
                                                                    descriptionContainer
                                                                        .appendChild(hr);
                                                                    descriptionContainer
                                                                        .appendChild(title);

                                                                    container.appendChild(
                                                                        imageContainer);
                                                                    container.appendChild(
                                                                        descriptionContainer);

                                                                    document.getElementById(
                                                                            'lastSearchContainer')
                                                                        .appendChild(container);
                                                                })
                                                                .catch(error => {
                                                                    console.error(
                                                                        'There was a problem with the fetch operation:',
                                                                        error);
                                                                });
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error(
                                                        'There was a problem with the fetch operation:',
                                                        error);
                                                });
                                        } else {
                                            console.error(
                                                'No se encontraron coordenadas para la dirección proporcionada.'
                                            );
                                        }
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    });
                </script>
                @if (count($userSaved) > 0)
                    <section class="w-full lg:pt-16">
                        <div class="container  px-4 md:px-6">
                            <p class="text-2xl lg:text-3xl font-bold w-full mb-2">Tus anuncios guardados</p>
                            <div class="mb-2">
                                <p class="text-xl font-bold w-full text-gray-700"></p>
                            </div>
                            <div class="w-full h-full flex overflow-x-auto justify-start gap-4 pb-4 min-h-80"
                                id="lastSearchContainer">
                                @foreach ($userSaved as $item)
                                    @php
                                        $inmuebleData = Inmueble::getById($item->inmueble_id);
                                        $inmuebleImage = InmuebleImage::where(
                                            'inmueble_id',
                                            $item->inmueble_id,
                                        )->first();
                                    @endphp

                                    <a href="/anuncio/{{ $item->display_id }}" target="_blank"
                                        class="w-64 min-w-64 min-h-64 h-auto hover:bg-gray-100 rounded-md cursor-pointer">
                                        <div class="max-h-1/2 w-full rounded-md"><img
                                                class="object-cover rounded-md max-h-32 min-h-32 w-full"
                                                src="{{ InmuebleImage::getImageFromUrl($inmuebleImage->url_image) }}"
                                                alt="">
                                        </div>
                                        <div class="max-h-1/2 w-full rounded-b-md px-4 py-2 flex flex-col justify-beetwen">
                                            <p class="text-xl font-semibold h-full">{{ $item->price }}€/mes</p>
                                            <p class="text-gray-700">{{ ucfirst($inmuebleData->category) }} en
                                                {{ $inmuebleData->address }}</p>
                                            <hr class="my-1">
                                            <p>{{ $item->title }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                <section class="w-full pt-12 md:pt-24 lg:py-24 bg-gray-100 sm:rounded-xl mt-4">
                    <div class="container space-y-10 xl:space-y-16 px-4 md:px-6 ">
                        <div class="grid gap-4 md:grid-cols-2 md:gap-16">
                            <div>
                                <h1
                                    class="lg:leading-tighter text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl xl:text-[3.4rem] 2xl:text-[3.75rem]">
                                    Empieza hoy mismo:<p class="text-pink-700"> gestiona tus propiedades.</p>

                                </h1>
                                <p class="mx-auto max-w-[700px] text-gray-500 md:text-xl dark:text-gray-400 mt-4">
                                    Administra tus propiedades de manera sencilla y eficiente desde cualquier lugar. Nuestra
                                    plataforma te ofrece todas las herramientas necesarias para llevar un control integral,
                                    desde la publicación de anuncios hasta la gestión de contratos y valoraciones de
                                    inquilinos. Comienza ahora y optimiza el manejo de tus inmuebles con facilidad y
                                    confianza.
                                </p>
                                <div class="my-8 space-x-4 flex">
                                    <a class="px-7 py-4 text-lg font-semibold bg-gray-700 hover:bg-gray-900 rounded-md text-white flex flex-col sm:flex-row text-center gap-2 w-auto items-center"
                                        href="/anuncio/new" rel="ugc" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                            <path
                                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                                        </svg>
                                        Publicar un anuncio
                                    </a>
                                    <a class="px-7 py-4 text-lg font-semibold bg-gray-700 hover:bg-pink-900 rounded-md text-white flex-col sm:flex-row text-center flex gap-2 w-auto items-center"
                                        href="/management/contract/new" rel="ugc" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5" />
                                            <path
                                                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                                        </svg>
                                        Crear un contrato
                                    </a>
                                </div>
                            </div>
                            <div class="grid gap-4 grid-cols-2 ">
                                <img src="https://media.renthub.es/img/system/home-banner-05.jpg" width="550"
                                    height="550" alt="Hero"
                                    class="mx-auto overflow-hidden rounded-xl object-cover mb-6" />
                                <img src="https://media.renthub.es/img/system/home-banner-06.jpg" width="550"
                                    height="550" alt="Hero"
                                    class="mx-auto overflow-hidden rounded-xl object-cover mb-6" />
                                <img src="https://media.renthub.es/img/system/home-banner-07.jpg" width="550"
                                    height="550" alt="Hero"
                                    class="mx-auto overflow-hidden rounded-xl object-cover mb-6" />
                                <img src="https://media.renthub.es/img/system/home-banner-04.jpg" width="550"
                                    height="550" alt="Hero"
                                    class="mx-auto overflow-hidden rounded-xl object-cover mb-6" />
                            </div>

                        </div>
                    </div>
                </section>
            </main>
            <br><br>
        @else
            <main class="flex-1">
                <section class="w-full pt-12 md:pt-24 lg:pt-32">
                    <div class="container space-y-10 xl:space-y-16 px-4 md:px-6">
                        <div class="grid gap-4 md:grid-cols-2 md:gap-16">
                            <div>
                                <h1
                                    class="lg:leading-tighter text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl xl:text-[3.4rem] 2xl:text-[3.75rem]">
                                    Hazlo a tu medida:<p class="text-gray-700"> tu espacio, tu confort, tu felicidad.</p>

                                </h1>
                                <p class="mx-auto max-w-[700px] text-gray-500 md:text-xl dark:text-gray-400 mt-4">
                                    Explora una gama diversa de propiedades para alquilar y personaliza tu experiencia de
                                    hogar
                                    según tus necesidades y estilo de vida. Encuentra tu espacio ideal, disfruta del confort
                                    que
                                    deseas y descubre la felicidad en tu nuevo hogar con RêntHûb.
                                </p>
                                <div class="my-8 space-x-4">
                                    <a class="px-5 py-3 bg-gray-100 hover:bg-gray-200 rounded-md" href="/login"
                                        rel="ugc">
                                        Inicia sesión
                                    </a>
                                    <a class="px-5 py-3 bg-gray-700 hover:bg-pink-700 rounded-md text-white "
                                        href="/signup" rel="ugc">
                                        Crear una cuenta
                                    </a>
                                </div>
                            </div>
                            <img src="https://media.renthub.es/img/system/home-banner-04.jpg" width="550"
                                height="550" alt="Hero"
                                class="mx-auto overflow-hidden rounded-xl object-cover mb-6" />
                        </div>
                    </div>
                </section>
                <section class="w-full py-12 md:py-24 lg:py-24 bg-gray-100 rounded-lg lg:px-24">
                    <div class="container px-4 md:px-6">
                        <p class="text-3xl font-bold tracking-tighter sm:text-5xl w-full text-center mb-8">¿Qué ofrecemos?
                        </p>
                        <br>
                        <br>
                        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            <div class=" gap-4 flex flex-col items-center sm:items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 bg-pink-700 rounded-full p-4"
                                    width="16" height="16" fill="white" class="bi bi-house-check"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z" />
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514" />
                                </svg>
                                <h3 class="text-xl font-bold">Encuentra inmuebles</h3>
                                <p class="text-gray-700 ">
                                    Descubre tu próximo inmueble en segundos. Con nuestra función de búsqueda, encuentra el
                                    lugar
                                    perfecto que se adapte a tu estilo de vida y presupuesto. Filtra por ubicación, tipo de
                                    propiedad, precio y más para una experiencia de búsqueda fácil y efectiva.
                                </p>
                            </div>
                            <div class="gap-4 flex flex-col items-center sm:items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 bg-pink-700 rounded-full p-4"
                                    width="16" height="16" fill="white" class="bi bi-file-earmark-plus"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                                </svg>
                                <h3 class="text-xl font-bold">Gestiona tus contratos</h3>
                                <p class="text-gray-700 ">
                                    Gestiona tus contratos de alquiler de manera eficiente y sin complicaciones. Desde la
                                    creación hasta la firma digital, nuestro sistema te permite administrar tus contratos de
                                    forma rápida y segura. Mantén un registro detallado de tus acuerdos, realiza
                                    modificaciones
                                    fácilmente y mantén una comunicación fluida con tus inquilinos, todo en un solo lugar.
                                </p>
                            </div>
                            <div class="flex flex-col items-center sm:items-start gap-4">
                                <svg class="h-16 w-16 bg-pink-700 rounded-full p-4" xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="white" class="bi bi-star"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                </svg>
                                <h3 class="text-xl font-bold">Valora a los usuarios</h3>
                                <p class="text-gray-700 ">
                                    Valora tu experiencia y construye una comunidad basada en la confianza. Con nuestra
                                    función
                                    de valoración de usuarios, puedes compartir tus opiniones y comentarios sobre tus
                                    interacciones con otros usuarios. Ayuda a futuros arrendadores y arrendatarios tomando
                                    decisiones informadas, y contribuye a un ambiente de colaboración y transparencia en
                                    nuestra
                                    plataforma.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="w-full py-12 md:py-24 lg:py-32 lg:px-24">
                    <div class="container px-4 md:px-6">
                        <p class="text-3xl font-bold tracking-tighter sm:text-5xl w-full text-center mb-8">Nuestros planes
                        </p>
                        <br>
                        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="grid gap-4 ">
                                <div
                                    class="bg-white p-6 rounded-lg shadow-lg lg:col-start-2 hover:border-gray-600 border flex flex-col">
                                    <h2 class="text-xl font-semibold mb-4 align-middle">Particular Básico <span
                                            class="inline-block px-3 py-1 text-sm font-semibold leading-tight text-white bg-pink-700 rounded-full ">Grátis</span>
                                    </h2>
                                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <h3 class="text-4xl font-semibold m-6 text-center">
                                        0€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="grid gap-4">
                                <div
                                    class="bg-white p-6 rounded-lg shadow-lg hover:border-gray-600 border lg:col-start-3 flex flex-col">
                                    <h2 class="text-xl font-semibold mb-4">Particular Premium</h2>
                                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <h3 class="text-4xl font-semibold m-6 text-center">
                                        9,90€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="grid gap-4">
                                <div
                                    class="bg-white p-6 rounded-lg border-pink-700 shadow-lg hover:border-blue-400 border lg:col-start-4 col-span-1 flex flex-col">
                                    <h2 class="text-xl font-semibold mb-4">Empresas</h2>
                                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <h3 class="text-4xl font-semibold m-6 text-center">
                                        29,90€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="w-full flex justify-center">
                            <a class="px-5 py-3 bg-gray-700 hover:bg-pink-700 rounded-md text-white text-xl font-bold"
                                href="/signup" rel="ugc">
                                ¡Comenzar ahora!
                            </a>
                        </div>

                    </div>
                </section>

            </main>
        @endif

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var header = document.getElementById('navSearch');
            //header.classList.toggle('hidden');
            let currentIndex = 0;
            const items = document.querySelectorAll('.carousel-item');

            setInterval(() => {
                items[currentIndex].classList.add('opacity-0');
                items[currentIndex].classList.add('pointer-events-none');
                items[currentIndex].classList.remove('opacity-100');
                items[currentIndex].classList.remove('pointer-events-auto');

                currentIndex = (currentIndex + 1) % items.length;

                items[currentIndex].classList.remove('hidden');
                items[currentIndex].classList.add('opacity-100');
                items[currentIndex].classList.add('pointer-events-auto');
            }, 2000); // Cambia de imagen cada 2 segundos



            // Obtener el elemento
            const elemento = document.getElementById('elemento');

            // Función para verificar si el elemento está visible en la pantalla
            function isElementVisible(el) {
                const rect = el.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
                );
            }

            // Función para manejar el scroll y fadeout
            // Función para manejar el scroll y fadeout
            function handleScroll() {
                const isVisible = isElementVisible(elemento);
                let lastScrollY = 0;
                const isScrollingDown = window.scrollY > lastScrollY;

                if (isVisible && isScrollingDown) {
                    // Aplicar fadeout si el elemento es visible y el usuario hace scroll hacia abajo
                    elemento.classList.remove('hide');
                    header.classList.add('hidden');
                } else if (!isVisible) {
                    // Quitar la clase hidden si el elemento no es visible
                    elemento.classList.add('hide');
                    header.classList.remove('hidden');
                }

                lastScrollY = window.scrollY;
            }


            // Manejar el evento de scroll
            window.addEventListener('scroll', handleScroll);

        });
    </script>
    <script>
        let searchButtonInner = document.getElementById('searchButtonInner')
        searchButtonInner.addEventListener('click', function() {
            var conceptName = $('#categoryInner').find(":selected").val();
            var locationInputInner = $('#locationInputInner').val();

            window.open('/search/' + conceptName + '/' + locationInputInner, '_self');
        });
    </script>
    @php
        $userId = null;
        if (Auth::user() != null) {
            $userId = Auth::user()->id;
        }
    @endphp
    <script>
        var searchInputInner = document.getElementById('locationInputInner');
        var searchResultsInner = document.getElementById('searchResultsInner');
        searchInputInner.addEventListener('input', function() {
            if ({{ $userId }} != null) {
                const url = '/history/{{ $userId }}';
                const requestOptions = {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                };
                fetch(url, requestOptions)
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Error en la solicitud');
                        }
                    })
                    .then(data => {
                        searchInputInner.innerHTML = '';
                        data.forEach(item => {
                            var div = document.createElement('div');
                            div.textContent = item.address;
                            div.classList.add('w-full', 'lg:w-96', 'sm:w-64', 'px-2', 'py-1',
                                'hover:cursor-pointer', 'hover:bg-gray-100');
                            div.addEventListener('click', function() {
                                searchInputInner.value = item.address;
                                searchInputInner.innerHTML = '';
                                searchInputInner.classList.toggle('hidden');
                            });
                            searchInputInner.appendChild(div);
                        });
                        searchInputInner.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

        });
    </script>
    <script>
        var searchInputInner = document.getElementById('locationInputInner');
        var searchResultsInner = document.getElementById('searchResultsInner');

        searchInputInner.setAttribute('autocomplete', 'off');

        var autocomplete = new google.maps.places.Autocomplete(null, {
            types: ['address']
        });

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            searchInputInner.value = place.formatted_address;
        });

        searchInputInner.addEventListener('input', function() {
            var query = searchInputInner.value;
            if (query.length === 0) {
                searchResultsInner.innerHTML = '';
                searchResultsInner.classList.add('hidden');
                return;
            }
            var service = new google.maps.places.AutocompleteService();
            service.getPlacePredictions({
                input: query
            }, function(predictions, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    searchResultsInner.innerHTML = '';
                    searchResultsInner.classList.remove('hidden');
                    predictions.forEach(function(prediction) {
                        var div = document.createElement('div');
                        div.textContent = prediction.description;
                        div.classList.add('w-full', 'lg:w-96', 'sm:w-64', 'px-2', 'py-1',
                            'hover:cursor-pointer', 'hover:bg-gray-100', 'bg-white');
                        div.addEventListener('click', function() {
                            prediction
                            searchInputInner.value = prediction.description;
                            searchResultsInner.innerHTML = '';
                            searchResultsInner.classList.add('hidden');
                        });
                        searchResultsInner.appendChild(div);
                    });
                } else {
                    alert("Ups! Something went wrong... \n" + status);
                }
            });
        });
    </script>

    </div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
