@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="displayFlex">
            <div class="horizontal-fill"></div>

            <div class="leftSideAuth">
                <div>
                    <x-input-label for="name" :value="__('auth.name')" class="section-content" />
                    <br>
                    <x-text-input id="name" class="authTextField" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('auth.email')" class="section-content" />
                    <br>
                    <x-text-input id="email" class="authTextField" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('auth.password')" class="section-content" />
                    <br>
                    <x-text-input id="password" class="authTextField"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('auth.confirm_password')" class="section-content" />
                    <br>
                    <x-text-input id="password_confirmation" class="authTextField"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- development Password  Bitte entfernen wenn developementphase vorbei ist.-->
               <!--  <div class="mt-4">
                    <x-input-label for="secret_password" :value="__('Secret Password')" class="section-content" />
                    <br>
                    <x-text-input id="secret_password" class="authTextField" type="password" name="secret_password" required />
                </div> -->

                </div>

            <div class="horizontal-fill"></div>
            <!-- spalte hier -->
            <div class="rightSideAuth">
                    
                <div class="flex items-center justify-end mt-4">
                    <a class="sectiontitle" href="{{ route('login') }}">
                        {{ __('auth.already_registered') }}
                    </a><br><br><br><b></b>

                    <x-primary-button class="approveButton">
                        {{ __('auth.register') }}
                    </x-primary-button>
                </div>
        <p class="section-content maxwidthXY">
            {{ __('auth.development_warning') }}
        </p>
            </div>
            <div class="horizontal-fill"></div>
        </div>
        </div>
    </form>
    <div>
    </div>
@endsection