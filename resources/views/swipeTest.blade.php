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


   
    @vite(['resources/js/animations.js', 'resources/css/application.scss'])
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
