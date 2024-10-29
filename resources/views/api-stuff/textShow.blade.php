@extends('layouts.lingua_main')
@section('title', 'text')
@section('head')
    <style>
        p {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }

        .highlighted {
            background-color: #FFD166;
        }

        .word {
            cursor: pointer;
            display: inline;
        }

        #selectionDropdown {
            position: absolute;
            background-color: white;
            display: none;
        }
    </style>
    <script defer>
        document.addEventListener('DOMContentLoaded', function() {
            const textContainer = document.getElementById('textContainer');
            const text = {!! json_encode($text->text) !!};

            let sentences = text.split(/(?<=[.\?!])/);

            sentences.forEach(sentence => {
                // Ersetze Zeilenumbrüche im Satz direkt mit <br> Tags vor der weiteren Verarbeitung
                const parts = sentence.replace(/\r?\n/g, '<br>').split(/(<br>|[\p{L}'’]+)/gu);

                parts.forEach(part => {
                    if (part === '<br>') {
                        // Füge direkt ein BR Element hinzu, wenn der Teil ein Zeilenumbruch ist
                        const br = document.createElement('br');
                        textContainer.appendChild(br);
                    } else {
                        // Behandle normale Textteile wie zuvor
                        const span = document.createElement('span');
                        span.innerHTML = part;
                        span.className = 'word';
                        if (/\p{L}|['’]/u.test(part)) {
                            span.addEventListener('mouseover', () => span.classList.add('highlighted'));
                            span.addEventListener('mouseout', () => span.classList.remove('highlighted'));
                            
                            span.addEventListener('click', (e) => handleClick(part, e));
                        }
                        textContainer.appendChild(span);
                    }
                });
            });
            document.addEventListener('selectionchange', handleSelection);
        });

        function handleSelection() {
            const selection = window.getSelection();
            const selectedText = selection.toString().trim();

            if (selectedText.length > 0) {
                const range = selection.getRangeAt(0);
                const rect = range.getBoundingClientRect();

                const dropdown = document.getElementById('selectionDropdown');
                dropdown.style.left = `${rect.left + window.scrollX}px`;
                dropdown.style.top = `${rect.bottom + window.scrollY}px`;
                dropdown.style.display = 'block';
            } else {
                document.getElementById('selectionDropdown').style.display = 'none';
            }
        }


        function translateSelection() {
            console.log("translateSelection");
            event.preventDefault(); //kann vielleicht auskommentiert werrden.
            const selectedText = window.getSelection().toString().trim();

            if (selectedText) {
                console.log(selectedText);// Use the same logic as handleClick, but without the event parameter
                const localLanguage = document.getElementById('currentLocalLanuguage').innerText;
                const translateWord = {
                    word: selectedText,
                    baseLang: "{{$text -> langOption -> language_code}}",
                    targetLang: localLanguage,
                };
                var csrf = document.querySelector('meta[name="_token"]').content;

                const formData = JSON.stringify(translateWord);

                fetch('/translate/', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    }
                })
                .then(response => response.json())
                .then(data => {
                    openModal(data);
                })
                .catch(error => console.error('Error:', error));
                    }
                    document.getElementById('selectionDropdown').style.display = 'none';
                }


       
    </script>
    <meta name="_token" content="{{ csrf_token() }}">

@endsection
@section('content')
<div class="text-learn-wrapper">
    <a href="/displayAllTexts" style="text-decoration: none;">
        <button class="standartButton">{{ __('api_texts.all-texts') }}</button>
    </a>
    @if($text->created_by == auth()->user()->id)
        <a href="/updateText/{{ $text->id}}"style="text-decoration: none;">
            <button class="standartButton">{{ __('api_texts.edit-text') }}</button>
        </a>
        <button onclick="openDeleteModal()" class="standartDangerButton standartButton">{{ __('api_texts.delete-text') }}</button>
    @endif

    <p class="pagetitle ">{{$text->title}}</p>
    <p id="textContainer" class="section-content"> </p>
    <br><br><br>
    <div id="selectionDropdown">
        <button onclick="translateSelection()" class="standartButton" style="padding:4px">{{ __('api_texts.translate') }}</button>
    </div>



    <!-- Modal-Struktur -->
    <div id="translationModal">
        <div class="modal-content">
            <p>{{ __('api_texts.word-translated') }}</p>
            <p id="translationText" class="sectiontitle"></p>
            <br>
            <p >{{ __('api_texts.wordYouAskedFor') }}</p>
            <p id="originalWord" class="sectiontitle"></p>
            <br>
            
            <br>
            <form action="/list_add_word"method="post" id="wordAddForm">
                @csrf
                <!-- muss zu einem späteren Zeitpunkt noch angeben, welche Sprache die base und targetLang ist. -->
                <p >{{ __('api_texts.add-to-list') }}</p>
                <div class="dropdown">
                    <select name="list" id="list">
                        @foreach ($ownLibraryList as $ownLibraryList)
                        <option value="{{$ownLibraryList->id}}">{{$ownLibraryList->name}}</option>
                        @endforeach
                        <input type="hidden" id="baseWordForm" name="baseWord" value="#">
                        <input type="hidden" id="targetWordForm" name="targetWord" value="#">
                    </select>
                </div>
                <br>
                <button type="submit" class="standartButton">{{ __('api_texts.add-to-list') }}</button>
                <button type="button" onclick="closeModal()"class="standartDangerButton standartButton">{{ __('api_texts.close') }}</button>
            </form>
        </div>
    </div>

    <!-- delete modal -->
    
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>{{ __('api_texts.delete-text') }}</p>
            <p>{{ __('api_texts.delete-text-question') }}</p>
            <form action="/deleteText" method="post">
                @csrf
                <input type="hidden" name="textId" value="{{$text->id}}">
                <button type="submit" class="standartDangerButton standartButton">{{ __('api_texts.delete') }}</button>
                <button type="button" onclick="closeDeleteModal()" class=" standartButton">{{ __('api_texts.cancel') }}</button>
            </form>
        </div>
    </div>
</div>
<script>
    function prevDef(event){
        event.preventDefault();
        /*
        document.getElementById('wordAddForm').submit(); */
    }

function handleClick(word, event) {
        

    const localLanguage = document.getElementById('currentLocalLanuguage').innerText;
    event.preventDefault();
    const translateWord = {
        word: word,
        baseLang: "{{$text -> langOption -> language_code}}",
        targetLang: localLanguage,
    };
    var csrf = document.querySelector('meta[name="_token"]').content;
    //console.log(csrf)

    const formData = JSON.stringify(translateWord);
    let translatedWord='';

    fetch('/translate/', {
            method: 'POST',
            body: formData,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            }
        })
    .then(response => response.json())
    .then(data => {

            openModal(data);
            // return data;
    })
    .catch(error => console.error('Error:', error));
        
}

function openModal(data) {
    document.getElementById('translationText').textContent = data.translation;
    document.getElementById('translationModal').style.display = 'block';
    document.getElementById('originalWord').textContent = data.request;
    document.getElementById('baseWordForm').value = data.request;
    document.getElementById('targetWordForm').value = data.translation;
}

function openDeleteModal() {
    document.getElementById('deleteModal').style.display = 'block';
}

closeDeleteModal = function() {
    document.getElementById('deleteModal').style.display = 'none';
}

function closeModal() {
    document.getElementById('translationModal').style.display = 'none';
}
document.getElementById('translationModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});
document.getElementById('deleteModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeDeleteModal();
    }
});



</script>
@endsection
