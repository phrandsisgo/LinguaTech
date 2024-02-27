@extends('layouts.lingua_main')
@section('title', 'textPlay')
@section('head')

@vite(['resources/css/library.scss'])

@endsection
@section('content')

<p class="pagetitle">Alle verfügbare Texte</p>
<a href="/addText" class="section-content">Neuer Text hinzufügen</a>
<div class="textSortierer">

    <div class="language-spez-text">
        <button class="language-button " data-target="eigeneTexte" onclick="changeArrowDirection('eigeneTexte')">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
            </svg>
            <p>Eigene Texte</p>
        </button>
        <div id="eigeneTexte" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->created_by == Auth::user()->id) 
                    <a href="/textShow/{{$text->id}}">
                        <div class="Texts-Card">
                            <p>{{ $text->title }}</p>
                            <p>{{$text->langOption->language_name}}</p>
                            <br>
                        </div>
                    </a>
                @endif
            @endforeach
       </div>
    </div>

    <div class="language-spez-text">
        <button class="language-button " data-target="DE" onclick="changeArrowDirection('DE')">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
            </svg>
            <p>Deutsch</p>
        </button>
        <div id="DE" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'DE' && $text->created_by == 1) 
                    <a href="/textShow/{{$text->id}}">
                        <div class="Texts-Card">
                            <p>{{ $text->title }}</p>
                            <p>{{$text->langOption->language_name}}</p>
                            <br>
                        </div>
                    </a>
                @endif
            @endforeach
       </div>
    </div>
    <div class="language-spez-text">
    
        <button class="language-button " data-target="FR" onclick="changeArrowDirection('FR')">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
            </svg>
            <p>Französisch</p>
        </button>
        <div id="FR" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'FR') 
                    <a href="/textShow/{{$text->id}}">
                        <div class="Texts-Card">
                            <p>{{ $text->title }}</p>
                            <p>{{$text->langOption->language_name}}</p>
                            <br>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="language-spez-text">
        <button class="language-button" data-target="RU" onclick="changeArrowDirection('RU')">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
            </svg>
            <p>Russisch</p>
        </button>
        <div id="RU" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'RU' && $text->created_by == 1) 
                    <a href="/textShow/{{$text->id}}">
                        <div class="Texts-Card">
                            <p>{{ $text->title }}</p>
                            <p>{{$text->langOption->language_name}}</p>
                            <br>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="language-spez-text">
        <button class="language-button" data-target="EN" onclick="changeArrowDirection('EN')">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
            </svg>
            <p>English</p>
        </button>
        <div id="EN" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'EN' && $text->created_by == 1) 
                    <a href="/textShow/{{$text->id}}">
                        <div class="Texts-Card">
                            <p>{{ $text->title }}</p>
                            <p>{{$text->langOption->language_name}}</p>
                            <br>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="language-spez-text">
        <button class="language-button" data-target="PT" onclick="changeArrowDirection('PT')">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#073B4C" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" fill="#073B4C"/>
            </svg>
            <p>Portuguese</p>
        </button>
        <div id="PT" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'PT' && $text->created_by == 1) 
                    <a href="/textShow/{{$text->id}}">
                        <div class="Texts-Card">
                            <p>{{ $text->title }}</p>
                            <p>{{$text->langOption->language_name}}</p>
                            <br>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div> 
<!--
<div class="Card-Wrapper">
    @foreach($allTexts as $text)
    <a href="/textShow/{{$text->id}}">
        <div class="Texts-Card">
        <p>{{ $text->title }}</p>
            <p>{{$text->langOption->language_name}}</p>
            <br>
        </div>
    </a>
    @endforeach
</div>
-->
<script>

function changeArrowDirection(lang_code) {
    const button = document.querySelector(`[data-target="${lang_code}"]`);
    const svg = button.querySelector('svg');
    svg.classList.toggle('arrow-Right');
}
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.language-button').forEach(button => {
            button.addEventListener('click', function() {
                let targetId = this.getAttribute('data-target');
                let targetElement = document.getElementById(targetId);

                if (targetElement.style.display === 'none') {
                    targetElement.style.display = '';
                } else {
                    targetElement.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
