@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<!-- ich muss noch fragen wesswegen library.scss nicht funktioniert-->
@vite('resources/css/library.scss')
<script>
function confirmDelete() {
    return confirm('sind sie sich sicher, dass sie dieses Wort löschen wollen?');
}
</script>
@endsection

@section('content')
<!--ich muss daraus ein component machen--->
<div class="displayFlex">
    <div>
        <p class="pagetitle">{{$liste->name}}</p>
        <p class="section-content">{{$liste->description}}</p>
    </div>
    <div class="horizontal-fill"></div>
    @if (Auth::user()->id == $liste->created_by)
        
    <div>
        <a href="/list_update/{{$liste->id}}"><p class="pagetitle noUnderline">Bearbeiten</p></a>
    </div>
    @endif
    <div class="space"></div>
    <div>
        <a href="/swipeLearn/{{$liste->id}}"><p class="pagetitle noUnderline">Lernen</p></a>
    </div>
</div>


@foreach ($liste->words as $begriffe)
    
<div class="library-Card">
    <div class="displayFlex">
        <div>
                <p class="sectiontitle center-vertically">{{ $begriffe->base_word}}</p>
                <hr class="hrborder">
                <p class="sectiontitle center-vertically">{{ $begriffe->target_word }}</p>
        </div>
        <form action="/word_delete_function/{{$begriffe->id}}/{{$liste->id}}" method="POST" onsubmit="return confirmDelete()">
                @csrf
                <button type="submit" class="delete-hitbox">
               
                    <img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="Löschen Icon">
              
                </button>
        </form>
        
    </div>
</div>
@endforeach


@endsection