const karteContent = document.getElementById('flip-card-inner');

document.addEventListener('DOMContentLoaded', function() {
    var hammertime = new Hammer(karteContent);
    hammertime.on('swipe', function(ev) {
        console.log(ev+" is the direction");
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
    var flipcard = document.getElementsById('flip-card-inner');
    //I need a function that checks if the class turnCard is already there and if so, removes it
    
    if(flipcard.classList.contains('turnCard')){
        flipcard.classList.remove('turnCard');
    }else{
        flipcard.classList.add('turnCard');
    }
}


function naechsteKarte() {
    aktuelleKarteIndex++;
    if (aktuelleKarteIndex >= woerterbuch.length) {
        aktuelleKarteIndex = 0; // Zurück zum Anfang, wenn das Ende erreicht ist
    }
    updateKarte();
}

function updateKarte() {
    /*
    const karteInfo = document.querySelector('.karteInfo');
    karteInfo.textContent = woerterbuch[aktuelleKarteIndex][0];
    karteInfo.setAttribute("data-index", aktuelleKarteIndex);
    console.log('hallo ich wurde geladen');*/

    //das obere ist veraltet desswegen ein neuer Anlauf
    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex][0];
    kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex][1];

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