@extends('Layouts.top')
@section('title', 'RêntHûb.es | Docs')
<script src="https://cdn.ckbox.io/ckbox/2.4.0/ckbox.js"></script>
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('top')
    <div class="sticky container mx-auto px-4 " style="backdrop-filter: blur(8px);">
        <div class="container lg:w-2/3 mx-auto border-b-gray-200 border-b pb-4">
            <h1 class="text-2xl font-bold">Documentos</h1>
            <br>
            <div class="flex justify-between">
                <input type="text" placeholder="Buscar en tus documentos" required
                    class="w-full lg:w-96 sm:w-64 px-2 py-1 border border-gray-300 rounded-md sm:rounded-l-md">
                <button id="newDocButton"
                    class="  bg-gray-100  px-3 py-1 rounded-md sm:rounded-r-md
                       hover:bg-gray-200">Nuevo</button>
            </div>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
            <br>
            <table class="w-full">
                <tr>
                    <th>Título</th>
                    <th>Última modificación</th>
                    <th>Opciones</th>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('content')
    @php
        use App\Models\Doc;
        $allDocs = Doc::getAll(Auth::user()->id);
    @endphp
    <div class="containergap-4 w-4/5 lg:w-2/3 mx-auto pt-2 mb-4 z-10">
        <div role="status" id="status" class="absolute top-1/4 right-1/2 mt-4">
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
            <div class="flex flex-col align-middle lg:p-3">
                <table class="w-full">
                    @foreach ($allDocs as $doc)
                        <tr class="border border-gray-100 rounded-md hover:bg-gray-100 cursor-pointer mb-2">
                            <td class="p-3">{{ $doc->title }}</td>
                            <td class="p-3">{{ $doc->updated_at }}</td>
                            <td class="p-3">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6 cursor-pointer dropdown-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                    <div
                                        class="absolute top-full right-0 hidden bg-white border border-gray-200 shadow-md py-1 px-2 w-48 rounded-md dropdown-menu">
                                        <a href="/docs/{{ $doc->display_id }}"
                                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Abrir</a>
                                        <a href="/docs/delete/{{ $doc->display_id }}"
                                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Eliminar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
        <div id="newDocDisplay" class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
            <div id="newDocDisplayBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
            <div id="newDocSelectorDisplay"
                class="bg-gray-100 lg:w-2/6 lg:h-1/4 h-2/5 mx-auto w-5/6 rounded-md border border-gray-200 flex p-5 gap-4 flex-col"
                style="backdrop-filter: blur(10px);">
                <p class="text-2xl font-bold">Nuevo documento</p>
                <form action="{{ route('docs.create') }}" method="POST" enctype="multipart/form-data"
                    class="flex justify-between gap-2">
                    @csrf
                    <input name="title" type="text" placeholder="Título para el documento" id="newDocTitle"
                        class="w-full px-2 py-1 border border-gray-300 rounded-md sm:rounded-l-md">

                    <button id="newDocButton" type="submit"
                        class="bg-white border border-gray-300 text-black px-3 py-1 rounded-md sm:rounded-r-md
                      hover:bg-gray-600 hover:text-white hover:border-gray-600">Crear</button>
                </form>

                <p>Se abrirá el editor de texto de tu documento en una nueva pestaña con tu nombre.</p>
            </div>
        </div>
    </div>
    @if ($action === 'new')
        <script>
            const newActionDocDisplay = document.getElementById('newDocDisplay');
            const newActionDocDisplayBackdrop = document.getElementById('newDocDisplayBackdrop');
            const newActionDocTitle = document.getElementById('newDocTitle');
            newActionDocDisplay.classList.toggle('hidden');
            newActionDocDisplayBackdrop.classList.toggle(
                'hidden');
            newActionDocTitle.focus()
        </script>
    @endif
    <script>
        const dropdownIcons = document.querySelectorAll('.dropdown-icon');
        dropdownIcons.forEach(icon => {
            icon.addEventListener('click', (event) => {
                event.stopPropagation();
                const dropdownMenu = icon.nextElementSibling;
                dropdownMenu.classList.toggle('hidden');
                document.addEventListener('click', closeDropdownMenu);
            });
        });

        function closeDropdownMenu(event) {
            const dropdownMenus = document.querySelectorAll('.dropdown-menu');
            dropdownMenus.forEach(menu => {
                if (!menu.contains(event.target)) {
                    menu.classList.add('hidden');
                    document.removeEventListener('click', closeDropdownMenu);
                }
            });
        }

        function openDoc(display_id) {
            var url = '/docs/' + display_id;

            window.open(url, '_blank');
        }
    </script>


    <script>
        const newDocButton = document.getElementById('newDocButton');
        const newDocDisplay = document.getElementById('newDocDisplay');
        const newDocDisplayBackdrop = document.getElementById('newDocDisplayBackdrop');

        newDocButton.addEventListener('click', function() {
            newDocDisplay.classList.toggle('hidden');
            newDocDisplayBackdrop.classList.toggle(
                'hidden');
        });

        newDocDisplayBackdrop.addEventListener('click', function() {
            newDocDisplay.classList.add('hidden');
            newDocDisplayBackdrop.classList.add(
                'hidden');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusElement = document.getElementById('status');
            const contentElement = document.getElementById('content');
            statusElement.classList.toggle('hidden');
            contentElement.classList.toggle('hidden');
        });
    </script>

@endsection
@section('footer')
@endsection
