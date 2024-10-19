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
                <h3 class="sectiontitle">Abonnement Details</h3>
                <p class="section-content"><strong>Credits übrig:</strong> {{ $user->credits }}</p>
                <p class="section-content"><strong>Abonnement läuft bis:</strong> {{ $user->subscribed_until ? \Carbon\Carbon::parse($user->subscribed_until)->toFormattedDateString() : 'Kein aktives Abonnement' }}</p>


                @if($user->subscribed_until && now()->lessThanOrEqualTo($user->subscribed_until))
                    <p class="section-content">Du kannst dein Abo noch bis zum {{ $user->subscribed_until}} nutzen.</p>

                    <form action="{{ route('profile.cancel-subscription') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Abo kündigen</button>
                    </form>
                @else
                    <p class="section-content">Du hast kein aktives Abonnement.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h3>Abonnement Details</h3>

        @if($user->stripe_subscription_id)
            <p><strong>Status:</strong> {{ ucfirst($user->subscription_status) }}</p>
            
            <p class="section-content"><strong>Abonnement läuft bis:</strong> {{ $user->subscribed_until }}</p>


            @if($user->subscription_status === 'active')
                <form action="{{ route('profile.cancel-subscription') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Abo kündigen</button>
                </form>
            @else
                <p>Dein Abonnement ist {{ $user->subscription_status }}.</p>
            @endif
        @else
            <p>Du hast kein aktives Abonnement.</p>
            <a href="{{ route('stripe.index') }}" class="btn btn-primary">Abonnement abschließen</a>
        @endif
    </div>
   
@endsection
