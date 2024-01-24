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
<p class="section-content">Hallo zusammen, mein Name ist Francisco Wohlgemuth. Ich bin angehender Web-developer. Auf dieser Webseite versuche ich, eine Sprach-App zu bauen, da ich mit anderen Sprach-Apps nicht zufrieden war." Ursprünglich stamme ich aus der Baubranche, wo ich als Elektroinstallateur tätig war. Doch dann entwickelte sich meine Leidenschaft für die Webentwicklung. Ich lerne gerne neue Verfahren über das programmieren und lerne gerne immer mehr dazu. Zur zeil liegt mein Fokus voll und ganz auf die Web-Entwicklung und ich bin zur Zeit auf der Stellensuche als web-entwickler in einer Junior position. Schauen Sie sich gerne meine Projekte auf meinem <a href="https://github.com/phrandsisgo">GitHub-Profil</a> an.</p>
<p class="section-content"> Falls sie Lust haben mehr über das Projekt zu erfahren, dann clicken sie <a href="/about_project">hier</a> drauf.</p>

<br>
<p class="sectiontitle"><b>Meine technischen Fähigkeiten:</b></p>



<p class="tech-skill">Frontend-Entwicklung: Umfassende Kenntnisse in HTML, JavaScript und CSS.</p>
<p class="tech-skill">Backend-Entwicklung: Erfahrung mit Python und Flask-Anwendungen sowie PHP, hauptsächlich im Rahmen von Laravel-Projekten.</p>
<p class="tech-skill">Mobile Entwicklung: Praktische Erfahrungen mit Dart und Flutter für cross-plattform mobile Anwendungen.</p>
<p class="tech-skill">Grundlagen in Java: Solide Kenntnisse in objektorientierter Programmierung durch Java.</p>

    @endsection