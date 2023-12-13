@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
  
    <form method="POST" action="{{ route('login') }}">
        @csrf

    <div class="displayFlex">
        <div class="horizontal-fill">

        </div>
        
        <div class="leftSideAuth"><p class="pagetitle">Login</p>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="section-content"/>
                <br>
                <input id="email" class="authTextField" type="email" name="email"  required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="section-content" />
                <br>
                <x-text-input id="password" class="authTextField"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span  class="section-content">{{ __('Remember me') }}</span>
                </label>
            </div>
        </div>
        <div class="horizontal-fill">

        </div>
        
        <div class="flex items-center justify-end mt-4 rightSideAuth"><br><br>
            <a class="sectiontitle" href="/register">
                    {{ __('Noch kein Benutzerkonto?') }}
                </a>
                <br><br>
            @if (Route::has('password.request'))
                <a class="sectiontitle" href="{{ route('password.request') }}">
                    {{ __('Passwort Vergessen?') }}
                </a>
            @endif
            <br><br><br>
            <x-primary-button class="approveButton">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="horizontal-fill">

</div>
    </div>

    </form>
@endsection
