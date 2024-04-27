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
        <form action="/signup/particular/new" method="POST" enctype="multipart/form-data">
            <div id="formstep1">
                <p class="text-gray-600 mb-4 text-center pt-10">Para comenzar a publicar tu anuncio, por favor completa el
                    siguiente formulario con la información relevante sobre la propiedad que deseas anunciar. Te guiaremos
                    paso a paso para asegurarnos de que tu anuncio sea completo y atractivo para posibles interesados.</p>
                <br>
                <div class="mb-6 ">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Categoría:</label>
                    <select name="provincia" id="provincia"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        required>
                        <option value="none" disabled selected hidden>Categoría</option>
                        <option value="pisos">Piso</option>
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
                    <label for="title" class="block text-gray-700 font-bold mb-2">Precio de alquiler:</label>
                    <div class="w-full flex border border-gray-300 rounded-md focus:border-gray-600">
                        <input type="text" id="title" name="title"
                            class="w-full px-4 py-2 outline-none border-none rounded-md focus:outline-none"
                            placeholder="Precio" required>
                        <p class="w-auto px-4 py-2 rounded-md focus:outline-none  focus:border-gray-600">€/mes</p>
                    </div>
                </div>
                <div class="mb-6 flex justify-between">
                    <a href="/signup"
                        class="text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Cancelar</a>
                    <button id="step2"
                        class="next bg-gray-100 border border-gray-300 text-black px-6 w-auto py-2 rounded-md hover:bg-blue-400 hover:text-white focus:outline-none ">Continuar</button>
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
                <label for="profilePic" class="block text-gray-700 font-bold mb-2">Imágenes: (Mínimo una)</label>
                <div class="w-full relative border-2 border-gray-300 border-dashed rounded-lg p-6" id="dropzone">
                    <div class="text-center">
                        <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg"
                            alt="">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            <label for="file-upload" class="relative cursor-pointer">
                                <span>Arrastra y suelta</span>
                                <span class="text-indigo-600"> o busca</span>
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
                    el resto de usuarios sepan a que parte del inmueble hace referencia dicha foto.
                </p>
                <div class="mt-4 mx-auto max-h-52 py-3 overflow-x-auto flex" id="preview" style="white-space: nowrap;">
                    <!-- Aquí se mostrarán las imágenes -->
                </div>
            </div>

            <div class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center z-30 hidden"
                id="imagePreview">
                <div id="imagePreviewBackdrop" class="fixed hidden top-0 left-0 w-screen h-screen bg-gray-200 opacity-50">
                </div>
                <div id="imagePreviewContent"
                    class="absolute bg-white p-4 rounded-lg shadow-lg w-3/4 h-3/4 items-center flex justify-center">
                    <!-- Aquí se mostrará la imagen en grande -->
                </div>
            </div>
            <br>
            <div class="mb-6">
                <label for="birthdate" class="block text-gray-700 font-bold mb-2">Dirección</label>
                <p class="text-sm mb-2 text-gray-600 mt-1">No es necesario que introduzcas la dirección exacta del inmueble,
                    simplemente una aproximada.
                </p>
                <div class="flex relative mb-2 lg:mb-0">
                    <input id="locationInputInner" type="text" placeholder="Ciudad, barrio, calle..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    <div id="searchResultsInner"
                        class="absolute top-full left-0 w-full bg-transparent border border-gray-300 rounded-l-md z-50 rounded-br-md hidden">
                    </div>
                </div>
                <br>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Características del
                        inmueble</label>
                    <div class="flex flex-col lg:flex-row mb-4 lg:mb-0 sm:mb-4">
                        <select name="categoryInner" id="caracteristicaKey"
                            class="w-full lg:w-40 sm:w-100 px-2 py-1  bg-transparent border-gray-300 rounded-l-md">
                            <option value="none" disabled selected hidden required>Opción</option>
                            <option value="num_rooms">Habitaciones</option>
                        </select>
                        <div class="flex relative mb-2 lg:mb-0">
                            <input type="text" placeholder="Valor" id="caracteristicaValue"
                                class="w-full lg:w-96 sm:w-64 px-3 py-2 border bg-transparent border-gray-300 ">
                        </div>
                        <button id="addCaracteristica"
                            class="bg-transparent border border-gray-300 text-black px-3 py-1 rounded-r-md  hover:bg-gray-600 hover:text-white hover:border-gray-600">Agregar</button>
                    </div>
                    <div class="mt-6 flex flex-col gap-2" id="caracteristicasDisplay">


                    </div>
                </div>

                <div class="mb-6 flex justify-between">
                    <button id="backstep2"
                        class="prev text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Volver</button>
                    <button id="step3"
                        class="next bg-gray-100 border border-gray-300 text-black px-6 w-auto py-2 rounded-md hover:bg-blue-400 hover:text-white focus:outline-none ">Continuar</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        var addCaracteristica = document.getElementById('addCaracteristica');
        var caracteristicasDisplay = document.getElementById('caracteristicasDisplay');

        addCaracteristica.addEventListener('click', function() {
            var selectElement = document.getElementById('caracteristicaKey');
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;

            var valueInput = document.getElementById('caracteristicaValue');
            var caracteristicaValue = valueInput.value;

            var container = document.createElement('div');
            container.classList.add('border', 'border-gray-200', 'rounded-md', 'w-full', 'flex', 'justify-end');

            var contentRow = document.createElement('div');
            contentRow.classList.add('flex', 'w-full');

            var keyElement = document.createElement('p');
            keyElement.classList.add('w-1/2', 'px-4', 'py-2', 'rounded-md', 'focus:outline-none', 'flex',
                'items-center');
            keyElement.textContent = selectedOption;
            contentRow.appendChild(keyElement);

            var valueElement = document.createElement('p');
            valueElement.classList.add('w-1/2', 'px-4', 'py-2', 'rounded-md', 'focus:outline-none', 'flex',
                'items-center');
            valueElement.textContent = caracteristicaValue;
            contentRow.appendChild(valueElement);

            container.appendChild(contentRow);

            var buttonContainer = document.createElement('div');
            buttonContainer.classList.add('flex', 'justify-center', 'items-center', 'h-12', 'w-12',
                'hover:bg-gray-200', 'cursor-pointer');
            buttonContainer.addEventListener('click', function() {
                caracteristicasDisplay.removeChild(container);
            });

            var svgElement = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svgElement.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            svgElement.setAttribute('fill', 'none');
            svgElement.setAttribute('viewBox', '0 0 24 24');
            svgElement.setAttribute('stroke-width', '1.5');
            svgElement.setAttribute('stroke', 'currentColor');
            svgElement.classList.add('w-6', 'h-6');

            var svgPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            svgPath.setAttribute('stroke-linecap', 'round');
            svgPath.setAttribute('stroke-linejoin', 'round');
            svgPath.setAttribute('d',
                'm14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0'
            );
            svgElement.appendChild(svgPath);

            buttonContainer.appendChild(svgElement);
            container.appendChild(buttonContainer);

            caracteristicasDisplay.appendChild(container);
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
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
                        div.classList.add('w-full', 'px-2', 'py-1',
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

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => {
                    var container = document.createElement('div');
                    container.classList.add('relative', 'mr-4', 'border-gray-200', 'rounded-md');

                    var image = document.createElement('img');
                    image.src = reader.result;
                    image.classList.add('max-h-40', 'w-auto', 'cursor-pointer');
                    image.addEventListener('click', function() {
                        showImageInPreview(reader.result);
                    });
                    container.appendChild(image);

                    var deleteBtn = document.createElement('button');
                    deleteBtn.classList.add('absolute', 'top-0', 'right-0', 'text-red-500', 'bg-white', 'rounded-full',
                        'p-1', 'hover:bg-red-500', 'hover:text-white');
                    deleteBtn.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>';
                    deleteBtn.style.display = 'none'; // Inicialmente oculto
                    deleteBtn.addEventListener('click', () => {
                        preview.removeChild(container);
                    });
                    container.appendChild(deleteBtn);

                    container.addEventListener('mouseover', () => {
                        deleteBtn.style.display = 'block';
                    });
                    container.addEventListener('mouseout', () => {
                        deleteBtn.style.display = 'none';
                    });

                    // Botón para mostrar input de texto
                    var textInputBtn = document.createElement('button');
                    textInputBtn.classList.add('absolute', 'top-0', 'left-0', 'text-green-500', 'bg-white',
                        'rounded-full',
                        'p-1', 'hover:bg-green-500', 'hover:text-white');
                    textInputBtn.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>';
                    textInputBtn.addEventListener('click', () => {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.setAttribute('placeholder', 'Etiqueta');
                        input.classList.add('border', 'border-gray-300', 'px-2', 'py-1', 'rounded');
                        input.style.width = image.offsetWidth +
                            'px'; // Establece el ancho del input igual al de la imagen
                        container.appendChild(input);
                    });
                    container.appendChild(textInputBtn);

                    preview.appendChild(container);
                };
            }

        }

        function showImageInPreview(imageUrl) {
            var image = document.createElement('img');
            image.src = imageUrl;
            image.classList.add('max-w-2/3full', 'max-h-full');


            imagePreviewContent.innerHTML = ''; // Limpia el contenido existente
            imagePreviewContent.appendChild(image); // Agrega la imagen al contenedor
            imagePreview.classList.remove('hidden'); // Muestra la vista previa de la imagen
            imagePreviewBackdrop.classList.remove('hidden'); // Muestra el fondo oscuro de la vista previa
        }

        const imagePreviewBackdrop = document.getElementById('imagePreviewBackdrop');
        imagePreviewBackdrop.addEventListener('click', function() {
            imagePreview.classList.add('hidden'); // Oculta la vista previa de la imagen
            imagePreviewBackdrop.classList.add('hidden'); // Oculta el fondo oscuro de la vista previa
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuTriggers = document.querySelectorAll('.next');
            menuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    let id = trigger.getAttribute('id').replace('step',
                        '');
                    if (id < 5) {
                        let nextForm = document.getElementById('formstep' + id);
                        let prevForm = document.getElementById('formstep' + (parseInt(id) - 1));

                        nextForm.classList.toggle('hidden');
                        prevForm.classList.toggle('hidden');

                        let nextMark = document.getElementById('markstep' + id);
                        let prevMark = document.getElementById('markstep' + (parseInt(id) - 1));

                        nextMark.classList.toggle('step');
                        prevMark.classList.toggle('step');
                    }

                });
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            const menuTriggers = document.querySelectorAll('.prev');
            menuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    let id = trigger.getAttribute('id').replace('backstep',
                        '');
                    if (id < 5) {
                        let nextForm = document.getElementById('formstep' + (parseInt(id) - 1));
                        let prevForm = document.getElementById('formstep' + id);

                        nextForm.classList.toggle('hidden');
                        prevForm.classList.toggle('hidden');

                        let nextMark = document.getElementById('markstep' + (parseInt(id) - 1));
                        let prevMark = document.getElementById('markstep' + id);

                        nextMark.classList.toggle('step');
                        prevMark.classList.toggle('step');
                    }

                });
            });
        });
    </script>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
