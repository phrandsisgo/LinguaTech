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
        <a href="/list_show/{{$liste->id}}"><p class="pagetitle noUnderline">{{ __('learn-lists.list-view') }}</p></a>
    </div>
        
    <div class="space"></div>
    @endif
    <div class="space"></div>
    <div>
        <a href="/swipeLearn/{{$liste->id}}"><p class="pagetitle noUnderline">{{ __('learn-lists.learn') }}</p></a>
    </div>
</div>

<!-- Großes Textfeld und Kopierbutton -->
<div class="json-container">
    <div class="textTopping">
        <p>{{ __('learn-lists.copy-your-JSON') }}</p>
        <div class="horizontal-fill"> </div>
        <button onClick="copyFunction()">{{ __('learn-lists.copy') }}</button>
    </div>
    <textarea id="jsonTextarea" style="font-family: 'Source Code Pro', monospace; width: 100%; height: 300px;">{
    Title: "{{$liste->name}}",
    Description: "{{$liste->description}}",
    Words: [
        @foreach ($liste->words as $word)
        {
            Base: "{{$word->base_word}}",
            Ziel: "{{$word->target_word}}"
        },
        @endforeach
    ]
}</textarea>
    <button onclick="copyToClipboard()" style="position: absolute; top: 0; right: 0;">{{ __('learn-lists.copy') }}</button>
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