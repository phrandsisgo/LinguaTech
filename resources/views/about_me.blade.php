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
<p class="section-content">Hallo zusammen, mein Name ist Francisco Wohlgemuth. Ich bin angehender Web-Developer. Auf dieser Webseite habe ich eine Sprach-App gebaut, da ich mit anderen nicht zufrieden war. Ursprünglich stamme ich aus der Baubranche, wo ich als Elektroinstallateur tätig war. Dann entwickelte sich meine Leidenschaft für die Webentwicklung. Ich probiere gerne neue Wege wie man programmiert aus und lerne immer mehr dazu. Zur Zeit liegt mein Fokus voll und ganz auf der Web-Entwicklung und ich bin auf Stellensuche als Web-Developer Junior. Schauen Sie sich doch meine Projekte auf GitHub <a href="https://github.com/phrandsisgo" target="_blank">phrandsisgo</a> an.</p>
<p class="section-content"><a href="/about_project">Hier</a> erfahren Sie mehr über dieses Projekt.</p>

<br>
<p class="sectiontitle"><b>Meine technischen Fähigkeiten:</b></p>

<div class="displayFlex" style="flex-wrap:wrap; justify-content:center;">
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">

            <img src="{{asset('svg-icons/codingLogo.svg')}}" alt="Icon für coding">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">Techstack</p>
            <p>SCSS, HTML, JS,CSS  <br> Laravel(PHP) Python <br> Einbindung diverser APIs</p>
        </div>

    </div>
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">

            <img src="{{asset('svg-icons/globeIcon.svg')}}" alt="Icon für coding">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">Nationalität & Sprachkenntnisse</p>
            <p>Schweizer  <br> Fliessend: Deutsch Englisch Porugiesisch <br> A1-A2: Französisch, Russisch, Spanisch</p>
        </div>

    </div>
    <br><br>
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">

            <img src="{{asset('svg-icons/educationIcon.svg')}}" alt="Icon für coding">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">Ausbildung</p>
            <p>Grundausbildung: Elektroinstallateur  <br> 6 Monate Codingbootcamp für WebDev</p>
        </div>

    </div>
    <div class="library-Card displayFlex media-Card">
        <div class="aboutCardsIcons">

            <img src="{{asset('svg-icons/brushIcon.svg')}}" alt="Icon für coding">
        </div>
        <div class="card-title-about">
            <p class="cardTitle">Interessen neben der IT</p>
            <p>Schach spielen<br> Video spiele <br> Geige</p>
        </div>

    </div>
    
</div>

    @endsection