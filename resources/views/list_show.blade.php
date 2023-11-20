@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite('resources/css/library.scss')
@endsection

@section('content')
<!--ich muss daraus ein component machen--->
<p class="pagetitle">Listentitel</p>
<p class="section-content">Eine Beschreibung der Listeninhalte und wofür diese Liste gebraucht werden kann.</p>

<div class="library-Card">
    <p class="sectiontitle center-vertically">baseword</p>
    <hr class="hrborder">
    <p class="sectiontitle center-vertically">targetword</p>
</div>

<div class="library-Card">
    <p class="sectiontitle center-vertically">baseword</p>
    <hr class="hrborder">
    <p class="sectiontitle center-vertically">targetword</p>
</div>

@foreach ($liste->words as $begriffe)
    
<div class="library-Card">
    <p class="sectiontitle center-vertically">{{ $begriffe->base_word}}</p>
    <hr class="hrborder">
    <p class="sectiontitle center-vertically">{{ $begriffe->target_word }}</p>
</div>
@endforeach


@endsection