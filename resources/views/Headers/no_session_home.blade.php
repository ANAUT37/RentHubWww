@section('header')
    <div class="container mx-auto flex-row justify-around p-4" id="header" style="backdrop-filter: blur(8px);">
        <nav>
            <div
                class="max-w-7xl mx-auto flex justify-between items-start flex-col lg:flex-row sm:flex-col sm:align-middle ">
                <a href="/" class=" text-2xl font-bold mb-4 lg:mb-0 sm:mb-4 w-1/2 lg:w-auto sm:w-full lg:order-1 order-1">RêntHûb<span class="text-pink-700 text-2xl hover:text-black">.</span>es</a>

                <ul class="flex space-x-4">
                    <li><a href="/login" class="text-gray-600 font-bold hover:text-gray-950">Iniciar sesión</a></li>
                    <li><a href="/signup" class="text-gray-600 font-bold hover:text-gray-950">Registrarme</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <script>
        let category = document.getElementById('category');
        var locationInput = document.getElementById('locationInput');
        let searchInput = document.getElementById('searchInput')
        locationInput.addEventListener('focus', function() {
            category.classList.toggle('hidden');
        });
        searchInput.addEventListener('click', function() {
            var conceptName = $('#category').find(":selected").val();
            var locationInput = $('#locationInput').val();
            console.log('/search/' + conceptName + '/' + locationInput);
            location.assign('/search/' + conceptName + '/' + locationInput);
        });
    </script>
@endsection
