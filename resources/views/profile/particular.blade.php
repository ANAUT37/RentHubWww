@extends('Layouts.main')
@section('title', 'RêntHûb.es | User')
@section('header')
    @include('Headers.header_manager_home')
@endsection
@section('content')
    @php
        $particularData = App\Models\Particular::getParticularData($userData->id);
    @endphp
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center">
        <div class="flex md:flex-row flex-col align-middle justify-start w-full">
            <div class="bg-white p-4 flex lg:flex-col justify-evenly md:justify-start md:w-2/6 w-full gap-2 md:gap-0">
                <div>
                    <img id="profilePicButton"
                        class="profile-button rounded-full w-20 h-20  md:h-40 md:w-40 p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="{{ App\Models\User::getProfilePic($userData->profile_pic_url) }}" alt="">
                    <br>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-bold">Información sobre {{ $particularData->name }}</p>
                    @if ($particularData->job != null)
                        <div class="flex gap-2 py-1 md:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>
                            <p class="text-md">{{ $particularData->job }}</p>
                        </div>
                    @endif
                    @if ($particularData->location != null)
                        <div class="flex gap-2 py-1 md:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            <p class="text-md">{{ $particularData->location }}</p>
                        </div>
                    @endif
                    @if ($particularData->lenguage != null)
                        <div class="flex gap-2 py-1 md:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                            </svg>

                            <p class="text-md">{{ $particularData->lenguage }}</p>
                        </div>
                    @endif
                    <div class="flex gap-2 py-2 md:mt-4 text-white bg-pink-700 w-fit px-2 md:px-4 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                        <p class="text-md ">Cuenta verificada</p>
                    </div>
                </div>
            </div>
            <div class="md:w-5/6 w-full bg-white p-4 rounded-lg lg:pt-6">
                <p class="text-2xl"><b>{{ $particularData->name }} {{ $particularData->surname }}</b></p>
                <p class="text-sm text-gray-500 font-bold">Particular</p>
                <br>
                <p class="text-md">{{ $particularData->description }}</p>
                <div class="w-full bg-gray-200 h-1 rounded-md mt-4 lg:hidden"></div>
            </div>
        </div>
        <div id="profilePicDisplay" class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
            <div id="profilePicDisplayBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
            <div id="documentSelectorDisplay" class="bg-gray-100 lg:w-2/6  mx-auto w-5/6 rounded-md border border-gray-200"
                style="backdrop-filter: blur(10px);">
                <div class="p-6 flex flex-col h-full justify-start gap-2">
                    <p class="text-xl font-bold">Foto de perfil</p>
                    <img class="profile-button min-w-46 w-full h-full p-1 flex object-cover items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="{{ App\Models\User::getProfilePic($userData->profile_pic_url) }}" alt="">
                </div>
            </div>
        </div>
        <br>
        <div class="flex w-full justify-between md:flex-row flex-col">
            <h1 class="text-2xl font-bold">Valoraciones</h1>
            <div class="flex">
                <p class="text-lg font-bold text-gray-950 mr-2">0.0</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
            </div>
        </div>
        <div id="valoracionesDisplay"
            class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
            <div id="valoracionesDisplayBackdrop" class="fixed  top-0 left-0 w-full h-full bg-black opacity-50 hidden">
            </div>
            <div id="documentSelectorDisplay"
                class="bg-gray-100  lg:w-2/6 lg:h-3/4 h-4/5 mx-auto w-5/6 rounded-md border border-gray-200"
                style="backdrop-filter: blur(10px);">
                <div class="p-6 flex flex-col h-full justify-start">
                    <p class="text-xl font-bold">Valoraciones</p>
                    <p class="text-md">{{ $particularData->name }} ha recibido un total de 0 valoraciones</p>
                    <div class="flex py-2 gap-2">
                        <button
                            class="px-2 border border-gray-200 bg-gray-300 rounded-md hover:bg-gray-300 font-semibold">Todas</button>
                        <button class="px-2 border border-gray-200 rounded-md hover:bg-gray-200 font-semibold">Como
                            inquilino</button>
                        <button class="px-2 border border-gray-200 rounded-md hover:bg-gray-200 font-semibold">Como
                            propietario</button>
                    </div>
                    <br>
                    <div class="flex overflow-y-scroll lg:p-4 space-y-2 justify-start flex-col">
                        <div class="border-gray-200 border rounded-md bg-white lg:min-w-80">
                            <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus
                                repellendus
                                totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque
                                unde
                                eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                            <div class="flex gap-2 cursor-pointer p-4">
                                <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                                    src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                                    alt="">
                                <div class="flex flex-col">
                                    <p class="text-md font-bold">Nombre Apellidos</p>
                                    <p class="text-sm">Fecha</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-gray-200 border rounded-md bg-white lg:min-w-80">
                            <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus
                                repellendus
                                totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque
                                unde
                                eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                            <div class="flex gap-2 cursor-pointer p-4">
                                <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                                    src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                                    alt="">
                                <div class="flex flex-col">
                                    <p class="text-md font-bold">Nombre Apellidos</p>
                                    <p class="text-sm">Fecha</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-gray-200 border rounded-md bg-white lg:min-w-80">
                            <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus
                                repellendus
                                totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque
                                unde
                                eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                            <div class="flex gap-2 cursor-pointer p-4">
                                <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                                    src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                                    alt="">
                                <div class="flex flex-col">
                                    <p class="text-md font-bold">Nombre Apellidos</p>
                                    <p class="text-sm">Fecha</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-gray-200 border rounded-md bg-white lg:min-w-80">
                            <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus
                                repellendus
                                totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque
                                unde
                                eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                            <div class="flex gap-2 cursor-pointer p-4">
                                <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                                    src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                                    alt="">
                                <div class="flex flex-col">
                                    <p class="text-md font-bold">Nombre Apellidos</p>
                                    <p class="text-sm">Fecha</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="valoracionesDisplay" class="flex overflow-x-scroll p-4 space-x-2 justify-start">
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-end">
            <button class="hover:underline" id="valoracionesButton">
                Mostrar todas
            </button>
        </div>
        <br>
        <br>
        <div class="flex w-full justify-between md:flex-row flex-col">
            <h1 class="text-2xl font-bold">Anuncios</h1>

        </div>

        <div role="status" id="statusAnuncios" class="absolute bottom-3 right-1/2 z-10 hidden">
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
        <div id="anunciosDisplay" class="flex overflow-x-scroll p-4 space-x-2 justify-start">

            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
            <div class="border-gray-200 border rounded-md bg-white min-w-80">
                <p class="p-4">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam natus repellendus
                    totam eius aperiam accusantium placeat recusandae iure! Blanditiis veniam voluptatum itaque unde
                    eligendi consequatur officia ab, assumenda tempora placeat!"</p>
                <div class="flex gap-2 cursor-pointer p-4">
                    <img class="profile-button rounded-full h-12 w-auto p-1 flex items-center justify-center border-1 border border-gray-200 focus:outline-none cursor-pointer"
                        src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg"
                        alt="">
                    <div class="flex flex-col">
                        <p class="text-md font-bold">Nombre Apellidos</p>
                        <p class="text-sm">Fecha</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-end mb-6">
            <button class="hover:underline">
                Mostrar todos
            </button>
        </div>
        <br>
        <div class="flex justify-center gap-2 mb-4">
            <button id="reportButton"
                class="px-4 py-2 border border-gray-200 rounded-md hover:bg-gray-100 hover:border-red-700 flex gap-2 items-center hover:text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>

                Bloquear o denunciar
            </button>
            <button class="px-4 py-2 border border-gray-200 rounded-md hover:bg-gray-200 flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                </svg>

                Compartir
            </button>
        </div>
        <div id="reportDisplay" class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
            <div id="reportDisplayBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
            <div id="documentSelectorDisplay"
                class="bg-gray-100 lg:w-2/6  mx-auto w-5/6 rounded-md border border-gray-200"
                style="backdrop-filter: blur(10px);">
                <div class="p-6 flex flex-col h-full justify-start gap-2">
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        <p class="text-xl font-bold">Denunciar o bloquear</p>
                    </div>
                    <form class="px-4 py-2 w-full">
                        <div class="mb-2 border border-gray-200 rounded-md px-4 py-2 cursor-pointer hover:bg-gray-200">
                            <input type="checkbox" id="fraude" name="fraude" value="fraude"
                                class="mr-2 cursor-pointer">
                            <label for="fraude" class="text-gray-700 w-full cursor-pointer">Fraude o estafa</label>
                        </div>
                        <div class="mb-2 border border-gray-200 rounded-md px-4 py-2 cursor-pointer hover:bg-gray-200">
                            <input type="checkbox" id="offensive" name="offensive" value="offensive"
                                class="mr-2 cursor-pointer">
                            <label for="offensive" class="text-gray-700 w-full cursor-pointer">Comportamiento
                                ofensivo</label>
                        </div>
                        <div class="mb-2 border border-gray-200 rounded-md px-4 py-2 cursor-pointer hover:bg-gray-200">
                            <input type="checkbox" id="other" name="other" value="other"
                                class="mr-2 cursor-pointer">
                            <label for="other" class="text-gray-700 w-full cursor-pointer">Otro motivo</label>
                        </div>
                        <textarea placeholder="Cúentanos que ha pasado" name="explanation" id="explanation" cols="30" rows="10"
                            class="w-full mb-2 border border-gray-200 rounded-md px-4 py-2 cursor-pointer hover:bg-gray-200"></textarea>
                        <div class="w-full flex justify-end">
                            <button
                                class="px-4 py-2 border border-gray-200 rounded-md hover:bg-gray-200 flex gap-2 items-center">
                                Denunciar y bloquear
                            </button>
                        </div>
                    </form>
                    <div class="w-auto bg-gray-200 h-1 rounded-md mt-4 mx-4"></div>
                    <button
                        class="mx-4 my-5 px-4 py-2 border border-gray-200 rounded-md hover:bg-gray-100 hover:border-red-700 flex gap-2 items-center hover:text-red-700">
                        Bloquear solamente
                    </button>

                </div>
            </div>
        </div>
    </div>
    <script src="https://media.renthub.es/js/bigPictureProfilePic.js"></script>
    <script src="https://media.renthub.es/js/bigPictureValoraciones.js"></script>
    <script src="https://media.renthub.es/js/bigPictureReport.js"></script>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
