@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
<!--ich muss daraus ein component machen--->
<p class="pagetitle">Deine Liste bearbeiten</p>
<p>{{$liste}}</p>

<form action="/list_update_function/{{$liste->id}}"  method="POST">
    @csrf
    <p class="section-content">Dein Titel:</p>
    <input type="text" name="listTitle" id="listTitle" value="{{$liste->name}}" placeholder="Titel" class="inputField">

    <p class="section-content">Die Beschreibung</p>
    <input type="text" name="listDescription" id="listDescription" value="{{$liste->description}}" placeholder="Beschreibung" class="inputField">

     @foreach ($liste->words as $begriffe)


     <div id="luis">
        <div class="library-Card">
            <input type="hidden" name="wordIds[]" value="{{ $begriffe->id }}">
            <input type="text" name="baseWord[]" value="{{ $begriffe->base_word}}" class="inputField">
            <p class="formHelper">Base Language</p>

            <input type="text" name="targetWord[]"  value="{{$begriffe->target_word}}" class="inputField">
            <p class="formHelper">Target Language</p>
        </div>
    </div>
     @endforeach


    <button onclick="createLibraryCard(karten); anzahlplus();//die Zahl sagt vor wie viele Begriffe bereits existieren"> weiterer Begriff hinzufügen.</button>
    <button type="submit">Änderungen abspeichern</button>
</form>
<script>
    let karten=0;
    function anzahlplus(){
        karten++;
        console.log(karten);
    }
</script>

@endsection
