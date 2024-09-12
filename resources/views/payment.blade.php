

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Payment Form</h1>

    <form action="/charge" method="post" id="payment-form">
        @csrf
        <div id="card-element">

        </div>

        <button type="submit">Submit Payment</button>
    </form>

    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {

                    console.error(result.error.message);
                } else {

                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
