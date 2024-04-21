
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
    <p class="sectiontitle">Hier können Sie eigene Texte einbringen oder mit Ihren Wortlisten lernen.</p>
    <a href="register">
        <button class="approveButton">Jetzt registrieren</button>
    </a>
            </a>
        </div>
        <div class="horizontal-fill"></div>
        <img id="gif1" src="{{ asset('Images/SwipeLearn.gif')}}" alt="{{ __('welcomepage.swipe_function') }}" class="horizontal-fill">
    </div>
    <br>
    <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
            <p class="pagetitle">Linguatech, der Ort, an dem Sie Ihr Laseverständnis perfektionieren können!</p>
            <p class="sectiontitle">Hier können Sie eigene Texte einbringen oder mit Ihren Wortlisten lernen.</p>
    </div>
    <div class="carousel-item">
            <p class="pagetitle">Linguatech, der Ort, an dem Sie Ihr Laseverständnis perfektionieren können!</p>
            <p class="sectiontitle">Hier können Sie eigene Texte einbringen oder mit Ihren Wortlisten lernen.</p>
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <div class="problemsection">
        <p class="landingFont2">Stellen Sie sich vor, Sie müssten niemals mehr nach passenden Inhalten suchen, um Ihre Zielsprache zu lernen.</p>
        <div class="solutionGraph">
            <p class="sectiontitle">Haben Sie Mühe, genügend Ressourcen für Ihre Zielsprache zu finden?</p>
            <p class="section-content">Hier können Sie alle Texte der Welt verwenden und für Ihre Bedürfnisse anpassen.</p>
        </div>
        <div class="solutionGraph">
            <p class="sectiontitle">Sie haben so viele Wörter, dass Sie nicht mehr wissen, wie man sie in einem Text verwendet?</p>
            <p class="section-content">Erstellen Sie Texte mittels KI, die auf Ihren Schwierigkeitsgrad angepasst werden, damit Sie Ihre Fremdwortsammlung perfekt lernen können.</p>
        </div>
        <div class="solutionGraph">
            <p class="sectiontitle">Sie haben keine Zeit, um Texte zu schreiben?</p>
            <p class="section-content">Kein Problem, wir haben eine Bibliothek mit Texten, die Sie verwenden können.</p>
        </div>
        <div class="solutionGraph">
            <p class="sectiontitle">Haben Sie Mühe, relevante Zeitungsartikel in Ihrer Sprache und Schwierigkeitsstufe zu finden?</p>
            <p class="section-content">An diesem Problem wird zurzeit gearbeitet, sodass Sie in Kürze Wissenswertes aus aller Welt hier konsumieren können.</p>
        </div>

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

