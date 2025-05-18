@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')

<script src="https://hammerjs.github.io/dist/hammer.js"></script> 
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>
<meta name="_token" content="{{ csrf_token() }}">

@vite(['resources/css/application.scss', 'resources/css/animations.scss'])
@endsection

@section('content')
<p class="sectiontitle swipeLearnTitle">{{$liste->name}}</p>
<button id="openLearningModeModal" class="standartButton" onclick="document.getElementById('learningModeModal').style.display = 'block';">{{ __('swipe.change_learning_mode') }}</button>
<div id="learningModeModal" style="display:none;" onclick="if(event.target === this) { document.getElementById('learningModeModal').style.display = 'none'; }">
    <div class="modal-content">
        <h2>{{ __('swipe.learning_mode') }}</h2>
        <label>
            <input type="radio" name="learningMode" value="base"> {{ __('swipe.learn_target_words') }}
        </label>
        <label>
            <input type="radio" name="learningMode" value="target" checked> {{ __('swipe.learn_base_words') }}
        </label>
        <br><br>
        <button id="shuffleFlashCards" class="standartButton" onclick="shuffleAndReloadCards();">{{ __('swipe.mix') }}</button>
        <br><br><br>
           
        @if (Auth::user()->status == "admin")
        <button type="button" class="standartButton" onclick="document.getElementById('swipeStatistikModal').style.display = 'block';">Show Swipe Statistics</button>
        <button type="button" class="standartButton" onclick="showRemaining();">Show remaining Words (experimental)</button>
        <br><br><br>
        @endif
        <a href="#"><button onclick="document.getElementById('learningModeModal').style.display = 'none';" class="modalclose">{{ __('swipe.close') }}</button></a>
    </div>
</div>

<div class="karteContent">
    <div class="flip-card-inner" id="flip-card-inner">
        <div class="flashCardContent frontface" id="flashCardFront">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin" id="repAzeigB">0</p></div>
                <div class="countAnzeige" id="countAnzeigeB">1/{{count($liste->words)}} {{ __('swipe.words') }}</div>
                <div class="doneCountBox"><p class="anzeigemargin" id="doneAnzeigeB">0</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="baseWord">{{ __('swipe.word') }}</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('svg-icons/denyIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerLeft(event)">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('svg-icons/confirmIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerRight(event)">
            </div>
        </div>

        <div class="flashCardContent backface" id="flashCardBack">
            <div class="countZeile">
                <div class="repetitionCountBox"><p class="anzeigemargin" id="repAzeigA">0</p></div>
                <div class="countAnzeige" id="countAnzeigeA">1/{{count($liste->words)}} {{ __('swipe.words') }}</div>
                <div class="doneCountBox"><p class="anzeigemargin" id="doneAnzeigeA">0</p></div>
            </div>
            <div class="flipcardWordWrapper" onclick="showUebersetzung()">
                <p class="flipcardWord" id="targetWord">{{ __('swipe.word') }}</p>
            </div>
            <div class="displayFlex">
                <img src="{{ asset('svg-icons/denyIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerLeft(event)">
                <div class="horizontal-fill"></div>
                <img src="{{ asset('svg-icons/confirmIcon.svg')}}" alt="{{ __('swipe.confirmIconAlt') }}" class="iconSpacer" onclick="triggerRight(event)">
            </div>
        </div>
    </div>
</div>

<button id="undoLastSwipe" class="standartDangerButton undoButton" onclick="undoLastSwipe();">Undo</button>

<p class="section-content swipeContent">{{ __('swipe.description') }} {{$liste->description}}</p>

<div id="swipeStatistikModal" style="display:none;">
    <div class="modal-content">
        <h2>{{ __('swipe.swipeStatistics') }}</h2>
        <p>{{ __('swipe.unknownAnswersCount')}} <span id="leftSwipeCount"></span></p>
        <p>{{ __('swipe.knownAnswersCount')}} <span id="rightSwipeCount"></span></p>
        <br>
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
let swipeHistory = [];
var karteContent = document.getElementById('flip-card-inner'); // Verschoben ins globale Scope
var unlearnedWords = []; // Declare unlearnedWords as a global variable

@php
$woerterbuch = $liste->words->map(function ($word) {
    return [
        'base_word' => $word->base_word,
        'target_word' => $word->target_word,
        'id' => $word->id,
        'learned' => false,
        'full_list' => $word,
    ];
});
$language = collect([
    'base_language' => $languages['base_language'],
    'target_language' => $languages['target_language']
]);
@endphp

var woerterbuch = @json($woerterbuch);
var language = @json($language);
var learningMode = 'target'; // Standardmäßig Zielwörter lernen

// Funktionen
function showUebersetzung(){
    var flipcard = document.getElementById('flip-card-inner');
    flipcard.classList.toggle('turnCard');
}

function resetFlipCard(){
    var flipcard = document.getElementById('flip-card-inner');
    flipcard.classList.remove('turnCard');
}

function updateUI() {
    // Aktualisiere die Wortzähler
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = "1/" + woerterbuch.length + " {{ __('swipe.words') }}";
    countAnzeigeB.textContent = "1/" + woerterbuch.length + " {{ __('swipe.words') }}";

    // Zeige das erste Wort an
    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    if (woerterbuch.length > 0) {
        if (learningMode === 'base') {
            kartenTextBase.textContent = woerterbuch[0].base_word;
            kartenTextTarget.textContent = woerterbuch[0].target_word;
        } else {
            kartenTextBase.textContent = woerterbuch[0].target_word;
            kartenTextTarget.textContent = woerterbuch[0].base_word;
        }
    } else {
        // Show a message when no words are left
        kartenTextBase.textContent = "{{ __('swipe.no_words_left') }}";
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

function zeigeStatistikModal() {
    document.getElementById('leftSwipeCount').textContent = repAzeig;
    document.getElementById('rightSwipeCount').textContent = doneAnzeige;
    document.getElementById('swipeStatistikModal').style.display = 'block';
}

function handleSwipe(direction, wordId) {
    console.log("handling swipe " + direction);
    event.preventDefault();
    const requestData = {
        wordId: wordId,
        direction: direction
    };
    var csrf = document.querySelector('meta[name="_token"]').content;

    const formData = JSON.stringify(requestData);
    /*
    //this is used if I'm gonna log the swipes for better algorithm
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
    */
}

function showNextWord() {
    aktuelleKarteIndex++;
    console.log(woerterbuch);
    console.log("das ist der aktuelle Index: " + aktuelleKarteIndex);
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
    countAnzeigeA.textContent = (aktuelleKarteIndex + 1) + "/" + listLength + " {{ __('swipe.words') }}";
    countAnzeigeB.textContent = (aktuelleKarteIndex + 1) + "/" + listLength + " {{ __('swipe.words') }}";

    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    if (learningMode === 'base') {
        kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex].base_word;
        kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex].target_word;
    } else {
        kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex].target_word;
        kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex].base_word;
    }
    resetFlipCard(); // Reset flip state when updating the card
}

function restartWithUnknownAnswers(){
    unlearnedWords = woerterbuch.filter(word => !word.learned); // Overwrite unlearnedWords
    if (unlearnedWords.length > 0) {
        woerterbuch = unlearnedWords; // Update woerterbuch to only contain unlearned words
        aktuelleKarteIndex = 0; // Reset the current card index
        listLength = unlearnedWords.length; // Update listLength to the number of unlearned words
        updateKarte(); // Update the card display
        document.getElementById('swipeStatistikModal').style.display = 'none';

        // Reset counters
        document.getElementById('repAzeigA').textContent = "0";
        document.getElementById('repAzeigB').textContent = "0";
        document.getElementById('doneAnzeigeA').textContent = "0";
        document.getElementById('doneAnzeigeB').textContent = "0";
        document.getElementById('countAnzeigeA').textContent = "1/" + listLength + " {{ __('swipe.words') }}";
        document.getElementById('countAnzeigeB').textContent = "1/" + listLength + " {{ __('swipe.words') }}";
    } else {
        alert("{{ __('swipe.all_words_learned') }}");
    }
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function shuffleAndReloadCards() {
    woerterbuch = shuffleArray(woerterbuch);
    aktuelleKarteIndex = 0;
    updateKarte();
}
function showRemaining() {
    var remainingWords = woerterbuch.filter(word => !word.learned);
    if (remainingWords.length > 0) {
        var remainingWordsJson = remainingWords.map(word => ({
            base_word: word.base_word,
            target_word: word.target_word
        }));

        // Create modal content dynamically
        var modalContent = `
            <div class="modal-content">
                <h2>{{ __('swipe.remaining_words') }}</h2>
                <button id="copyRemainingWords" class="standartButton">{{ __('swipe.copy_to_clipboard') }}</button>
                <textarea id="remainingWordsJson" style="width: 100%; height: 200px;" readonly>${JSON.stringify(remainingWordsJson, null, 2)}</textarea>
                <br><br>
                <button onclick="document.getElementById('remainingWordsModal').style.display = 'none';" class="modalclose">{{ __('swipe.close') }}</button>
            </div>
        `;

        // Create modal container if it doesn't exist
        var modalContainer = document.getElementById('remainingWordsModal');
        if (!modalContainer) {
            modalContainer = document.createElement('div');
            modalContainer.id = 'remainingWordsModal';
            modalContainer.style.display = 'none';
            document.body.appendChild(modalContainer);
        }

        modalContainer.innerHTML = modalContent;
        modalContainer.style.display = 'block';

        // Add copy functionality
        document.getElementById('copyRemainingWords').addEventListener('click', function() {
            var textarea = document.getElementById('remainingWordsJson');
            textarea.select();
            document.execCommand('copy');
            alert("{{ __('swipe.copied_to_clipboard') }}");
        });
    } else {
        alert("{{ __('swipe.all_words_learned') }}");
    }
}

function undoLastSwipe() {
    if (swipeHistory.length > 0) {
        aktuelleKarteIndex = swipeHistory.pop(); // Restore last index
        updateKarte(); // Update the card display
    } else {
        console.log("{{ __('swipe.no_swipes_to_undo') }}");
    }
}

function triggerAnimationLeft(callback){
    karteContent.classList.add('animate__rollOut__left');
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__left');
        if (callback) callback();
    }, { once: true });
}

function triggerAnimationRight(callback){
    karteContent.classList.add('animate__rollOut__right');
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__right');
        if (callback) callback();
    }, { once: true });
}

function triggerLeft(event){
    console.log("trigger left");
    // Check if event is provided and stopPropagation is a function
    if (event && typeof event.stopPropagation === 'function') {
        event.stopPropagation();
    }
    triggerAnimationLeft(function(){
        showNextWord();
    });

    swipeHistory.push(aktuelleKarteIndex); // Aktuellen Index speichern
    repAzeig++;
    document.getElementById('repAzeigA').innerHTML = repAzeig;
    document.getElementById('repAzeigB').innerHTML = repAzeig;
    handleSwipe("left", woerterbuch[aktuelleKarteIndex].id);
}

function triggerRight(event){
    console.log("trigger right");
    if (event && typeof event.stopPropagation === 'function') {
        event.stopPropagation();
    }
    triggerAnimationRight(function(){
        showNextWord();
    });

    swipeHistory.push(aktuelleKarteIndex); // Aktuellen Index speichern
    woerterbuch[aktuelleKarteIndex].learned = true;
    doneAnzeige++;
    document.getElementById('doneAnzeigeA').innerHTML = doneAnzeige;
    document.getElementById('doneAnzeigeB').innerHTML = doneAnzeige;
    handleSwipe("right", woerterbuch[aktuelleKarteIndex].id);
}

// Event Listener für die Auswahl des Lernmodus
document.querySelectorAll('input[name="learningMode"]').forEach((elem) => {
    elem.addEventListener("change", function(event) {
        learningMode = event.target.value;
        updateKarte(); // Aktualisiere die Karte entsprechend
        resetFlipCard(); // Kartenrückseite ausblenden
    });
});

// Hammer.js Integration
document.addEventListener('DOMContentLoaded', function() {
    // Initialisiere die UI
    updateUI();

    // 'karteContent' ist bereits global definiert
    // var karteContent = document.getElementById('flip-card-inner');

    var hammertime = new Hammer(karteContent);
    hammertime.on('swipe', function(ev) {
        console.log(ev.type + " in Richtung " + ev.direction);
        if (ev.direction === Hammer.DIRECTION_LEFT) {
            triggerLeft(); // Do not pass the 'ev' parameter
        } else if (ev.direction === Hammer.DIRECTION_RIGHT) {
            triggerRight(); // Do not pass the 'ev' parameter
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowLeft') {
            triggerLeft();
        } else if (event.key === 'ArrowRight') {
            triggerRight();
        }
    });
});
</script>
@endsection
