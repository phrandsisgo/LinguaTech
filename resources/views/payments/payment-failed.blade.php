@extends('layouts.lingua_main')
@section('title', 'payment')
@section('head')
@endsection
@section('content')
<p class="pagetitle">{{ __('stripe.payment_failed') }}</p>
<a href="/stripe">{{ __('stripe.try_again') }}
<br>
<a href="/">{{ __('stripe.back_main_page') }}</a>
@endsection 
