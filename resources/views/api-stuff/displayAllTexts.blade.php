@extends('layouts.lingua_main')
@section('title', 'textPlay')
@section('head')

@vite(['resources/css/library.scss'])

@endsection
@section('content')

<p class="pagetitle">Alle verfügbare Texte</p>

<div class="textSortierer">
    <div class="language-spez-text">
        <button class="language-button" data-target="DE">Deutsch</button>
        <div id="DE" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'DE') 
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
    
        <button class="language-button " data-target="FR">
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
        <button class="language-button" data-target="RU">Russisch</button>
        <div id="RU" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'RU') 
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
        <button class="language-button" data-target="EN">Englisch</button>
        <div id="EN" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'EN') 
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
        <button class="language-button" data-target="PT">Portugiesisch</button>
        <div id="PT" style="display: none;" class="text-container">
            @foreach($allTexts as $text)
                @if ($text->langOption->language_code == 'PT') 
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
@endsection
<script>
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
