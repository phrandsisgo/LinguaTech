@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<?php 
$path = "edit";
?>
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')

<p class="pagetitle">Einstellungen für das Profil.</p>
<br><br>
    @include('profile.partials.update-interests-languages')
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
              
        </div>
    </div>
   
@endsection
