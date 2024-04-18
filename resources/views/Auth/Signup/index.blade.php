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
                            class="inline-block px-3 py-1 text-sm font-semibold leading-tight text-white bg-blue-400 rounded-full ">Grátis</span>
                    </h2>
                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                    <h3 class="text-4xl font-semibold m-6 text-center">
                        0€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                    </h3>
                    <a href="/signup/particular"
                        class="text-center bg-gray-100 border border-gray-300 hover:cursor-pointer text-black px-6 w-full py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">Seleccionar</a>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:border-gray-600 border lg:col-start-3 flex flex-col">
                    <h2 class="text-xl font-semibold mb-4">Particular Premium</h2>
                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                    <h3 class="text-4xl font-semibold m-6 text-center">
                        10€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                    </h3>
                    <a href="/signup/particular?p=1"
                    class="text-center bg-gray-100 border border-gray-300 hover:cursor-pointer text-black px-6 w-full py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">Seleccionar</a>
                </div>
                <div 
                    class="bg-white p-6 rounded-lg border-blue-400 shadow-lg hover:border-blue-400 border lg:col-start-4 col-span-1 flex flex-col">
                    <h2 class="text-xl font-semibold mb-4">Empresas</h2>
                    <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</p>
                    <h3 class="text-4xl font-semibold m-6 text-center">
                        30€<span class="text-sm font-semibold mb-4 text-center">/mes</span>
                    </h3>
                    <a href="/signup/empresa"
                    class="text-center bg-gray-100 border border-gray-300 hover:cursor-pointer text-black px-6 w-full py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">Seleccionar</a>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
