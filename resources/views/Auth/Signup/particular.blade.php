@extends('Layouts.main')
@section('title', 'RêntHûb.es | Signup')
@section('header')
@include('Headers.header_manager')
@endsection
@section('content')
    <style>
        .step {
            background-color: rgb(59 130 246);
            color: white;
        }
    </style>
    <div class="container mx-auto py-12 px-4 max-w-2xl" id="particularForm">
        <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Particular {{ $type }}</h1>
        <div class="flex items-center justify-center">
            <div class="flex justify-between w-full max-w-lg sm:flex-row flex-col gap-3 ">
                <div class="flex items-center">
                    <div id="markstep1" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center step">1</div>
                    <div class="ml-2">Cuenta</div>
                </div>
                <div class="flex items-center">
                    <div id="markstep2" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">2</div>
                    <div class="ml-2">Sobre ti</div>
                </div>
                <div class="flex items-center">
                    <div id="markstep3" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">3</div>
                    <div class="ml-2">Pagos</div>
                </div>
                <div class="flex items-center">
                    <div id="markstep4" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">4</div>
                    <div class="ml-2">Confirmación</div>
                </div>
            </div>
        </div>
        <form action="{{ route('signup') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="formstep1">
                <p class="text-gray-600 mb-4 text-center pt-10">Para iniciar tu registro, por favor completa el siguiente
                    formulario con la información relacionada a tu cuenta.</p>
                <br>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Correo electrónico:</label>
                    <p class="text-sm mb-2 text-gray-600">Te enviaremos un correo de Confirmación.</p>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Tu correo electrónico" required>
                </div>
                <div class="mb-6">
                    <div class="mb-6">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">Número de teléfono:
                            (Opcional)</label>
                        <div class="mb-6 flex">
                            <select name="phoneCode"
                                class="w-24 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:border-gray-600">
                                <option value="value1">+34</option>
                                <option value="value2" selected>+1</option>
                                <option value="value3">+2</option>
                            </select>
                            <input type="number" id="phone" name="phone"
                                class="w-full px-4 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:border-gray-600"
                                placeholder="Tu teléfono" required>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                    <p class="text-sm mb-2 text-gray-600">Debe tener entre 8 y 16 carácteres conteniendo como
                        mínmo
                        una mayúscula,
                        una minúscula y un número.</p>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Tu contraseña" required>
                </div>
                <div class="mb-6">
                    <label for="repeatPassword" class="block text-gray-700 font-bold mb-2">Repetir contraseña:</label>
                    <input type="password" id="repeatPassword" name="repeatPassword"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Repite tu contraseña" required>
                </div>
                <div class="mb-6 flex justify-between">
                    <a href="/signup" class="text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Volver</a>
                    <button id="step2"
                        class="next bg-gray-100 border border-gray-300 text-black px-6 w-auto py-2 rounded-md hover:bg-blue-400 hover:text-white focus:outline-none ">Continuar</button>
                </div>
            </div>
            <div id="formstep2" class="hidden">
                <p class="text-gray-600 mb-4 text-center pt-10">
                    Ahora es necesario que proporciones información relacionada contigo para verificar tu identidad. Algunos
                    de los campos serán visibles para otros usuarios, pero nunca se mostrará tu información sensible a
                    personas no autorizadas. Para obtener más detalles, consulta nuestros <b><a href="/help/privacy"
                            class="text-gray-600 hover:underline"> Términos de
                            privacidad</a></b></p>
                <br>
                <div class="mb-6">
                    <label for="profilePic" class="block text-gray-700 font-bold mb-2">Foto de perfil: (Opcional)</label>
                    <label for="input-file" class="block cursor-pointer">
                        <div id="contenedor"
                            class="w-32 h-32 m-auto bg-gray-200 flex items-center justify-center rounded-full">
                            <img id="profilePic" class="w-full h-full object-cover rounded-full" src="#"
                                alt=" ">
                        </div>
                        <input id="input-file" type="file" accept="image/*" class="hidden"
                            onchange="mostrarImagen(this)">
                    </label>
                </div>
                <div class="grid grid-cols-2 mb-6 gap-3">
                    <div>
                        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                        <input type="text" id="nombre" name="nombre"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="Tu nombre" required>
                    </div>
                    <div>
                        <label for="surname" class="block text-gray-700 font-bold mb-2">Apellidos:</label>
                        <input type="text" id="surname" name="surname"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="Tu apellidos" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="birthdate" class="block text-gray-700 font-bold mb-2">Fecha de nacimiento:</label>
                    <input type="date" id="birthdate" name="birthdate"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Tu fecha de nacimiento" required>
                </div>
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descripción: (Opcional)</label>
                    <textarea id="description" name="description"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        placeholder="Una descripción sobre ti"></textarea>
                </div>
                <div class="mb-6">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Ubicación actual:</label>
                        <p class="text-sm mb-2 text-gray-600">Utilizaremos tu ubicación para recomendarte anuncios y
                            garantizar la autenticidad de los usuarios. Tu ubicación no será visible para otros usuarios a
                            menos que lo autorices expresamente. Es importante destacar que RêntHûb.es ofrece sus servicios
                            <b>exclusivamente</b> en España en este momento.
                        </p>
                        <div class="mb-6 flex">
                            <select name="provincia" id="provincia"
                                class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:border-gray-600"
                                required>
                            </select>
                            <select name="municipio" id="municipio"
                                class="w-full px-4 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:border-gray-600"
                                required disabled>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-6 flex justify-between">
                    <button id="backstep2"
                        class="prev text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Volver</button>
                    <button id="step3"
                        class="next bg-gray-100 border border-gray-300 text-black px-6 w-auto py-2 rounded-md hover:bg-blue-400 hover:text-white focus:outline-none ">Continuar</button>
                </div>
            </div>
            <div id="formstep3" class="hidden">
                <p class="text-gray-600 mb-4 text-center pt-10">
                    Al solicitar que vincules un método de pago a tu cuenta, queremos aclarar que esto no implica que se
                    te vaya a realizar ningún cargo. Utilizaremos esta información únicamente para verificar la
                    identidad de usuarios únicos. Cualquier transacción que se realice con tu consentimiento previo será
                    notificada y autorizada por ti. Para obtener más información, visita nuestros <b><a
                            href="/help/privacy" class="text-gray-600 hover:underline"> Términos de
                            privacidad</a></b></p>
                <h2 class="text-2xl font-bold mb-4">Vincula un método de pago</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre-titular">
                        Nombre del titular
                    </label>
                    <input
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                        id="nombre-titular" type="text" placeholder="Nombre del titular">
                </div>
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Número de la tarjeta:</label>
                <div class="grid grid-cols-4 mb-6 gap-3">
                    <div>
                        <input type="number" min="0" id="cardNumer1" name="cardNumer1"
                            class="text-center w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="XXXX" maxlength="4" required>
                    </div>
                    <div>
                        <input type="number" min="0" id="cardNumer2" name="cardNumer2"
                            class="text-center w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="XXXX" maxlength="4" required>
                    </div>
                    <div>
                        <input type="number" min="0" id="cardNumer3" name="cardNumer3"
                            class="text-center w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="XXXX" maxlength="4" required>
                    </div>
                    <div>
                        <input type="number" min="0" id="cardNumer4" name="cardNumer4"
                            class="text-center w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600"
                            placeholder="XXXX" maxlength="4" required>
                    </div>
                </div>
                <div class="mb-6 flex flex-row gap-3">
                    <div class="mb-6">
                        <label for="expiration" class="block text-gray-700 font-bold mb-2">Fecha de Expiración</label>
                        <div class="mb-6 flex">
                            <input type="number" id="expirationMonth" name="expirationMonth"
                                class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:border-gray-600"
                                placeholder="MM" required>
                            <input type="number" id="expirationYear" name="expirationYear"
                                class="w-full px-4 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:border-gray-600"
                                placeholder="AA" required>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2" for="cvv">CVV</label>
                        <div class="mb-6 flex">
                            <input
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600  "
                                id="cvv" type="password" maxlength="3" placeholder="CVV">
                        </div>

                    </div>
                </div>
                <div class="mb-6 flex justify-between">
                    <button id="backstep3"
                        class="prev text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Volver</button>
                    <button  type="submit"
                        class="next bg-gray-100 border border-gray-300 text-black px-6 w-auto py-2 rounded-md hover:bg-blue-400 hover:text-white focus:outline-none ">REGISTRAR</button>
                </div>
                <br>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/pselect.js@4.0.1/dist/pselect.min.js"></script>
    <script>
        var prov = document.getElementById('provincia');
        var mun = document.getElementById('municipio');
        new Pselect().create(prov, mun);

        $('#provincia').change(function() {
            if ($(this).val() !== 'Provincia') {
                $('#municipio').removeAttr('disabled');
            } else {
                $('#municipio').attr('disabled', 'disabled');
            }
        });
    </script>
    <script>
        const inputs = document.getElementById('input[type="number"]');
        inputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                const length = this.value.length;
                if (length === 4 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                } else if (length === 4 && index === inputs.length - 1) {
                    this.blur();
                }
            });
        });
    </script>
    <script>
        function mostrarImagen(input) {
            const imagenPerfil = document.getElementById('profilePic');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagenPerfil.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuTriggers = document.querySelectorAll('.next');
            menuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    let id = trigger.getAttribute('id').replace('step',
                        '');
                    if (id < 5) {
                        let nextForm = document.getElementById('formstep' + id);
                        let prevForm = document.getElementById('formstep' + (parseInt(id) - 1));

                        nextForm.classList.toggle('hidden');
                        prevForm.classList.toggle('hidden');

                        let nextMark = document.getElementById('markstep' + id);
                        let prevMark = document.getElementById('markstep' + (parseInt(id) - 1));

                        nextMark.classList.toggle('step');
                        prevMark.classList.toggle('step');
                    }

                });
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            const menuTriggers = document.querySelectorAll('.prev');
            menuTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    let id = trigger.getAttribute('id').replace('backstep',
                        '');
                    if (id < 5) {
                        let nextForm = document.getElementById('formstep' + (parseInt(id) - 1));
                        let prevForm = document.getElementById('formstep' + id);

                        nextForm.classList.toggle('hidden');
                        prevForm.classList.toggle('hidden');

                        let nextMark = document.getElementById('markstep' + (parseInt(id) - 1));
                        let prevMark = document.getElementById('markstep' + id);

                        nextMark.classList.toggle('step');
                        prevMark.classList.toggle('step');
                    }

                });
            });
        });
    </script>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
