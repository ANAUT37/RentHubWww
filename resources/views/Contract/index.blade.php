@extends('Layouts.main')
@section('title', 'RêntHûb.es | Management')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    <div class="container flex-col gap-4 w-4/5 lg:w-2/3 mx-auto pt-2 flex h-full justify-between ">
        <div>
            <h1 class="text-2xl font-bold"><a href="{{ route('management.index') }}" class="hover:underline">Área de
                    Gestión</a> >
                Contratos</h1>
            <p class="text-lg">¡Hola, {{ App\Models\Particular::getParticularName(Auth::user()->id) }}!</p>
        </div>
        <div class="h-full">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4 mb-4">

                <a href="/management/contract/new" class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <br>
                    <p class="text-lg">Crear modelo de contrato</p>
                </a>
                <a href="/management/contract/history" class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <br>
                    <p class="text-lg">Historial</p>
                </a>
            </div>
        </div>
        <div class="h-full">
            <p class="text-2xl font-bold">Contratos</p>
            <br>
            <div class="w-full h-full ">
                <div class="w-full flex flex-col justify-center h-1/2 items-center py-10 hidden">
                    <p class="text-center font-bold text-xl">No se han encontrado resultados</p>
                    <p class="text-center text-lg">Conforme apruebes contratos aparecerán aquí</p>
                </div>
                <div class="flex overflow-y-auto h-auto flex-col gap-2 ">
                    @foreach ($userContracts as $item)
                        <a href="/management/contract/{{$item->display_id}}" class="bg-gray-100 w-full h-32 rounded-md hover:bg-gray-200 cursor-pointer flex p-4">
                            <div>
                                <p class="text-lg font-bold">
                                    Contrato
                                    @if ($item->display_name === '')
                                        #{{ $item->display_id }}
                                    @else
                                        {{ Str::ucfirst($item->display_name) }}
                                        (#{{ $item->display_id }})
                                    @endif
                                </p>
                                @if ($item->status === 0)
                                    <p class="text-lg ">Estado:
                                        <b class="text-lg text-yellow-500"> Inactivo</b>
                                    </p>
                                @else
                                    <p class="text-lg ">Estado:
                                        <b class="text-lg text-green-600"> Activo</b>
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
