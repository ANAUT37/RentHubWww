@extends('Layouts.main')
@section('title', 'RêntHûb.es | Signup')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('content')
    <style>
        .step {
            background-color: 'text-pink-700';
            color: white;
        }
    </style>
    <div class="container mx-auto py-12 px-4 max-w-2xl" id="particularForm">
        <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Particular {{ $type }}</h1>
        <div class="flex items-center justify-center">
            <div class="flex justify-center w-full max-w-lg sm:flex-row flex-col gap-3 ">
                <div class="flex items-center">
                    <div id="markstep1" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center step">1</div>
                    <div class="ml-2">Cuenta</div>
                </div>
                <div class="flex items-center">
                    <div id="markstep2" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">2</div>
                    <div class="ml-2">Sobre ti</div>
                </div>
                @if ($type === 'Premium')
                    <div class="flex items-center">
                        <div id="markstep3" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">3
                        </div>
                        <div class="ml-2">Pago</div>
                    </div>
                    <div class="flex items-center">
                        <div id="markstep4" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">4
                        </div>
                        <div class="ml-2">Confirmación</div>
                    </div>
                @else
                    <div class="flex items-center">
                        <div id="markstep3" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">3
                        </div>
                        <div class="ml-2">Confirmación</div>
                    </div>
                @endif
            </div>
        </div>
        <form action="/signup/particular" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($type === 'Básico')
                <input type="text" name="type" id="type" value="basic" hidden>
            @else
                <input type="text" name="type" id="type" value="premium" hidden>
            @endif

            <div id="formstep1" class="">
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
                                <option value="+1">+1</option>
                                <option value="+7">+7</option>
                                <option value="+20">+20</option>
                                <option value="+27">+27</option>
                                <option value="+30">+30</option>
                                <option value="+31">+31</option>
                                <option value="+32">+32</option>
                                <option value="+33">+33</option>
                                <option value="+34" selected>+34</option>
                                <option value="+36">+36</option>
                                <option value="+39">+39</option>
                                <option value="+40">+40</option>
                                <option value="+41">+41</option>
                                <option value="+43">+43</option>
                                <option value="+44">+44</option>
                                <option value="+45">+45</option>
                                <option value="+46">+46</option>
                                <option value="+47">+47</option>
                                <option value="+48">+48</option>
                                <option value="+49">+49</option>
                                <option value="+51">+51</option>
                                <option value="+52">+52</option>
                                <option value="+53">+53</option>
                                <option value="+54">+54</option>
                                <option value="+55">+55</option>
                                <option value="+56">+56</option>
                                <option value="+57">+57</option>
                                <option value="+58">+58</option>
                                <option value="+60">+60</option>
                                <option value="+61">+61</option>
                                <option value="+62">+62</option>
                                <option value="+63">+63</option>
                                <option value="+64">+64</option>
                                <option value="+65">+65</option>
                                <option value="+66">+66</option>
                                <option value="+81">+81</option>
                                <option value="+82">+82</option>
                                <option value="+84">+84</option>
                                <option value="+86">+86</option>
                                <option value="+90">+90</option>
                                <option value="+91">+91</option>
                                <option value="+92">+92</option>
                                <option value="+93">+93</option>
                                <option value="+94">+94</option>
                                <option value="+95">+95</option>
                                <option value="+98">+98</option>
                                <option value="+211">+211</option>
                                <option value="+212">+212</option>
                                <option value="+213">+213</option>
                                <option value="+216">+216</option>
                                <option value="+218">+218</option>
                                <option value="+220">+220</option>
                                <option value="+221">+221</option>
                                <option value="+222">+222</option>
                                <option value="+223">+223</option>
                                <option value="+224">+224</option>
                                <option value="+225">+225</option>
                                <option value="+226">+226</option>
                                <option value="+227">+227</option>
                                <option value="+228">+228</option>
                                <option value="+229">+229</option>
                                <option value="+230">+230</option>
                                <option value="+231">+231</option>
                                <option value="+232">+232</option>
                                <option value="+233">+233</option>
                                <option value="+234">+234</option>
                                <option value="+235">+235</option>
                                <option value="+236">+236</option>
                                <option value="+237">+237</option>
                                <option value="+238">+238</option>
                                <option value="+239">+239</option>
                                <option value="+240">+240</option>
                                <option value="+241">+241</option>
                                <option value="+242">+242</option>
                                <option value="+243">+243</option>
                                <option value="+244">+244</option>
                                <option value="+245">+245</option>
                                <option value="+246">+246</option>
                                <option value="+248">+248</option>
                                <option value="+249">+249</option>
                                <option value="+250">+250</option>
                                <option value="+251">+251</option>
                                <option value="+252">+252</option>
                                <option value="+253">+253</option>
                                <option value="+254">+254</option>
                                <option value="+255">+255</option>
                                <option value="+256">+256</option>
                                <option value="+257">+257</option>
                                <option value="+258">+258</option>
                                <option value="+260">+260</option>
                                <option value="+261">+261</option>
                                <option value="+262">+262</option>
                                <option value="+263">+263</option>
                                <option value="+264">+264</option>
                                <option value="+265">+265</option>
                                <option value="+266">+266</option>
                                <option value="+267">+267</option>
                                <option value="+268">+268</option>
                                <option value="+269">+269</option>
                                <option value="+290">+290</option>
                                <option value="+291">+291</option>
                                <option value="+297">+297</option>
                                <option value="+298">+298</option>
                                <option value="+299">+299</option>
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
                    <a href="/signup"
                        class="text-gray-600 hover:underline col-start-1 plan hover:cursor-pointer">Volver</a>
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
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                        <input type="text" id="name" name="name"
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
                    <button type="submit"
                        class="next bg-gray-100 border border-gray-300 text-black px-6 w-auto py-2 rounded-md hover:bg-blue-400 hover:text-white focus:outline-none ">Completar</button>
                </div>
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
