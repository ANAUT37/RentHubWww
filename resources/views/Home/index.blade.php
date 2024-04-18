@extends('Layouts.main')
@section('title', 'RêntHûb.es')
@section('header')
    <div class="sticky">
        @if (Auth::check())
            @include('Headers.sessioned')
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
    <div class="h-96 relative mt-0">
        <div
            class="absolute z-10 top-2/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full lg:w-auto sm:w-auto lg:flex lg:justify-center">
            <div id="elemento"
                class="flex flex-col mb-4 lg:mb-0 sm:mb-4 w-full p-4 rounded-lg lg:w-auto sm:w-auto bg-white bg-opacity-90"
                style="backdrop-filter: blur(8px);">
                <h1 class="text-2xl font-bold mb-6">Encuentra tu sitio</h1>
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
                        <option value="pisos">Piso</option>
                        <option value="locales">Local</option>
                        <option value="compartir">Compartir</option>
                        <option value="casas">Casa</option>
                        <option value="garajes">Garaje</option>
                        <option value="oficinas">Oficina</option>
                        <option value="trasteros">Trastero</option>
                        <option value="terrenos">Terreno</option>
                    </select>
                    <button id="searchButtonInner"
                        class="bg-transparent border border-gray-300 text-black px-3 py-1 rounded-r-md  hover:bg-gray-600 hover:text-white hover:border-gray-600">Buscar</button>
                </div>
            </div>
        </div>
        <div class="carousel w-full relative">
            <div
                class="relative h-56 overflow-hidden rounded-t-lg lg:rounded-l-lg lg:rounded-r-none sm:h-64 xl:h-80 2xl:h-96">
                <div class="carousel-item duration-700 ease-in-out opacity-100 transition-opacity">
                    <img src="https://t3.ftcdn.net/jpg/05/85/86/44/360_F_585864419_kgIYUcDQ0yiLOCo1aRjeu7kRxndcoitz.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
                <div class="carousel-item hidden duration-700 ease-in-out opacity-0 transition-opacity">
                    <img src="https://c0.wallpaperflare.com/preview/541/428/45/lake-lakeside-landscape-mountain-peak.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
                <div class="carousel-item hidden duration-700 ease-in-out opacity-0 transition-opacity">
                    <img src="https://wallpapers-clan.com/wp-content/uploads/2023/11/cool-vaporwave-art-desktop-wallpaper-preview.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover  -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
                <div class="carousel-item hidden duration-700 ease-in-out opacity-0 transition-opacity">
                    <img src="https://img.freepik.com/foto-gratis/pintura-lago-montana-montana-al-fondo_188544-9126.jpg"
                        class="absolute left-1/2 top-1/2 block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2"
                        alt="..." />
                </div>
            </div>
        </div>

    </div>
    <div>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sagittis nulla quis egestas ultricies. Maecenas
        lectus nulla, ornare tincidunt varius ac, semper sed ligula. Proin augue elit, finibus at tempus id, dictum a
        neque. Nullam auctor augue non ex egestas auctor. Nullam rutrum id justo eget mollis. Phasellus interdum, ante
        at dictum convallis, nunc nisl consequat sapien, eget ultricies nisi metus ac leo. Quisque eu volutpat turpis,
        eget consectetur ante. Suspendisse a odio sit amet orci elementum aliquam. Integer nec massa gravida, placerat
        erat vel, accumsan augue. Aenean consequat feugiat blandit. Etiam mattis enim nec tincidunt vulputate. Sed
        interdum sagittis molestie. Etiam non elit accumsan, eleifend sem vel, maximus dui. Curabitur mattis viverra
        eros, eget tempor tortor. Integer massa metus, tempus et dignissim et, maximus sit amet quam. Donec sagittis,
        arcu eget porta rutrum, dolor metus placerat justo, eget sagittis tellus libero aliquam dui.

        Pellentesque tincidunt vel metus sed volutpat. Donec id nunc placerat, maximus felis vel, tincidunt lectus.
        Donec nec mattis augue. Aliquam sem justo, sagittis in arcu eu, convallis laoreet mi. Nunc ac ultrices urna.
        Etiam auctor pretium orci eu vestibulum. Praesent quis felis semper, porttitor lorem interdum, semper lorem.
        Praesent vel metus sit amet mauris semper porttitor eget non arcu. Duis nec maximus nibh, vitae porta risus. In
        hac habitasse platea dictumst. Nunc tincidunt orci quis erat euismod, sollicitudin faucibus risus viverra.

        In non dignissim lorem, vitae suscipit libero. Vivamus viverra quis metus sed rhoncus. Nunc vel congue turpis.
        Donec venenatis convallis fermentum. Praesent eu magna a mi porttitor pretium. Cras eros tellus, ornare eu dolor
        nec, aliquet viverra est. Pellentesque viverra elit massa, at consectetur urna pellentesque et.

        Pellentesque tincidunt nunc quis justo pulvinar auctor. Vivamus velit eros, rhoncus vitae varius id, facilisis a
        nunc. Quisque lacinia, urna ut molestie placerat, quam ligula porta magna, in pulvinar neque magna eget odio.
        Phasellus viverra, ex ac placerat tempor, purus mi vulputate enim, in semper lacus mauris vel lorem. Proin
        pharetra, ex vitae congue maximus, velit odio sagittis justo, quis auctor dolor justo eget magna. Sed aliquet
        mauris quis efficitur sollicitudin. Etiam euismod consectetur dolor, a pellentesque mauris finibus egestas.
        Quisque in purus varius, vulputate ipsum ac, dignissim dolor. Nam egestas faucibus tincidunt. Aenean blandit
        tincidunt risus eu luctus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
        himenaeos. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In mattis
        tellus non eros congue, id suscipit orci imperdiet. Maecenas vitae enim diam. Nullam dolor lorem, sodales quis
        ultrices tempor, auctor tincidunt sapien.

        Sed placerat maximus odio scelerisque scelerisque. Nam sed convallis elit. Vestibulum convallis, purus nec
        congue sagittis, nisi odio vulputate neque, a blandit ante nibh eu lacus. Sed hendrerit metus nunc, in tincidunt
        lorem auctor in. Duis non bibendum ipsum. Vestibulum sit amet urna et sapien convallis hendrerit. Proin semper
        dolor convallis mi sodales imperdiet. Ut ipsum orci, bibendum eu placerat vitae, vehicula eget metus. Aenean
        quis erat malesuada, volutpat velit non, vestibulum augue. Nulla porta accumsan mi, vitae varius tortor finibus
        sed. Vestibulum ac dui sed lectus eleifend molestie eget ac metus. Aliquam sit amet commodo sem. Proin nec augue
        ut diam vehicula feugiat.

        Nam mauris libero, laoreet non metus quis, feugiat aliquet sapien. Nullam congue, lorem a consectetur luctus,
        metus magna elementum nisi, et tempor eros elit et dui. Mauris nec tempus nulla. Etiam porta auctor pharetra.
        Aenean placerat nunc ac luctus rutrum. Sed elementum augue id consectetur vehicula. Nulla sagittis erat a neque
        varius ultrices ut in eros. Aliquam erat volutpat. Donec vestibulum lectus at sem egestas, non imperdiet mi
        tincidunt. Duis lacinia consectetur libero vel imperdiet. Morbi ac vulputate magna. In non enim fringilla,
        interdum lacus non, varius lacus.

        Nulla vestibulum odio at tempus ornare. Nulla sodales sem sed sollicitudin commodo. Phasellus nec velit vitae
        arcu pulvinar scelerisque sed id lectus. Integer convallis urna non nulla porttitor, id porta ligula dictum.
        Aenean hendrerit, ex vel tempus mollis, est arcu malesuada purus, posuere pharetra leo dui at magna. Donec enim
        nisl, ultrices a odio placerat, malesuada ullamcorper metus. Praesent eros nisi, efficitur a ex sit amet,
        vulputate volutpat est. Etiam eleifend accumsan arcu id venenatis. Nunc lorem massa, tempor non risus vel,
        dignissim vestibulum diam.

        Donec nec ullamcorper sapien. Ut tempor nisl et enim ultricies pretium non at tortor. Curabitur rhoncus
        fermentum turpis, vel placerat urna tempus ut. Suspendisse cursus fermentum libero at tincidunt. Curabitur id
        tellus tempus, consectetur sem at, ultricies massa. Integer luctus pellentesque sollicitudin. Integer interdum
        eros nec volutpat convallis. Aenean lorem lacus, suscipit nec ipsum a, auctor placerat risus. Aenean ultricies
        eros in pretium posuere. Phasellus neque eros, accumsan at dui a, tincidunt sodales quam. Sed feugiat quis orci
        euismod elementum.

        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eleifend, dolor a varius vehicula, nisl dui
        tincidunt arcu, quis tempus metus ligula id metus. In elit nisl, pharetra non laoreet id, tempus quis nisl.
        Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. In
        quis tincidunt enim, eget euismod ex. Praesent finibus, metus sit amet vulputate facilisis, justo est efficitur
        nisi, eu suscipit ipsum enim ac est. Suspendisse tempus enim vitae aliquet sagittis. Pellentesque porttitor
        augue id felis venenatis consectetur. Vivamus vestibulum blandit sagittis. Cras consectetur feugiat diam eu
        commodo. Vivamus vitae rhoncus erat, ac porttitor purus. Proin augue eros, aliquet id leo non, dictum aliquam
        lectus. Pellentesque quis odio quis ligula placerat tincidunt. Duis feugiat dolor sem, in varius massa vehicula
        et. Nullam ac porttitor massa.

        Sed id libero magna. Praesent lobortis sodales elit, non aliquam libero mattis id. Aenean quam mi, finibus non
        iaculis sed, suscipit ut ex. Nulla facilisi. In non eros augue. Sed sollicitudin metus ex, et fermentum lacus
        eleifend eu. Ut sed maximus lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur
        ridiculus mus. Morbi porttitor nisl sed scelerisque dignissim. Sed pellentesque commodo pellentesque. Duis non
        quam tempus, vulputate mi a, venenatis leo. Quisque sed semper risus, ac placerat ante. Morbi convallis, lorem
        eu pellentesque iaculis, lacus elit congue ipsum, sed efficitur mi est et mauris. Praesent non magna sed nisl
        lacinia dictum
    </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var header = document.getElementById('navSearch');
                header.classList.add('hide');
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
                        header.classList.add('hide');
                    } else if (!isVisible) {
                        // Quitar la clase hidden si el elemento no es visible
                        elemento.classList.add('hide');
                        header.classList.remove('hide');
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
            location.assign('/search/' + conceptName + '/' + locationInputInner);
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
                        div.classList.add('w-full', 'lg:w-96', 'sm:w-64', 'px-2', 'py-1',
                            'hover:cursor-pointer', 'hover:bg-gray-100','bg-white');
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
