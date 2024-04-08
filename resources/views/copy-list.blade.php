@extends('layouts.lingua_main')
@section('title', 'Copy List')
@section('head')
@vite('resources/css/library.scss')
<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
<script>
function confirmDelete() {
    return confirm('sind sie sich sicher, dass sie dieses Wort löschen wollen?');
}
</script>
@endsection

@section('content')<div class="displayFlex">
    <div>
        <p class="pagetitle">{{$liste->name}}</p>
    </div>
    <div class="horizontal-fill"></div>
    @if (Auth::user()->id == $liste->created_by)

    <div>
        <a href="/list_show/{{$liste->id}}"><p class="pagetitle noUnderline">Listen Ansicht</p></a>
    </div>
        
    <div class="space"></div>
    @endif
    <div class="space"></div>
    <div>
        <a href="/swipeLearn/{{$liste->id}}"><p class="pagetitle noUnderline">Lernen</p></a>
    </div>
</div>

<!-- Großes Textfeld und Kopierbutton -->
<div class="json-container">
    <div class="textTopping">
        <p>Kopiere dein JSON</p>
        <div class="horizontal-fill"> </div>
        <button onClick="copyFunction()">Kopieren</button>
    </div>
    <textarea id="jsonTextarea" style="font-family: 'Source Code Pro', monospace; width: 100%; height: 300px;">{
    Titel: "{{$liste->name}}",
    Beschreibung: "{{$liste->description}}",
    Wörter: [
        @foreach ($liste->words as $word)
        {
            Base: "{{$word->base_word}}",
            Ziel: "{{$word->target_word}}"
        },
        @endforeach
    ]
}</textarea>
    <button onclick="copyToClipboard()" style="position: absolute; top: 0; right: 0;">Kopieren</button>
</div>

<script>
 
    function copyFunction() {
        var copyText = document.getElementById("jsonTextarea");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
    }

</script>
@endsection