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
    <div class="flip-card-inner"id="flip-card-inner">
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
        <a href="#"><button onclick="restartWithUnknownAnswers();" class="standartButton">repeat wrong Answers</button></a>
        <a href="#"><button onclick="location.reload();" class="standartButton">{{ __('swipe.learnAgain') }}</button></a>
        <a href="/library"><button onclick="document.getElementById('swipeStatistikModal').style.display = 'none';" class="modalclose" >{{ __('swipe.close') }}</button></a>
    </div>
</div>

<script>

var listLength={{count($liste->words)}};
var listProgress=0;
var doneAnzeige=0;
var repAzeig=0;
let aktuelleKarteIndex = 0;
let unknownAnswers = [];

var woerterbuch = @json($liste->words->map(function ($word) {
    return [$word->base_word, $word->target_word, $word->id]; 
}));

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
    //console.log(csrf)

    const formData = JSON.stringify(requestData);
    //let translatedWord='';

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

           // openModal(data);
            // return data;
    })
    .catch(error => console.error('Error:', error));
        
}
function updateUI() {
    // Aktualisiere die Wortzähler
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = "1/" + woerterbuch.length + " Wörter";
    countAnzeigeB.textContent = "1/" + woerterbuch.length + " Wörter";

    // Zeige das erste Wort der neuen Liste an
    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    if (woerterbuch.length > 0) {
        kartenTextBase.textContent = woerterbuch[0][0];
        kartenTextTarget.textContent = woerterbuch[0][1];
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

    // Zusätzliche UI-Elemente, die aktualisiert werden müssen, können hier hinzugefügt werden
}


function restartWithUnknownAnswers(){
    if (unknownAnswers.length > 0) {
         // Filtere das Wörterbuch, um nur die falsch beantworteten Wörter zu behalten
         woerterbuch = woerterbuch.filter(word => unknownAnswers.includes(word[2]));
        aktuelleKarteIndex = 0;
        repAzeig = 0;
        doneAnzeige = 0;
        listLength = woerterbuch.length; // Aktualisiere die Gesamtzahl der Wörter
        // Aktualisiere die UI entsprechend
        updateUI();
        // Schließe das Modal
        document.getElementById('swipeStatistikModal').style.display = 'none';
    } else {
        alert("Es gibt keine falsch beantworteten Wörter zum Wiederholen.");
    }
    
}
const karteContent = document.getElementById('flip-card-inner');
function triggerLeft(){

    if (!unknownAnswers.includes(woerterbuch[aktuelleKarteIndex][2])) {
        unknownAnswers.push(woerterbuch[aktuelleKarteIndex][2]);
        console.log("ID des nicht gewussten Wortes gespeichert:", woerterbuch[aktuelleKarteIndex][2]);
    }

    karteContent.classList.add('animate__rollOut__left');

    //  class has to be removed after the animation ends to allow it to be triggered again
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__left','flipInY', 'flipOutY');
    });    
    
    aktuelleKarteIndex++;
    repAzeig++;
    if (aktuelleKarteIndex >= woerterbuch.length) {
        zeigeStatistikModal();
        //aktuelleKarteIndex = 0; // Zurück zum Anfang, wenn das Ende erreicht ist
    }
    
    console.log(aktuelleKarteIndex, woerterbuch.length);
    console.log("Aktuelle Karte ID:" +woerterbuch[aktuelleKarteIndex][2])
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = aktuelleKarteIndex+1+"/"+woerterbuch.length;
    countAnzeigeB.textContent = aktuelleKarteIndex+1+"/"+woerterbuch.length;


    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex][0];
    kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex][1];
    document.getElementById('repAzeigA').innerHTML=repAzeig;
    document.getElementById('repAzeigB').innerHTML=repAzeig;
    handleSwipe("left", woerterbuch[aktuelleKarteIndex][2]);
}
function triggerRight(){
    karteContent.classList.add('animate__rollOut__right');
    //  class has to be removed after the animation ends to allow it to be triggered again
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__right','flipInY', 'flipOutY');
    });
    aktuelleKarteIndex++;
    doneAnzeige++;
    if (aktuelleKarteIndex >= woerterbuch.length) {
        zeigeStatistikModal();
        //aktuelleKarteIndex = 0; // Zurück zum Anfang, wenn das Ende erreicht ist
    }
    console.log("Aktuelle Karte ID:" +woerterbuch[aktuelleKarteIndex][2])
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = aktuelleKarteIndex+1+"/"+woerterbuch.length;
    countAnzeigeB.textContent = aktuelleKarteIndex+1+"/"+woerterbuch.length;

    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex][0];
    kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex][1];
    document.getElementById('doneAnzeigeA').innerHTML=doneAnzeige;
    document.getElementById('doneAnzeigeB').innerHTML=doneAnzeige;
    handleSwipe("right", woerterbuch[aktuelleKarteIndex][2]);
}

function showUebersetzung(){
    var flipcard = document.getElementById('flip-card-inner');
    
    if(flipcard.classList.contains('turnCard')){
        flipcard.classList.remove('turnCard');
    }else{
        flipcard.classList.add('turnCard');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var baseWord = document.getElementById('baseWord');
    var targetWord = document.getElementById('targetWord');
    baseWord.innerHTML=woerterbuch[0][0];
    targetWord.innerHTML=woerterbuch[0][1];
});
</script>
@endsection