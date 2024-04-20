@extends('Layouts.anuncio')
@section('title', 'RêntHûb.es | Anuncio')
@section('system-message')
@endsection
@section('header')
    @include('Headers.header_manager')
@endsection
@section('gallery')
    <div class="w-full h-screen fixed hidden inset-0 bg-white">

    </div>
@endsection
@section('content')
    <div
        class="max-w-7xl mx-auto flex flex-wrap justify-between items-start flex-row lg:flex-row sm:flex-col sm:align-middle mt-4">
        <div>
            <div class="relative gap-2 grid lg:grid-cols-2 sm:grid-cols-1">
                <div class="relative h-full">
                    <img class="h-full max-w-full  lg:rounded-l-lg object-cover"
                        src="https://flowbite.s3.amazonaws.com/docs/gallery/featured/image.jpg" alt="">
                    <div class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 rounded-l-lg"></div>
                </div>
                <div class="lg:grid grid-cols-2 gap-2 hidden ">
                    <div class="relative">
                        <img class="h-auto max-w-full  object-cover"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" alt="">
                        <div
                            class="absolute  inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 transition-opacity ">
                        </div>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-tr-lg object-cover"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" alt="">
                        <div class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 rounded-tr-lg">
                        </div>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full object-cover"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg" alt="">
                        <div class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15"></div>
                    </div>
                    <div class="relative">
                        <img class="h-auto max-w-full rounded-br-lg  object-cover"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" alt="">
                        <div class="absolute inset-0 cursor-pointer bg-gray-950 opacity-0 hover:opacity-15 rounded-br-lg">
                        </div>
                    </div>
                </div>
                <div
                    class="absolute bottom-5 right-5  bg-gray-100 border mt-2 flex gap-2 border-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>

                        <button class="">Ver galería completa</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-full mx-2 lg:w-8/12 flex flex-col align-middle lg:mx-auto">
            <div class="py-4 flex justify-between w-full px-2 lg:px-0">
                <div>
                    <h1 class="lg:text-2xl font-bold text-gray-950">Título</h1>
                    <p class="lg:text-2xl font-bold text-gray-700">Dirección</p>
                </div>
                <div class="text-end gap-">
                    <p class="lg:text-2xl font-bold text-gray-950">0€/mes</p>
                    <button
                        class="bg-gray-100 border mt-2 flex gap-2 border-gray-300 text-black px-4 py-1 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                        Ponerme en contacto
                    </button>
                </div>
            </div>
            <div class="flex justify-between flex-col sm:flex-row mb-2">
                <div class="flex justify-center">
                    <button
                        class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                    py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        Guardar</button>
                    <button id="shareButtonTop"
                        class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                    py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                        Compartir</button>
                </div>
                <div class="flex border justify-center border-gray-100 rounded-lg">
                    <button
                        class="rounded-l-lg w-full text-center flex gap-1 hover:cursor-pointer text-black px-3 justify-center
                    py-2 -l-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>
                        (0)
                    </button>
                    <button
                        class="rounded-r-lg text-center flex gap-1 hover:cursor-pointer text-black px-3 w-full justify-center
                    py-2  hover:bg-gray-600 hover:text-white focus:outline-none ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                        </svg>
                        (0)
                    </button>
                </div>
            </div>
            <div class="px-2 lg:px-0 w-full">
                <p class="text-sm lg:text-md text-gray-700">Información del anunciante</p>
                <div
                    class="w-full mt-1 hover:bg-gray-100 hover:cursor-pointer flex lg:flex-row flex-col justify-between items-start lg:items-center rounded-lg">
                    <div class="flex items-center">
                        <div class="px-1 ml-4">
                            <img class="profile-button rounded-full h-10 w-auto flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                                src="https://www.4x4.ec/overlandecuador/wp-content/uploads/2017/06/default-user-icon-8.jpg"
                                alt="">
                        </div>
                        <div>
                            <div class="max-w-lg p-4 rounded-lg ">
                                <p class="text-lg text-gray-950">Nombre Apellidos</p>
                                <p class="text-md text-gray-700">Particular</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row gap-2 items-center lg:flex-col px-4">
                        <div class="flex">
                            <p class="text-lg font-bold text-gray-950 mr-2">0.0</p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        </div>
                        <a href="/user/{user_id}/rating" class="hover:underline items-end">Ver valoraciones (0)</a>
                    </div>
                </div>
                <div class="mt-2 border-t border-gray-200 pt-2">
                    <p class="text-sm lg:text-md mb-2 text-gray-700">Información del inmueble</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam repellendus eaque laborum blanditiis
                        nulla
                        libero fuga expedita corrupti error obcaecati eos, numquam vitae cupiditate a laudantium
                        voluptatibus
                        ipsum nihil nemo! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo odio at
                        consequatur,
                        quam vitae tenetur explicabo quos facilis debitis saepe voluptatum in nobis dolore, vel tempora.
                        Tenetur
                        eaque excepturi ab.
                    </p>
                    <p class="lg:text-2xl font-bold text-gray-700 mt-2 mb-1">Características</p>
                    <div class="grid lg:grid-cols-12 grid-cols-4 md:grid-cols-6 mt-2">
                        <div class="flex flex-col items-center w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                            </svg>
                            <p class="text-sm lg:text-md text-gray-700">Dato</p>
                            <p class="text-lg text-gray-950 font-bold">Info</p>
                        </div>


                    </div>
                    <p class="lg:text-2xl font-bold text-gray-700 mt-2 mb-1">Localización</p>
                    <p>Dirección</p>
                    <div id="displayMap" class="w-full h-96 bg-slate-50 rounded-lg mt-2 relative">
                        <div role="status" id="status"
                            class="absolute inset-0 flex items-center justify-center z-0">
                            <svg aria-hidden="true"
                                class="w-6 h-6 text-gray-100 animate-spin dark:text-gray-300 fill-gray-950"
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
                    </div>
                    <br>
                    <div class="flex justify-between">
                        <div class="flex">
                            <button
                                class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                            py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                Guardar</button>
                            <button id="shareButton"
                                class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                            py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                </svg>
                                Compartir</button>
                        </div>
                        <div>
                            <button
                                class="text-center flex gap-1 hover:cursor-pointer text-black px-3 w-auto
                            py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                </svg>

                                Reportar
                            </button>
                        </div>
                    </div>
                    <br><br>
                    <p class="lg:text-2xl font-bold text-gray-700 mt-2 mb-1">También podria interesarte...</p>


                    <div id="shareDisplay" class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
                        <div id="shareDisplayBackdrop" class="fixed hidden top-0 left-0 w-full h-full bg-black opacity-50"></div>
                        <div id="documentSelectorDisplay" class="bg-gray-100 lg:w-2/6 lg:h-1/4 h-2/5 mx-auto w-5/6 rounded-md border border-gray-200" style="backdrop-filter: blur(10px);">
                            <div class="p-6 flex flex-col h-full justify-between">
                                <p class="text-xl font-bold">Compartir este anuncio</p>
                                <div class="flex gap-4 flex-wrap justify-between">
                                    <button id="shareFacebook" class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                        </svg>
                                        Facebook
                                    </button>
                                    <button id="shareWhatsApp" class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                            <path
                                                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                        </svg>
                                        WhatsApp
                                    </button>
                                    <button id="shareMail" class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                        </svg>
                                        Email
                                    </button>
                                    <button id="shareTwitter" class="flex flex-col align-middle items-center h-full py-8 lg:py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                            <path
                                                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                                        </svg>
                                        Twitter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>

    <script>
        const shareButtonTop = document.getElementById('shareButtonTop');
        const shareButton = document.getElementById('shareButton');
        const shareDisplay = document.getElementById('shareDisplay');
        const shareDisplayBackdrop = document.getElementById('shareDisplayBackdrop');

        shareButtonTop.addEventListener('click', function() {
            shareDisplay.classList.toggle('hidden');
            shareDisplayBackdrop.classList.toggle(
                'hidden'); // Asegúrate de mostrar u ocultar el backdrop junto con el shareDisplay
        });

        shareButton.addEventListener('click', function() {  
            shareDisplay.classList.toggle('hidden');
            shareDisplayBackdrop.classList.toggle(
                'hidden'); // Asegúrate de mostrar u ocultar el backdrop junto con el shareDisplay
        });

        shareDisplayBackdrop.addEventListener('click', function() {
            shareDisplay.classList.add('hidden');
            shareDisplayBackdrop.classList.add('hidden'); // Oculta el backdrop al hacer clic fuera del shareDisplay
        });
    </script>



    <script>
        // Compartir en Facebook
        const shareFacebookButton = document.getElementById('shareFacebook');
        shareFacebookButton.addEventListener('click', function() {
            const pageUrl = encodeURIComponent(window.location.href);
            const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
            window.open(facebookUrl, '_blank', 'width=600,height=300');
        });

        // Compartir en WhatsApp
        const shareWhatsAppButton = document.getElementById('shareWhatsApp');
        shareWhatsAppButton.addEventListener('click', function() {
            const pageUrl = encodeURIComponent(window.location.href);
            const whatsappUrl = `https://api.whatsapp.com/send?text=${pageUrl}`;
            window.open(whatsappUrl, '_blank', 'width=600,height=300');
        });

        // Compartir por correo electrónico
        const shareMailButton = document.getElementById('shareMail');
        shareMailButton.addEventListener('click', function() {
            const pageTitle = encodeURIComponent(document.title);
            const pageUrl = encodeURIComponent(window.location.href);
            const mailUrl = `mailto:?subject=${pageTitle}&body=${pageUrl}`;
            window.open(mailUrl, '_blank', 'width=600,height=300');
        });

        // Compartir en Twitter
        const shareTwitterButton = document.getElementById('shareTwitter');
        shareTwitterButton.addEventListener('click', function() {
            const pageTitle = encodeURIComponent(document.title);
            const pageUrl = encodeURIComponent(window.location.href);
            const tweetUrl = `https://twitter.com/intent/tweet?url=${pageUrl}&text=${pageTitle}`;
            window.open(tweetUrl, '_blank', 'width=600,height=300');
        });
        
    </script>






    <br><br><br>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
