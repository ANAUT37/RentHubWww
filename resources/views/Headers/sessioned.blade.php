@section('header')
    <div class="container mx-auto flex-row justify-around p-4" id="header" style="backdrop-filter: blur(8px);">
        <nav class="relative h-auto">
            <div
                class="max-w-7xl mx-auto flex flex-wrap w-full justify-between items-start flex-row md:flex-row sm:flex-row sm:align-middle">
                <a href="/"
                    class=" text-2xl font-bold mb-4 lg:mb-0 sm:mb-4 w-1/2 lg:w-auto sm:w-full lg:order-1 order-1">RêntHûb<span
                        class="text-pink-700 text-2xl hover:text-black">.</span>es</a>

                <div id="navSearch"
                    class="flex flex-col sm:flex-row mb-4 lg:mb-0 sm:mb-4 w-full lg:w-auto sm:w-auto relative lg:order-2 order-3 mt-3 lg:mt-0">
                    <div class="flex relative">
                        <input id="locationInput" type="text"
                            @if (isset($location)) placeholder="{{ $location }}"
                            @else
                            placeholder="Ciudad, barrio, calle..." @endif
                            class="w-full lg:w-96 sm:w-64 px-2 py-1 border border-gray-300 rounded-tl-md sm:rounded-l-md">
                        <div id="searchResults"
                            class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-l-md z-50 rounded-br-md hidden">
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
                <div class="relative xl:order-3 order-2">
                    <button
                        class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none">
                        <img src="{{ App\Models\User::getProfilePic(Auth::user()->profile_pic_url) }}"
                            alt="Imagen de perfil" class="rounded-full h-10 w-10">
                        <p class="p-1 py-2 text-sm text-gray-700 font-bold">
                            {{ App\Models\Particular::getParticularName(Auth::user()->id) }}</p>
                    </button>
                    <div
                        class="dropdown-menu absolute right-0 z-50 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 py-1 hidden">
                        <p class="block px-4 py-2 text-md text-gray-700 font-bold border-b border-gray-200">
                            <?php
                            date_default_timezone_set('Europe/Madrid');
                            $hora = date('G');
                            
                            if ($hora >= 5 && $hora < 12) {
                                echo '¡Buenos días!';
                            } elseif ($hora >= 12 && $hora < 20) {
                                echo '¡Buenas tardes!';
                            } else {
                                echo '¡Buenas noches!';
                            } ?>
                        </p>
                        <a href="/messages" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mensajes</a>
                        <a href="/anuncio/new" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Publicar
                            anuncio</a>
                        <a href="/recent"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-200">Búsquedas</a>
                        <a href="/management" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Área de
                            gestión</a>
                        <a href="/account"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-200">Perfil
                            y cuenta</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 hover:cursor-pointer"
                                :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>



    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.querySelector('.profile-button');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            profileButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                const isClickInside = profileButton.contains(event.target) || dropdownMenu.contains(event
                    .target);
                if (!isClickInside) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
    @php
        $userId = Auth::user()->id;
    @endphp

    <script>
        let searchButton = document.getElementById('searchButton')
        searchButton.addEventListener('click', function() {
            var conceptName = $('#category').find(":selected").val();
            var locationInput = $('#locationInput').val();


            fetch('/history/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}" // Incluir el token CSRF en el encabezado
                    },
                    body: JSON.stringify({
                        address: locationInput,
                        category: conceptName,
                    }),
                })
                .then(response => {
                    if (response.ok) {
                        location.assign('/search/' + conceptName + '/' + locationInput);
                        console.log('Solicitud HTTP enviada exitosamente');
                    } else {
                        console.error('Error al enviar la solicitud HTTP');
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud HTTP:', error);
                });
        });
    </script>



    </script>
    <script>
        var searchInput = document.getElementById('locationInput');
        var searchResults = document.getElementById('searchResults');
        searchInput.addEventListener('input', function() {
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
                        console.log("error")
                    }
                })
                .then(data => {
                    console.log(data)
                    searchResults.innerHTML = '';
                    data.forEach(item => {
                        var div = document.createElement('div');
                        div.textContent = item.address;
                        div.classList.add('w-full', 'lg:w-96', 'sm:w-64', 'px-2', 'py-1',
                            'hover:cursor-pointer', 'hover:bg-gray-100');
                        div.addEventListener('click', function() {
                            searchInput.value = item.address;
                            searchResults.innerHTML = '';
                            searchResults.classList.toggle('hidden');
                        });
                        searchResults.appendChild(div);
                    });
                    searchResults.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

    <script>
        var searchInput = document.getElementById('locationInput');
        var searchResults = document.getElementById('searchResults');



        //searchInput.setAttribute('autocomplete', 'off');

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
