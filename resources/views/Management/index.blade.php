@extends('Layouts.main')
@section('title', 'RêntHûb.es | Management')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center ">
        <h1 class="text-2xl font-bold">Área de Géstión</h1>
        <p class="text-lg">¡Hola, {{ App\Models\Particular::getParticularName(Auth::user()->id) }}!</p>
        <br>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4 mb-4">
            <a href="{{ route('management.contracts') }}" class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                  </svg>
                  
                <br>
                <p class="text-lg">Contratos</p>
            </a>

            <a href="{{ route('docs.index') }}" class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                  </svg>
                  
                <br>
                <p class="text-lg">Documentos</p>
            </a>
            <a href="{{ route('management.anuncios') }}" class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>                  
                <br>
                <p class="text-lg">Mis anuncios</p>
            </a>
        </div>
        <h1 class="text-2xl font-bold">Novedades recientes</h1>
    </div>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
