@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // ,'resources/js/delete-functions.js'
    function deleteList(id) {
        var bestaetigung = confirm("Sind Sie sicher, dass Sie diesen Post unwiderruflich löschen möchten?");

        // Überprüfen, ob der Benutzer auf "OK" geklickt hat
        if (bestaetigung) {  
            axios.post('/list_delete_function/'+id)
            .then(function(response) {
            location.reload();
        })
            console.log("Post wurde gelöscht.");
        } else {
            console.log("Löschvorgang abgebrochen.");
        }

        event.preventDefault();
        return false;

    }
    function confirmDelete() {
    return confirm('sind sie sich sicher, dass sie diese Liste löschen wollen?');
}
</script>

@vite(['resources/css/library.scss'])


@endsection

@section('content')
<!--ich muss ich daraus ein Component machen?--->
<div class="displayFlex">

<p class="pagetitle">Deine Bibliothek</p>
<div class="horizontal-fill"></div>
<a href="/list_create">
    <div class="addButton">
        <p class="addButtonText">neue Liste erstellen</p>
    </div>
</a>
</div>

@foreach ($libraryList as $libraryList)
    
<div class="library-Card">
    <a href="/list_show/{{$libraryList->id}}">
        <div class="displayFlex">
            <p class="cardTitle">{{$libraryList->name}}</p>
            <div class="horizontal-fill"></div>
            
            <form action="/list_delete_function/{{$libraryList->id}}" method="POST" onsubmit="return confirmDelete()">
                @csrf
                <button type="submit" class="delete-hitbox">
               
                    <img src="{{ asset('icons/trash-icon.svg')}}" alt="Löschen Icon">
              
                </button>
            </form>
        </div>
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
    </a>
</div>

@endforeach

@endsection