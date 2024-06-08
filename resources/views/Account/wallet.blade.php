@extends('Layouts.main')
@section('title', 'RêntHûb.es | Account')
@section('header')
    @include('Headers.sessioned_home')
@endsection
@section('content')
    @php
        $userData = App\Models\User::find(Auth::user()->id);
        $dataWallet = App\Models\CreditCard::getUserWalletData(Auth::user()->id);
    @endphp
    <div class="container flex-col gap-2 w-4/5 lg:w-2/3 mx-auto pt-2 flex justify-center">
        <h1 class="text-2xl font-bold"><a href="{{ route('profile.index') }}" class="hover:underline">Tu cuenta</a> >
            <a href="{{ route('account.payments') }}" class="hover:underline">Pagos y cobros</a> > Tu cartera
        </h1>
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
        <div id="content" class="hidden">
            <div class="flex flex-col align-middle p-4">
                <p class="text-2xl font-bold">Tus tarjetas asociadas</p>
                <div class="p-4 gap-2">
                    <div id="credicCardButton"
                        class="border border-gray-200 rounded-md h-20 flex p-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p>Agregar nueva tarjeta</p>
                    </div>
                    @foreach ($dataWallet as $card)
                        <div
                            class="border border-gray-200 rounded-md h-20 flex p-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                            <div class="w-full flex flex-col">
                                <p>{{ $card->full_name }}</p>
                                <p>{{ $card->expiration_month }} / {{ $card->expiration_year }} </p>
                                <p>{{ $card->number }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br>
                <p class="text-2xl font-bold">Tus cuentas bancarias asociadas</p>
                <div class="p-4">
                    <div id="bankButton"
                        class="border border-gray-200 rounded-md h-20 flex p-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p>Agregar nueva cuenta bancaria</p>
                    </div>
                    @foreach ($bankAccountData as $item)
                        <div
                            class="border border-gray-200 rounded-md h-auto flex p-4 justify-start items-center gap-2 hover:bg-gray-200 cursor-pointer mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>

                            <div class="w-full flex flex-col">
                                <p>Titular: {{ $item->holder_name }}</p>
                                <p>Banco: {{ $item->bank_name }} ({{ $item->bank_code }}) </p>
                                <p>IBAN: {{ $item->iban }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="creditCardDisplay" class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
            <div id="creditCardBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
            <div id="documentSelectorDisplay" class="bg-gray-100 lg:w-2/6  mx-auto w-5/6 rounded-md border border-gray-200"
                style="backdrop-filter: blur(10px);">
                <div class="p-6 flex flex-col h-full justify-start gap-2">
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                        <p class="text-xl font-bold">Nueva tarjeta</p>
                    </div>
                    <p class="text-md text-gray-500  hover:opacity-100">Se hará una comprobación para confirmar la validez
                        de la tarjeta</p>
                    <form class="px-4 py-2 w-full" id="payment-form" method="POST" action="/account/payments/wallet/save"
                        enctype="multipart/form-data">
                        @csrf
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
                            <div class="mb-6 w-1/2">
                                <label for="expiration" class="block text-gray-700 font-bold mb-2">Fecha de
                                    Expiración</label>

                                <div class="mb-6 flex">
                                    <select id="expirationMonth" name="expirationMonth"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:border-gray-600"
                                        required>
                                        <option value="" disabled selected hidden>MM</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select id="expirationYear" name="expirationYear"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:border-gray-600"
                                        required>
                                        <option value="" disabled selected hidden>AA</option>
                                        <?php
                                        $currentYear = date('Y');
                                        $yearsAhead = 20;
                                        for ($i = 0; $i < $yearsAhead; $i++) {
                                            $year = $currentYear + $i;
                                            echo "<option value='$year'>$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-6 w-1/2">
                                <label class="block text-gray-700 font-bold mb-2" for="cvv">CVV</label>
                                <div class="mb-6 flex">
                                    <input
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600  "
                                        id="cvv" type="password" maxlength="3" placeholder="CVV">
                                </div>
                            </div>
                        </div>
                        <div class="mb-6 flex flex-row gap-3 justify-end">
                            <input type="submit" value="Continuar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="bankDisplay" class="fixed top-0 left-0 w-full h-full flex justify-center items-center z-30 hidden">
        <div id="bankBackdrop" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 hidden"></div>
        <div id="documentSelectorDisplay" class="bg-gray-100 lg:w-2/6  mx-auto w-5/6 rounded-md border border-gray-200"
            style="backdrop-filter: blur(10px);">
            <div class="p-6 flex flex-col h-full justify-start gap-2">
                <div class="flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                    <p class="text-xl font-bold">Nueva cuenta bancaria</p>
                </div>
                <p class="text-md text-gray-500  hover:opacity-100">Agregue los datos según aparezca en su cuenta bancaria.
                </p>
                <form class="px-4 py-2 w-full" method="POST" action="/account/payments/wallet/bank/save"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="accountHolderName" class="block text-gray-700 text-sm font-bold mb-2">Nombre del
                            Titular:</label>
                        <input type="text" id="accountHolderName" name="accountHolderName"
                            placeholder="Nombre del titular" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    </div>
                    <div class="mb-4">
                        <label for="accountNumber" class="block text-gray-700 text-sm font-bold mb-2">Número de
                            Cuenta:</label>
                        <input type="text" id="accountNumber" name="accountNumber" placeholder="Número de cuenta"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    </div>
                    <div class="mb-4">
                        <label for="accountType" class="block text-gray-700 text-sm font-bold mb-2">Tipo de
                            Cuenta:</label>
                        <select id="accountType" name="accountType" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                            <option value="savings">Ahorros</option>
                            <option value="checking">Corriente</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="bankName" class="block text-gray-700 text-sm font-bold mb-2">Nombre del Banco:</label>
                        <input type="text" id="bankName" name="bankName" placeholder="Nombre del banco" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    </div>
                    <div class="mb-4">
                        <label for="bankCode" class="block text-gray-700 text-sm font-bold mb-2">Código del Banco
                            (SWIFT/BIC):</label>
                        <input type="text" id="bankCode" name="bankCode" placeholder="Código SWIFT/BIC" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    </div>
                    <div class="mb-4">
                        <label for="iban" class="block text-gray-700 text-sm font-bold mb-2">Número IBAN:</label>
                        <input type="text" id="iban" name="iban" placeholder="Número IBAN" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    </div>
                    <div class="mb-4">
                        <label for="branchAddress" class="block text-gray-700 text-sm font-bold mb-2">Dirección de la
                            Sucursal:</label>
                        <input type="text" id="branchAddress" name="branchAddress"
                            placeholder="Dirección de la sucursal"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    </div>
                    <div class="mb-4">
                        <label for="accountHolderAddress" class="block text-gray-700 text-sm font-bold mb-2">Dirección del
                            Titular:</label>
                        <input type="text" id="accountHolderAddress" name="accountHolderAddress"
                            placeholder="Dirección del titular" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-600">
                    </div>
                    <div class="mb-6 flex flex-row gap-3 justify-end">
                        <input type="submit" value="Continuar">
                    </div>
                </form>
            </div>
        </div>
    </div>


    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://media.renthub.es/js/loader.js"></script>
    <script src="https://media.renthub.es/js/bigAddCreditCard.js"></script>
    <script src="https://media.renthub.es/js/bigAddBankAccount.js"></script>
    @if ($item === 'bank')
    <script>
        const newActionBankDisplay = document.getElementById('bankDisplay');
        const newActionBankDisplayBackdrop = document.getElementById('bankBackdrop');
        if (newActionBankDisplay && newActionBankDisplayBackdrop) {
            newActionBankDisplay.classList.remove('hidden');
            newActionBankDisplayBackdrop.classList.remove('hidden');
        }
    </script>
@endif
@endsection
@section('footer')
    @include('Footers.full_footer')
@endsection
