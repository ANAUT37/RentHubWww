@extends('Layouts.main')
@section('title', 'RêntHûb.es | Management')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    <div class="container flex-col gap-4 w-4/5 lg:w-2/3 mx-auto pt-2 flex h-full justify-between ">
        <div>
            <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Nueva incidencia</h1>
        </div>
        <form id="formulario" action="/management/contract/{{$contractData->display_id}}/incidences/save" method="POST"
            enctype="multipart/form-data" class="mx-auto">
            @csrf
            <input type="hidden" name="contract_id" value="{{ $contractData->id }}">
            <input type="hidden" name="reported_by" value="{{ Auth::user()->id }}">
            <input type="hidden" name="incidence_id" value="{{ $incidence_id }}">
            <div class="mb-6 h-auto w-full">
                <label for="" class="block text-gray-700 mb-2"><b>Contrato:</b></label>
                <div class="flex items-center justify-between bg-gray-100  rounded-md px-4 py-2">
                    <div class="px-4 py-2  flex justify-between" data-contractid="{{ $contractData->id }}"
                        data-reportedby="{{ Auth::user()->id }}" data-incidenceid="{{ $incidence_id }}">
                        <div class="flex gap-2">
                            <div>
                                <p class="text-lg font-bold">
                                    @if ($contractData->display_name === '')
                                        Contrato #{{ $contractData->display_id }}
                                    @else
                                        Contrato: {{ Str::ucfirst($contractData->display_name) }}
                                        (#{{ $contractData->display_id }})
                                    @endif
                                </p>
                                <p>
                                    Categoría: {{ ucfirst($contractData->category) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <p class="text-sm pb-2">Se informará al propietario del inmueble sobre esta incidencia. Una vez que haya
                    sido respondida o solucionada, se te notificará.</p>
                <div class="text-sm pb-2">
                    ID Incidencia: <b>{{ $incidence_id }}</b>
                </div>
                <div class="flex w-full gap-4 flex-col">
                    <div>
                        <label for="incident-type" class="block text-gray-700 font-bold mb-2">Tipo de Incidencia:</label>
                        <select name="incident-type" id="incident-type"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600 cursor-pointer hover:bg-gray-200"
                            required>
                            <option value="none" disabled selected hidden>Tipo de Incidencia</option>
                            <option value="maintenance_issue">Problema de Mantenimiento</option>
                            <option value="repair_request">Solicitud de Reparación</option>
                            <option value="noise_complaint">Queja por Ruido</option>
                            <option value="neighbor_dispute">Disputa con Vecino</option>
                            <option value="damage_report">Reporte de Daño</option>
                            <option value="utility_issue">Problema de Servicios Públicos</option>
                            <option value="security_concern">Preocupación por Seguridad</option>
                            <option value="pest_infestation">Infestación de Plagas</option>
                            <option value="lease_violation">Violación de Contrato</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="insurance-company-name" class="block text-gray-700 font-bold mb-2">Descripción de la
                            incidencia: (Opcional)</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            name="description" id="description" rows="10" placeholder="Aporta información acerca de la incidencia aqui..."></textarea>
                    </div>

                </div>
                <br>
                <div class="mb-6">
                    <div class="mb-6 flex justify-end">
                        <input  type="submit" value="Crear"
                            class="next bg-gray-100  cursor-pointer  text-black px-6 w-auto py-2 rounded-md hover:bg-gray-200  focus:outline-none "></input>
                    </div>
                </div>
            </div>
        </form>
        <br>
    </div>
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
