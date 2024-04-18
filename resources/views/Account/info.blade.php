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
                    <div class="elementData flex justify-between cursor-pointer">
                        <img class="profile-button rounded-full h-24 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                            src="{{ App\Models\User::getProfilePic(Auth::user()->id) }}" alt="">
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
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
                    <div>
                        <form action="" class="flex justify-between flex-row mt-1">
                            <input name="nombre" type="text" class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            value="{{ $particularData->name }}">
                            <input name="surname" type="text" class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            value="{{ $particularData->surname }}">
                            <input type="submit" value="Guardar" class="bg-gray-100 border border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
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
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Fecha de nacimiento</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">
                            {{ \Carbon\Carbon::parse($particularData->birthdate)->toDateString() }}</p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
                </div>
                <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4">
                    <p class="text-md">Género</p>
                    <div class="elementData flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">{{ $particularData->genre }}</p>
                        <label for="nombre"
                            class="opacity-0 transition-opacity c duration-300 text-md text-gray-500 cursor-pointer hover:opacity-100">Pulsa
                            para editar</label>
                    </div>
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("status").classList.toggle('hidden');
                document.getElementById("content").classList.toggle('hidden');
            });
        </script>
    </div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
