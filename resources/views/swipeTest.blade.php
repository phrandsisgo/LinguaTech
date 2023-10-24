<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            console.log("Links geklickt!");
            naechsteKarte();
        }

        function handleRightClick() {
            console.log("Rechts geklickt!");
            naechsteKarte();
        }
        function showUebersetzung(){
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
            justify-content: space-between;
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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

    </style>
</head>
<body>
<button id="startPlay" onclick="openModal()">Start Play</button>


    <div id="karteModal" class="modal">
        <div class="karteContent">
            <button id="zurueckBtn">Zurück</button>
            <div class="kartenInhalt">
                <div class="karteLeft" onclick="handleLeftClick()">← Links</div>
                <div> </div>
                <span onclick="showUebersetzung()"><div class="karteInfo">kart1</div></span>
                <div> </div>
                <div class="karteRight" onclick="handleRightClick()">Rechts →</div>
            </div>
    </div>

</body>
</html>