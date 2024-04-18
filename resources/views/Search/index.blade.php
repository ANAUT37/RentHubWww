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
    </style>
    <div class="sticky container mx-auto py-4 px-4 " style="backdrop-filter: blur(8px);">
        <div class="container w-2/3 mx-auto  border-b-gray-200 border-b pb-4">
            <h1 class="text-xl mb-2">Resultados de <b>{{ ucfirst($category) }}</b> en <b>{{ ucfirst($location) }}</b></h1>
            <div class="flex lg:justify-between lg:flex-row flex-col align-middle">
                <div class="flex gap-1">
                    <button
                        class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                    py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none "><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                        Filtros(0)</button>
                    <select name="order" id="orderInput"
                        class="px-4 py-2 bg-transparent w-40 hover:text-white hover:bg-gray-600 rounded-md outline-none focus:border-gray-600 hover:cursor-pointer">
                        <option value="none" selected>Relevancia</option>
                        <option value="pisos">Más visitados</option>
                        <option value="locales">Precio menor</option>
                        <option value="compartir">Precio mayor</option>
                    </select>
                </div>
                <div class="flex gap-1">
                    <button
                        class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                        py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        Guardar</button>
                    <button id="showMap"
                        class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                     py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none "><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                        </svg>
                        Mapa</button>
                </div>
            </div>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async
            defer></script>
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
                getCoordinatesFromOption("{{ $location }}", function(coordinates) {
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

                        // Define el ícono personalizado
                        var icon = {
                            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(
                                '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="40" viewBox="0 0 24 30"><path fill="#2C3E50" d="M12 2C7.31 2 3.74 5.43 3.2 9.998l.001.002c.008.092.019.184.033.276l.008.059C3.4 15.584 12 22 12 22s8.6-6.416 8.748-11.666l.008-.059c.014-.092.025-.184.033-.276l.001-.002C20.26 5.43 16.69 2 12 2zm0 8a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 2.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/></svg>'
                            ),
                            scaledSize: new google.maps.Size(38, 46), // Tamaño del ícono ajustado
                            origin: new google.maps.Point(0, 0), // Punto de origen
                            anchor: new google.maps.Point(12, 30) // Punto de anclaje
                        };

                        // Crea el marcador con el ícono personalizado
                        var marker = new google.maps.Marker({
                            position: coordinates, // Coordenadas del marcador
                            map: map, // Mapa al que se va a añadir el marcador
                            title: 'Ubicación', // Título del marcador (opcional)
                            icon: icon // Ícono personalizado
                        });

                        document.getElementById('zoomInInner').addEventListener('click', function() {
                            if (map) {
                                var currentZoom = map.getZoom();
                                map.setZoom(currentZoom + 1);
                            }
                        });

                        // Disminuir el zoom al hacer clic en el botón zoomOutInner
                        document.getElementById('zoomOutInner').addEventListener('click', function() {
                            if (map) {
                                var currentZoom = map.getZoom();
                                map.setZoom(currentZoom - 1);
                            }
                        });

                        // Define el contenido del texto que se mostrará al pasar el ratón sobre el marcador
                        var infoWindowContent = '¡Texto de información!';

                        // Crea un objeto InfoWindow con el contenido
                        var infoWindow = new google.maps.InfoWindow({
                            content: infoWindowContent
                        });

                        // Añade un evento para mostrar el InfoWindow al pasar el ratón sobre el marcador
                        marker.addListener('mouseover', function() {
                            infoWindow.open(map, marker);
                        });

                        // Añade un evento para cerrar el InfoWindow al quitar el ratón del marcador
                        marker.addListener('mouseout', function() {
                            infoWindow.close();
                        });



                        var statusMap = document.getElementById('statusMap');
                        statusMap.classList.toggle('hidden');
                    } else {
                        console.log('No se pudieron obtener las coordenadas.');
                    }
                });
            });
        </script>
    @endsection
    @section('map')
        <div class="w-full h-screen pt-2 hidden fixed inset-0 overflow-hidden bottom-50"
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var showMapButton = document.getElementById('showMap');
                var showMapInnerButton = document.getElementById('showMapInner');
                var displayMapDiv = document.getElementById('mapDisplay');

                function toggleMapDisplay() {
                    displayMapDiv.classList.toggle('hidden');
                    if (!displayMapDiv.classList.contains('hidden')) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = 'auto';
                    }
                }

                showMapButton.addEventListener('click', toggleMapDisplay);
                showMapInnerButton.addEventListener('click', toggleMapDisplay);
            });
        </script>
    @endsection
    @section('content')
        <div class="container flex-col gap-4 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center mb-4 z-10">
            @include('Anuncio.in_list')
            @include('Anuncio.in_list')
            <div role="status" class="text-center flex justify-center mt-3">
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
    </div>
    <script>
        const carousels = document.querySelectorAll('.carousel');
        carousels.forEach(carousel => {
            const $prevButton = carousel.querySelector('.carousel-prev');
            const $nextButton = carousel.querySelector('.carousel-next');
            const $carouselItems = carousel.querySelectorAll('.carousel-item');
            const $indicators = carousel.querySelectorAll('.carousel-indicator');
            let currentIndex = 0;

            function showElement(index) {
                $carouselItems.forEach(item => {
                    item.classList.add('hidden');
                });
                $carouselItems[index].classList.remove('hidden');
            }

            function showPrevElement() {
                currentIndex = (currentIndex - 1 + $carouselItems.length) % $carouselItems.length;
                showElement(currentIndex);
            }

            function showNextElement() {
                currentIndex = (currentIndex + 1) % $carouselItems.length;
                showElement(currentIndex);
            }
            $prevButton.addEventListener('click', showPrevElement);
            $nextButton.addEventListener('click', showNextElement);

            showElement(currentIndex);
        });
    </script>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
