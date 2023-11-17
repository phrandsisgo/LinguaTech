@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite('resources/css/library.scss')
@endsection

@section('content')
<!--ich muss daraus ein component machen--->

<div class="library-Card">
    <p class="cardTitle">Spanisch a3</p>
    <div></div>
    <div>
        <p class="begriffCount">12 Begriffe</p>
    </div>
    <div class="leading-library">
        <p class="leadingText">Erstellt von Laura</p>
        <div class="horizontal-fill"></div>
        <p class="leadingText">23.06.22</p>
    </div>
</div>

<div class="library-Card">
    <p class="cardTitle">Spanisch a3</p>
    <div></div>
    <div>
        <p class="begriffCount">12 Begriffe</p>
    </div>
    <div class="leading-library">
        <p class="leadingText">Erstellt von Laura</p>
        <div class="horizontal-fill"></div>
        <p class="leadingText">23.06.22</p>
    </div>
</div>

<div class="library-Card">
    <p class="cardTitle">Spanisch a3</p>
    <div></div>
    <div>
        <p class="begriffCount">12 Begriffe</p>
    </div>
    <div class="leading-library">
        <p class="leadingText">Erstellt von Laura</p>
        <div class="horizontal-fill"></div>
        <p class="leadingText">23.06.22</p>
    </div>
</div>
@foreach ($libraryList as $libraryList)
    
<div class="library-Card">
    <p class="cardTitle">{{$libraryList->name}}</p>
    <div></div>
    <div>
        <!-- give me the amount of words next-->
        <p class="begriffCount">{{$libraryList->words->count()}} Begriffe</p> 
    </div> 
    <div class="leading-library">
        <p class="leadingText">Erstellt von {{$libraryList->creator->name}}</p>
        <div class="horizontal-fill"></div>
        <p class="leadingText">{{ date('d.m.y', strtotime($libraryList->created_at)) }}</p>
    </div>
</div>
@endforeach


@endsection