const karteContent = document.getElementById('flip-card-inner');
function printMe(){
    console.log("I am here");
}
document.addEventListener('DOMContentLoaded', function() {
    var hammertime = new Hammer(karteContent);
    hammertime.on('swipe', function(ev) {
        console.log(ev+" is the direction");
        // alert(ev.direction);
        if(ev.direction === Hammer.DIRECTION_LEFT){
            triggerAnimationLeft(function() {
                naechsteKarte();
            });
            handleLeftClickLeft();
        }else if(ev.direction === Hammer.DIRECTION_RIGHT){
            triggerAnimationRight(function() {
                naechsteKarte();
            });
            handleRightClick();
        }
    });

    function triggerRight(){
        triggerAnimationRight(function() {
            naechsteKarte();
        });
        handleRightClick();
    }

    function handleLeftClickLeft() {
        //this direction is when the User fails
        triggerAnimationLeft(function() {
            naechsteKarte();
        });
        repAzeig++;
        document.getElementById('repAzeigA').innerHTML=repAzeig;
        document.getElementById('repAzeigB').innerHTML=repAzeig;
        handleSwipe("left", woerterbuch[aktuelleKarteIndex][2]);
    }
    
    
    function handleRightClick() {
        //this direction is when the User succeeds
        triggerAnimationRight(function() {
            naechsteKarte();
        });
        doneAnzeige++;
        document.getElementById('doneAnzeigeA').innerHTML=doneAnzeige;
        document.getElementById('doneAnzeigeB').innerHTML=doneAnzeige;
        handleSwipe("right", woerterbuch[aktuelleKarteIndex][2]);
 }
});

function triggerAnimationRight(callback){
    karteContent.classList.add('animate__rollOut__right');
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__right');
        if (callback) callback();
    }, { once: true });
}

function triggerAnimationLeft(callback){
    karteContent.classList.add('animate__rollOut__left');
    karteContent.addEventListener('animationend', function(){
        karteContent.classList.remove('animate__rollOut__left', 'flipInY', 'flipOutY');
        if (callback) callback();
    }, { once: true });
}




let aktuelleKarteIndex = 0;



function zeigeStatistikModal() {
    document.getElementById('leftSwipeCount').textContent = repAzeig;
    document.getElementById('rightSwipeCount').textContent = doneAnzeige;
    document.getElementById('swipeStatistikModal').style.display = 'block';
}

function closeStatModal() {
    document.getElementById('swipeStatistikModal').style.display = 'none';
}

function naechsteKarte() {
    aktuelleKarteIndex++;
    if (aktuelleKarteIndex >= woerterbuch.length) {
        zeigeStatistikModal();
        //aktuelleKarteIndex = 0; // Zurück zum Anfang, wenn das Ende erreicht ist
    }
    console.log("Aktuelle Karte ID:" +woerterbuch[aktuelleKarteIndex][2])
    updateKarte();
}

function updateKarte() {
    var countAnzeigeA = document.getElementById('countAnzeigeA');
    var countAnzeigeB = document.getElementById('countAnzeigeB');
    countAnzeigeA.textContent = (aktuelleKarteIndex + 1) + "/" + woerterbuch.length;
    countAnzeigeB.textContent = (aktuelleKarteIndex + 1) + "/" + woerterbuch.length;

    const kartenTextBase = document.getElementById('baseWord');
    const kartenTextTarget = document.getElementById('targetWord');
    kartenTextBase.textContent = woerterbuch[aktuelleKarteIndex].base_word;
    kartenTextTarget.textContent = woerterbuch[aktuelleKarteIndex].target_word;
}

document.getElementById('zurueckBtn').addEventListener('click', function() {
    document.getElementById('karteModal').style.display = 'none';
});

updateKarte();