@extends('Layouts.main')
@section('title', 'RêntHûb.es | Inmueble')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    @php
        use App\Models\User;
        use App\Models\InmuebleImage;
    @endphp
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center ">
        <h1 class="text-2xl font-bold">Inmueble #{{ $inmuebleData->display_id }}</h1>
        <p class="text-lg">Propietario del inmueble: <a class="hover:underline" href="/user/{{ $owner->display_id }}"
                target="_blank">{{ App\Models\Particular::getParticularName($owner->id) }}</a></p>
        <br>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4 mb-4">
            <div class="bg-gray-100 rounded-md p-4 ">
                <p class="text-sm lg:text-md text-gray-700">Dirección</p>
                <p class="text-lg">{{ $inmuebleData->address }}</p>
            </div>
            <div class="bg-gray-100 rounded-md p-4 ">
                <p class="text-sm lg:text-md text-gray-700">Categoría</p>
                <p class="text-lg">{{ ucfirst($inmuebleData->category) }}</p>
            </div>
            <div class="bg-gray-100 rounded-md p-4 ">
                <p class="text-sm lg:text-md text-gray-700">Fecha de publicación</p>
                <p class="text-lg">{{ ucfirst($inmuebleData->created_at) }}</p>
            </div>
        </div>
        <h1 class="text-2xl font-bold">Características</h1>
        @if (count($inmuebleAttributes) > 0)
            <div class="grid lg:grid-cols-8 grid-cols-4 md:grid-cols-6 mt-4 mb-8 gap-4 ">
                @foreach ($inmuebleAttributes as $item)
                    <div class="flex flex-col items-center w-auto">
                        @if ($item['icon'] != null)
                            {!! $item['icon'] !!}
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
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
        <h1 class="text-2xl font-bold">Fotos del inmueble</h1>
        <div class="flex items-center flex-col h-full w-full">
            <div class="mb-4 w-full h-2/6 md:h-4/6 flex flex-col justify-center items-center ">
                <img id="largeImage" class="min-w-full min-h-full h-full object-cover rounded-lg "
                    src="{{ InmuebleImage::getImageFromUrl($listOfImages[0]->url_image) }}" alt="">
                <div class="flex justify-center w-full py-1 gap-1 items-center">
                    <button id="prevImage"
                        class="h-10 w-10 bg-gray-100 hover:bg-gray-200 p-2 rounded-full focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <span id="countImage"></span>
                    <button id="nextImage"
                        class="h-10 w-10 bg-gray-100 hover:bg-gray-200 p-2 rounded-full focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <br>
            <div class="overflow-x-auto w-full">
                <div id="galleryDisplay" class="flex space-x-4">
                    @foreach ($listOfImages as $item)
                        <div class="thumbnail relative flex-shrink-0 w-32 h-24 cursor-pointer">
                            <img class="w-full h-full object-cover rounded-lg"
                                src="{{ InmuebleImage::getImageFromUrl($item->url_image) }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <br><br>
        </div>
    </div>
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
    @endsection
    @section('footer')
        @include('Footers.small_footer')
    @endsection
