@extends('Layouts.aside')
@section('title', 'RêntHûb.es | Help')
@section('header')
@include('Headers.header_manager')
@endsection
<style>
    .rotated{
        transform: rotate(90deg);
    }
</style>
<div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row">
    @section('aside')
        <aside class=" md:w-1/3 lg:w-1/4 py-4 md:block">
            <div class="sticky top-12 flex flex-col gap-2 p-2 border rounded-xl">
                <a href="/help" class="px-3 py-1 font-semibold hover:bg-indigo-50 rounded-md">
                    Inicio
                </a>
                <div class="menu-dropdown inline-flex flex-col items-start pl-1">
                    <div class="menu-trigger inline-flex items-center w-full hover:bg-indigo-50 rounded-md cursor-pointer">
                        <svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <button class="py-1 font-semibold">
                            Ayuda para inquilinos
                        </button>
                    </div>
                    <div class="flex flex-col p-2 hidden">
                        <a href="#" class="px-3 py-1 font-semibold hover:bg-indigo-50 rounded-md cursor-pointer w-full">Opción 1</a>
                        <a href="#" class="px-3 py-1 font-semibold hover:bg-indigo-50 rounded-md cursor-pointer w-full">Opción 2</a>
                    </div>
                </div>
                <div class="menu-dropdown inline-flex flex-col items-start pl-1">
                    <div class="menu-trigger inline-flex items-center w-full hover:bg-indigo-50 rounded-md cursor-pointer">
                        <svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" ></path>
                        </svg>
                        <button  class="py-1 font-semibold">
                            Ayuda para propietarios
                        </button>
                    </div>
                    <div class="flex flex-col p-2 hidden">
                        <a href="#" class="px-3 py-1 font-semibold">Opción 1</a>
                        <a href="#" class="px-3 py-1 font-semibold">Opción 2</a>
                    </div>
                </div>
                <div class="menu-dropdown inline-flex flex-col items-start pl-1">
                    <div class="menu-trigger inline-flex items-center w-full hover:bg-indigo-50 rounded-md cursor-pointer">
                        <svg class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <button class="py-1 font-semibold">
                            Otros temas
                        </button>
                    </div>
                    <div class="flex flex-col p-2 hidden">
                        <a href="#" class="px-3 py-1 font-semibold">Opción 1</a>
                        <a href="#" class="px-3 py-1 font-semibold">Opción 2</a>
                    </div>
                </div>

                <a href="" class="px-3 py-1 font-semibold opacity-90 hover:bg-indigo-50 rounded-md">
                    Ajustes
                </a>

                <a href="/contact"
                class="bg-gray-100 border border-gray-300 text-black px-6 py-2 text-center rounded-md hover:bg-gray-600 hover:text-white focus:outline-none ">
                    Ponte en contacto con <b>Support</b>
                </a>
            </div>
        </aside>
        <script>
            const menuTriggers = document.querySelectorAll('.menu-trigger');
            menuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    const menuContent = trigger.nextElementSibling;
                    const svgIcon = trigger.querySelector('svg');
                    svgIcon.classList.toggle('rotated');
                    menuContent.classList.toggle('hidden');
                });
            });
        </script>        
    @endsection
    @section('content')



        <main class="md:w-2/3 lg:w-3/4 w-full py-1 min-h-screen">

        </main>

    @endsection
</div>
@section('footer')
    @include('Footers.full_footer')
@endsection
