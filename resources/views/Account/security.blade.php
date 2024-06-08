@extends('Layouts.main')
@section('title', 'RêntHûb.es | Account')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    @php
        $particularData = App\Models\Particular::getParticularData(Auth::user()->id);
        $userData = App\Models\User::find(Auth::user()->id);
    @endphp
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center">
        <h1 class="text-2xl font-bold"><a href="{{ route('profile.index') }}" class="hover:underline">Tu cuenta</a> >
            Incio de sesión y seguridad</h1>
        <div role="status" id="status" class="absolute top-1/4 right-1/2 z-10">
            <svg aria-hidden="true" class="w-6 h-6 text-gray-100 animate-spin dark:text-gray-300 fill-gray-950"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
        <br>
        <div id="content" class="hidden">
            <p class="text-xl font-bold p-2">Inicios de sesión</p>
            <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4 p-2">
                <p class="text-md">Contraseña</p>
                <div class="flex justify-between cursor-pointer">
                    <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">Es recomendable cambiar tu contraseña
                        con frecuencia</p>
                    <label for="nombre" class="text-md text-gray-500 cursor-pointer underline">Actualizar</label>
                </div><br>
                <div>
                    <form action="{{ route('account.reset-password') }}" method="POST"
                        class="flex justify-between flex-col gap-1 mt-1">
                        @csrf
                        <input name="current_password" type="password" placeholder="Contraseña actual" value="Pitillas6839"
                            class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                        <br>
                        <input name="password" type="password" placeholder="Nueva contraseña" value="Pitillas123"
                            class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                        <input name="confirmed" type="password" placeholder="Confirmar nueva contraseña" value="Pitillas123"
                            class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                        <input type="submit" value="Guardar"
                            class="bg-gray-100 border w-1/2 border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                    </form>
                </div>
            </div>
            <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4 p-2">
                <p class="text-md">PIN de Acceso Seguro</p>
                <div class="flex justify-between cursor-pointer">
                    <p name="nombre" class="text-lg text-gray-500  hover:opacity-100">
                        <?php
                           if( App\Models\SecurePin::isPinActivated(Auth::user()->id)){
                        ?>
                        <b class="text-green-600">Activado</b>
                        <?php }else{ ?>
                        <b class="text-red-600">Desactivado</b>
                        <?php
                        }
                        ?>
                        <br>El PIN de Acceso Seguro es un código personalizado de 6 dígitos que se
                        utiliza para proteger el acceso a partes importantes de tu cuenta, como la configuración, la
                        seguridad, los contratos y otra información sensible. Cuando activas esta opción, se te pedirá que
                        establezcas un código PIN único.
                    </p>
                    <button class="text-md text-gray-500 cursor-pointer underline" id="securePinButton">Actualizar</button>
                </div>
                <br>
                <form method="POST" action="secure/save" class="flex justify-between flex-col gap-1 mt-1 hidden" id="securePinForm">
                    @csrf
                    <?php
                    if( App\Models\SecurePin::isPinActivated(Auth::user()->id)){
                    ?>
                    <input name="current_pin" type="password" placeholder="PIN de Acceso Seguro actual" maxlength="6" required
                        class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    <br>
                    <?php }?>
                    <input name="new_pin" type="password" placeholder="Nuevo PIN de Acceso Seguro" maxlength="6" required
                        class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    <input name="confirmed_pin" type="password" placeholder="Confirmar nuevo PIN de Acceso Seguro"
                        value="" maxlength="6" required
                        class="w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    <input type="submit" value="Guardar"
                        class="bg-gray-100 border w-1/2 border-gray-300 text-black px-6 py-2 rounded-md hover:bg-gray-600 hover:text-white focus:outline-none cursor-pointer">
                </form>
                <script>
                    const securePinButton=document.getElementById('securePinButton');
                    const securePinForm=document.getElementById('securePinForm');

                    securePinButton.addEventListener('click', function(){
                        securePinForm.classList.toggle('hidden');
                    })
                </script>
            </div>
            <div class="flex flex-col align-top  border-b border-gray-200 mb-4 pb-4 p-2">
                <p class="text-md">Autenticación en 2 pasos</p>
                <div class="flex justify-between cursor-pointer">
                    <p name="nombre" class="text-lg text-gray-500  hover:opacity-100"><b
                            class="text-red-600">Desactivada</b><br> Si activas esta opción, se te pedirá un código de
                        acceso que te enviaremos a tu correo electrónico cada vez que inicies sesión.</p>
                    <a href="" class="text-md text-gray-500 cursor-pointer underline">Actualizar</a>

                </div>
            </div>
            <p class="text-xl font-bold p-2">Sesiones activas</p>
            @php
                $userSessions = App\Models\Session::getUserSessions(Auth::user()->id);
            @endphp
            @foreach ($userSessions as $session)
                <div class="flex flex-col align-top border-b border-gray-200 mb-4 pb-4 p-2 gap-2">
                    <div class="flex gap-2 md:flex-row flex-col">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                        <p name="nombre" class="user-agent text-lg text-gray-500 hover:opacity-100">
                            {{ $session->user_agent }}</p>
                    </div>
                    <div class="flex justify-between cursor-pointer">
                        <p name="nombre" class="text-lg text-gray-500 hover:opacity-100">{{ $session->ip_address }}</p>
                        <label for="nombre" class="text-md text-red-600 cursor-pointer underline">Cerrar esta
                            sesión</label>
                    </div>
                </div>
            @endforeach




        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ua-parser-js/0.7.29/ua-parser.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("status").classList.toggle('hidden');
                document.getElementById("content").classList.toggle('hidden');
            });
        </script>
    </div>
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
