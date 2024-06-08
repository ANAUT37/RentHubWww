@extends('Layouts.main')
@section('title', 'RêntHûb.es | Plan')
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
            Gestionar plan</h1>
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
            @if ($userSuscriptionData->subscription_type == 'particular_basic')
                <div class="bg-gray-100  p-6 rounded-lg shadow-md " id="suscriptionDisplay">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <h2 class="text-2xl font-bold">Particular Básico</h2>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>

                            <h3 class="text-lg font-medium mb-2">Detalles del plan</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">
                                Ideal para propietarios de un segundo inmueble o inquilinos interesados en alquilar un único
                                inmueble.
                            </p>
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="h-5 w-5 mr-2 text-gray-500 dark:text-gray-400">
                                    <line x1="12" x2="12" y1="2" y2="22"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                <span class="text-2xl font-bold">0</span>
                                <span class="text-gray-500 dark:text-gray-400 ml-2">/mes</span>
                            </div>

                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-2">Qúe incluye</h3>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Publicación de un anuncio</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Uso activo de un contrato</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Creación de 5 documentos</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="mt-5">
                        <div class="w-full flex gap-2 justify-between">
                            <div>
                                <button id="openSuscriptionCheckout"
                                    class="border hover:text-white border-pink-700 rounded-md h-10 flex py-2 px-4 justify-start items-center gap-2 hover:bg-pink-700 hover:border-none cursor-pointer mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Cambiar a suscripción Particular Premium
                                </button>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end"></div>
                    </div>
                </div>
                <script src="https://js.stripe.com/v3/"></script>
                <div class="container mx-auto px-4 max-w-2xl hidden" id="suscriptionForm">
                    <div class="flex items-center justify-center">
                        <h2 class="text-2xl font-bold text-center">Suscripción Particular <span
                                class="text-pink-700">Premium</span></h2>
                    </div>
                    <p class="text-gray-600 mb-4 text-center pt-10">Para completar tu suscripción, debes abonar la cantidad
                        de la primera
                        mensualidad de la suscripción a RêntHûb
                        Premium.</p>

                    <br>
                    <main class="flex flex-col items-center justify-between h-auto">
                        <form id="payment-form"
                            class="bg-white w-full max-w-3xl mx-auto px-6 py-8 shadow-md rounded-md flex md:flex-row flex-col border border-gray-200 rounded-m">
                            @csrf
                            <div class="w-full pr-8 border-r-2 border-slate-300">
                                <label class="text-neutral-800 font-bold text-sm mb-2 block">Nombre del titular:</label>
                                <input id="cardholder-name" type="text" name="card-holder-name" required
                                    placeholder="Nombre Apellidos"
                                    class="flex justify-center items-center h-10 w-full rounded-md border-2 px-4 py-1.5 text-lg ring-offset-background focus-visible:outline-none focus-visible:border-purple-600 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mb-4">
                                </input>
                                <label class="text-neutral-800 font-bold text-sm mb-2 block">Número de la tarjeta:</label>
                                <div
                                    class="flex justify-center items-center h-10 w-full rounded-md border-2 px-4 py-1.5 text-lg ring-offset-background focus-visible:outline-none focus-visible:border-purple-600 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mb-4">
                                    <div id="card-number"></div>
                                </div>
                                <div class="flex gap-x-2 mb-4">
                                    <div class="flex-1">
                                        <label class="text-neutral-800 font-bold text-sm mb-2 block">Fecha Exp:</label>
                                        <div
                                            class="flex justify-center items-center h-10 w-full rounded-md border-2 px-4 py-1.5 text-lg ring-offset-background focus-visible:outline-none focus-visible:border-purple-600 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mb-4">
                                            <div id="expiration-date"></div>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <label class="text-neutral-800 font-bold text-sm mb-2 block">CCV:</label>
                                        <div
                                            class="flex justify-center items-center h-10 w-full rounded-md border-2 px-4 py-1.5 text-lg ring-offset-background focus-visible:outline-none focus-visible:border-purple-600 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 mb-4">
                                            <div id="cvv"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2 items-center hidden" id="statusPayment">
                                    <div role="status" id="status" class="">
                                        <svg aria-hidden="true"
                                            class="w-4 h-4 text-gray-100 animate-spin dark:text-gray-300 fill-gray-950"
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
                                    <p class="text-sm">Procesando...</p>
                                </div>
                                <div id="error-message" class="text-sm text-red-500 p-2"></div>
                                <button id="submit"
                                    class="border border-gray-200 hover:bg-gray-200 rounded-md px-4 py-2">Pagar</button>
                            </div>
                            <div class="w-full px-4">
                                <p class="text-xl font-bold ">Resumen</p>
                                <div class="flex flex-col justify-between w-full h-full pb-4">
                                    <div>
                                        <div class="h-auto w-full flex justify-between py-2">
                                            <p class="font-bold text-gray-800">Cuenta Premium</p>
                                            <p class="font-bold  text-right">9,90€</p>
                                        </div>
                                    </div>
                                    <div class="h-auto w-full border-t border-gray-200 flex justify-between py-2">
                                        <p class="font-bold text-gray-800">Total</p>
                                        <p class="font-bold  text-right">9,90€</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </main>
                    <button id="closeSuscriptionCheckout"
                        class="mt-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md">Cancelar</button>
                </div>
                <script>
                    var openSuscriptionCheckout = document.getElementById('openSuscriptionCheckout')
                    var closeSuscriptionCheckout = document.getElementById('closeSuscriptionCheckout')
                    var suscriptionForm = document.getElementById('suscriptionForm')
                    var suscriptionDisplay = document.getElementById('suscriptionDisplay')

                    openSuscriptionCheckout.addEventListener('click', function() {
                        suscriptionForm.classList.toggle('hidden')
                        suscriptionDisplay.classList.toggle('hidden')
                    })
                    closeSuscriptionCheckout.addEventListener('click', function() {
                        suscriptionForm.classList.toggle('hidden')
                        suscriptionDisplay.classList.toggle('hidden')
                    })
                </script>
                <script>
                    // Inicializa Stripe
                    const stripe = Stripe(
                        'pk_test_51OexU1FHiAmjSHlNxC9rvIumCWrUpjIH2K3PIzYfryueYzwOS7oiG1VOxtfxGe7P3nZtAemD7n7DqQvQ4aY4Ke4h00b14By47l'
                    );
                    const elements = stripe.elements();

                    var style = {
                        base: {},
                    };

                    var cardNumber = elements.create('cardNumber', {
                        style: style,
                        classes: {
                            base: 'form-control w-full'
                        }
                    });

                    var cardExpiry = elements.create('cardExpiry', {
                        style: style,
                        classes: {
                            base: 'form-control w-full'
                        }
                    });

                    var cardCvc = elements.create('cardCvc', {
                        style: style,
                        classes: {
                            base: 'form-control w-full'
                        },
                    });


                    cardNumber.mount('#card-number');
                    cardExpiry.mount('#expiration-date');
                    cardCvc.mount('#cvv');

                    const form = document.getElementById('payment-form');
                    form.addEventListener('submit', async (event) => {
                        event.preventDefault();
                        const status = document.getElementById('statusPayment');
                        status.classList.toggle('hidden');
                        const {
                            paymentMethod,
                            error
                        } = await stripe.createPaymentMethod({
                            type: 'card',
                            card: cardNumber
                        });

                        if (error) {
                            status.classList.toggle('hidden');
                            document.getElementById('error-message').textContent = error.message;
                        } else {
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            const cardHolderName = document.getElementById('cardholder-name').value;
                            const paymentMethodId = paymentMethod.id;

                            const paymentStatus = 'completed';

                            fetch('/transaction/account/checkout/premium', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-Token': csrfToken
                                },
                                body: JSON.stringify({
                                    paymentMethodId: paymentMethodId,
                                    paymentStatus: paymentStatus,
                                }),
                            }).then(response => response.json()).then(data => {
                                if (data.error) {
                                    status.classList.toggle('hidden');
                                    document.getElementById('error-message').textContent = data.error;
                                } else {
                                    var url = '/suscription/premium';
                                    console.log(paymentMethodId)
                                    fetch(url, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-Token': csrfToken
                                            },
                                            body: JSON.stringify({
                                                paymentMethodId: paymentMethodId,
                                                paymentStatus: paymentStatus,
                                            }),
                                        })
                                        .then(response => console.log(response.json()))
                                        .then(data => {
                                            console.log(data)
                                           // window.open('/account/plan', '_self');
                                        })
                                        .catch(error => {
                                            document.getElementById('error-message').textContent =
                                                'An error occurred. Please try again later.';
                                        });
                                }

                            });
                        }
                    });
                </script>
            @endif
            @if ($userSuscriptionData->subscription_type == 'particular_premium')
                <div class="bg-gray-100  p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <h2 class="text-2xl font-bold">Particular <span class="text-pink-700">Premium</span></h2>
                        </div>
                        @if ($userSuscriptionData->status == 'active')
                            <span
                                class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium dark:bg-green-900 dark:text-green-300">
                                Activo
                            </span>
                        @else
                            <span
                                class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium dark:bg-red-900 dark:text-red-300">
                                Inactivo
                            </span>
                        @endif

                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>

                            <h3 class="text-lg font-medium mb-2">Detalles del plan</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">
                                Ideal para propietarios con varios inmuebles disponibles o inquilinos interesados en
                                alquilar una gran cantidad de espacios.
                            </p>
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="h-5 w-5 mr-2 text-gray-500 dark:text-gray-400">
                                    <line x1="12" x2="12" y1="2" y2="22"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                <span class="text-2xl font-bold">9,90</span>
                                <span class="text-gray-500 dark:text-gray-400 ml-2">/mes</span>
                            </div>
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="h-5 w-5 mr-2 text-gray-500 dark:text-gray-400">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                <span>Expira el {{ $userSuscriptionData->end_date }}</span>
                            </div>
                            @if ($userSuscriptionData->status == 'active')
                                @if (isset($userSuscriptionData->renewal_date))
                                    @if ($userSuscriptionData->plan_id == 1)
                                        <div class="flex items-center mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-5 w-5 mr-2 text-gray-500 dark:text-gray-400">
                                                <path d="M8 2v4"></path>
                                                <path d="M16 2v4"></path>
                                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                <path d="M3 10h18"></path>
                                            </svg>
                                            <span>Renovación el {{ $userSuscriptionData->renewal_date }}</span>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            @if ($userSuscriptionData->status == 'inactive')
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="h-5 w-5 mr-2 text-gray-500 dark:text-gray-400">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                    <span>Cancelada el {{ $userSuscriptionData->cancellation_date }}</span>
                                </div>
                            @endif

                        </div>
                        <div>
                            <h3 class="text-lg font-medium mb-2">Included Features</h3>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Publicación de anuncios ilimitados</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Uso activo de contratos ilimitados</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Creación de documentos ilimitados</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="h-5 w-5 mr-2 text-pink-700 ">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                    <span>Acceso a estadísticas de tus anuncios</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="mt-5">
                        <div class="w-full flex gap-2 justify-between">
                            <div>
                                @if ($userSuscriptionData->cancellation_date === null)
                                    @if ($userSuscriptionData->plan_id == 1)
                                        <a href="/suscription/renovate/automatic/{{ $userSuscriptionData->id }}/cancel"
                                            class="border border-gray-200 rounded-md h-10 flex py-2 px-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer mt-2">
                                            <div class="w-4 h-4 rounded-full bg-green-500">
                                            </div>
                                            Pago automático activado
                                        </a>
                                    @else
                                        <a href="/suscription/renovate/automatic/{{ $userSuscriptionData->id }}/activate"
                                            class="border border-gray-200 rounded-md h-10 flex py-2 px-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer mt-2">
                                            <div class="w-4 h-4 rounded-full bg-red-500">
                                            </div>
                                            Pago automático desactivado
                                        </a>
                                    @endif
                                @endif

                                <br>
                                @if (isset($dataWallet))
                                    <div>
                                        <h4 class="text-lg font-medium mb-2">Tarjeta de crédito</h4>
                                        <div
                                            class="border border-gray-200 rounded-md h-20 flex p-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                            </svg>
                                            <div class="w-full flex flex-col">
                                                <p>{{ $dataWallet->full_name }}</p>
                                                <p>{{ $dataWallet->expiration_month }} / {{ $dataWallet->expiration_year }}
                                                </p>
                                                <p>{{ $dataWallet->number }}</p>
                                            </div>

                                        </div>
                                    </div>
                                @endif

                            </div>
                            @if ($userSuscriptionData->cancellation_date === null)
                                <a href="/suscription/renovate/cancel/{{ $userSuscriptionData->id }}"
                                    class="border border-gray-200 rounded-md h-10 flex py-2 px-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer mt-2">Cancelar
                                    suscripción</a>
                            @else
                                <a href="/suscription/renovate/activate/{{ $userSuscriptionData->id }}"
                                    class="border border-gray-200 rounded-md h-10 flex py-2 px-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer mt-2">Activar
                                    suscripción de nuevo</a>
                            @endif


                        </div>
                    </div>
                    <div class="mt-6 flex justify-end"></div>
                </div>
            @endif
        </div>
        <br><br>
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
