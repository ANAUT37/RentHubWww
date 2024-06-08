@extends('Layouts.main')
@section('title', 'RêntHûb.es | New')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('content')
    <style>
        .step {
            background-color: rgb(59 130 246);
            color: white;
        }
    </style>
    <div class="container mx-auto py-12 px-4 max-w-2xl" id="particularForm">
        <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Editar anuncio</h1>
        <form id="formulario" action="/anuncio/new/save" method="POST" enctype="multipart/form-data">
            @csrf
            <div class=" w-full rounded-md h-28 flex justify-start items-center p-2 border border-gray-100 gap-2 ">
                <img src="https://images.livspace-cdn.com/plain/https://jumanji.livspace-cdn.com/magazine/wp-content/uploads/sites/3/2021/10/18115838/modern-house-design.jpg"
                 alt="" class="w-28 h-24 border-gray-100 border rounded-md object-fit">
                 <div class="flex flex-col items-start justify-between">
                    <p class="font-bold text-xl">{{$anuncioData->title}}</p>
                    <p class="text-lg">Creado el {{$anuncioData->created_at}}</p>
                 </div>
            </div>
            <br>
            <div class="mb-6 ">
                <label for="" class="block text-gray-700 mb-2"><b>Categoría:</b> (No es posble cambiar la categoría de un anuncio una vez creado)</label>
                <p id="categoria" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">{{ucfirst($anuncioData->category)}}</p>
            </div>
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-bold mb-2">Título:</label>
                <input type="text" id="title" name="title"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600" value="{{$anuncioData->title}}"
                    placeholder="Título" required>
            </div>
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-bold mb-2">Descripción: (Opcional)</label>
                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                    name="description" id="description" rows="10" placeholder="Descripción">@if($anuncioData->description!==null){{$anuncioData->description}}@endif</textarea>
            </div>
            <div class="mb-6">
                <label for="price" class="block text-gray-700 font-bold mb-2">Precio de alquiler:</label>
                <div class="w-full flex border border-gray-300 rounded-md focus:border-gray-600">
                    <input type="text" id="price" name="price" value="{{$anuncioData->price}}"
                        class="w-full px-4 py-2 outline-none border-none rounded-md focus:outline-none" placeholder="Precio"
                        required>
                    <p class="w-auto px-4 py-2 rounded-md focus:outline-none  focus:border-gray-600">€/mes</p>
                </div>
            </div>
            <div class="mb-6">
                <label for="dropzone" class="block text-gray-700 font-bold mb-2">Imágenes: (Mínimo una)</label>
                <div class="w-full relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone">
                    <div class="text-center">
                        <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg"
                            alt="">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            <label for="file-upload" class="relative cursor-pointer">
                                <span>Arrastra y suelta</span>
                                <span class="text-gray-600"> o busca</span>
                                <span>en tus archivos</span>
                            </label>
                            <input type="file" class="absolute inset-0 w-full h-full opacity-0 z-50" id="file-upload" />
                        </h3>
                        <p class="mt-1 text-xs text-gray-500">
                            PNG, JPG, GIF hasta 2MB
                        </p>
                    </div>
                </div>
                <p class="text-sm mb-2 text-gray-600 mt-1">Las <b>Etiquetas</b> que agregues a tus fotos servirán para que
                    el resto de usuarios sepan a que parte del inmueble hace referencia dicha foto. Haz click en el símbolo
                    ➕ para añadir una etiqueta
                </p>
                <div class="mt-4 mx-auto max-h-52 py-3 overflow-x-auto flex" id="preview" style="white-space: nowrap;">
                </div>
            </div>

            <div class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center z-30 hidden"
                id="imagePreview">
                <div id="imagePreviewBackdrop" class="fixed hidden top-0 left-0 w-screen h-screen bg-gray-200 opacity-50">
                </div>
                <div id="imagePreviewContent"
                    class="absolute bg-white p-4 rounded-lg shadow-lg w-3/4 h-3/4 items-center flex justify-center">
                </div>
            </div>
            <br>
            <div class="mb-6">
                <label for="birthdate" class="block text-gray-700 font-bold mb-2">Dirección</label>
                <p class="text-sm mb-2 text-gray-600 mt-1">No es necesario que introduzcas la dirección exacta del inmueble,
                    simplemente una aproximada.
                </p>
                <div class="flex relative mb-2 lg:mb-0">
                    <input id="locationInputInner" type="text" placeholder="Ciudad, barrio, calle..." name="address" value="{{$inmuebleData->address}}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    <div id="searchResultsInner"
                        class="absolute top-full left-0 w-full bg-transparent border border-gray-300 rounded-l-md z-50 rounded-br-md hidden">
                    </div>
                </div>
                <br>
                <div class="mb-6">
                    <label for="caracteristicas" class="block text-gray-700 font-bold mb-2">Características del
                        inmueble</label>
                    <div class="flex flex-col lg:flex-row mb-4 lg:mb-0 sm:mb-4 items-center">
                        <select name="categoryAttribute" id="caracteristicaKey" disabled
                            class="w-full lg:w-40 sm:w-100 px-2  bg-transparent border-gray-300 rounded-l-md h-full">
                            <option value="none" disabled selected hidden required>Opción</option>
                        </select>
                        <div class="flex relative mb-2 lg:mb-0 h-full">
                            <input type="text" placeholder="Valor" id="caracteristicaValue" disabled
                                class="w-full lg:w-96 sm:w-64 px-3 py-2 border bg-transparent border-gray-300 ">
                        </div>
                        <a id="addCaracteristica" disabled
                            class="bg-transparent border  border-gray-300 text-black px-3 py-2 rounded-r-md  hover:bg-gray-600 hover:text-white hover:border-gray-600">Agregar</a>
                    </div>
                    <div class="mt-6 flex flex-col gap-2" id="caracteristicasDisplay">

                    </div>
                </div>

                <div class="mb-6 flex justify-end">
                    <input id="step3" type="submit" value="Guardar"
                        class="next bg-gray-100 border cursor-pointer border-gray-300 text-black px-6 w-auto py-2 rounded-md hover:bg-blue-400 hover:text-white focus:outline-none "></input>
                </div>
                <input type="text" name="latitude" id="latitude" hidden value="">
                <input type="text" name="longitude" id="longitude" hidden value="">
            </div>
        </form>
        <script>
            function execGeocoding() {
                const address = document.getElementById('locationInputInner').value;
                geocodeAddress(address);
            }

            function geocodeAddress(address) {
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (status === 'OK') {
                        const location = results[0].geometry.location;
                        const lat = location.lat();
                        const lng = location.lng();
                        displayResult(lat, lng);
                    } else {
                        displayResult(null, null, 'La dirección no se pudo convertir.');
                    }
                });
            }

            function displayResult(lat, lng, error = null) {
                var latDisplay = document.getElementById('latitude');
                latDisplay.value = lat;
                var lngDisplay = document.getElementById('longitude');
                lngDisplay.value = lng;
            }
        </script>
    </div>
    <script src="https://media.renthub.es/js/categoryAttributeHandler.js"></script>
    <script src="https://media.renthub.es/js/categoryAttributesDisplayManager.js"></script>
    <script src="https://media.renthub.es/js/locationFillerInner.js"></script>
    <script src="https://media.renthub.es/js/imageDrop.js"></script>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
