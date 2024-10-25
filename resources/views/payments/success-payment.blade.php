@extends('layouts.lingua_main')
@section('title', 'Successful Payment')
@section('head')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
</head>
@endsection
@section('content')
<body>
    <h1 class="pagetitle">{{ __('stripe.successfull_payment') }}</h1>
    <p class="section-content">{{ __('stripe.thanks_for_purchase') }}</p>
    <p class="section-content">{{ __('stripe.recieve_payment', ['amount' => $amount]) }}</p>

    <p class="section-content">{{ __('stripe.subscription_active_until', ['date'=> $subscriptionEndDate]) }}</p>
    <a href="{{ route('dashboard') }}" class="successButton">{{ __('stripe.close') }}</a>
</body>
@endsection
