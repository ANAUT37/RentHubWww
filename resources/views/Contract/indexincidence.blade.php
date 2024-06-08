@extends('Layouts.main')
@section('title', 'RêntHûb.es | Management')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    @php
        use App\Models\Contract\ContractIncident;
    @endphp
    <div class="container flex-col gap-4 w-5/6 lg:w-2/3 mx-auto pt-2 flex h-full justify-between ">
        <div>
            <h1 class="text-2xl font-bold"><a href="{{ route('management.index') }}" class="hover:underline">Área de
                    Gestión</a> >
                <a href="/management/contract" class="hover:underline">Contratos</a> > <a class="hover:underline"
                    href="/management/contract/{{ $contractData->display_id }}">
                    @if ($contractData->display_name === '')
                        Contrato #{{ $contractData->display_id }}
                    @else
                        Contrato: {{ Str::ucfirst($contractData->display_name) }} (#{{ $contractData->display_id }})
                    @endif
                </a> > Incidencias
            </h1>
        </div>
        <div class="w-full flex justify-end mt-4">
            <a class="bg-gray-100 px-4 py-2 rounded-md hover:bg-gray-200"
                href="/management/contract/{{ $contractData->display_id }}/incidences/new">Crear incidencia</a>
        </div>
        <br>
        <div class="overflow-x-auto">
            <table class="w-full rounded-md">
                <thead>
                    <tr>
                        <th class="bg-gray-100 rounded-tl-md px-4 py-2">ID incidencia</th>
                        <th class="bg-gray-100 px-4 py-2">Estado</th>
                        <th class="bg-gray-100 px-4 py-2">Tipo</th>
                        <th class="bg-gray-100 px-4 py-2">Descripción</th>
                        <th class="bg-gray-100 px-4 py-2">Creada por</th>
                        <th class="bg-gray-100 rounded-tr-md px-4 py-2"></th>
                    </tr>
                </thead>
                @if (count($incidencesData) > 0)
                    <tbody>
                        @foreach ($incidencesData as $item)
                            <tr class="hover:bg-gray-200">
                                <td class="py-3 text-center">{{ $item->display_id }}</td>
                                <td class="py-3 text-center">
                                    @switch($item->status)
                                        @case('pending')
                                            Pendiente
                                        @break

                                        @case('solved')
                                            Resuelta
                                        @break

                                        @default
                                            Desconocido
                                    @endswitch
                                </td>
                                <td class="py-3 text-center">{{ ContractIncident::getTypeText($item->type) }}</td>
                                <td class="py-3 text-center">{{ ucfirst($item->description) }}</td>
                                <td class="py-3 text-center">{{ $item->reported_by }}</td>
                                <td
                                    class="py-3 text-center hover:bg-gray-300 flex justify-center items-center  cursor-pointer">
                                    <a
                                        href="/management/contract/{{ $contractData->display_id }}/incidences/{{ $item->display_id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        @else
            </table>
            <div class="w-full flex justify-center py-5">
                <p class="text-lg">No se han encontrado resultados</p>
            </div>

            @endif


        </div>
    </div>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
