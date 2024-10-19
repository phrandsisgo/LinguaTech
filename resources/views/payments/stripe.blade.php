<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Stripe Test Payment</h1>
    <button id="checkout-button">Zahlung durchführen</button>

    <script type="text/javascript">
        var stripe = Stripe('{{ env('STRIPE_TEST_PUBLIC') }}');

        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function () {
            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function (result) {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
