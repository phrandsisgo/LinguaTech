@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
<!--ich muss daraus ein component machen--->
<p class="pagetitle">Eine Neue Liste erstellen</p>



<form action="/list_create_function" method="POST" id="list_create_form">
    @csrf

    <p class="section-content">Bitte fügen sie ein Titel ein</p>
    <input type="text" name="listTitle" id="listTitle" placeholder="Titel" class="inputField">
    @error("listTitle")
    <p class="error">{{$message}}</p>

    
    @enderror
    <p class="section-content">Bitte fügen sie eine Beschreibung ein</p>
    <input type="text" name="listDescription" id="listDescription" placeholder="Beschreibung" class="inputField">

    @error("listDescription")
    <p class="error">{{$message}}</p>
    @enderror
    <div id="luis">
        <div class="library-Card">
            <input type="text" name="baseWord[]" id="baseWord" placeholder="Basiswort" class="inputField">
            <p class="formHelper">Base Language</p>

            <input type="text" name="targetWord[]" id="targetWord" placeholder="Zielwort" class="inputField">
            <p class="formHelper">Target Language</p>
        </div>
    </div>
    @error("baseWord.*")
    <p class="error">{{$message}}</p>
    @enderror  
    @error("targetWord.*")
    <p class="error">{{$message}}</p>
    @enderror 
    <button onclick="createLibraryCard(karten); anzahlplus();//die Zahl sagt vor wie viele Begriffe bereits existieren"> weiterer Begriff hinzufügen.</button>
    <button type="submit">Liste erstellen</button>
</form>
<script>
document.getElementById('list_create_form').addEventListener('submit', function(event) {
    let isValid = true;
    const baseWords = document.querySelectorAll('input[name="baseWord[]"]');
    const targetWords = document.querySelectorAll('input[name="targetWord[]"]');
    const listTitle = document.getElementById('listTitle');
    const listDescription = document.getElementById('listDescription');

    // Validierung für Listentitel
    if (listTitle.value.trim().length < 3 || listTitle.value.trim().length > 40) {
        isValid = false;
        alert('Titel muss zwischen 3 und 40 Zeichen lang sein.');
    }

    // Validierung für Listenbeschreibung
    if (listDescription.value.trim().length > 200) {
        isValid = false;
        alert('Beschreibung darf nicht länger als 200 Zeichen sein.');
    }

    // Validierung für baseWord und targetWord
    baseWords.forEach((element, index) => {
        if (element.value.trim() === '' || targetWords[index].value.trim() === '') {
            isValid = false;
            alert('Alle Basiswörter und Zielwörter müssen ausgefüllt werden.');
        }
    });

    if (!isValid) {
        event.preventDefault();
    }
});
</script>
<script>
    let karten=0;
    function anzahlplus(){
        karten++;
        console.log(karten);
    }
</script>

@endsection
