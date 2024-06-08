@extends('Layouts.main')
@section('title', 'RêntHûb.es | Reciente')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('content')
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-lg mx-auto bg-white p-10 rounded-lg ">
            <h1 class="text-2xl font-bold mb-6">¡Has llegado al límite de tu suscripción!</h1>
            @if ($suscription->subscription_type == 'particular_basic')
                <div class="bg-gray-100  p-6 rounded-lg shadow-md">
                    <div class="flex  flex-col justify-between mb-6 items-start">
                        <div class="flex items-center">
                            <h2 class="text-2xl font-bold">Particular Básico</h2>
                        </div>
                        <br>
                        <div>
                            <h3 class="text-lg font-medium mb-2">Qúe incluye</h3>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Publicación de un anuncio</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Uso activo de un contrato</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Creación de 5 documentos</span>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <a href="/account/plan" target="_blank" class="hover:underline">Ver más información</a>
                        <br><br>
                        <div class="w-full flex gap-2 justify-between">
                            <div>
                                <span>Actualiza tu suscripción para acceder a más características</span>
                                <a href="/account/plan"
                                    class="border w-full hover:text-white border-gray-200 rounded-md h-10 flex py-2 px-4 justify-start items-center gap-2 hover:bg-pink-700 hover:border-none cursor-pointer mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Cambiar a suscripción Particular Premium
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
