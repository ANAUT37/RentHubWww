@extends('Layouts.main')
@section('title', 'RêntHûb.es | New')
@section('header')
    @include('Headers.header_manager_home')
@endsection
@section('content')
    <style>
        .step {
            background-color: rgb(190, 24, 93);
            color: white;
        }
    </style>
    <div class="container mx-auto py-12 px-4 max-w-2xl" id="particularForm">
        <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Crear anuncio</h1>
        <div class="flex items-center justify-center">
            <div class="flex justify-center w-full max-w-lg sm:flex-row flex-col gap-3 ">
                <div class="flex items-center">
                    <div id="markstep1" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center step">1</div>
                    <div class="ml-2">Anuncio</div>
                </div>
                <div class="flex items-center">
                    <div id="markstep2" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">2</div>
                    <div class="ml-2">Inmueble</div>
                </div>
            </div>
        </div>
        <form id="formulario" action="/anuncio/new/save" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="formstep1">
                <p class="text-gray-600 mb-4 text-center pt-10">Para comenzar a publicar tu anuncio, por favor completa el
                    siguiente formulario con la información relevante sobre la propiedad que deseas anunciar. Te guiaremos
                    paso a paso para asegurarnos de que tu anuncio sea completo y atractivo para posibles interesados.</p>
                <br>
                <div class="mb-6 ">
                    <label for="categoria" class="block text-gray-700 font-bold mb-2">Categoría:</label>
                    <select name="categoria" id="categoria"
                        class="w-full px-4 py-2 bg-white rounded-md focus:outline-none  cursor-pointer hover:bg-gray-200"
                        required>
                        <option value="none" disabled selected hidden>Categoría</option>
                        <option value="locales">Local</option>
                        <option value="compartir">Compartir</option>
                        <option value="casas">Casa</option>
                        <option value="garajes">Garaje</option>
                        <option value="oficinas">Oficina</option>
                        <option value="trasteros">Trastero</option>
                        <option value="terrenos">Terreno</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Título:</label>
                    <input type="text" id="title" name="title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Título" required>
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descripción: (Opcional)</label>
                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        name="description" id="description" rows="10" placeholder="Descripción"></textarea>
                </div>
                <div class="mb-6">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Precio de alquiler:</label>
                    <div class="w-full flex border border-gray-300 rounded-md focus:border-gray-600">
                        <input type="text" id="price" name="price"
                            class="w-full px-4 py-2 outline-none border-none rounded-md focus:outline-none"
                            placeholder="Precio" required>
                        <p class="w-auto px-4 py-2 rounded-md focus:outline-none  focus:border-gray-600">€/mes</p>
                    </div>
                </div>
                <div class="mb-6 flex justify-between">
                    <a href="/signup"
                        class="text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Cancelar</a>
                    <button id="step2"
                        class="bg-gray-100 rounded-md px-4 py-2 hover:bg-gray-200 next">Continuar</button>
                </div>
            </div>
            <div id="formstep2" class="">
                <p class="text-gray-600 mb-4 text-center pt-10">
                    Ahora es necesario que proporciones información relacionada contigo para verificar tu identidad. Algunos
                    de los campos serán visibles para otros usuarios, pero nunca se mostrará tu información sensible a
                    personas no autorizadas. Para obtener más detalles, consulta nuestros <b><a href="/help/privacy"
                            class="text-gray-600 hover:underline"> Términos de
                            privacidad</a></b></p>
                <br>
            </div>
            <div class="mb-6">
                <div id="imageSelectorDisplay"
                    class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center z-30 hidden">
                    <div id="imageSelectorBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden">
                    </div>
                    <div class="w-full h-full pt-20">
                        <div id="documentSelectorDisplay"
                            class="bg-white w-full h-full mx-auto  rounded-md flex justify-center"
                            style="backdrop-filter: blur(10px);">
                            <div class="lg:w-4/5 w-full h-full  flex justify-center">
                                <div class="w-full lg:w-3/5 p-4 flex items-center flex-col">
                                    <div class="w-full flex justify-between items-center">
                                        <p class="block text-start text-xl font-bold mb-2">Selector de imágenes</p>
                                        <div id="imageSelectorButtonClose" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-10">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="overflow-y-auto flex items-center flex-col h-full">
                                        <label for="dropzone" class="block text-gray-700 font-bold mb-2">Imágenes: (Mínimo
                                            una)</label>
                                        <div class="lg:w-4/5 w-full relative border-2 border-gray-300 border-dashed rounded-lg p-6"
                                            id="dropzone">
                                            <div class="text-center">
                                                <img class="mx-auto h-12 w-12"
                                                    src="https://www.svgrepo.com/show/357902/image-upload.svg"
                                                    alt="">
                                                <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                    <label for="file-upload" class="relative cursor-pointer">
                                                        <span>Arrastra y suelta</span>
                                                        <span class="text-gray-600"> o busca</span>
                                                        <span>en tus archivos</span>
                                                    </label>
                                                    <input type="file"
                                                        class="absolute inset-0 w-full h-full opacity-0 z-50"
                                                        id="file-upload" />
                                                </h3>
                                                <p class="mt-1 text-xs text-gray-500">
                                                    PNG, JPG, GIF hasta 2MB
                                                </p>
                                            </div>
                                        </div>
                                        <p class="text-sm mb-2 text-gray-600 mt-1 w-full lg:w-4/5">Las <b>Etiquetas</b> que
                                            agregues a tus fotos servirán para que
                                            el resto de usuarios sepan a que parte del inmueble hace referencia dicha foto.
                                        </p>
                                        <div class="mt-4 w-full h-auto py-3  grid grid-cols-1 lg:grid-cols-2 gap-2"
                                            id="preview" style="white-space: nowrap;">
                                        </div>
                                    </div>
                                    <div class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center z-30 hidden"
                                        id="imagePreview">
                                        <div id="imagePreviewBackdrop"
                                            class="fixed hidden top-0 left-0 w-screen h-screen bg-gray-200 opacity-50">
                                        </div>
                                        <div id="imagePreviewContent"
                                            class="absolute bg-white p-4 rounded-lg shadow-lg w-3/4 h-3/4 items-center flex justify-center ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="dropzone" class="block text-gray-700 font-bold mb-2">Imágenes: (Mínimo una)</label>
                <div class="flex justify-center p-4">
                    <div id="imageSelectorButtonOpen"
                        class="px-4 py-2 bg-gray-100 rounded-md hover:bg-gray-200 cursor-pointer ">
                        Pulse para abrir el selector de imágenes</div>
                </div>
            </div>
            <br>
            <div class="mb-6">
                <label for="birthdate" class="block text-gray-700 font-bold mb-2">Dirección</label>
                <p class="text-sm mb-2 text-gray-600 mt-1">No es necesario que introduzcas la dirección exacta del
                    inmueble,
                    simplemente una aproximada.
                </p>
                <div class="flex relative mb-2 lg:mb-0">
                    <input id="locationInputInner" type="text" placeholder="Ciudad, barrio, calle..." name="address"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    <div id="searchResultsInner"
                        class="absolute top-full left-0 w-full bg-transparent border border-gray-300 rounded-l-md z-50 rounded-br-md hidden">
                    </div>
                </div>
                <br>
                <div class="mb-6">
                    <label for="caracteristicas" class="block text-gray-700 font-bold mb-2">Características del
                        inmueble</label>
                    <div class="flex lg:flex-row mb-4 lg:mb-0 sm:mb-4 items-center">
                        <select name="categoryAttribute" id="caracteristicaKey"
                            class="w-40 px-2  bg-transparent border-gray-300 rounded-l-md h-full">
                            <option value="none" selected hidden required>Opción</option>
                        </select>
                        <div class="flex relative mb-0 h-full">
                            <input type="text" placeholder="Valor" id="caracteristicaValue"
                                class="w-full lg:w-96 sm:w-64 px-3 py-2 border bg-transparent border-gray-300 ">
                        </div>
                        <div id="addCaracteristica"
                            class="bg-transparent border  border-gray-300 text-black px-3 py-2 rounded-r-md  hover:bg-gray-200  hover:border-gray-600 cursor-pointer">
                            Agregar</div>
                    </div>
                    <div class="mt-6 flex flex-col gap-2" id="caracteristicasDisplay">

                    </div>
                </div>
                <div class="mb-6 flex justify-between">
                    <button id="backstep2"
                        class="prev text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Volver</button>
                    <input id="step3" type="submit" value="Publicar"
                        class="next bg-pink-700 cursor-pointer rounded-md px-4 py-2 hover:bg-gray-200"></input>
                </div>
                <input type="text" name="latitude" id="latitude" hidden value="">
                <input type="text" name="longitude" id="longitude" hidden value="">
            </div>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const categoriaSelect = document.getElementById('categoria');
                const caracteristicaKeySelect = document.getElementById('caracteristicaKey');


                categoriaSelect.addEventListener('change', function() {
                    const categoria = this.value;
                    const url = '/anuncio/new/categories?categoria=' + categoria
                    console.log(url)
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            caracteristicaKeySelect.innerHTML = '';
                            console.log(data)
                            data.forEach(option => {
                                const optionElement = document.createElement('option');
                                optionElement.value = option.key;
                                optionElement.textContent = option.display_name;
                                caracteristicaKeySelect.appendChild(optionElement);
                                var addCaracteristica = document.getElementById(
                                    'addCaracteristica');
                                var valueInput = document.getElementById('caracteristicaValue');
                                caracteristicaKeySelect.removeAttribute('disabled');
                                valueInput.removeAttribute('disabled');
                                addCaracteristica.removeAttribute('disabled');


                            });
                        })
                        .catch(error => {
                            console.error('Hubo un error al obtener las opciones:', error);
                        });
                });
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
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

    <script>
        var imageSelectorDisplay = document.getElementById('imageSelectorDisplay');
        var imageSelectorBackdrop = document.getElementById('imageSelectorBackdrop');
        var imageSelectorButtonOpen = document.getElementById('imageSelectorButtonOpen');
        var imageSelectorButtonClose = document.getElementById('imageSelectorButtonClose');

        imageSelectorButtonOpen.addEventListener('click', function() {
            imageSelectorDisplay.classList.toggle('hidden');
            imageSelectorBackdrop.classList.toggle('hidden');
        });

        imageSelectorButtonClose.addEventListener('click', function() {
            imageSelectorDisplay.classList.toggle('hidden');
            imageSelectorBackdrop.classList.toggle('hidden');
        });
    </script>
    <script>
        var dropzone = document.getElementById('dropzone');
        var imagePreview = document.getElementById('imagePreview');
        var imagePreviewContent = document.getElementById('imagePreviewContent');

        dropzone.addEventListener('dragover', e => {
            e.preventDefault();
            dropzone.classList.add('border-indigo-600');
        });

        dropzone.addEventListener('dragleave', e => {
            e.preventDefault();
            dropzone.classList.remove('border-indigo-600');
        });

        dropzone.addEventListener('drop', e => {
            e.preventDefault();
            dropzone.classList.remove('border-indigo-600');
            var files = e.dataTransfer.files;
            displayPreview(files);
        });

        var input = document.getElementById('file-upload');

        input.addEventListener('change', e => {
            var files = e.target.files;
            displayPreview(files);
        });

        function displayPreview(files) {
            var preview = document.getElementById('preview');
            var number = preview.children.length;

            //var number = 0; // Variable para el nombre del input de archivo

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => {
                    var container = document.createElement('div');
                    container.classList.add('rounded-md', 'border', 'border-gray-200', 'flex', 'flex-col', 'max-h-auto',
                        'relative', 'overflow-hidden');

                    var image = document.createElement('img');
                    image.src = reader.result;
                    image.classList.add('object-cover', 'rounded-t-md', 'max-h-60', 'h-60', 'w-full');
                    image.addEventListener('click', function() {
                        showImageInPreview(reader.result);
                    });
                    container.appendChild(image);

                    // Create delete button and place it fixed to the top-left of the container
                    var deleteBtn = document.createElement('button');
                    deleteBtn.classList.add('absolute', 'top-0', 'left-0');
                    deleteBtn.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" fill="#ff0000" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff0000" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>';
                    deleteBtn.addEventListener('click', () => {
                        preview.removeChild(container);
                    });
                    container.appendChild(deleteBtn); // Append the button to the container

                    // Create file input and input text for tagging
                    var inputFile = document.createElement('input');
                    inputFile.setAttribute('type', 'file');
                    inputFile.setAttribute('name', 'img-' + number); // Set the name of the file input
                    //inputFile.setAttribute('style', 'display:none;'); // Hide the input
                    container.appendChild(inputFile); // Append the hidden input to the container

                    var inputText = document.createElement('input');
                    inputText.setAttribute('type', 'text');
                    inputText.setAttribute('name', 'img-etiqueta-' + number);
                    inputText.setAttribute('placeholder', 'Etiqueta');
                    inputText.classList.add('w-full', 'rounded-b-md');
                    container.appendChild(inputText); // Append the text input to the container

                    number++;
                    preview.prepend(container);
                };
            }

        }


        function showImageInPreview(imageUrl) {
            var image = document.createElement('img');
            image.src = imageUrl;
            image.classList.add('max-w-2/3full', 'max-h-full');

            imagePreviewContent.innerHTML = '';
            imagePreviewContent.appendChild(image);
            imagePreview.classList.remove('hidden');
            imagePreviewBackdrop.classList.remove('hidden');
        }

        const imagePreviewBackdrop = document.getElementById('imagePreviewBackdrop');
        imagePreviewBackdrop.addEventListener('click', function() {
            imagePreview.classList.add('hidden');
            imagePreviewBackdrop.classList.add('hidden');
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const categoriaSelect = document.getElementById('categoria');
            const caracteristicaKeySelect = document.getElementById('caracteristicaKey');

            categoriaSelect.addEventListener('change', function() {
                const categoria = this.value;
                fetch('/anuncio/new/categories?categoria=' + categoria)
                    .then(response => response.json())
                    .then(data => {
                        caracteristicaKeySelect.innerHTML = '';
                        data.forEach(option => {
                            const optionElement = document.createElement('option');
                            optionElement.value = option.key;
                            optionElement.textContent = option.display_name;
                            caracteristicaKeySelect.appendChild(optionElement);
                            var addCaracteristica = document.getElementById(
                                'addCaracteristica');
                            var valueInput = document.getElementById('caracteristicaValue');
                            caracteristicaKeySelect.removeAttribute('disabled');
                            valueInput.removeAttribute('disabled');
                            addCaracteristica.removeAttribute('disabled');


                        });
                    })
                    .catch(error => {
                        console.error('Hubo un error al obtener las opciones:', error);
                    });
            });
        });
    </script>


    <script src="https://media.renthub.es/js/categoryAttributeHandler.js"></script>
    <script src="https://media.renthub.es/js/categoryAttributesDisplayManager.js"></script>
    <script src="https://media.renthub.es/js/locationFillerInner.js"></script>
    <!--<script src="https://media.renthub.es/js/imageDrop.js"></script>-->
    <script src="https://media.renthub.es/js/dinamicFormStepper.js"></script>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
