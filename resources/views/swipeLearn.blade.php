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
                <div class="countAnzeige" id="countAnzeigeB">1/{{count($liste->words)}}Wörter</div>
                <div class="doneCountBox"><p class="anzeigemargin" id="doneAnzeigeB">0</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="baseWord">word</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('svg-icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('svg-icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
            </div>

        </div>

        <div class="flashCardContent backface" id="flashCardContent">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin" id="repAzeigA">0</p></div>
                <div class="countAnzeige" id="countAnzeigeA">1/{{count($liste->words)}}Wörter</div>
                <div class="doneCountBox"><p class="anzeigemargin" id="doneAnzeigeA">0</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="targetWord">Wort</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('svg-icons/denyIcon.svg')}}" alt="confirm Icon" class="iconSpacer" onclick="handleLeftClickLeft(); triggerAnimationLeft();">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('svg-icons/confirmIcon.svg')}}" alt="confirm Icon" class="iconSpacer">
            </div>
        </div>
    </div>
</div>

<p class="section-content swipeContent">Beschreibung: {{$liste->description}}</p>

<div id="swipeStatistikModal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeStatModal()">&times;</span>
        <h2>Swipe Statistik</h2>
        <p>Anzahl der Swipes nach links: <span id="leftSwipeCount"></span></p>
        <p>Anzahl der Swipes nach rechts: <span id="rightSwipeCount"></span></p>
        <button onclick="location.reload();">von vorne lernen</button>
        <button onclick="document.getElementById('swipeStatistikModal').style.display = 'none';" class="modalclose" >Schliessen</button>
    </div>
</div>

<script>
var listLength={{count($liste->words)}};
var listProgress=0;
var doneAnzeige=0;
var repAzeig=0;



function handleSwipe(direction, wordId) {
        event.preventDefault();
        const translateWord = {
            word: word
        };
        var csrf = document.querySelector('meta[name="_token"]').content;
        //console.log(csrf)

    const formData = JSON.stringify(translateWord);
    let translatedWord='';

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

function showUebersetzung(){
    var flipcard = document.getElementById('flip-card-inner');
    
    if(flipcard.classList.contains('turnCard')){
        flipcard.classList.remove('turnCard');
    }else{
        flipcard.classList.add('turnCard');
    }
}
var woerterbuch = @json($liste->words->map(function ($word) {
    return [$word->base_word, $word->target_word, $word->id]; 
}));
document.addEventListener('DOMContentLoaded', function() {
    var baseWord = document.getElementById('baseWord');
    var targetWord = document.getElementById('targetWord');
    baseWord.innerHTML=woerterbuch[0][0];
    targetWord.innerHTML=woerterbuch[0][1];
});
</script>
@endsection