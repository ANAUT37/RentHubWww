@extends('Layouts.main')
@section('title', 'RêntHûb.es | New')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    <style>
        .step {
            background-color: rgb(59 130 246);
            color: white;
        }
    </style>
    @php
        use App\Models\InmuebleImage;
        use App\Http\Controllers\InmuebleController;
    @endphp
    <div class="container mx-auto py-12 px-4 max-w-2xl" id="particularForm">
        <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Crear contrato</h1>
        <form id="formulario" action="/management/contract/save" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6 h-auto w-full">
                <label for="" class="block text-gray-700 mb-2"><b>Inmueble:</b></label>
                <p class="text-sm pb-2">Seleccione el inmueble para el cual se va a crear el contrato de alquiler.</p>
                <div>
                    <x-input-error :messages="$errors->get('inmuebleId')" class="mt-2" />
                </div>
                @if (count($userInmuebles) > 0)
                    <div class="relative">
                        <div class="flex items-center justify-between bg-white border border-gray-300 rounded-md px-4 py-2 cursor-pointer"
                            id="selectButton">
                            <x-input-error :messages="$errors->get('inmuebleId')" class="mt-2" />
                            <span class="mr-2">Selecciona un inmueble</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 12l-4-4h8z" />
                            </svg>
                        </div>
                        <div class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-b-md hidden"
                            id="optionsContainer">
                            @foreach ($userInmuebles as $item)
                                <div class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex justify-between"
                                    data-inmuebleid="{{ $item->id }}" data-category="{{ $item->category }}">
                                    <div class="flex gap-2">
                                        <div class="items-center flex">
                                            @php
                                                $inmuebleImageIds = InmuebleController::getInmuebleImages($item->id);
                                                $imageUrl = InmuebleImage::getImageFromUrl(
                                                    $inmuebleImageIds[0]->url_image,
                                                );
                                            @endphp
                                            <img src="{{ $imageUrl }}" class="rounded-md w-16 h-12 object-cover"
                                                alt="">
                                        </div>
                                        <div>
                                            <p>Categoría: {{ ucfirst($item->category) }}</p>
                                            <p>Dirección: {{ $item->address }}</p>
                                        </div>
                                    </div>
                                    <div class="items-center flex">
                                        <a href="/management/inmueble/{{ $item->display_id }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="inmuebleId" id="inmuebleId" value="">
                    </div>
                @endif
            </div>
            <div>
                <a href="/management/inmueble/new" target="_blank"
                    class="w-full  bg-gray-100 cursor-pointer hover:bg-gray-200 px-4 py-2 rounded-md">
                    Crear nuevo inmueble</a>
            </div>
            <br>
            <div class="mb-6 flex gap-2">
                <div class="w-1/2">
                    <label class="block text-gray-700 font-bold mb-2">Categoría:</label>
                    <div id="categoryField"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600 min-h-10">
                        -</div>
                </div>
            </div>
            <br>
            <p class="block text-lg font-bold mb-2">Información del contrato</p>
            <div class="mb-6 h-auto w-full">
                <p class="text-sm pb-2">Seleccione uno de sus documentos con la Información del contrato.</p>
                <x-input-error :messages="$errors->get('docId')" class="mt-2" />
                @if (count($userDocs) > 0)
                    <div class="relative">
                        <div class="flex items-center justify-between bg-white border border-gray-300 rounded-md px-4 py-2 cursor-pointer"
                            id="selectDocButton">
                            <span class="mr-2">Selecciona un documento</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 12l-4-4h8z" />
                            </svg>
                        </div>
                        <div class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-b-md hidden"
                            id="optionsDocContainer">
                            @foreach ($userDocs as $item)
                                <div class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex justify-between"
                                    data-docid="{{ $item->display_id }}">
                                    <div>
                                        <p>Título: {{ ucfirst($item->title) }}</p>
                                    </div>
                                    <div class="items-center flex">
                                        <a href="/docs/{{ $item->display_id }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="docId" id="docId" value="">
                    </div>
                @endif
            </div>
            <div>
                <a href="/docs?action=new" target="_blank"
                    class="w-full  bg-gray-100 cursor-pointer hover:bg-gray-200 px-4 py-2 rounded-md">
                    Crear nuevo documento</a>
            </div>
            <br>
            <br>
            <div class="mb-6 flex gap-2">
                <div class="w-1/2">
                    <label for="start" class="block text-gray-700 font-bold mb-2">Fecha de inicio:</label>
                    <input type="date" id="start" name="start"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Inicio" required value="{{ old('start') }}">
                    <x-input-error :messages="$errors->get('start')" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <label for="end" class="block text-gray-700 font-bold mb-2">Fecha de fin:</label>
                    <input type="date" id="end" name="end"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Final" required value="{{ old('end') }}">
                        <x-input-error :messages="$errors->get('end')" class="mt-2" />
                </div>
            </div>
            <div class="mb-6 flex gap-2">
                <div class="w-1/2">
                    <label for="paymentFrequence" class="block text-gray-700 font-bold mb-2">Frecuencia de pago:</label>
                    <select name="paymentFrequence" id="paymentFrequence"  value="{{ old('paymentFrequence') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                        <option value="mensual">Mensual</option>
                        <option value="trimestral">Trimestral</option>
                        <option value="semestral">Semestral</option>
                        <option value="anual">Anual</option>
                    </select>
                    <x-input-error :messages="$errors->get('paymentFrequence')" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Monto de alquiler: (Precio)</label>
                    <input type="number" id="price" name="price"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Pago" required value="{{ old('price') }}">
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
            </div>
            <div class="mb-6 flex gap-2">
                <div class="w-1/2">
                    <label for="fianza" class="block text-gray-700 font-bold mb-2">Depósito de seguridad:
                        (Fianza)</label>
                    <input type="number" id="fianza" name="fianza"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="0€" required value="{{ old('fianza') }}">
                    <x-input-error :messages="$errors->get('fianza')" class="mt-2" />
                </div>
            </div>
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-bold mb-2">Normas del inmueble:
                    (Opcional)</label>
                <p class="text-sm pb-2">Especifique aquí las normas a seguir que considere necesarias para un correcto uso
                    de la propiedad.</p>
                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                    name="rules" id="rules" rows="10" placeholder="Escribe aquí las normas del inmueble..."></textarea>
            </div>
            <br>
            <p class="block text-lg font-bold mb-2">Método de pago</p>
            <div class="mb-6 h-auto w-full">
                <p class="text-sm pb-2">Seleccione una cuenta bancaria en la que recibirá los pagos.</p>
                <x-input-error :messages="$errors->get('bankAccount')" class="mt-2" />
                @if (count($userBank) > 0)
                    <div class="relative">
                        <div class="flex items-center justify-between bg-white border border-gray-300 rounded-md px-4 py-2 cursor-pointer"
                            id="selectBankButton">
                            <span class="mr-2">Selecciona una cuenta bancaria</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 12l-4-4h8z" />
                            </svg>
                        </div>
                        <div class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-b-md hidden"
                            id="optionsBankContainer">
                            @foreach ($userBank as $item)
                                <div class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex justify-between"
                                    data-bankid="{{ $item->id }}">
                                    <div>
                                        <p>Titular: {{ ucfirst($item->holder_name) }}</p>
                                        <p>Banco: {{ $item->bank_name }} ({{ $item->bank_code }})</p>
                                        <p>IBAN: {{ $item->iban }}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="bankAccount" id="bankAccount" value="">
                    </div>
                @endif

            </div>
            <div>
                <a href="/account/payments/wallet?action=new&item=bank" target="_blank"
                    class="w-full bg-gray-100 cursor-pointer hover:bg-gray-200 px-4 py-2 rounded-md">
                    Agregar cuenta bancaria</a>
            </div>
            <div class="mb-6 h-auto w-full">
                <p class="text-sm pb-2 mt-6">Elige un procedimiento por el cual tus inquilinos realizarán el pago del
                    alquiler.</p>
                <div class="relative">
                    <div class="flex items-center justify-between bg-white border border-gray-300 rounded-md px-4 py-2 cursor-pointer"
                        id="selectPaymentProcess">
                        <span class="mr-2">Seleccionar procedimiento de pago</span>
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 12l-4-4h8z" />
                        </svg>
                    </div>
                    <div class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-b-md hidden"
                        id="paymentProcessContainer">
                        <div class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex justify-between"
                            data-paymentprocess="automatic">
                            <div>
                                <p class="text-lg font-semibold">Automático a través de RêntHûb.es (Con comisiones)</p>
                                <p class="text-sm text-gray-700">
                                    Mediante este proceso, se realizará el cobro del alquiler a la tarjeta o cuenta bancaria
                                    asociada de tu inquilino y se transferirá automáticamente a tu cuenta.
                                    <b>IMPORTANTE:</b> Este método tiene unos gastos de gestión que se descontarán del monto
                                    total que te ingresemos.
                                </p>

                            </div>
                        </div>
                        <div class="px-4 py-2 cursor-pointer hover:bg-gray-100 flex justify-between gap-2"
                            data-paymentprocess="manual">
                            <div>
                                <p class="text-lg font-semibold">Manual (Gratuito)</p>
                                <p class="text-sm text-gray-700">
                                    Mediante este proceso, el inquilino será responsable de realizar la transferencia del
                                    monto del alquiler a la cuenta bancaria asociada al contrato. No se cobran comisiones en
                                    este método.
                                </p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="paymentProcess" id="paymentProcess" value="">
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const selectPaymentProcess = document.getElementById('selectPaymentProcess');
                            const paymentProcessContainer = document.getElementById('paymentProcessContainer');
                            const paymentProcess = document.getElementById('paymentProcess');

                            selectPaymentProcess.addEventListener('click', function() {
                                paymentProcessContainer.classList.toggle('hidden');
                            });

                            paymentProcessContainer.querySelectorAll('div[data-paymentprocess]').forEach(option => {
                                option.addEventListener('click', function() {
                                    const selectedPaymentProcess = option.querySelector('p').textContent;
                                    const payment = option.dataset.paymentprocess;
                                    selectPaymentProcess.querySelector('span').textContent = selectedPaymentProcess;
                                    paymentProcessContainer.classList.add('hidden');
                                    paymentProcess.value = payment;
                                });
                            });
                        });
                    </script>
                </div>

            </div>
            <br>
            <br>
            <p class="block text-lg font-bold mb-2">Asociados</p>
            <div class="mb-6">
                <div id="segurosSelectorDisplay"
                    class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center z-30 hidden">
                    <div id="segurosSelectorBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden">
                    </div>
                    <div class="w-full h-full pt-20">
                        <div id="documentSelectorDisplay"
                            class="bg-white w-full h-full mx-auto  rounded-md flex justify-center"
                            style="backdrop-filter: blur(10px);">
                            <div class="lg:w-4/5 w-full h-full  flex justify-center">
                                <div class="w-full lg:w-3/5 p-4 flex items-center flex-col">
                                    <div class="w-full flex justify-between items-center">
                                        <p class="block text-start text-xl font-bold mb-2">Selector de Seguros</p>
                                        <div id="segurosButtonClose" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-10">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="overflow-y-auto flex w-full flex-col h-full pr-2">
                                        <p class="text-sm pb-2">Rellene los campos del seguro a registrar. No es
                                            obligatorio que registre un seguro.</p>
                                        <p id="segurosError" class="text-red-700 font-bold hidden">Por favor, rellene los
                                            campos
                                            requeridos.</p>
                                        <div class="flex flex-col mb-4 lg:mb-0 sm:mb-4 items-start gap-2">
                                            <div class="flex w-full gap-2">
                                                <div class="w-full">
                                                    <label for="insurance-company-name"
                                                        class="block text-gray-700 font-bold mb-2">Nombre de la
                                                        compañía:</label>
                                                    <input type="text" id="insurance-company-name"
                                                        name="insurance-company-name"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        placeholder="Nombre de la compañía" >
                                                </div>
                                            </div>
                                            <div class="flex w-full gap-2">

                                                <div class="w-full">
                                                    <label for="insurance-category"
                                                        class="block text-gray-700 font-bold mb-2">Tipo de Seguro:</label>
                                                    <select name="insurance-category" id="insurance-category"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600 cursor-pointer hover:bg-gray-200"
                                                        >
                                                        <option value="none" disabled selected hidden>Tipo de Seguro
                                                        </option>
                                                        <option value="seguro_hogar">Seguro de Hogar</option>
                                                        <option value="seguro_alquiler">Seguro de Alquiler</option>
                                                        <option value="seguro_hipoteca">Seguro de Hipoteca</option>
                                                        <option value="seguro_inquilino">Seguro de Inquilino</option>
                                                        <option value="seguro_edificio">Seguro de Edificio</option>
                                                        <option value="seguro_multirriesgo">Seguro Multirriesgo</option>
                                                        <option value="seguro_responsabilidad_civil">Seguro de
                                                            Responsabilidad Civil</option>
                                                    </select>
                                                </div>
                                                <div class="w-full">
                                                    <label for="insurance-policy-number"
                                                        class="block text-gray-700 font-bold mb-2">Número de
                                                        póliza:</label>
                                                    <input type="text" id="insurance-policy-number"
                                                        name="insurance-policy-number"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        placeholder="X1234567890" >
                                                </div>
                                            </div>
                                            <div class="flex gap-2 w-full">
                                                <div class="w-1/2">
                                                    <label for="insurance-start-date"
                                                        class="block text-gray-700 font-bold mb-2">Fecha de inicio:</label>
                                                    <input type="date" id="insurance-start-date"
                                                        name="insurance-start-date"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        placeholder="Inicio" >
                                                </div>
                                                <div class="w-1/2">
                                                    <label for="insurance-end-date"
                                                        class="block text-gray-700 font-bold mb-2">Fecha de fin:</label>
                                                    <input type="date" id="insurance-end-date"
                                                        name="insurance-end-date"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        placeholder="Final" >
                                                </div>
                                            </div>
                                            <div class="flex gap-2 w-full">
                                                <div class="w-1/2">
                                                    <label for="insurance-amount"
                                                        class="block text-gray-700 font-bold mb-2">Cantidad asegurada:
                                                        (Opcional)</label>
                                                    <input type="number" id="insurance-amount" name="insurance-amount"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        placeholder="€" >
                                                </div>
                                                <div class="w-1/2">
                                                    <label for="insurance-price"
                                                        class="block text-gray-700 font-bold mb-2">Coste:</label>
                                                    <input type="number" id="insurance-price" name="insurance-price"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        placeholder="€" >
                                                </div>
                                            </div>
                                            <div class="flex gap-2 w-full">
                                                <div class="w-1/2">
                                                    <label for="insurance-description"
                                                        class="block text-gray-700 font-bold mb-2">Descripción:
                                                        (Opcional)</label>
                                                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        name="insurance-description" id="insurance-description" rows="6" placeholder="Descripción"></textarea>
                                                </div>
                                                <div class="w-1/2">
                                                    <label for="insurance-contact"
                                                        class="block text-gray-700 font-bold mb-2">Información de
                                                        contacto:</label>
                                                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                                                        name="insurance-contact" id="insurance-contact" rows="6" placeholder="Información de contacto"></textarea>
                                                </div>
                                            </div>
                                            <div class="w-full flex justify-end mb-1" id="addSeguroButton">
                                                <div
                                                    class="bg-gray-100  text-black px-3 py-2 rounded-md  hover:bg-gray-200  cursor-pointer">
                                                    Agregar</div>
                                            </div>

                                            <div class="border border-gray-100 w-full mb-2"></div>
                                        </div>
                                        <div id="segurosValues"></div>
                                        <p class="block text-start text-xl font-bold mb-2">Seguros agregados</p>
                                        <div class="flex flex-col gap-2" id="segurosDisplay">
                                            <div
                                                class="w-full rounded-md border border-gray-200 p-4 gap-2 flex flex-col hidden">
                                                <div class="flex w-full gap-2 flex-col">
                                                    <label for="fianza"
                                                        class="block text-gray-700 font-bold mb-2">Nombre de la
                                                        compañía:</label>
                                                    <p id="fianza"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-md">
                                                        -</p>
                                                </div>
                                                <div class="flex w-full gap-2">
                                                    <div class="w-full">
                                                        <label for="categoria"
                                                            class="block text-gray-700 font-bold mb-2">Tipo de
                                                            Seguro:</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                    <div class="w-full">
                                                        <label for="fianza"
                                                            class="block text-gray-700 font-bold mb-2">Número de
                                                            póliza:</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                </div>
                                                <div class="flex gap-2 w-full">
                                                    <div class="w-1/2">
                                                        <label for="start"
                                                            class="block text-gray-700 font-bold mb-2">Fecha de
                                                            inicio:</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                    <div class="w-1/2">
                                                        <label for="end"
                                                            class="block text-gray-700 font-bold mb-2">Fecha de
                                                            fin:</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                </div>
                                                <div class="flex gap-2 w-full">
                                                    <div class="w-1/2">
                                                        <label for="price"
                                                            class="block text-gray-700 font-bold mb-2">Cantidad asegurada:
                                                            (Opcional)</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                    <div class="w-1/2">
                                                        <label for="price"
                                                            class="block text-gray-700 font-bold mb-2">Coste:</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                </div>
                                                <div class="flex gap-2 w-full">
                                                    <div class="w-1/2">
                                                        <label for="description"
                                                            class="block text-gray-700 font-bold mb-2">Descripción:
                                                            (Opcional)</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                    <div class="w-1/2">
                                                        <label for="description"
                                                            class="block text-gray-700 font-bold mb-2">Información de
                                                            contacto:</label>
                                                        <p id="fianza"
                                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                                                            -</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="birthdate" class="block text-gray-700 font-bold mb-2">Seguros: (Opcional)</label>
                <div class="flex justify-center p-4">
                    <div id="segurosButtonOpen"
                        class="px-4 py-2 bg-gray-100  rounded-md hover:bg-gray-200 cursor-pointer hover:border-gray-600">
                        Pulse para abrir el selector de <b>Seguros</b></div>
                </div>
            </div>
            <div class="mb-6">
                <label for="birthdate" class="block text-gray-700 font-bold mb-2">Servicios: (Opcional)</label>
                <div class="flex justify-center p-4">
                    <div id="imageSelectorButtonOpen"
                        class="px-4 py-2 bg-gray-100  rounded-md hover:bg-gray-200 cursor-pointer hover:border-gray-600">
                        Pulse para abrir el selector de <b>Servicios</b></div>
                </div>
            </div>
            <br>
            <div class="mb-6">
                <div class="mb-6 flex justify-end">
                    <input id="step3" type="submit" value="Crear"
                        class="next bg-gray-100  cursor-pointer  text-black px-6 w-auto py-2 rounded-md hover:bg-gray-200  focus:outline-none "></input>
                </div>
            </div>
        </form>
        <script>
            const companyNameInput = document.getElementById('insurance-company-name');
            const categorySelect = document.getElementById('insurance-category');
            const policyNumberInput = document.getElementById('insurance-policy-number');
            const startDateInput = document.getElementById('insurance-start-date');
            const endDateInput = document.getElementById('insurance-end-date');
            const amountInput = document.getElementById('insurance-amount');
            const priceInput = document.getElementById('insurance-price');
            const descriptionTextarea = document.getElementById('insurance-description');
            const contactTextarea = document.getElementById('insurance-contact');
            const addSeguroButton = document.getElementById('addSeguroButton');

            addSeguroButton.addEventListener('click', function() {
                var segurosError = document.getElementById('segurosError');
                const segurosDisplay = document.getElementById('segurosDisplay');
                const segurosValues = document.getElementById('segurosValues');
                const inputContainer = document.createElement('div');

                // Validar que los campos obligatorios estén completos
                if (!companyNameInput.value || !categorySelect.value || !policyNumberInput.value || !startDateInput
                    .value || !endDateInput.value || !priceInput.value) {
                    segurosError.classList.remove('hidden');
                    return;
                }
                segurosError.classList.add('hidden');
                // Obtener el texto seleccionado del select
                const selectedCategory = categorySelect.selectedOptions[0].textContent;

                // Crear un nuevo contenedor div para el seguro
                const container = document.createElement('div');
                container.classList.add('w-full', 'rounded-md', 'border', 'border-gray-200', 'p-4', 'grid',
                    'grid-cols-2',
                    'gap-2');

                // Crear elementos de texto para cada campo del seguro y agregarlos al contenedor
                const fields = [{
                        label: 'Nombre de la compañía:',
                        value: companyNameInput
                    },
                    {
                        label: 'Tipo de Seguro:',
                        value: selectedCategory
                    }, // Usar el texto seleccionado en lugar del valor
                    {
                        label: 'Número de póliza:',
                        value: policyNumberInput
                    },
                    {
                        label: 'Fecha de inicio:',
                        value: startDateInput
                    },
                    {
                        label: 'Fecha de fin:',
                        value: endDateInput
                    },
                    {
                        label: 'Cantidad asegurada:',
                        value: amountInput
                    },
                    {
                        label: 'Coste:',
                        value: priceInput
                    },
                    {
                        label: 'Descripción:',
                        value: descriptionTextarea
                    },
                    {
                        label: 'Información de contacto:',
                        value: contactTextarea
                    }
                ];

                fields.forEach(field => {
                    const label = document.createElement('p');
                    label.classList.add('block', 'text-gray-700', 'font-bold', 'mb-2');
                    label.textContent = field.label;

                    const text = document.createElement('p');
                    text.classList.add('w-full', 'px-4', 'py-2', 'border', 'border-gray-200', 'rounded-md');
                    text.textContent = field.value.value;

                    var numberOfSeguros = segurosValues.children.length;
                    const input = document.createElement('input');
                    input.setAttribute('type', 'text');
                    input.setAttribute('name', 'seguro-' + field.value.name + '-' + numberOfSeguros);
                    input.setAttribute('value', field.value.value)
                    input.classList.add('hidden');

                    inputContainer.appendChild(input);
                    // Append the text input to the container
                    container.appendChild(label);
                    container.appendChild(text);
                });

                // Agregar el contenedor al elemento 'segurosDisplay'
                segurosValues.appendChild(inputContainer)
                segurosDisplay.appendChild(container);
            });
        </script>
        <script>
            segurosSelectorDisplay = document.getElementById('segurosSelectorDisplay');
            segurosSelectorBackdrop = document.getElementById('segurosSelectorBackdrop');
            segurosButtonOpen = document.getElementById('segurosButtonOpen');
            segurosButtonClose = document.getElementById('segurosButtonClose');

            segurosButtonOpen.addEventListener('click', function() {
                segurosSelectorDisplay.classList.toggle('hidden')
                segurosSelectorBackdrop.classList.toggle('hidden')
            })

            segurosButtonClose.addEventListener('click', function() {
                segurosSelectorDisplay.classList.toggle('hidden')
                segurosSelectorBackdrop.classList.toggle('hidden')
            })
        </script>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectButton = document.getElementById('selectButton');
            const optionsContainer = document.getElementById('optionsContainer');
            const inmuebleIdInput = document.getElementById('inmuebleId');
            const categoryField = document.getElementById('categoryField');

            selectButton.addEventListener('click', function() {
                optionsContainer.classList.toggle('hidden');
            });

            optionsContainer.querySelectorAll('div').forEach(option => {
                option.addEventListener('click', function() {
                    const selectedOption = option.textContent.trim();
                    const inmuebleId = option.dataset.inmuebleid;
                    const category = option.dataset.category;
                    selectButton.querySelector('span').textContent = selectedOption;
                    optionsContainer.classList.add('hidden');
                    console.log(category);
                    categoryField.textContent = category.charAt(0).toUpperCase() + category.slice(
                        1);
                    inmuebleIdInput.value = inmuebleId;

                    const categoryInput = document.createElement('input');
                    categoryInput.setAttribute('type', 'text');
                    categoryInput.setAttribute('name', 'category');
                    categoryInput.setAttribute('value', category);
                    categoryInput.classList.add('hidden');

                    const formulario = document.getElementById('formulario');
                    formulario.appendChild(categoryInput);
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectDocButton = document.getElementById('selectDocButton');
            const optionsDocContainer = document.getElementById('optionsDocContainer');
            const docIdInput = document.getElementById('docId');

            selectDocButton.addEventListener('click', function() {
                optionsDocContainer.classList.toggle('hidden');
            });

            optionsDocContainer.querySelectorAll('div[data-docid]').forEach(option => {
                option.addEventListener('click', function() {
                    const selectedDocOption = option.querySelector('p').textContent;
                    const docId = option.dataset.docid;
                    selectDocButton.querySelector('span').textContent = selectedDocOption;
                    optionsDocContainer.classList.add('hidden');
                    docIdInput.value = docId;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectBankButton = document.getElementById('selectBankButton');
            const optionsBankContainer = document.getElementById('optionsBankContainer');
            const bankAccountInput = document.getElementById('bankAccount');

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
@endsection
@section('footer')
    @include('Footers.small_footer')
@endsection
