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

    <div class="authDisplayFlex">
        <div class="horizontal-fill">

        </div>
        
        <div class="leftSideAuth"><p class="pagetitle">{{ __('auth.login') }}</p>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('auth.email')" class="section-content"/>
                <br>
                <input id="email" class="authTextField" type="email" name="email"  required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('auth.password')" class="section-content" />
                <br>
                <x-text-input id="password" class="authTextField"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Show Password Checkbox -->
            <div class="mt-2">
                <input type="checkbox" id="show-password" onclick="togglePassword()">
                <label for="show-password" class="section-content">{{ __('Show Password') }}</label>
            </div>

            <!-- JavaScript to toggle password visibility -->
            <script>
                function togglePassword() {
                    var passwordField = document.getElementById('password');
                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                    } else {
                        passwordField.type = 'password';
                    }
                }
            </script>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span  class="section-content">{{ __('auth.remember_me') }}</span>
                </label>
            </div>
        </div>
        <div class="horizontal-fill">

        </div>
        
        <div class="items-center justify-end mt-4 rightSideAuth"><br><br>
            <a class="sectiontitle" href="/register">
                    {{ __('auth.no_account_yet') }}
                </a>
                <br><br>
            @if (Route::has('password.request'))
                <a class="sectiontitle" href="{{ route('password.request') }}">
                    {{ __('auth.forgot_password') }}
                </a>
            @endif
            <br><br><br>
            <x-primary-button class="approveButton">
                {{ __('auth.log_in') }}
            </x-primary-button>
        </div>
        <div class="horizontal-fill">

</div>
    </div>

    </form>
@endsection
