@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<?php 
$path = "profile";
?>
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')

<p class="pagetitle">Einstellungen für das Profil.</p>
<br><br>
    <!-- @include('profile.partials.update-interests-languages') -->
    @include('profile.partials.select-language')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
   
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
           
            @include('profile.partials.update-profile-information-form')
        

            @include('profile.partials.update-password-form')
        

    
            @include('profile.partials.delete-user-form')
            <!-- Success Message -->
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-4">
                <h3 class="sectiontitle">{{ __('profile.subscription_details') }}</h3>
                <p class="section-content"><strong>{{ __('profile.credits_remaining') }}</strong> {{ $user->credits }}</p>
                @if($user->subscribed_until && now()->lessThanOrEqualTo($user->subscribed_until))
                    <p class="section-content"><strong>{{ __('profile.subscription_expires_on') }}</strong> {{ $user->subscribed_until ? \Carbon\Carbon::parse($user->subscribed_until)->toFormattedDateString() : __('profile.no_active_subscription') }}</p>

                    <p class="section-content">{{ __('profile.subscription_valid_until', ['subscribed_until' => \Carbon\Carbon::parse($user->subscribed_until)->toFormattedDateString()]) }}</p>

                    @if($user->subscription_status === 'active')
                        <form action="{{ route('profile.cancel-subscription') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">{{ __('profile.cancel_subscription') }}</button>
                        </form>
                    @elseif (ucfirst($user->subscription_status) === 'Canceled')
                        <a href="/stripe" class="standartButton" style="text-decoration: none;">{{ __('profile.renew_subscription') }}</a>
                    @endif
                @else
                    <p class="section-content">{{ __('profile.no_active_subscription') }}</p>
                @endif
            </div>

            <div class="mt-4">
                <h3 class="sectiontitle">{{ __('profile.subscription_status') }}</h3>

                @if($user->stripe_subscription_id)
                    <p class="section-content"><strong>{{ __('profile.status') }}</strong> {{ ucfirst($user->subscription_status) }}</p>
                    
                    <p class="section-content"><strong>{{ __('profile.subscription_expires_on') }}</strong> {{ $user->subscribed_until ? \Carbon\Carbon::parse($user->subscribed_until)->toFormattedDateString() : __('profile.no_active_subscription') }}</p>

                    @if($user->subscription_status === 'active')
                        <form action="{{ route('profile.cancel-subscription') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">{{ __('profile.cancel_subscription') }}</button>
                        </form>
                    @else
                        <p class="section-content">{{ __('profile.your_subscription_is', ['subscription_status' => $user->subscription_status]) }}</p>
                    @endif
                @else
                    <p class="section-content">{{ __('profile.no_active_subscription') }}</p>
                    <a href="{{ route('stripe.index') }}" class="btn btn-primary">{{ __('profile.subscribe_now') }}</a>
                @endif
            </div>

   
@endsection
