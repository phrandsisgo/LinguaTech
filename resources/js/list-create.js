
window.createLibraryCard = function(cardAnzahl) {//die Anzahl in der Funktion ist die Anzahl der Karten, die schon existieren
    event.preventDefault();
    
    var luis= document.getElementById('luis');
    var libraryCard = document.createElement('div');
    libraryCard.className = 'library-Card';


    // Verstecktes Feld für die Wort-ID (mit speziellem Wert für neue Wörter)
    var inputWordId = document.createElement('input');
    inputWordId.setAttribute('type', 'hidden');
    inputWordId.setAttribute('name', 'wordIds[]');
    inputWordId.setAttribute('value', 'new');
    libraryCard.appendChild(inputWordId);

    // Erstellen des ersten Input-Feldes
    var inputBaseWord = document.createElement('input');
    inputBaseWord.setAttribute('type', 'text');
    inputBaseWord.setAttribute('name', 'baseWord[]');
    inputBaseWord.setAttribute('id', 'baseWord'+cardAnzahl);
    inputBaseWord.setAttribute('placeholder', 'Basiswort');
    inputBaseWord.className = 'inputField';
    libraryCard.appendChild(inputBaseWord);

    // Erstellen des ersten Paragraphen
    var pBaseLanguage = document.createElement('p');
    pBaseLanguage.className = 'formHelper';
    pBaseLanguage.textContent = 'Base Language';
    libraryCard.appendChild(pBaseLanguage);

    // Erstellen des zweiten Input-Feldes
    var inputTargetWord = document.createElement('input');
    inputTargetWord.setAttribute('type', 'text');
    inputTargetWord.setAttribute('name', 'targetWord[]');
    inputTargetWord.setAttribute('id', 'targetWord'+cardAnzahl);
    inputTargetWord.setAttribute('placeholder', 'Zielwort');
    inputTargetWord.className = 'inputField';
    libraryCard.appendChild(inputTargetWord);

    // Erstellen des zweiten Paragraphen
    var pTargetLanguage = document.createElement('p');
    pTargetLanguage.className = 'formHelper';
    pTargetLanguage.textContent = 'Target Language';
    libraryCard.appendChild(pTargetLanguage);

    // Hinzufügen des Div-Containers zum Dokument
    luis.append(libraryCard);
}

