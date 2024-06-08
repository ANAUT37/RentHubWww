<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Setup</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <form id="payout-form">
        <button type="submit">Submit</button>
    </form>

    <script>
        var stripe = Stripe(
            'pk_test_51OexU1FHiAmjSHlNxC9rvIumCWrUpjIH2K3PIzYfryueYzwOS7oiG1VOxtfxGe7P3nZtAemD7n7DqQvQ4aY4Ke4h00b14By47l'
        );

        // Obtener el formulario
        var form = document.getElementById('payout-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            console.log(1);
            // Solicitar al backend el client secret
            fetch('/transaction/bank/create-client-secret', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    var clientSecret = data.client_secret;
                    console.log(2);
                    // Confirmar la transferencia bancaria SEPA
                    stripe.confirmSepaDebitPayment(clientSecret, {
                            payment_method: {
                                sepa_debit: {
                                    iban: 'ES0700120345030000067890', // Aquí debes agregar el IBAN del comprador obtenido del formulario
                                },
                                billing_details: {
                                    name: 'Nombre del titular de la cuenta', // Nombre del titular del IBAN
                                    email: 'correo@example.com' // Correo electrónico del titular del IBAN
                                }
                            }
                        })
                        .then(function(result) {
                            // Manejar la respuesta
                            console.log(3);
                            if (result.error) {
                                console.log(result.error.message);
                            } else {
                                var paymentIntent = result.paymentIntent;
                                if (paymentIntent.status === "succeeded") {
                                    // La transferencia se realizó correctamente
                                    console.log("La transferencia se realizó correctamente.");
                                } else {
                                    // Manejar otros estados del PaymentIntent si es necesario
                                    console.log(paymentIntent.status);
                                }
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                        });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>


</body>

</html>
