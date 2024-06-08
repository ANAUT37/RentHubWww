@extends('Layouts.main')
@section('title', 'RêntHûb.es | Management')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    @php
        use App\Models\InmuebleImage;
        use App\Http\Controllers\InmuebleController;
    @endphp
    <div class="container flex-col gap-4 w-4/5 lg:w-2/3 mx-auto pt-2 flex  h-full justify-between overflow-y-auto">
        <div>
            <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Solicitud de contrato</h1>
        </div>
        <div class="mb-6 h-auto w-full">
            <div class="w-full h-auto flex flex-col ">
                <p class="text-2xl font-bold mb-2">Condiciones del contrato:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 ">
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
            <div class="w-full h-auto flex flex-col py-4">
                <p class="text-lg text-gray-800 font-bold">Normas del inmueble</p>
                <p class="">{{ $contractData->rules }}</p>
            </div>
            <br>
            <p class="text-2xl font-bold ">Pagos:</p>
            <div class="w-full h-auto flex flex-col py-4">
                <p class="text-lg text-gray-800 font-bold">Proceso de pago</p>
                <input type="hidden" name="payment_process" id="payment_process"
                    value="{{ $contractData->payment_process }}">
                @if ($contractData->payment_process === 'automatic')
                    <div class="px-6 py-4 rounded-md bg-gray-100 flex justify-between">
                        <div>
                            <p class="text-lg font-semibold">Automático a través de RêntHûb.es (Con comisiones)</p>
                            <p class="text-sm text-gray-700">
                                Mediante este proceso, se realizará el cobro del alquiler a la tarjeta o cuenta bancaria
                                asociada del inquilino y se transferirá automáticamente a la cuenta del propietario.
                                <b>IMPORTANTE:</b> Este método tiene unos gastos de gestión aplicados al monto que recibirá
                                el propeitario.
                            </p>
                        </div>
                    </div>
                    <p class="text-lg text-gray-800 font-bold mt-2">Método de pago</p>

                    <div class="mb-6 h-auto w-full">
                        <p class="text-sm pb-2">Seleccione una tarjeta de credito de la que cobrará el monto del alquiler.
                        </p>
                        @if (count($creditCardData) > 0)
                            <div class="relative">
                                <div class="flex items-center justify-between bg-white border border-gray-300 rounded-md px-4 py-2 cursor-pointer"
                                    id="selectBankButton">
                                    <span class="mr-2">Selecciona una cuenta bancaria</span>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path d="M10 12l-4-4h8z" />
                                    </svg>
                                </div>
                                <div class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-b-md hidden"
                                    id="optionsBankContainer">
                                    @foreach ($creditCardData as $item)
                                        <div class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex justify-between"
                                            data-bankid="{{ $item->id }}">
                                            <div>
                                                <p>Número: {{ ucfirst($item->number) }}</p>
                                                <p>Fecha Exp.: {{ $item->expiration_month }}/{{ $item->expiration_year }}
                                                </p>
                                                <p>CVV: ***</p>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="creditCard" id="creditCard" value="">
                            </div>
                        @endif
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const selectBankButton = document.getElementById('selectBankButton');
                            const optionsBankContainer = document.getElementById('optionsBankContainer');
                            const bankAccountInput = document.getElementById('creditCard');

                            selectBankButton.addEventListener('click', function() {
                                optionsBankContainer.classList.toggle('hidden');
                            });

                            optionsBankContainer.querySelectorAll('div[data-bankid]').forEach(option => {
                                option.addEventListener('click', function() {
                                    const selectedBankOption = option.querySelector('p').textContent;
                                    const bankId = option.dataset.bankid;
                                    selectBankButton.querySelector('span').textContent = selectedBankOption;
                                    optionsBankContainer.classList.add('hidden');
                                    bankAccountInput.value = bankId;
                                });
                            });
                        });
                    </script>
                    <div>
                        <a href="/account/payments/wallet?action=new&item=creditcard" target="_blank"
                            class="w-full bg-gray-100 cursor-pointer hover:bg-gray-200 px-4 py-2 rounded-md">
                            Agregar tarjeta de crédito</a>
                    </div>
                @else
                    <div class="px-6 py-4 rounded-md bg-gray-100 flex justify-between gap-2" data-paymentprocess="manual">
                        <div>
                            <p class="text-lg font-semibold">Manual (Gratuito)</p>
                            <p class="text-sm text-gray-700">
                                Mediante este proceso, el inquilino será responsable de realizar la transferencia del
                                monto del alquiler a la cuenta bancaria asociada al contrato. No se cobran comisiones en
                                este método.
                            </p>
                        </div>
                    </div>
                @endif
            </div>


        </div>
        @if (isset($ensurancesData))
            @if (count($ensurancesData) > 0)
                <div class="mb-6 h-auto w-full">
                    <div class="w-full h-auto flex flex-col">
                        <p class="text-2xl font-bold mb-2">Servicios asociados:</p>
                        <div class="flex gap-2 w-full flex-col">
                            <p class="text-lg text-gray-800 font-bold">Seguros</p>
                            @foreach ($ensurancesData as $index => $item)
                                <div
                                    class="flex items-center flex-col justify-between bg-gray-100 w-full rounded-md px-4 py-2 mb-4">
                                    <div class="bg-white rounded-md p-6 max-w-4xl mx-auto">
                                        <p class="text-lg text-gray-800 font-bold mb-2">Seguro #{{ $index + 1 }}</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Tipo de Seguro</p>
                                                <p class="text-lg font-medium">{{ $item->type }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Compañía Aseguradora</p>
                                                <p class="text-lg font-medium">{{ $item->company_name }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Número de Póliza</p>
                                                <p class="text-lg font-medium">{{ $item->policy_number }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Fecha de Inicio</p>
                                                <p class="text-lg font-medium">{{ $item->start_insurance_date }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Fecha de Finalización</p>
                                                <p class="text-lg font-medium">{{ $item->end_insurance_date }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Descripción</p>
                                                <p class="text-lg font-medium">{{ $item->description }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Monto Asegurado</p>
                                                <p class="text-lg font-medium">{{ $item->insured_amount }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Costo del Seguro</p>
                                                <p class="text-lg font-medium">{{ $item->insurance_cost }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Información de Contacto</p>
                                                <p class="text-lg font-medium">{{ $item->contact_information }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <div class="mb-6 h-auto w-full">
            <p class="text-2xl font-bold mb-2">Acerca del inmueble:</p>
            <div class="flex items-center justify-between bg-gray-100  rounded-md px-4 py-2">
                <div class="flex gap-2 px-4 py-2 flex-col w-full">
                    <div class="overflow-x-auto w-full">
                        <div id="galleryDisplay" class="flex space-x-4">
                            @foreach ($listOfImages as $item)
                                <div class="relative flex-shrink-0 w-32 h-24 cursor-pointer pb-2">
                                    <img class="w-full h-full object-cover rounded-lg"
                                        src="{{ InmuebleImage::getImageFromUrl($item->url_image) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-between w-full items-center">
                        <div class="flex justify-start gap-4">
                            <div class="mb-4">
                                <p class="text-sm text-gray-500">Categoría</p>
                                <p class="text-lg font-medium">{{ ucfirst($inmuebleData->category) }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm text-gray-500">Dirección</p>
                                <p class="text-lg font-medium">{{ ucfirst($inmuebleData->address) }}</p>
                            </div>
                        </div>
                        <div>
                            <a href="/inmueble/{{ $inmuebleData->display_id }}" target="_blank"
                                class="px-2 py-1 rounded-md bg-gray-200 hover:bg-gray-300 h-auto">Ver información
                                completa</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="mb-6 h-auto w-full">
            <p class="text-2xl font-bold mb-2">Acerca del propietario:</p>
            <div class="flex items-center justify-between bg-gray-100  rounded-md px-4 py-2">
                <div>
                    <div class="w-100 hover:bg-gray-100 hover:cursor-pointer flex rounded-lg">
                        <div class="p-4">
                            <img class="profile-button rounded-full h-10 w-10 flex items-center justify-center border-1 border border-gray-200 focus:outline-none"
                                src="{{ App\Models\User::getProfilePic($ownerData->profile_pic_url) }}" alt="">
                        </div>
                        <div>
                            <a class="max-w-lg p-4 rounded-lg ">
                                <p class="text-lg"><b>{{ $ownerTypedData->name }} {{ $ownerTypedData->surname }}</b></p>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="/user/{{ $ownerData->display_id }}" target="_blank"
                        class="px-2 py-1 rounded-md bg-gray-200 hover:bg-gray-300 h-auto">Ver perfil</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <div class="sticky left-0 mx-0 bottom-0 min-h-32 sm:min-h-56 bg-gray-100 w-full z-20 border-t border-gray-100 ">
        <div class="flex w-full mx-auto min-h-full justify-center p-6 md:p-12 flex-col items-center gap-3">
            <p id="errorText" class="text-red-500"></p>
            @if ($requestData->status == 'pending')
                <p>Antes de aceptar o rechazar la solicitud de contrato lee atentamente las condiciones de este.</p>
                <div class=" w-auto flex gap-8">
                    <button id="acceptButton"
                        class="bg-gray-200 hover:bg-gray-300 rounded-md px-4 py-2 font-bold">Aceptar</button>
                    <button id="declineButton"
                        class="bg-gray-200 hover:bg-red-200 rounded-md px-4 py-2 font-bold">Rechazar</button>
                </div>
            @endif
            @if ($requestData->status == 'accept')
                <p class="text-lg">Esta solicitud de contrato ya ha sido aceptada.</p>
            @endif
            @if ($requestData->status == 'decline')
                <p class="text-lg">Esta solicitud de contrato ya ha sido rechazada.</p>
            @endif
        </div>
    </div>
    @if ($requestData->status == 'pending')
        <script>
            var acceptButton = document.getElementById('acceptButton');
            var declineButton = document.getElementById('declineButton');

            acceptButton.addEventListener('click', function() {
                manageRequest('accept');
            });
            declineButton.addEventListener('click', function() {
                manageRequest('decline');
            });

            function manageRequest(action) {
                var creditCard = document.getElementById('creditCard');
                var paymentProcess = document.getElementById('payment_process');
                var requestBody = {
                    'action': action,
                };

                if (paymentProcess.value === 'automatic') {
                    if (creditCard.value !== '') {
                        requestBody['creditCard'] = creditCard.value;
                        requestBody['payment_process'] = paymentProcess.value;
                    } else {
                        var errorText = document.getElementById('errorText');
                        errorText.textContent = 'Debes seleccionar una tarjeta de crédito';
                        return;
                    }
                }
                fetch('/management/contract/{{ $display_id }}/request/handle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(requestBody)
                    })
                    .then(response => response.json())
                    .then(data => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        </script>
    @endif


    @include('Footers.small_footer')
@endsection
