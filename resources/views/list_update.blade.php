@extends('layouts.lingua_main')
@section('title', "update your list")
@section('head')
@vite(['resources/css/library.scss','resources/js/list-create.js'])
@endsection

@section('content')
<p class="pagetitle">{{__('list_update.edit_your_list') }}</p>

<form action="/list_update_function/{{$liste->id}}"  method="POST" id="list_update_form">
    @csrf
    <div class="displayFlex">
        <div class="horizontal-fill"></div>
        <button onclick="createLibraryCard(karten); anzahlplus();" class="standartButton">{{ __('list_update.add_another_term') }}</button>
        <button type="submit" class="approveButton">{{ __('list_update.save_changes') }}</button>
    </div>

    <p class="section-content">{{ __('list_update.your_title') }}</p>
    <input type="text" name="listTitle" id="listTitle" value="{{$liste->name}}" placeholder="{{ __('list_update.your_title') }}" class="inputField">
    @error('listTitle' )
    <p class="formHelper colorDanger">{{ __('list_update.title_must_be_between') }}</p>
    @enderror
    <br><br><br>

    <p class="section-content">{{ __('list_update.description_optional') }}</p>
    <input type="text" name="listDescription" id="listDescription" value="{{$liste->description}}" placeholder="{{ __('list_update.description_optional') }}" class="inputField">
    @error('listDescription' )
    <p class="formHelper colorDanger">{{ __('list_update.description_cannot_be_longer') }}</p>
    @enderror
    <div id="luis">

    @foreach ($liste->words as $begriffe)
    <div class="library-Card" data-word-id="{{ $begriffe->id }}">
        <input type="hidden" name="wordIds[]" value="{{ $begriffe->id }}">
        <div class="displayFlex">
            <div>
                <input type="text" name="baseWord[]" value="{{ $begriffe->base_word }}" class="inputField">
                @error('baseWord.' . $loop->index)
                    <p class="errorMessages colorDanger">{{ __('list_update.the_base_word_must_be_between') }}</p>
                @enderror
                <p class="formHelper">{{ __('list_update.base_language') }}</p>

                <input type="text" name="targetWord[]" value="{{ $begriffe->target_word }}" class="inputField">
                <p class="formHelper">{{ __('list_update.target_language') }}</p>
                @error('targetWord.' . $loop->index)
                    <p class="errorMessages colorDanger">{{ __('list_update.the_target_word_must_be_between') }}</p>
                @enderror
            </div>
            <div class="horizontal-fill"></div>
            <button type="button" class="delete-hitbox" onclick="markForDeletion(this)">
                <img src="{{ asset('svg-icons/trash-icon.svg')}}" alt="Löschen Icon">
            </button>
        </div>
    </div>
    @endforeach
    </div>

    <button onclick="createLibraryCard(karten); anzahlplus();" class="standartButton">{{ __('list_update.add_another_term') }}</button>
    <button type="submit" class="approveButton">{{ __('list_update.save_changes') }}</button>
</form>

<script>
    let karten=0;
    function anzahlplus(){
        karten++;
        console.log(karten);
    }
    document.getElementById('list_update_form').addEventListener('submit', function(event) {
    let isValid = true;
    const baseWords = document.querySelectorAll('input[name="baseWord[]"]');
    const targetWords = document.querySelectorAll('input[name="targetWord[]"]');
    const listTitle = document.getElementById('listTitle');
    const listDescription = document.getElementById('listDescription');

    // Validierung für Listentitel
    if (listTitle.value.trim().length < 3 || listTitle.value.trim().length > 40) {
        isValid = false;
        alert('{{ __('list_update.title_length_validation') }}');
    }

    // Validierung für Listenbeschreibung
    if (listDescription.value.trim().length > 200) {
        isValid = false;
        alert('{{ __('list_update.description_length_validation') }}');
    }

    // Validierung für baseWord und targetWord
    baseWords.forEach((element, index) => {
        if (element.value.trim() === '' || targetWords[index].value.trim() === '') {
            isValid = false;
            alert('{{ __('list_update.all_base_and_target_words_must_be_filled') }}');
        }
    });

    if (!isValid) {
        event.preventDefault();
    }
});

    function markForDeletion(button) {
        const card = button.closest('.library-Card');
        const wordId = card.getAttribute('data-word-id');
        card.remove();
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'deletedWordIds[]';
        input.value = wordId;
        document.getElementById('list_update_form').appendChild(input);
    }
</script>

@endsection
