@extends('layouts.header')

@section('content')
    <h1>Paiement de la commande</h1>

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="amount">Montant à payer (en €)</label>
            <input type="number" id="amount" name="amount" class="form-control" min="1" value="{{ $total }}">
        </div>

        <div class="form-group">
            <label for="card-element">Informations de paiement</label>
            <div id="card-element"></div>
        </div>

        <button type="submit" class="btn btn-primary">Payer</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

        var elements = stripe.elements();
        var cardElement = elements.create('card');

        cardElement.mount('#card-element');

        var form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);
                    form.submit();
                }
            });
        });
    </script>
@endsection
