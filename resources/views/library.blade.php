@extends('layouts.lingua_main')
@section('title', 'Home')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/js/bootstrap5-toggle.ecmas.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function deleteList(id) {
        var bestaetigung = confirm("{{__('library.rUSureUDelete') }}");

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
    return confirm('{{__('library.rUSureUDelete') }}');
}
document.querySelectorAll('input[type=checkbox][data-toggle="toggle"]').forEach(function(ele) {
    ele.bootstrapToggle();
});
</script>

@vite(['resources/css/library.scss'])


@endsection

@section('content')
<!--toggle button--->

<div class=" titleMargin">
    <div class="toggle-wrapper">
        <input type="checkbox" id="toggleButton" class="toggle-checkbox">
        <label for="toggleButton" class="toggle-label">
            <span class="toggle-inner"></span>
            <span class="toggle-on">{{__('library.own') }}</span>
            <span class="toggle-off">{{__('library.public') }}</span>
        </label>
    </div>
</div>
<script>
document.getElementById('toggleButton').addEventListener('change', function() {
    if(this.checked) {
        //if the id="privateList" is visible, hide it
        document.getElementById('privateList').style.display = 'none';
        //if the id="publicList" is hidden, show it
        document.getElementById('publicList').style.display = 'block';
    } else {
        //if the id="privateList" is hidden, show it
        document.getElementById('privateList').style.display = 'block';
        //if the id="publicList" is visible, hide it
        document.getElementById('publicList').style.display = 'none';
    }
});
</script>
<!--
<input type="checkbox" checked="" data-toggle="toggle">
-->



<!-- nur Listen anzeigen die öffentlich sind-->
<div class="" id="publicList" style="display:none">
    <div class="displayFlex titleMargin">
        <p class="pagetitle">{{__('library.titlePublic') }}</p>
        <div class="horizontal-fill"></div>
    </div>
    @foreach ($libraryList as $libraryListe)
    @if ($libraryListe->created_by == 1)
        
    <div class="library-Card ">
        <a href="/list_show/{{$libraryListe->id}}" class="anker-no-underline">
            <div class="displayFlex">
                <p class="cardTitle">{{$libraryListe->name}}</p>
                <div class="horizontal-fill"></div>
            <form action="#" method="POST" onsubmit="return confirmDelete()">
                @csrf
                <button type="submit" class="delete-hitbox">
                    <img src="{{ asset('svg-icons/copy-icon.svg')}}" alt="Löschen Icon" class="libraryIcon">
                </button>
            </form>
            </div>
            <div></div>
            <div>
                <!-- give me the amount of words next-->
                <p class="begriffCount">{{$libraryListe->words->count()}} {{__('library.begriff') }}</p> 
            </div> 
            <div class="leading-library">
                <p class="leadingText"> {{__('library.begriff') }} {{$libraryListe->creator->name}}</p>
                <div class="horizontal-fill"></div>
                <p class="leadingText">{{ date('d.m.y', strtotime($libraryListe->created_at)) }}</p>
            </div>
        </a>
    </div>
    @endif
    @endforeach
</div>


<!-- nur Listen anzeigen die vom User erstellt wurden-->
 

<div class="" id="privateList">
<div class="displayFlex titleMargin">
        <p class="pagetitle">{{__('library.titlePrivate') }}</p>
        <div class="horizontal-fill"></div>
        <a href="/list_create">
            <div class="addButton">
                <p class="addButtonText pagetitle">{{__('library.newList') }}</p>
            </div>
        </a>
    </div>
@foreach ($libraryList as $privateList)
@if ($privateList->created_by == auth()->user()->id)
<div class="library-Card">
    <a href="/list_show/{{$privateList->id}}" class=" anker-no-underline">
        <div class="displayFlex">
            <p class="cardTitle">{{$privateList->name}}</p>
            <div class="horizontal-fill"></div>
            <a href="/swipeLearn/{{$privateList->id}}">
                <img src="{{ asset('svg-icons/learnIcon.svg')}}" alt="Bearbeiten Icon" class="libraryIcon">
            <a>
            <a href="/list_update/{{$privateList->id}}">
                <img src="{{ asset('svg-icons/pencil-icon.svg')}}" alt="Bearbeiten Icon" class="libraryIcon">
            </a>
            <form action="/list_delete_function/{{$privateList->id}}" method="POST" onsubmit="return confirmDelete()">
                @csrf
                <button type="submit" class="delete-hitbox">
                    <img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="Löschen Icon" class="libryryIcon">
                </button>
            </form>
        </div>
        <div></div>
        <div>
            <!-- give me the amount of words next-->
            <p class="begriffCount">{{$privateList->words->count()}} {{__('library.begriff') }}</p> 
        </div> 
        <div class="leading-library">
            <p class="leadingText"> {{__('library.createdBy') }} {{$privateList->creator->name}}</p>
            <div class="horizontal-fill"></div>
            <p class="leadingText">{{ date('d.m.y', strtotime($privateList->created_at)) }}</p>
        </div>
    </a>
</div>
@endif
@endforeach
</div>
@endsection