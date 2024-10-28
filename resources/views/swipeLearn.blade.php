@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')

<script src="https://hammerjs.github.io/dist/hammer.js"></script> 
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>
@vite(['resources/css/application.scss', 'resources/css/animations.scss', 'resources/js/animations.js'])

<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('content')
<p class="sectiontitle swipeLearnTitle">{{$liste->name}}</p>

<div class="karteContent">
    <div class="flip-card-inner" id="flip-card-inner">
        <div class="flashCardContent frontface" id="flashCardContent">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin" id="repAzeigB">0</p></div>
                <div class="countAnzeige" id="countAnzeigeB">1/{{count($liste->words)}} {{ __('swipe.words') }}</div>
                <div class="doneCountBox"><p class="anzeigemargin" id="doneAnzeigeB">0</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="baseWord">word</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('svg-icons/denyIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerLeft()">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('svg-icons/confirmIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerRight()">
            </div>
        </div>

        <div class="flashCardContent backface" id="flashCardContent">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin" id="repAzeigA">0</p></div>
                <div class="countAnzeige" id="countAnzeigeA">1/{{count($liste->words)}} {{ __('swipe.words') }}</div>
                <div class="doneCountBox"><p class="anzeigemargin" id="doneAnzeigeA">0</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="targetWord">{{ __('swipe.word') }}</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('svg-icons/denyIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerLeft()">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('svg-icons/confirmIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerRight()">
            </div>
        </div>
    </div>
</div>

<p class="section-content swipeContent">{{ __('swipe.description') }} {{$liste->description}}</p>

<div id="swipeStatistikModal" style="display:none;">
    <div class="modal-content">
        <h2>{{ __('swipe.swipeStatistics') }}</h2>
        <p>{{ __('swipe.unknownAnswersCount')}} <span id="leftSwipeCount"></span></p>
        <p>{{ __('swipe.knownAnswersCount')}} <span id="rightSwipeCount"></span></p>
        <br><br>
        <div style="height:4rem;"></div>
        <a href="#"><button onclick="restartWithUnknownAnswers();" class="standartButton">{{ __('swipe.repeat-wrong-answers') }}</button></a>   
        <a href="#"><button onclick="location.reload();" class="standartButton">{{ __('swipe.learnAgain') }}</button></a>
        <a href="/library"><button onclick="document.getElementById('swipeStatistikModal').style.display = 'none';" class="modalclose" >{{ __('swipe.close') }}</button></a>
    </div>
</div>

<script>
// Globale Variablen
var listLength = {{count($liste->words)}};
var listProgress = 0;
var doneAnzeige = 0;
var repAzeig = 0;
var aktuelleKarteIndex = 0;
var unknownAnswers = [];

@php
$woerterbuch = $liste->words->map(function ($word) {
    return [
        'base_word' => $word->base_word,
        'target_word' => $word->target_word,
        'id' => $word->id,
        'learned' => false,
    ];
});
@endphp

var woerterbuch = @json($woerterbuch);

// Funktionen
function zeigeStatistikModal() {
    document.getElementById('leftSwipeCount').textContent = repAzeig;
    document.getElementById('rightSwipeCount').textContent = doneAnzeige;
    document.getElementById('swipeStatistikModal').style.display = 'block';
}

function handleSwipe(direction, wordId) {
    event.preventDefault();
    const requestData = {
        wordId: wordId,
        direction: direction
    };
    var csrf = document.querySelector('meta[name="_token"]').content;

    const formData = JSON.stringify(requestData);

    fetch('/swipeHandle/', {
            method: 'POST',
            body: formData,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            }
        })
    .then(response => response.json())
    .then(data => {
           // Handle response if needed
    })
    .catch(error => console.error('Error:', error));   
}

function updateUI() {
    // Aktualisiere die Wortzähler
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = "1/" + woerterbuch.length + " Wörter";
    countAnzeigeB.textContent = "1/" + woerterbuch.length + " Wörter";

    // Zeige das erste Wort an
    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    if (woerterbuch.length > 0) {
        kartenTextBase.textContent = woerterbuch[0].base_word;
        kartenTextTarget.textContent = woerterbuch[0].target_word;
    } else {
        // Zeige eine Meldung an, wenn keine Wörter übrig sind
        kartenTextBase.textContent = "Keine Wörter übrig.";
        kartenTextTarget.textContent = "";
    }

    // Setze die Anzeigen zurück
    document.getElementById('repAzeigA').textContent = "0";
    document.getElementById('repAzeigB').textContent = "0";
    document.getElementById('doneAnzeigeA').textContent = "0";
    document.getElementById('doneAnzeigeB').textContent = "0";

    // Zurücksetzen der Fortschrittsvariablen
    aktuelleKarteIndex = 0;
    repAzeig = 0;
    doneAnzeige = 0;
}

function restartWithUnknownAnswers(){
    var unlearnedWords = woerterbuch.filter(word => !word.learned);
    if (unlearnedWords.length > 0) {
        aktuelleKarteIndex = woerterbuch.findIndex(word => !word.learned);
        // Zähler zurücksetzen
        repAzeig = 0;
        doneAnzeige = 0;
        listLength = unlearnedWords.length;
        updateKarte();
        document.getElementById('swipeStatistikModal').style.display = 'none';
    } else {
        alert("Herzlichen Glückwunsch! Du hast alle Wörter gelernt.");
    }
}

function showNextWord() {
    aktuelleKarteIndex++;
    while (aktuelleKarteIndex < woerterbuch.length && woerterbuch[aktuelleKarteIndex].learned) {
        aktuelleKarteIndex++;
    }
    if (aktuelleKarteIndex >= woerterbuch.length) {
        zeigeStatistikModal();
    } else {
        updateKarte();
    }
}

function updateKarte() {
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = (aktuelleKarteIndex + 1) + "/" + woerterbuch.length + " Wörter";
    countAnzeigeB.textContent = (aktuelleKarteIndex + 1) + "/" + woerterbuch.length + " Wörter";

    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex].base_word;
    kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex].target_word;
}

function showUebersetzung(){
    var flipcard = document.getElementById('flip-card-inner');
    if(flipcard.classList.contains('turnCard')){
        flipcard.classList.remove('turnCard');
    }else{
        flipcard.classList.add('turnCard');
    }
}

function triggerLeft(){
    // Animation hinzufügen
    console.log('triggerLeft');
    var karteContent = document.getElementById('flip-card-inner');
    karteContent.classList.add('animate__rollOut__left');
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__left');
    });

    repAzeig++;
    document.getElementById('repAzeigA').innerHTML = repAzeig;
    document.getElementById('repAzeigB').innerHTML = repAzeig;
    handleSwipe("left", woerterbuch[aktuelleKarteIndex].id);

    // Nächste Karte anzeigen
    showNextWord();
}

function triggerRight(){
    // Animation hinzufügen
    var karteContent = document.getElementById('flip-card-inner');
    karteContent.classList.add('animate__rollOut__right');
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__right');
    });

    // Lernstatus aktualisieren
    woerterbuch[aktuelleKarteIndex].learned = true;
    doneAnzeige++;
    document.getElementById('doneAnzeigeA').innerHTML = doneAnzeige;
    document.getElementById('doneAnzeigeB').innerHTML = doneAnzeige;
    handleSwipe("right", woerterbuch[aktuelleKarteIndex].id);

    // Nächste Karte anzeigen
    showNextWord();
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialisiere die UI
    updateUI();
});
</script>
@endsection
