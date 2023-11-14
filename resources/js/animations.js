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

function openModal() {
    document.getElementById('karteModal').style.display = 'block';
    updateKarte();
}
document.getElementById('zurueckBtn').addEventListener('click', function() {
    document.getElementById('karteModal').style.display = 'none';
});

updateKarte();