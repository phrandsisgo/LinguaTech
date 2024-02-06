@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
<!--ich muss daraus ein component machen--->
<p class="pagetitle">Deine Liste bearbeiten</p>


<form action="/list_update_function/{{$liste->id}}"  method="POST" id="list_update_form">
    @csrf
    <div class="displayFlex">
        <div class="horizontal-fill"></div>
        <button onclick="createLibraryCard(karten); anzahlplus();" class="standartButton"> Weiterer Begriff hinzufügen.</button>
        <button type="submit" class="approveButton">Änderungen abspeichern</button>

    </div>

    <p class="section-content">Dein Titel</p>
    <input type="text" name="listTitle" id="listTitle" value="{{$liste->name}}" placeholder="Titel" class="inputField">
    @error('listTitle' )
    <p class="formHelper">Der Titel muss zwischen 3 und 20 Zeichen lang sein.</p>
    @enderror
    <br><br><br>

    <p class="section-content">Beschreibung (optional)</p>
    <input type="text" name="listDescription" id="listDescription" value="{{$liste->description}}" placeholder="Beschreibung (optional)." class="inputField">
    @error('listDescription' )
    <p class="formHelper">Die Beschreibung darf nicht länger als 200 Zeichen sein.</p>
    @enderror
    <div id="luis">
    


     @foreach ($liste->words as $begriffe)
    <div class="library-Card">
        <input type="hidden" name="wordIds[]" value="{{ $begriffe->id }}">
        <input type="text" name="baseWord[]" value="{{ $begriffe->base_word }}" class="inputField">
        @error('baseWord.' . $loop->index)
            <p class="errorMessages">Das Basiswort muss zwischen 1 und 50 Zeichen lang sein.</p>
        @enderror
        <p class="formHelper">Basis Sprache</p>

        <input type="text" name="targetWord[]" value="{{ $begriffe->target_word }}" class="inputField">
        <p class="formHelper">Ziel Sprache</p>
        @error('targetWord.' . $loop->index)
            <p class="errorMessages">Das Zielwort muss zwischen 1 und 50 Zeichen lang sein.</p>
        @enderror
    </div>
    @endforeach
     </div>

    <button onclick="createLibraryCard(karten); anzahlplus();" class="standartButton"> Weiterer Begriff hinzufügen</button>
    <button type="submit" class="approveButton">Änderungen abspeichern</button>
</form>

<script>
    let karten=0;
    function anzahlplus(){
        karten++;
        console.log(karten);
    }
    document.getElementById('list_update_form').addEventListener('submit', function(event) {
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

@endsection
