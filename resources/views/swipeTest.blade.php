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
    <!-- hier kommt mein script für hammer.js hin -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myElement = document.getElementById('flashCardContent');
            var hammertime = new Hammer(myElement);
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
            const karteContent = document.getElementById('flashCardContent');
            karteContent.classList.add('animate__rollOut__right');

            //  make sure to remove the class after the animation ends to allow it to be triggered again
            karteContent.addEventListener('animationend', function(){
                karteContent.classList.remove('animate__rollOut__right');
            });
        }
        function triggerAnimationLeft(){
            //const karteContent = document.querySelector('.flashCardContent');
            const karteContent = document.getElementById('flashCardContent');
            karteContent.classList.add('animate__rollOut__left');

            //  make sure to remove the class after the animation ends to allow it to be triggered again
            karteContent.addEventListener('animationend', function(){
                karteContent.classList.remove('animate__rollOut__left');
            });
        }
    </script>

    <script defer>
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

        document.getElementById('startPlay').addEventListener('click', function() {
            document.getElementById('karteModal').style.display = 'block';
            updateKarte();
        });

        function handleLeftClick() {
           // console.log("Links geklickt!");
            naechsteKarte();
        }

        function handleRightClick() {
            console.log("Rechts geklickt!");
            naechsteKarte();
        }
        function showUebersetzung(){

            const karteContent = document.getElementById('flashCardContent');
            karteContent.classList.add('animate__flipOutY');
            const baseLangWord = document.querySelector('.karteInfo');
            const index = baseLangWord.getAttribute("data-index");
            if(baseLangWord.textContent == woerterbuch[index][0]){
                baseLangWord.textContent = woerterbuch[index][1];
            }else{
                baseLangWord.textContent = woerterbuch[index][0];
            }
            baseLangWord.removeEventListener('click', showUebersetzung);
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
        }

        function openModal() {
            document.getElementById('karteModal').style.display = 'block';
            updateKarte();
        }
        document.getElementById('zurueckBtn').addEventListener('click', function() {
            document.getElementById('karteModal').style.display = 'none';
        });
        


    </script>
    <!-- Styles -->
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            z-index: 999;
        }

        .karteContent {
            align-items: center;
            position: fixed;
            top:0;
            left: 0;
            right:0;
            bottom: 0;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            width: 40%;
            height:50%;
        }
        .kartenInhalt{
            display: flex;    
            border: 1px solid #888;   
            justify-content: center;
            align-items: center; 
            height:50vh;
        }

        .karteLeft, .karteRight {
            cursor: pointer;
            padding: 10px;
        }

         #flashCardContent{

            border: 5px solid green;
         }
            .confirmRight{
                position: absolute;
                top: 80%;
                left:84%;
            }
            .confirmLeft{
                position: absolute;
                top: 80%;
                left: 16%;
            }
            
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
                -webkit-transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 60deg);
                transform: translate3d(100%, 0, 0) rotate3d(0, 0, 1, 60deg);
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
                -webkit-transform: translate3d(-150%, 0, 0) rotate3d(0, 0, 1, -120deg);
                transform: translate3d(-150%, 0, 0) rotate3d(0, 0, 1, -120deg);
            }}
            @keyframes rollOutLeft {
            from {
                opacity: 1;
            }
            to{
                opacity: 0;
                -webkit-transform: translate3d(-150%, 0, 0) rotate3d(0, 0, 1, -60deg);
                transform: translate3d(-150%, 0, 0) rotate3d(0, 0, 1, -60deg);
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
                -webkit-transform: perspective(400px) rotate3d(0, , 0, -15deg);
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
            <div class="confirmRight"><img src="https://www.svgrepo.com/show/384403/accept-check-good-mark-ok-tick.svg" alt="accept" height="20px"></div>
            <div class="confirmLeft">
                <img src="{{ asset('questionmark-icon.svg')}}" alt="questionmark-icon" height="20">
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
