@section('header')
    <div class="container mx-auto flex-row justify-around p-4" id="header" style="backdrop-filter: blur(8px);">
        <nav class="relative">
            <div class="max-w-7xl mx-auto flex justify-between items-start flex-col lg:flex-row sm:flex-col sm:align-middle">
                <a href="/"
                    class="text-gray-950 text-2xl font-bold mb-4 lg:mb-0 sm:mb-4 w-full lg:w-auto sm:w-full">RêntHûb.es</a>
                <div id="navSearch" class="flex mb-4 lg:mb-0 sm:mb-4 w-full lg:w-auto sm:w-auto relative">
                    <div class="flex">
                        <div class="flex relative">
                            <input id="locationInput" type="text" placeholder="Ciudad, barrio, calle..."
                                class="w-full lg:w-96 sm:w-64 px-2 py-1 border border-gray-300 rounded-l-md"
                                value="<?php
                                if (isset($location)) {
                                    echo $location;
                                }
                                ?>">
                            <div id="searchResults"
                                class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-l-md z-50 rounded-br-md hidden">
                            </div>

                        </div>
                        <select name="category" id="category"
                            class="w-full lg:w-40 sm:w-100 px-2 py-1 border border-gray-300">
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
                        <button id="searchInput"
                            class="bg-white border border-gray-300 text-black px-3 py-1 rounded-r-md  hover:bg-gray-600 hover:text-white hover:border-gray-600">Buscar</button>
                    </div>
                </div>
                <ul class="flex space-x-4">
                    <li><a href="/login" class="text-gray-600 font-bold hover:text-gray-950">Iniciar sesión</a></li>
                    <li><a href="/signup" class="text-gray-600 font-bold hover:text-gray-950">Registrarme</a></li>
                </ul>
            </div>
        </nav>

    </div>
    <script>
        searchInput.addEventListener('click', function() {
            var conceptName = $('#category').find(":selected").val();
            var locationInput = $('#locationInput').val();
            location.assign('/search/' + conceptName + '/' + locationInput);
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script>
        var searchInput = document.getElementById('locationInput');
        var searchResults = document.getElementById('searchResults');

        searchInput.setAttribute('autocomplete', 'off');

        var autocomplete = new google.maps.places.Autocomplete(null, {
            types: ['address']
        });

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            searchInput.value = place.formatted_address;
        });

        searchInput.addEventListener('input', function() {
            var query = searchInput.value;
            if (query.length === 0) {
                searchResults.innerHTML = '';
                searchResults.classList.add('hidden');
                return;
            }
            var service = new google.maps.places.AutocompleteService();
            service.getPlacePredictions({
                input: query
            }, function(predictions, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    searchResults.innerHTML = '';
                    searchResults.classList.remove('hidden');
                    predictions.forEach(function(prediction) {
                        var div = document.createElement('div');
                        div.textContent = prediction.description;
                        div.classList.add('w-full', 'lg:w-96', 'sm:w-64', 'px-2', 'py-1',
                            'hover:cursor-pointer', 'hover:bg-gray-100');
                        div.addEventListener('click', function() {
                            prediction
                            searchInput.value = prediction.description;
                            searchResults.innerHTML = '';
                            searchResults.classList.add('hidden');
                        });
                        searchResults.appendChild(div);
                    });
                } else {
                    alert("Ups! Something went wrong... \n" + status);
                }
            });
        });
    </script>
@endsection
