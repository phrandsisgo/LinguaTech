
@extends('layouts.lingua_main')
@section('title', 'Landing Page')
@section('head')
    <style>


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
        <div class="heroFontSection">
            <p class="pagetitle">Linguatech, der Ort, an dem Sie Ihr Leseverständnis perfektionieren können!</p>
            <p class="sectiontitle">Hier können Sie eigene Texte einbringen oder mit Ihren Wortlisten lernen!</p>
            <a href="register">
                <button class="approveButton">Jetzt registrieren</button>
            </a>
        </div>
        <div class="horizontal-fill"></div>
        <img id="gif1" src="{{ asset('Images/SwipeLearn.gif')}}" alt="{{ __('welcomepage.swipe_function') }}" class="horizontal-fill">
    </div>
    <br>
    <div class="colorBreak">
        <p>Folgende Probleme haben mich beschäftigt bevor ich Linguatech gegründed habe:</p>
    </div>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500" >
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-wrapper">
                    <p class="pagetitle">Haben Sie mühe, genügend Ressourcen für Ihre Zielsprache zu finden?</p>
                    <p class="sectiontitle">Hier können Sie alle Texte der Welt verwenden und für Ihre Bedürfnisse anpassen.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-wrapper">
                    <p class="pagetitle">Sie haben so viele Wörter, dass Sie nicht mehr wissen, wie man sie in einem Text verwendet?</p>
                    <p class="sectiontitle">Erstellen Sie Texte mittels KI, die auf Ihren Schwierigkeitsgrad angepasst werden, damit Sie Ihre Fremdwortsammlung perfekt lernen können.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-wrapper">
                    <p class="pagetitle">Sie haben keine Zeit, um Ihre eigene Lerntexte zu schreiben?</p>
                    <p class="sectiontitle">Kein Problem, wir haben eine Bibliothek mit Texten, die Sie verwenden können.</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-wrapper">
                    <p class="pagetitle">Haben Sie Mühe, relevante Zeitungsartikel in Ihrer Sprache und Schwierigkeitsstufe zu finden?</p>
                    <p class="sectiontitle">An diesem Problem wird zurzeit gearbeitet, sodass Sie in Kürze Wissenswertes aus aller Welt hier konsumieren können.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev" style=" margin-left: -20px;">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="42" height="42"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M6 12L11 7M6 12L11 17" stroke="#073B4C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style=" margin-right: -20px;">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="42" height="42"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12H18M18 12L13 7M18 12L13 17" stroke="#073B4C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <span class="visually-hidden">Next</span>
        </button>
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
    </div>
@endsection

