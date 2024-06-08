@section('header')
    <div class="container mx-auto flex-row justify-around p-4" id="header" style="backdrop-filter: blur(8px);">
        <nav class="relative">
            <div
                class="max-w-7xl mx-auto flex flex-wrap justify-between items-start flex-row lg:flex-row sm:flex-col sm:align-middle">
                <a href="/" class=" text-2xl font-bold mb-4 lg:mb-0 sm:mb-4 w-1/2 lg:w-auto sm:w-full lg:order-1 order-1">RêntHûb<span class="text-pink-700 text-2xl hover:text-black">.</span>es</a>

                <div class="relative lg:order-3 order-2">
                    <button
                        class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none">
                        <img src="{{ App\Models\User::getProfilePic(Auth::user()->profile_pic_url) }}"
                            alt="Imagen de perfil" class="rounded-full h-10 w-10">
                        <p class="p-1 py-2 text-sm text-gray-700 font-bold">{{App\Models\Particular::getParticularName(Auth::user()->id)}}</p>
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
                            } ?></p>
                        <a href="/messages" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mensajes</a>
                        <a href="/anuncio/new" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Publicar
                            anuncio</a>
                        <a href="/recent"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-200">Búsquedas</a>
                        <a href="/management" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Área de
                            gestión</a>
                        <a href="/account" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-b border-gray-200">Perfil y
                            cuenta</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 hover:cursor-pointer"
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
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
@endsection
