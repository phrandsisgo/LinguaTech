@extends('layouts.lingua_main')
@section('title', 'textPlay')
@section('head')

@vite(['resources/css/library.scss'])

@endsection
@section('content')
<div class="Card-Wrapper">
    @foreach($allTexts as $text)
    <a href="/textShow/{{$text->id}}">
        <div class="Texts-Card">
        <p>{{ $text->title }}</p>
            <p>{{$text->langOption->language_name}}</p>
            <br>
        </div>
    </a>
    @endforeach
</div>
@endsection