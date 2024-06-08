@extends('Layouts.main')
@section('title', 'RêntHûb.es | Checkout')
@section('header')
    @include('Headers.header_manager')
@endsection
@section('content')
    <script src="https://js.stripe.com/v3/"></script>
    <div class="container mx-auto py-12 px-4 max-w-2xl" id="particularForm">
        <h1 class="text-2xl font-bold mb-6 text-center col-start-2">Particular Premium</h1>
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

                <div class="flex items-center ">
                    <div id="markstep3" class="rounded-full bg-blue-500 w-8 h-8 flex items-center justify-center">3
                    </div>
                    <div class="ml-2">Pago</div>
                </div>
                <div class="flex items-center">
                    <div id="markstep4" class="rounded-full bg-gray-300 w-8 h-8 flex items-center justify-center">4
                    </div>
                    <div class="ml-2">Confirmación</div>
                </div>
            </div>
        </div>
        <p class="text-gray-600 mb-4 text-center pt-10">Para completar tu registro, debes abonar la cantidad de la primera
            mensualidad de la suscripción a RêntHûb
            Premium.</p>
        <p>Si has cambiado de opinión, puedes continuar con una cuenta Básica Gratis <a
                href="/signup/checkout/{{ $display_id }}/cancel" class="underline">pulsando aquí</a>.</p>
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
    </div>
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

                console.log('Cardholder Name:', cardHolderName);
                console.log('Payment Method ID:', paymentMethodId);
                console.log('Payment Status:', paymentStatus);
                console.log(elements.getElement('cardNumber'))

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
                        console.log(paymentMethodId)

                        fetch('/signup/checkout/{{ $display_id }}/'+paymentMethodId+'/'+paymentStatus+'/confirmed', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-Token': csrfToken
                            },
                            body: JSON.stringify({
                                status: 1,
                                paymentMethodId: paymentMethodId,
                            }),
                        }).then(response => response.json()).then(data=>{
                            if(data.error){
                                window.location.href="https://renthub.es/signup/completed"
                            }else{
                                window.location.href="https://renthub.es/signup/completed"
                            }
                        });
                    }
                });
            }
            window.location.href="https://renthub.es/signup/completed"  
        });
    </script>

    <script>
        const cardEl = document.getElementById("creditCard");
        const flipCard = (flip) => {
            if (flip === "flipToRear" && !cardEl.classList.contains("rearIsVsible")) {
                cardEl.classList.add("rearIsVsible");
            }
            if (flip === "flipToFront" && cardEl.classList.contains("rearIsVsible")) {
                cardEl.classList.remove("rearIsVsible");
            }
            if (flip === "flip") {
                if (cardEl.classList.contains("rearIsVsible")) {
                    cardEl.classList.remove("rearIsVsible");
                } else {
                    cardEl.classList.add("rearIsVsible");
                }
            }
        };

        const inputCCVNumber = document.getElementById("cvv");
        const imageCCVNumber = document.getElementById("imageCCVNumber");

        inputCCVNumber.addEventListener("input", (event) => {
            const input = event.target.value.replace(/\D/g, "");
            inputCCVNumber.value = input;
            imageCCVNumber.innerHTML = input;
        });

        const expirationDate = document.getElementById("expiration-date");
        const imageExpDate = document.getElementById("imageExpDate");

        expirationDate.addEventListener("input", (event) => {
            const input = event.target.value.replace(/\D/g, "");
            let formattedInput = "";
            for (let i = 0; i < input.length; i++) {
                if (i % 2 === 0 && i > 0) {
                    formattedInput += "/";
                }
                formattedInput += input[i];
            }

            expirationDate.value = formattedInput;
            imageExpDate.innerHTML = formattedInput;
        });
    </script>

@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
