@extends('layouts.lingua_main')
@section('title', 'about me')
@section('head')
<style>

</style>

@vite(['resources/css/library.scss'])
@endsection
@section('content')

<div class="hero">
    <div class="image-crop">
        <img src="{{ asset('profilbild.jpg')}}" alt="" id="profilBild">
    </div>
    <div class="heroLeading">
        <p class="pagetitle">Francisco <br> Wohlgemuth</p>
    </div>
</div>
<p class="section-content">{{ __('about_me.introduction') }} <a href="https://github.com/phrandsisgo" target="_blank">phrandsisgo</a>.</p>
<p class="section-content"><a href="/about_project">{{ __('about_me.project_link') }}</a></p>

<br>
<p class="sectiontitle"><b>{{ __('about_me.skills_title') }}</b></p>

<div class="displayFlex" style="flex-wrap:wrap; justify-content:center;">
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">
            <img src="{{asset('svg-icons/codingLogo.svg')}}" alt="Icon für coding">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">{{ __('about_me.techstack') }}</p>
            <p>{{ __('about_me.techstack_details') }}</p>
        </div>
    </div>
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">
            <img src="{{asset('svg-icons/globeIcon.svg')}}" alt="Icon für Sprachen">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">{{ __('about_me.nationality_languages') }}</p>
            <p>{{ __('about_me.nationality_languages_details') }}</p>
        </div>
    </div>
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">
            <img src="{{asset('svg-icons/educationIcon.svg')}}" alt="Icon für Ausbildung">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">{{ __('about_me.education') }}</p>
            <p>{{ __('about_me.education_details') }}</p>
        </div>
    </div>
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">
            <img src="{{asset('svg-icons/brushIcon.svg')}}" alt="Icon für Hobbys">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">{{ __('about_me.hobbies') }}</p>
            <p>{{ __('about_me.hobbies_details') }}</p>
        </div>
    </div>
</div>

@endsection
