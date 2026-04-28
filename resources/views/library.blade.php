@extends('layouts.lingua_main')
@section('title', 'Library')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/css/bootstrap5-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.0.4/js/bootstrap5-toggle.ecmas.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function deleteList(id) {
        var bestaetigung = confirm("{{__('library.rUSureUDelete') }}");

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
function confirmCopy() {
    return confirm('Sind Sie sicher, dass Sie diese Liste kopieren wollen?');
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
        document.getElementById('privateList').style.display = 'none';
        document.getElementById('publicList').style.display = 'block';
    } else {
        document.getElementById('privateList').style.display = 'block';
        document.getElementById('publicList').style.display = 'none';
    }
});
</script>




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
            <form action="/subscribeList/{{$libraryListe->id}}" method="POST" onsubmit="return confirm('Möchten Sie diese Liste abonnieren?')">
                @csrf
                <button type="submit" class="standartButton" style="margin-right:8px;">Abonnieren</button>
            </form>
            </div>
            <div></div>
            <div>
                <p class="begriffCount">{{ \App\Models\Word::where('word_list_id', $libraryListe->id)->count() }} {{__('library.begriff') }}</p> 
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
@foreach ($libraryList->sortByDesc('updated_at') as $privateList)
@if ($privateList->created_by == auth()->user()->id)
<div class="library-Card">
    <div class="displayFlex">
        <a href="/list_show/{{$privateList->id}}" class=" anker-no-underline displayFlex">
        <p class="cardTitle">{{$privateList->name}}</p>

        </a>
        <a href="/list_show/{{$privateList->id}}" class="horizontal-fill"></a>
        <a href="/swipeLearn/{{$privateList->id}}">
        <img src="{{ asset('svg-icons/learnIcon.svg')}}" alt="Bearbeiten Icon" class="libraryIcon">
        </a>
        <a href="/list_update/{{$privateList->id}}">
        <img src="{{ asset('svg-icons/pencil-icon.svg')}}" alt="Bearbeiten Icon" class="libraryIcon">
        </a>
        <form action="/list_delete_function/{{$privateList->id}}" method="POST" onsubmit="return confirmDelete()">
        @csrf
        <button type="submit" class="delete-hitbox">
            <img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="Löschen Icon" style ="height:34px; padding-top:3px;"class="libryryIcon">
        </button>
        </form>
    <a href="/list_show/{{$privateList->id}}" class=" anker-no-underline">
    </div>
    <div>
        <!-- give me the amount of words next-->
        <p class="begriffCount">{{ \App\Models\Word::where('word_list_id', $privateList->id)->count() }} {{__('library.begriff') }}</p> 
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

<!-- Abonnierte Listen -->
@if(isset($subscribedLists) && count($subscribedLists) > 0)
<div class="" id="subscribedList">
    <div class="displayFlex titleMargin">
        <p class="pagetitle">Abonnierte Listen</p>
        <div class="horizontal-fill"></div>
    </div>
    @foreach ($subscribedLists as $subList)
    <div class="library-Card">
        <div class="displayFlex">
            <a href="/list_show/{{$subList->id}}" class=" anker-no-underline displayFlex">
            <p class="cardTitle">{{$subList->name}}</p>
            </a>
            <a href="/list_show/{{$subList->id}}" class="horizontal-fill"></a>
            <a href="/swipeLearn/{{$subList->id}}">
            <img src="{{ asset('svg-icons/learnIcon.svg')}}" alt="Lernen" class="libraryIcon">
            </a>
        </div>
        <div>
            <p class="begriffCount">{{ \App\Models\Word::where('word_list_id', $subList->id)->count() }} {{__('library.begriff') }}</p>
        </div>
        <div class="leading-library">
            <p class="leadingText"> {{__('library.createdBy') }} {{$subList->creator->name}}</p>
            <div class="horizontal-fill"></div>
            <p class="leadingText">{{ date('d.m.y', strtotime($subList->created_at)) }}</p>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
