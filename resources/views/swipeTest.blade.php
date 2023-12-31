<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://hammerjs.github.io/dist/hammer.js"></script> 
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <script>
        const karteContent = document.getElementById('flashCardContent');

document.addEventListener('DOMContentLoaded', function() {
    var hammertime = new Hammer(karteContent);
    hammertime.on('swipe', function(ev) {
        console.log(ev);
       // alert(ev.direction);
        if(ev.direction === Hammer.DIRECTION_LEFT){
        triggerAnimationLeft();
           // alert("swipe left");
            handleLeftClick();
        }else if(ev.direction === Hammer.DIRECTION_RIGHT){
        triggerAnimationRight();
            //alert("swipe right");
            handleRightClick();
        }
    });

    function handleLeftClickLeft() {
        triggerAnimationLeft();
        //console.log("Links geklickt!");
        naechsteKarte();
    }
    function handleRightClick() {
        triggerAnimationRight();
       // console.log("Rechts geklickt!");
        naechsteKarte();
 }
});

function triggerAnimationRight(){
    //const karteContent = document.querySelector('.flashCardContent');
    karteContent.classList.add('animate__rollOut__right');

    //  class has to be removed after the animation ends to allow it to be triggered again
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__right');
    });
}
function triggerAnimationLeft(){
    karteContent.classList.add('animate__rollOut__left');

    //  class has to be removed after the animation ends to allow it to be triggered again
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__left','flipInY', 'flipOutY');
    });
}

const karten = [
    'Karte 1',
    'Karte 2',
    'Karte 3',
    'Karte 4',
    'Karte 5',
];
const woerterbuch = [
    ["libro", "Buch"],
    ["mesa", "Tisch"],
    ["silla", "Stuhl"],
    ["puerta", "Tür"],
    ["ventana", "Fenster"],
    ["agua", "Wasser"],
    ["sol", "Sonne"],
    ["luna", "Mond"],
    ["cielo", "Himmel"],
    ["estrella", "Stern"],
    // ... Fügen Sie hier weitere Wörter hinzu
];
let aktuelleKarteIndex = 0;


function handleLeftClick() {
   // console.log("Links geklickt!");
    naechsteKarte();
}

function handleRightClick() {
    console.log("Rechts geklickt!");
    naechsteKarte();
}
function showUebersetzung(){

    karteContent.classList.add('animate__flipOutY');
    //  make sure to remove the class after the animate__flipOutY ends to allow the next animation to be triggered again
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__flipOutY');
        if(baseLangWord.textContent == woerterbuch[index][0]){
            baseLangWord.textContent = woerterbuch[index][1];
        }else{
            baseLangWord.textContent = woerterbuch[index][0];
        }
        baseLangWord.removeEventListener('click', showUebersetzung);
        //falls spiegelverkehrt-klasse vorhanden, entferne sie
        if(baseLangWord.classList.contains('spiegelverkehrt')){
            baseLangWord.classList.remove('spiegelverkehrt');
        }else{
            baseLangWord.classList.add('spiegelverkehrt');
        }
        element.classList.add('animate__flipInY');

        element.addEventListener('animationend', function(){
            element.classList.remove('animate__flipInY', 'animate__flipOutY', );
        });
    });
    //next Animation 
    const baseLangWord = document.querySelector('.karteInfo');
    const index = baseLangWord.getAttribute("data-index");
   
}

function naechsteKarte() {
    aktuelleKarteIndex++;
    if (aktuelleKarteIndex >= woerterbuch.length) {
        aktuelleKarteIndex = 0; // Zurück zum Anfang, wenn das Ende erreicht ist
    }
    updateKarte();
}

function updateKarte() {
    const karteInfo = document.querySelector('.karteInfo');
    karteInfo.textContent = woerterbuch[aktuelleKarteIndex][0];
    karteInfo.setAttribute("data-index", aktuelleKarteIndex);
    console.log('hallo ich wurde geladen');
}
/*//warscheindlich braucht es diese funktion nicht nov 14
function openModal() {
    document.getElementById('karteModal').style.display = 'block';
    updateKarte();
}*/
document.getElementById('zurueckBtn').addEventListener('click', function() {
    document.getElementById('karteModal').style.display = 'none';
});

updateKarte();
    </script>

    <style>
        @-webkit-keyframes rollOutRight {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
        -webkit-transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
        transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
    }
    }
    @keyframes rollOutRight {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
        -webkit-transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
        transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 120deg);
    }
    }
    .animate__rollOut__right {
    -webkit-animation-name: rollOutRight;
    animation-name: rollOutRight;
    /* Define the duration, fill mode, etc. for the animation */
    -webkit-animation-duration: 0.7s;
    animation-duration: 0.7s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    }

    @-webkit-keyframes rollOutLeft {
    from {
        opacity: 1;
    }
    to{
        opacity: 0;
        -webkit-transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
        transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
    }}
    @keyframes rollOutLeft {
    from {
        opacity: 1;
    }
    to{
        opacity: 0;
        -webkit-transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
        transform: translate3d(-100%, 0, 0) rotate3d(0, 0, 1, -120deg);
    }}
    .animate__rollOut__left {
    -webkit-animation-name: rollOutLeft;
    animation-name: rollOutLeft;
    /* Define the duration, fill mode, etc. for the animation */
    -webkit-animation-duration: 0.7s;
    animation-duration: 0.7s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    }

    /*hier noch die Animation für das flippen der Karten*/

    @keyframes flipOutY {
    from {
        -webkit-transform: perspective(400px);
        transform: perspective(400px);
        transform-origin: center;
    }

    30% {
        -webkit-transform: perspective(400px) rotate3d(0, 1, 0, -15deg);
        transform: perspective(400px) rotate3d(0, 1, 0, -15deg);
        opacity: 1;
    }

    to {
        -webkit-transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
        transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
        opacity: 0;
    }}
    .animate__flipOutY {
    -webkit-animation-duration: calc(1s * 0.75);
    animation-duration: calc(1s * 0.75);
    -webkit-animation-duration: calc(var(--animate-duration) * 0.75);
    animation-duration: calc(var(--animate-duration) * 0.75);
    -webkit-backface-visibility: visible !important;
    backface-visibility: visible !important;
    -webkit-animation-name: flipOutY;
    animation-name: flipOutY;
    
    }
    </style>
</head>
<body>

<button id="startPlay" onclick="openModal()" class="animate__flip">Start Play</button>
    <div id="karteModal" class="modal">
        <div class="karteContent animate__flip" id="flashCardContent">   
            <div class="confirmRight"><img src="https://www.svgrepo.com/show/384403/accept-check-good-mark-ok-tick.svg" alt="accept" height="20px" onclick="handleRightClick()"></div>
            <div class="confirmLeft">
                <img src="{{ asset('questionmark-icon.svg')}}" alt="questionmark-icon" height="20" onclick="handleLeftClick()">
            </div>
            <button id="zurueckBtn" onclick="triggerAnimation()">Zurück</button>
            <div class="kartenInhalt">
                <div class="karteLeft" onclick="handleLeftClick()">← Links </div>

                <div> </div>
                <span onclick="showUebersetzung()"><div class="karteInfo">kart1</div></span>
                <div> </div>
                <div class="karteRight" onclick="handleRightClick()">Rechts →</div>
            </div> 
         
    </div>

</body>
</html>
