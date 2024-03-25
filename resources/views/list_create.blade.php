@extends('layouts.lingua_main')
@section('title', __('list_create.create_new_list'))
@section('head')
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
<p class="pagetitle">{{ __('list_create.create_new_list') }}</p>

<form action="/list_create_function" method="POST" id="list_create_form">
    @csrf

    <p class="section-content" id="listTitleInput">{{ __('list_create.insert_title') }}</p>
    <input type="text" name="listTitle" id="listTitle" placeholder="{{ __('list_create.title_placeholder') }}" class="inputField">
    @error("listTitle")
    <p class="error">{{$message}}</p>
    @enderror
    <br><br>
    <p class="section-content">{{ __('list_create.description_optional') }}</p>
    <input type="text" name="listDescription" id="listDescription" placeholder="{{ __('list_create.description_placeholder') }}" class="inputField">

    @error("listDescription")
    <p class="error">{{$message}}</p>
    @enderror
    <div id="luis">
        <div class="library-Card">
            <input type="text" name="baseWord[]" id="baseWord" placeholder="{{ __('list_create.base_word_placeholder') }}" class="inputField">
            <p class="formHelper">{{ __('list_create.base_language') }}</p>

            <input type="text" name="targetWord[]" id="targetWord" placeholder="{{ __('list_create.target_word_placeholder') }}" class="inputField">
            <p class="formHelper">{{ __('list_create.target_language') }}</p>
        </div>
    </div>
    @error("baseWord.*")
    <p class="error">{{$message}}</p>
    @enderror  
    @error("targetWord.*")
    <p class="error">{{$message}}</p>
    @enderror 
    <button onclick="createLibraryCard(karten); anzahlplus();" class="standartButton">{{ __('list_create.add_another_term') }}</button>
    <button type="submit" class="approveButton">{{ __('list_create.create_list') }}</button>
</form>
<script>
document.getElementById('list_create_form').addEventListener('submit', function(event) {
    let isValid = true;
    const baseWords = document.querySelectorAll('input[name="baseWord[]"]');
    const targetWords = document.querySelectorAll('input[name="targetWord[]"]');
    const listTitle = document.getElementById('listTitle');
    const listDescription = document.getElementById('listDescription');
    const listTitleInput = document.getElementById('listTitleInput');
    // Validierung für Listentitel
    if (listTitle.value.trim().length < 3 || listTitle.value.trim().length > 40) {
        isValid = false;
        listTitleInput.style.color = "red";
        listTitleInput.innerHTML = "Bitte fügen sie ein Titel ein (zwischen 3 und 40 Zeichen)";
        //alert('Titel muss zwischen 3 und 40 Zeichen lang sein.');
    }

    // Validierung für Listenbeschreibung
    if (listDescription.value.trim().length > 200) {
        isValid = false;
        alert('Beschreibung darf nicht länger als 200 Zeichen sein.');
    }

    // Validierung für baseWord und targetWord
    baseWords.forEach((element, index) => {
        if (element.value.trim() === '' || targetWords[index].value.trim() === '') {
            isValid = false;
            alert('Alle Basiswörter und Zielwörter müssen ausgefüllt werden.');
        }
    });

    if (!isValid) {
        event.preventDefault();
    }
});
</script>
<script>
    let karten=0;
    function anzahlplus(){
        karten++;
        console.log(karten);
    }
</script>

@endsection
