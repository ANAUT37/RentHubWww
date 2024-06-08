<div class="container w-full flex h-full text-gray-950 bg-gray-100 border-b-gray-200 mx-2 rounded-lg flex-col lg:flex-row" >
    <div class="carousel lg:w-1/2 w-full relative">
        <div class="relative h-56 overflow-hidden rounded-t-lg lg:rounded-l-lg lg:rounded-r-none sm:h-64 xl:h-80 2xl:h-96">
            <div class="carousel-item duration-700 ease-in-out">
                <img src="https://t3.ftcdn.net/jpg/05/85/86/44/360_F_585864419_kgIYUcDQ0yiLOCo1aRjeu7kRxndcoitz.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover -translate-x-1/2 -translate-y-1/2" alt="..." />
            </div>
            <div class="carousel-item hidden duration-700 ease-in-out">
                <img src="https://c0.wallpaperflare.com/preview/541/428/45/lake-lakeside-landscape-mountain-peak.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover -translate-x-1/2 -translate-y-1/2" alt="..." />
            </div>
            <div class="carousel-item hidden duration-700 ease-in-out">
                <img src="https://wallpapers-clan.com/wp-content/uploads/2023/11/cool-vaporwave-art-desktop-wallpaper-preview.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover  -translate-x-1/2 -translate-y-1/2" alt="..." />
            </div>
            <div class="carousel-item hidden duration-700 ease-in-out">
                <img src="https://img.freepik.com/foto-gratis/pintura-lago-montana-montana-al-fondo_188544-9126.jpg"
                    class="absolute left-1/2 top-1/2 block h-full object-cover -translate-x-1/2 -translate-y-1/2" alt="..." />
            </div>
        </div>
        <button type="button"
            class="carousel-prev group absolute left-0 top-0 z-5 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
            <span
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-200 hover:bg-slate-400 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                <svg class="h-4 w-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
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
                <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="hidden">Siguiente</span>
            </span>
        </button>
    </div>
    <div class="flex flex-col lg:w-1/2 w-full" id="in_list_anuncio">
        <p id="priceLabel" class="text-xl font-bold p-3 w-full">0€/mes</p>
        <p id="categoryLocationLabel" class="text-md pl-3 w-full"><b>Categoría</b> en <b>Dirección</b></p>
        <p id="categoryLocationLabel" class="text-sm w-full overflow-hidden line-clamp-4 px-3">Descripción. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis fugiat repudiandae vero magnam, nobis tenetur odit, itaque culpa iusto doloremque ullam veritatis sunt corrupti! Quis omnis doloremque labore molestiae deleniti?</p>
    </div>
</div>
<script>
    const in_list_anuncio = document.getElementById('in_list_anuncio');
    in_list_anuncio.addEventListener('click', function() {
        window.location.href = `/anuncio/1`;
    });

</script>
