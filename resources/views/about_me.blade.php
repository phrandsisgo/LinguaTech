@extends('layouts.lingua_main')
@section('title', 'about me')
@section('head')
<style>

</style>
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



<p class="tech-skill">Frontend-Entwicklung: Umfassende Kenntnisse in HTML, JavaScript und CSS.</p>
<p class="tech-skill">Backend-Entwicklung: Erfahrung mit Python und Flask-Anwendungen sowie PHP, hauptsächlich im Rahmen von Laravel-Projekten.</p>
<p class="tech-skill">Mobile Entwicklung: Praktische Erfahrungen mit Dart und Flutter für cross-plattform mobile Anwendungen.</p>
<p class="tech-skill">Grundlagen in Java: Solide Kenntnisse in objektorientierter Programmierung durch Java.</p>

    @endsection