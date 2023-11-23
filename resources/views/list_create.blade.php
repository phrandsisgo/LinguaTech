@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
<!--ich muss daraus ein component machen--->
<p class="pagetitle">Eine Neue Liste erstellen</p>

<form action="/list_create_function" method="POST">
    @csrf

    <p class="section-content">Bitte fügen sie ein Titel ein</p>
    <input type="text" name="listTitle" id="listTitle" placeholder="Titel" class="inputField">

    <p class="section-content">Bitte fügen sie eine Beschreibung ein</p>
    <input type="text" name="listDescription" id="listDescription" placeholder="Beschreibung" class="inputField">

    <div id="luis">
        <div class="library-Card">
            <input type="text" name="baseWord[]" id="baseWord" placeholder="Basiswort" class="inputField">
            <p class="formHelper">Base Language</p>

            <input type="text" name="targetWord[]" id="targetWord" placeholder="Zielwort" class="inputField">
            <p class="formHelper">Target Language</p>
        </div>
    </div>
    <button onclick="createLibraryCard(karten); anzahlplus();//die Zahl sagt vor wie viele Begriffe bereits existieren"> weiterer Begriff hinzufügen.</button>
    <button type="submit">Liste erstellen</button>
</form>
<script>
    let karten=0;
    function anzahlplus(){
        karten++;
        console.log(karten);
    }
</script>

@endsection
