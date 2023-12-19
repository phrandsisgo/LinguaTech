@extends('layouts.lingua_main')
@section('title', 'Initiate')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection
<p class="pagetitle">Welche Sprachen kannst du schon?</p>
<div class="interestsWrapper">
    <p class="sectiontitle"> diese Sprachen kannst du schon:</p>
    <div class="interestsWords">
        <p>Dingsbumsisch</p>
    </div>
    <div class="langWrapper">
        <p>Dingsbumsisch</p>
    </div>
    <div class="langWrapper">
        <p>Dingsbumsisch</p>
    </div>
    <div class="langWrapper">
        <p>Dingsbumsisch</p>
    </div>
</div>
<form action="/addLanguage" method="post">
    @csrf
    <label for="language" class="section-content">Neue Sprache hinzufügen:</label>
    <br>
    <select id="language" name="language[]">
        @foreach ($languages as $language)
            <option value="{{ $language->id }}">{{ $language->language_name }}</option>
            
        @endforeach
    </select>
    <br><br>
    

    <button type="button" onclick="addLanguage()">Hinzufügen</button>
    <input type="submit" value="Speichern">
</form>

<script>
function addLanguage() {
    var language = document.getElementById('language').value;
    var level = document.getElementById('level').value;

    // Fügen Sie die Sprache zur Liste hinzu
}

function removeLanguage(language, level) {
    // Entfernen Sie die Sprache aus der Liste
}


</script>
@section('content')