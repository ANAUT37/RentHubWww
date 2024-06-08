@php
    use App\Models\Inmueble;
    $inmuebleData = Inmueble::getById($anuncio->inmueble_id);
@endphp

<div
    class="container w-full flex h-full text-gray-950 bg-gray-100 border-b-gray-200 mx-2 rounded-lg flex-col lg:flex-row">
    <div class="carousel lg:w-1/2 w-full relative">
        <div
            class="relative h-56 overflow-hidden rounded-t-lg lg:rounded-l-lg lg:rounded-r-none sm:h-64 xl:h-80 2xl:h-96">
            <div class="carousel-item duration-700 ease-in-out">
                <img src="https://t3.ftcdn.net/jpg/05/85/86/44/360_F_585864419_kgIYUcDQ0yiLOCo1aRjeu7kRxndcoitz.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover -translate-x-1/2 -translate-y-1/2"
                    alt="..." />
            </div>
            <div class="carousel-item hidden duration-700 ease-in-out">
                <img src="https://c0.wallpaperflare.com/preview/541/428/45/lake-lakeside-landscape-mountain-peak.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover -translate-x-1/2 -translate-y-1/2"
                    alt="..." />
            </div>
            <div class="carousel-item hidden duration-700 ease-in-out">
                <img src="https://wallpapers-clan.com/wp-content/uploads/2023/11/cool-vaporwave-art-desktop-wallpaper-preview.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover  -translate-x-1/2 -translate-y-1/2"
                    alt="..." />
            </div>
            <div class="carousel-item hidden duration-700 ease-in-out">
                <img src="https://img.freepik.com/foto-gratis/pintura-lago-montana-montana-al-fondo_188544-9126.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover -translate-x-1/2 -translate-y-1/2"
                    alt="..." />
            </div>
        </div>
        <button type="button"
            class="carousel-prev group absolute left-0 top-0 z-5 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
            <span
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 hover:bg-slate-400 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                <svg class="h-4 w-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="hidden">Anterior</span>
            </span>
        </button>
        <button type="button"
            class="carousel-next group absolute right-0 top-0 z-5 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
            <span
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 hover:bg-slate-400 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="hidden">Siguiente</span>
            </span>
        </button>
    </div>
    <div class="flex flex-col lg:w-1/2 w-full justify-between">
        <div id="in_list_anuncio" class="h-full gap-1 flex flex-col cursor-pointer">
            <p id="priceLabel" class="text-xl font-bold p-3 w-full">{{ $anuncio->price }}€/mes</p>
            <p id="categoryLocationLabel" class="text-md pl-3 w-full">{{ ucfirst($anuncio->title) }}</p>
            <p id="categoryLocationLabel" class="text-md pl-3 w-full"><b>{{ ucfirst($anuncio->category) }}</b> en
                <b>{{ $inmuebleData->address }}</b>
            </p>
            <p id="categoryLocationLabel" class="text-sm w-full overflow-hidden line-clamp-4 px-3">
                {{ $anuncio->description }}</p>
        </div>
        <div class="flex justify-between p-4 gap-2 w-full border-t border-gray-200">
            <div class="flex gap-2">
                <a id="editAnuncioButton" href="/anuncio/stats/{{ $anuncio->display_id }}"
                    class="bg-gray-200   px-3 py-1 rounded-md sm:rounded-r-md
               hover:bg-gray-300 cursor-pointer flex gap-2"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Estadísticas
                </a>
                <a href="/anuncio/{{ $anuncio->display_id }}"
                    class="bg-gray-200   px-3 py-1 rounded-md sm:rounded-r-md
               hover:bg-gray-300 cursor-pointer flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Visitar
                </a>
            </div>

            <div class="flex gap-2">
                <a id="editAnuncioButton" href="/anuncio/edit/{{ $anuncio->display_id }}"
                    class="px-3 py-1 rounded-md sm:rounded-r-md bg-gray-200
              hover:bg-gray-300  hover:border-gray-600 cursor-pointer flex gap-2"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Editar</a>
                <a id="editAnuncioButton" href="/anuncio/delete/{{ $anuncio->display_id }}"
                    class="bg-gray-200  px-3 py-1 rounded-md sm:rounded-r-md
                hover:bg-red-600 hover:text-white cursor-pointer flex gap-2"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>

                    Eliminar</a>
            </div>

        </div>
    </div>
</div>
