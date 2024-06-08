@extends('Layouts.main')
@section('title', 'RêntHûb.es | Account')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    <style>
        .elementData:hover label {
            opacity: 1;
            transition: 0.5s;
        }
    </style>
    @php
        $particularData = App\Models\Particular::getParticularData(Auth::user()->id);
    @endphp
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center">
        <h1 class="text-2xl font-bold"><a href="{{ route('profile.index') }}" class="hover:underline">Tu cuenta</a> >
            Información de tu cuenta</h1>
        <div role="status" id="status" class="absolute top-1/4 right-1/2 z-10">
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
        <div id="content" class="hidden">

            <div class="flex flex-col align-middle p-4">

                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md mb-2">Foto de perfil</p>
                    <div class="elementData flex justify-between cursor-pointer" id="profilePicWrapper">
                        <div class="relative">
                            <img id="profilePic"
                                class="profile-button rounded-full h-24 w-24 p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                                src="{{ App\Models\User::getProfilePic(Auth::user()->profile_pic_url) }}" alt="">
                            <div id="dropdownMenu" class="hidden absolute bg-white shadow-md py-1 w-24 left-0 rounded-md">
                                <a id="profilePicButton" href="#"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Ver</a>
                                <a id="editOption" href="#"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Editar</a>
                            </div>
                        </div>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>

                    </div>
                    <!--
                            <form action="https://media.renthub.es/v1/profile/{{ Auth::user()->display_id }}.jpg/update"
                                method="POST" enctype="multipart/form-data">

                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="profilePicInput" type="file">
                                    <input type="submit" value="Guardar"
                                    class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                            </form>
                        -->
                    <form action="https://media.renthub.es/v1/profile/{{$user->display_id}}/update" class="flex justify-between w-1/2 flex-col mt-4 gap-2"
                        method="POST" enctype="multipart/form-data">
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            name="archivo" id="archivo" type="file" accept="image/*" >
                        <div class="w-full flex justify-end">
                            <input type="submit" value="Guardar"
                                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        </div>

                    </form>

                    <div id="profilePicDisplay"
                        class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
                        <div id="profilePicDisplayBackdrop"
                            class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
                        <div id="documentSelectorDisplay"
                            class="bg-gray-100 lg:w-2/6  mx-auto w-5/6 rounded-md border border-gray-200"
                            style="backdrop-filter: blur(10px);">
                            <div class="p-6 flex flex-col h-full justify-start gap-2">
                                <p class="text-xl font-bold">Foto de perfil</p>
                                <img id="newProfilePic"
                                    class="profile-button min-w-46 w-full h-full p-1 flex object-cover items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                                    src="{{ App\Models\User::getProfilePic(Auth::user()->profile_pic_url) }}" alt="">
                            </div>
                        </div>
                    </div>

                    <script>
                        const profilePicWrapper = document.getElementById('profilePicWrapper');
                        const profilePic = document.getElementById('profilePic');
                        const editOption = document.getElementById('editOption');
                        const profilePicInput = document.getElementById('profilePicInput');
                        const newProfilePic = document.getElementById('newProfilePic');
                        const dropdownMenu = document.getElementById('dropdownMenu');

                        profilePicWrapper.addEventListener('click', () => {
                            dropdownMenu.classList.toggle('hidden');
                        });

                        editOption.addEventListener('click', (e) => {
                            e.preventDefault();
                            dropdownMenu.classList.add('hidden');
                            profilePicInput.click();
                        });
                        /*
                        profilePicInput.addEventListener('change', () => {
                            const file = profilePicInput.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    newProfilePic.src = e.target.result;
                                    profilePic.src = newProfilePic.src;
                                    // Crear un objeto FormData
                                    const formData = new FormData();
                                    formData.append('profile_pic', file);
                                    // Enviar la solicitud AJAX
                                    fetch('https://media.renthub.es/v1/profile/{{ Auth::user()->display_id }}.jpg/update', {
                                        method: 'POST',
                                        mode: 'no-cors',
                                        body: formData
                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            // Manejar la respuesta del servidor
                                            console.log(data);
                                        })
                                        .catch(error => {
                                            console.error('There was an error with the fetch operation:', error);
                                        });
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        */
                    </script>
                </div>


                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Nombre y apellidos</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">{{ $particularData->name }}
                            {{ $particularData->surname }}</p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                    <div class="w-full ">
                        <form action="/account/edit" class="flex justify-between w-1/2 flex-col mt-4 gap-2" method="POST">
                            @csrf
                            <input name="name" type="text"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                placeholder="{{ $particularData->name }}">
                            <input name="surname" type="text"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                placeholder="{{ $particularData->surname }}">
                            <div class="w-full flex justify-end">
                                <input type="submit" value="Guardar"
                                    class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Correo electrónico</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">{{ Auth::user()->email }}</p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                    <form action="/account/edit" class="flex justify-between w-1/2 flex-col mt-4 gap-2" method="POST">
                        @csrf
                        <p class="text-sm">Se te enviará un correo para que confirmar la validez del nuevo email que
                            introduzcas</p>
                        <input name="email" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="{{ Auth::user()->email }}">
                        <div class="w-full flex justify-end">
                            <input type="submit" value="Guardar"
                                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        </div>
                    </form>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Número de teléfono</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">{{ Auth::user()->phone_code }}
                            {{ Auth::user()->phone }}</p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                    <form action="/account/edit" class="flex justify-between w-1/2 flex-col mt-4 gap-2" method="POST">
                        @csrf
                        <input name="phone" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="{{ Auth::user()->phone_code }} {{ Auth::user()->phone }}">
                        <div class="w-full flex justify-end">
                            <input type="submit" value="Guardar"
                                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        </div>
                    </form>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Localización</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">
                            {{ $particularData->location }}
                        </p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                    <form action="/account/edit" class="flex justify-between w-1/2 flex-col mt-4 gap-2" method="POST">
                        @csrf
                        <input name="location" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="{{ $particularData->location }}">
                        <div class="w-full flex justify-end">
                            <input type="submit" value="Guardar"
                                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        </div>
                    </form>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Empleo</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">{{ $particularData->job }}</p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                    <form action="/account/edit" class="flex justify-between w-1/2 flex-col mt-4 gap-2" method="POST">
                        @csrf
                        <input name="job" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="{{ $particularData->job }}">
                        <div class="w-full flex justify-end">
                            <input type="submit" value="Guardar"
                                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        </div>
                    </form>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Idiomas</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="lenguage" class="text-lg text-gray-500  hover:opacity-100">
                            {{ $particularData->lenguage }}
                        </p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                    <form action="/account/edit" class="flex justify-between w-1/2 flex-col mt-4 gap-2" method="POST">
                        @csrf
                        <input name="name" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="{{ $particularData->lenguage }}">
                        <div class="w-full flex justify-end">
                            <input type="submit" value="Guardar"
                                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        </div>
                    </form>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Fecha de nacimiento</p>
                    <div class="elementData flex justify-between">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">
                            {{ \Carbon\Carbon::parse($particularData->birthdate)->toDateString() }}</p>
                    </div>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Género</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">{{ $particularData->genre }}
                        </p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                    <form action="/account/edit" class="flex justify-between w-1/2 flex-col mt-4 gap-2" method="POST">
                        @csrf
                        <input name="genre" type="text"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="{{ $particularData->genre }}">
                        <div class="w-full flex justify-end">
                            <input type="submit" value="Guardar"
                                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        </div>
                    </form>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Descripción</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100 ">
                            {{ $particularData->description }}
                        </p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>

                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Creación de la cuenta</p>
                    <div class="flex justify-between">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">
                            {{ \Carbon\Carbon::parse(Auth::user()->created_at)->toDateString() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://media.renthub.es/js/loader.js"></script>
        <script src="https://media.renthub.es/js/bigPictureProfilePic.js"></script>
    </div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
