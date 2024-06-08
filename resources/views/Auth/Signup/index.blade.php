@extends('Layouts.main')
@section('title', 'RêntHûb.es | Signup')
@section('header')
@include('Headers.header_manager')
@endsection
@section('content')
    <div class="container mx-auto py-12 px-4" id="contentDisplay">
        <div class="container mx-auto" id="form-plan">
            <h1 class="text-2xl font-bold mb-6 text-center">Selecciona un plan</h1>
            <p class="text-gray-600 mb-4 text-center">Selecciona el plan que mejor se ajuste a tus necesidades.</p>
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg lg:col-start-2 hover:border-gray-600 border flex flex-col">
                    <h2 class="text-xl font-semibold mb-4 align-middle">Particular Básico <span
                            class="inline-block px-3 py-1 text-sm font-semibold leading-tight text-white bg-pink-700 rounded-full ">Grátis</span>
                    </h2>
                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                    <h3 class="text-4xl font-semibold m-6 text-center">
                        0€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                    </h3>
                    <a href="/signup/particular"
                        class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                        py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">Seleccionar</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:border-gray-600 border lg:col-start-3 flex flex-col">
                    <h2 class="text-xl font-semibold mb-4">Particular Premium</h2>
                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                    <h3 class="text-4xl font-semibold m-6 text-center">
                        9,90€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                    </h3>
                    <a href="/signup/particular?type=premium"
                    class="text-center flex gap-1 hover:cursor-pointer  px-3 w-auto
                    py-2 rounded-md hover:bg-gray-200 bg-gray-100 focus:outline-none ">Seleccionar</a>
                </div>
                <div 
                    class="bg-white p-6 rounded-lg border-pink-700 shadow-lg hover:border-pink-700 border lg:col-start-4 col-span-1 flex flex-col">
                    <h2 class="text-xl font-semibold mb-4">Empresas</h2>
                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                    <h3 class="text-4xl font-semibold m-6 text-center">
                        29,90€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                    </h3>
                    <p 
                    class="text-center flex gap-1 border border-pink-700 align-center px-3 w-auto
                    py-2 rounded-md  ">¡Próximamente!</p>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
