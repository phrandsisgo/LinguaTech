
@extends('layouts.lingua_main')
@section('title', 'under construction')
@section('head')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
<div class="mainHero">
    <p class="sectiontitle">Willkommen bei Linguatech</p>
    <img id="gif1" src="{{ asset('Images/SwipeLearn.gif')}}" alt="{{ __('welcomepage.swipe_function') }}">

</div>
        <p class="sectiontitle">{{ __('welcomepage.section_title') }}</p>
        <div class="lauf-Text">
            <p class="section-content">{{ __('welcomepage.welcome_text') }}</p>
            <img id="gif1" src="{{ asset('Images/SwipeLearn.gif')}}" alt="{{ __('welcomepage.swipe_function') }}">
            <p>{{ __('welcomepage.swipe_function') }}</p>

            <br><br><br>

            <p class="section-content">{{ __('welcomepage.library_text') }}</p>
            <img id="gif2" src="{{ asset('Images/apiGif.gif')}}" alt="{{ __('welcomepage.text_function') }}">
            <p>{{ __('welcomepage.text_function') }}</p>
            <br><br><br>
            <p class="section-content">
                {{ __('welcomepage.signup_invitation') }}
            </p>
@endsection

