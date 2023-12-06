const karteContent = document.getElementById('flip-card-inner');

document.addEventListener('DOMContentLoaded', function() {
    var hammertime = new Hammer(karteContent);
    hammertime.on('swipe', function(ev) {
        console.log(ev+" is the direction");
        // alert(ev.direction);
        if(ev.direction === Hammer.DIRECTION_LEFT){
            triggerAnimationLeft();
            handleLeftClickLeft();
        }else if(ev.direction === Hammer.DIRECTION_RIGHT){
            triggerAnimationRight();
            handleRightClick();
        }
    });

    function handleLeftClickLeft() {
        triggerAnimationLeft();
        naechsteKarte();
        repAzeig++;
        document.getElementById('repAzeigA').innerHTML=repAzeig;
        document.getElementById('repAzeigB').innerHTML=repAzeig;
    }
    
    
    function handleRightClick() {
        triggerAnimationRight();
        // console.log("Rechts geklickt!");
       
        naechsteKarte();
        doneAnzeige++;
        document.getElementById('doneAnzeigeA').innerHTML=doneAnzeige;
        document.getElementById('doneAnzeigeB').innerHTML=doneAnzeige;
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




let aktuelleKarteIndex = 0;



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
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = aktuelleKarteIndex+1+"/"+woerterbuch.length;
    countAnzeigeB.textContent = aktuelleKarteIndex+1+"/"+woerterbuch.length;


    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex][0];
    kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex][1];

}
document.getElementById('zurueckBtn').addEventListener('click', function() {
    document.getElementById('karteModal').style.display = 'none';
});

updateKarte();