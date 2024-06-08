@section('header')
    <div class="container mx-auto flex-row justify-around p-4" id="header" style="backdrop-filter: blur(8px);">
        <nav class="relative">
            <div class="max-w-7xl mx-auto flex justify-between items-start flex-col lg:flex-row sm:flex-col sm:align-middle">
                <a href="/"
                    class="text-gray-950 text-2xl font-bold mb-4 lg:mb-0 sm:mb-4 w-1/2 lg:w-auto sm:w-full lg:order-1 order-1">RêntHûb<span class="text-pink-700 text-xl hover:text-black">.</span>es</a>
                    
                <div id="navSearch"
                    class="flex flex-col sm:flex-row mb-4 lg:mb-0 sm:mb-4 w-full lg:w-auto sm:w-auto relative lg:order-2 order-3 mt-3 lg:mt-0">
                    <div class="flex relative">
                        <input id="locationInput" type="text"
                            @if (isset($location)) placeholder="{{ $location }}"
                        @else
                        placeholder="Ciudad, barrio, calle..." @endif
                            class="w-full lg:w-96 sm:w-64 px-2 py-1 border border-gray-300 rounded-tl-md sm:rounded-l-md">
                        <div id="searchResults"
                            class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-l-md z-10 rounded-br-md hidden">
                        </div>
                    </div>
                    <div class="flex ">
                        <select name="category" id="category"
                            class="w-full lg:w-40 sm:w-auto px-2 py-1 border rounded-bl-md sm:rounded-none border-gray-300">
                            <option value="none" disabled selected hidden required>Categoría</option>
                            <option value="locales">Local</option>
                            <option value="compartir">Compartir</option>
                            <option value="casas">Casa</option>
                            <option value="garajes">Garaje</option>
                            <option value="oficinas">Oficina</option>
                            <option value="trasteros">Trastero</option>
                            <option value="terrenos">Terreno</option>
                        </select>
                        <button id="searchButton"
                            class="bg-pink-700  text-white px-3 py-1 rounded-r-md hover:text-white  hover:bg-gray-600  hover:border-gray-600">Buscar</button>
                    </div>

                </div>
                <ul class="flex space-x-4 justify-center w-full items-center lg:w-auto order-3">
                    <li><a href="/login" class="text-gray-600 font-bold hover:text-gray-950">Iniciar sesión</a></li>
                    <li><a href="/signup" class="text-gray-600 font-bold hover:text-gray-950">Registrarme</a></li>
                </ul>
            </div>
        </nav>

    </div>
    <script>
        var searchButton = document.getElementById('searchButton');

        searchButton.addEventListener('click', function() {
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
