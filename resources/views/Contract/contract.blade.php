@extends('Layouts.main')
@section('title', 'RêntHûb.es | Contrato')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    @php
        use App\Models\User;
        use App\Models\InmuebleImage;
        use App\Http\Controllers\InmuebleController;
        use App\Models\Contract\ContractIncident;
    @endphp
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center ">
        <h1 class="text-2xl font-bold"><a href="{{ route('management.index') }}" class="hover:underline">Área de Gestión</a> >
            <a href="/management/contract" class="hover:underline">Contratos</a> >
            @if ($contractData->display_name === '')
                Contrato #{{ $contractData->display_id }}
            @else
                Contrato: {{ Str::ucfirst($contractData->display_name) }} (#{{ $contractData->display_id }})
            @endif
        </h1>
        <br>
        <div class="flex w-full">
            @if ($contractData->status === 0)
                <p class="text-lg font-bold">Estado: <b class="text-lg text-yellow-500"> Inactivo</b></p>
            @else
                <p class="text-lg font-bold">Estado: <b class="text-lg text-green-600"> Activo</b></p>
            @endif
        </div>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4 mb-4">
            <a href="/management/contract/{{ $display_id }}/incidences"
                class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <br>
                <p class="text-lg">Ver incidencias</p>
            </a>

            <a href="/messages/{{ $contractData->chat_id }}"
                class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                </svg>
                <br>
                <p class="text-lg">Chat del inmueble</p>
            </a>
            <a href="/docs/{{ $contractData->document_id }}"
                class="bg-gray-100 rounded-md p-4 cursor-pointer hover:bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                <br>
                <p class="text-lg">Ver contrato</p>
            </a>
        </div>
        <br>
        <div class="w-full h-auto flex flex-col py-4">
            <p class="text-2xl font-bold">Información del contrato</p>
            <div class="grid grid-cols-2 md:grid-cols-4 p-2 gap-2 ">
                <div class="bg-gray-100 rounded-md p-4 flex flex-col items-center">
                    <p class="text-lg">Fecha inicio</p>
                    <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($contractData->start_date)->format('d-m-Y') }}
                    </p>
                </div>
                <div class="bg-gray-100 rounded-md p-4 flex flex-col items-center">
                    <p class="text-lg">Fecha final</p>
                    <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($contractData->end_date)->format('d-m-Y') }}
                    </p>
                </div>
                <div class="bg-gray-100 rounded-md p-4 flex flex-col items-center">
                    <p class="text-lg">Pago actual</p>
                    <p class="text-lg font-bold text-green-600"></p>
                </div>
                <div class="bg-gray-100 rounded-md p-4 flex flex-col items-center">
                    <p class="text-lg">Próximo pago</p>
                    <p class="text-lg font-bold"></p>
                </div>
                <div class="bg-gray-100 rounded-md p-4 flex flex-col items-center">
                    <p class="text-lg">Monto de Alquiler</p>
                    <p class="text-lg font-bold">{{ $contractData->price }}€</p>
                </div>
                <div class="bg-gray-100 rounded-md p-4 flex flex-col items-center">
                    <p class="text-lg">Frecuencia de Pago</p>
                    <p class="text-lg font-bold">{{ Str::ucfirst($contractData->payment_frequency) }}</p>
                </div>
                <div class="bg-gray-100 rounded-md p-4 flex flex-col items-center">
                    <p class="text-lg">Depósito de Seguridad</p>
                    <p class="text-lg font-bold">{{ $contractData->bail }}€</p>
                </div>
            </div>
        </div>
        <div class="w-full h-auto flex flex-col py-4 accordion-item">
            <div class="flex justify-between accordion-header cursor-pointer ">
                <p class="text-lg text-gray-800 font-bold">Historial de transacciones</p>
                <button id="toggleHistoryTransactions">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" class="icon-header">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </div>
            <div id="containerHistoryTransactions" class="accordion-content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante
                dapibus diam. Sed nisi.
            </div>
        </div>

        <div class="w-full h-auto flex flex-col py-4 ">
            <div class="flex justify-between accordion-header ">
                <p class="text-lg text-gray-800 font-bold">Información del inmueble</p>
            </div>
            <div id="containerHistoryTransactions" class=" py-4">
                <a href="/management/inmueble/{{ $inmuebleData->display_id }}"
                    class="px-4 py-5 cursor-pointer hover:bg-gray-200 flex justify-between bg-gray-100 rounded-md">
                    <div class="flex gap-4">
                        <div class="items-center flex">
                            @php
                                $inmuebleImageIds = InmuebleController::getInmuebleImages($inmuebleData->id);
                                $imageUrl = InmuebleImage::getImageFromUrl($inmuebleImageIds[0]->url_image);
                            @endphp
                            <img src="{{ $imageUrl }}" class="rounded-md w-16 h-12 object-cover" alt="">
                        </div>
                        <div>
                            <p class="text-lg">Categoría: {{ ucfirst($inmuebleData->category) }}</p>
                            <p class="text-lg">Dirección: {{ $inmuebleData->address }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="w-full h-auto flex flex-col py-4 accordion-item">
            <div class="flex justify-between accordion-header cursor-pointer">
                <p class="text-lg text-gray-800 font-bold">Información de participantes</p>
                <button id="toggleHistoryTransactions">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </div>
            <div class="gap-2 flex flex-col accordion-content py-2 hidden">
                @foreach ($contractParticipants as $item)
                    @php
                        $userData = User::getDataById($item->user_id);
                        $otherUserData = User::getTypedData(0, $userData->id);
                    @endphp
                    <a href="/user/{{ $userData->display_id }}" target="_blank"
                        class="w-100 bg-gray-100 hover:cursor-pointer flex hover:bg-gray-200 rounded-lg items-center">
                        <div class="p-4">
                            <img class="profile-button rounded-full h-10 w-10 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                                src="{{ App\Models\User::getProfilePic($userData->profile_pic_url) }}" alt="">
                        </div>
                        <div>
                            <div class="max-w-lg p-4 rounded-lg ">
                                <p class="text-lg"><b>{{ $otherUserData->name }} {{ $otherUserData->surname }}
                                        @if ($userData->id === Auth::user()->id)
                                            (Tú)
                                        @endif
                                    </b></p>
                                @if ($item->role === 'owner')
                                    <p class="text-lg">Propietario</p>
                                @else
                                    <p class="text-lg">Inquilino</p>
                                @endif

                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="w-full h-auto flex flex-col py-4">
            <p class="text-lg text-gray-800 font-bold">Servicios asociados</p>

        </div>
        <div class="w-full h-auto flex flex-col py-4 accordion-item">
            <div class="flex justify-between accordion-header cursor-pointer ">
                <p class="text-lg text-gray-800 font-bold">Historial de incidencias</p>
                <button id="toggleHistoryTransactions">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" class="icon-header">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
            </div>
            <div id="containerHistoryTransactions" class="accordion-content gap-2 py-5 flex flex-col hidden">
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
                                    <td class="py-3 text-center">{{ ucfirst($item->status) }}</td>
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
        <div class="w-full h-auto flex flex-col py-4">
            <p class="text-lg text-gray-800 font-bold">Normas del inmueble</p>
            <p class="">{{ $contractData->rules }}</p>
        </div>

        <script>
            const accordionItems = document.querySelectorAll('.accordion-item');
            accordionItems.forEach(item => {
                const header = item.querySelector('.accordion-header');
                const content = item.querySelector('.accordion-content');

                header.addEventListener('click', () => {
                    header.classList.toggle('active');
                    if (content.style.display === 'block') {
                        content.style.display = 'none';
                    } else {
                        content.style.display = 'block';
                    }
                });
            });
        </script>
    </div>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
