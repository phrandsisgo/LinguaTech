@extends('layouts.lingua_main')
@section('title', 'payment')
@section('head')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
@endsection
@section('content')
<h1>Stripe Test Payment</h1>
<button id="checkout-button">Start payment</button>

<div class="container py-5">
    <h1 class="text-center font-color-main">{{ __('stripe.pricing_title') }}</h1>
    <p class="text-center lead font-color-main">{{ __('stripe.pricing_subtitle') }}</p>

    <!-- Introductory Text -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <p class="font-color-main">{{ __('stripe.description_intro') }}</p>
            <p class="font-color-main">{{ __('stripe.description_features') }}</p>
            <p class="font-color-main">{{ __('stripe.description_development') }}</p>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <!-- Free Plan -->
        <div class="col-md-5">
            <div class="card mb-5 shadow-sm">
                <div class="card-header text-center">
                    <h4 class="my-0 font-weight-normal">{{ __('stripe.plan_free') }}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">0€ <small class="text-muted">/ {{ __('stripe.per_month') }}</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>{{ __('stripe.unlimited_stories') }}</li>
                        <li>{{ __('stripe.unlimited_decks') }}</li>
                        <li>{{ __('stripe.limited_story_generation') }}</li>
                        <li>{{ __('stripe.no_audiobooks') }}</li>
                    </ul>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-lg btn-block btn-outline-primary">{{ __('stripe.sign_up') }}</a>
                    @else
                    <a href="/library" class="standartButton" style="text-decoration: none;">{{ __('stripe.go_to_library') }}</a>
                    @endguest
                </div>
            </div>
        </div>
        <!-- Premium Plan -->
        <div class="col-md-5">
            <div class="card mb-5 shadow-sm">
                <div class="card-header text-center">
                    <h4 class="my-0 font-weight-normal">{{ __('stripe.plan_premium') }}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">8€ <small class="text-muted">/ {{ __('stripe.per_month') }}</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>{{ __('stripe.unlimited_stories') }}</li>
                        <li>{{ __('stripe.unlimited_decks') }}</li>
                        <li>{{ __('stripe.unlimited_story_generation') }}</li>
                        <li>{{ __('stripe.audiobooks_included') }}</li>
                    </ul>
                    @guest
                        <a href="/register" class="approveButton" style="text-decoration: none;">{{ __('stripe.sign_up') }}</a>
                    @else
                        <button id="checkout-button" class="approveButton" onclick="StripeInitiation()">{{ __('stripe.subscribe_now') }}</button>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');

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
            if (session.error) {
                alert(session.error);
                return;
            }
            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    });
</script>
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


    function StripeInitiation() {
        fetch('/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Falls du CSRF-Schutz verwendest
            },
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (session) {
            if (session.error) {
                alert(session.error);
                return;
            }

            var stripe = Stripe('{{ env('STRIPE_TEST_PUBLIC') }}'); //bei production auf live key ändern

            return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    }
</script>
@endsection 
