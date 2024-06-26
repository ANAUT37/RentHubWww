@extends('Layouts.main')
@section('title', 'RêntHûb.es | Reciente')
@section('header')
    @include('Headers.sessioned')
@endsection
@section('content')
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center">
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
            <div class="flex justify-start gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>

                <p class="text-2xl font-bold">Búsquedas seguidas</p>
            </div>
            <div class="container mx-auto p-4 gap-2 flex flex-col h-max-96 overflow-y-auto">
                @if (count($followedList) === 0)
                <div class="w-full h-full flex justify-center ">
                    <div class="w-1/2 flex flex-col justify-center h-1/2 items-center py-20">
                        <p class="text-center font-bold text-xl">No se han encontrado resultados</p>
                        <p class="text-center text-lg">Prueba a realizar una búsqueda</p>
                    </div>
                </div>
                @else
                    @foreach ($followedList as $item)
                        <a class="hover:bg-gray-100 cursor-pointer lg:p-3 flex justify-between rounded-md"
                            href="/search/{{ $item->category }}/{{ $item->address }}">
                            <div>
                                <p class="lg:text-lg font-bold">{{ $item->address }}</p>
                                <p class="lg:text-md text-sm font-bold">{{ ucfirst($item->category) }}</p>
                                <p class="text-xs">{{ $item->created_at }}</p>
                            </div>
                            <div class="items-center flex">
                                <button class="hover:border border-gray-100 rounded-md p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            <br>
            <br>
            <div class="flex justify-start gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <p class="text-2xl font-bold">Historial de búsquedas</p>
            </div>
            <div class="container mx-auto p-4 gap-2 flex flex-col h-max-96 overflow-y-auto">
                @if (count($historyList) === 0)
                <div class="w-full h-full flex justify-center ">
                    <div class="w-1/2 flex flex-col justify-center h-1/2 items-center py-20">
                        <p class="text-center font-bold text-xl">No se han encontrado resultados</p>
                        <p class="text-center text-lg">Cuando hagas búsquedas aparecerán aquí.</p>
                    </div>
                </div>
                @else
                    @foreach ($historyList as $item)
                        <a class="hover:bg-gray-100 cursor-pointer lg:p-3 flex justify-between rounded-md"
                            href="/search/{{ $item->category }}/{{ $item->address }}">
                            <div>
                                <p class="lg:text-lg font-bold">{{ $item->address }}</p>
                                <p class="lg:text-md text-sm font-bold">{{ ucfirst($item->category) }}</p>
                                <p class="text-xs">{{ $item->created_at }}</p>
                            </div>
                            <div class="items-center flex">
                                <button class="hover:border border-gray-100 rounded-md p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
            <br>
            <br>
            <div class="flex justify-start gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <p class="text-2xl font-bold">Anuncios visitados</p>
            </div>
            <div class="container mx-auto p-4 gap-2 flex flex-col h-max-96 overflow-y-auto">
                @if (count($historyList) > 0)
                <div class="w-full h-full flex justify-center ">
                    <div class="w-1/2 flex flex-col justify-center h-1/2 items-center py-20">
                        <p class="text-center font-bold text-xl">No se han encontrado resultados</p>
                        <p class="text-center text-lg">Prueba a explorar los anuncios de la comunidad</p>
                    </div>
                </div>
                @else
                    @foreach ($historyList as $item)
                        <a class="hover:bg-gray-100 cursor-pointer lg:p-3 flex justify-between rounded-md"
                            href="/search/{{ $item->category }}/{{ $item->address }}">
                            <div>
                                <p class="lg:text-lg font-bold">{{ $item->address }}</p>
                                <p class="lg:text-md text-sm font-bold">{{ ucfirst($item->category) }}</p>
                                <p class="text-xs">{{ $item->created_at }}</p>
                            </div>
                            <div class="items-center flex">
                                <button class="hover:border border-gray-100 rounded-md p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script src="https://media.renthub.es/js/loader.js"></script>
    <script src="https://media.renthub.es/js/acquisitions.js"></script>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
