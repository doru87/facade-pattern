@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Stripe Payment</h2>

    <form action="{{ route('payment.store') }}" method="POST" id="payment-form">
        @csrf
        
        <!-- Card input field provided by Stripe Elements -->
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <input type="text" name="amount" id="amount">
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>

        <button type="submit">Pay</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Create a Stripe client.
    var stripe = Stripe('pk_test_51IDASUGMKwBbdaOByrLwMB4BUCy1pu34phvsg39UIXdsOIFqpKZqeRzgBjDiWoHGfBg5UNDpbdt4PikZk0fLFE1c00vXq5PEjk'); // Replace with your Stripe public key
    var elements = stripe.elements();

    // Create an instance of the card Element.
    var card = elements.create('card');

    // Add an instance of the card Element into the `card-element` div.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

});
</script>
@endsection
