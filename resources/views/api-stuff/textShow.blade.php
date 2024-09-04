@extends('layouts.lingua_main')
@section('title', 'textPlay')
@section('head')
<style>
        p {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }

        .highlighted {
            background-color: yellow;
        }

        .word {
            cursor: pointer;
            display: inline;
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
                            
                            span.addEventListener('click', (e) => handleClick(part, sentence, e));
                        }
                        textContainer.appendChild(span);
                    }
                });
            });
        });


       
    </script>
    <meta name="_token" content="{{ csrf_token() }}">

@endsection
@section('content')

<a href="/displayAllTexts">
    <button class="standartButton">{{ __('api_texts.all-texts') }}</button>
</a>
<p class="pagetitle ">{{$text->title}}</p>
<p id="textContainer" class="section-content"> </p>
<br><br><br>



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
<script>
    function prevDef(event){
        event.preventDefault();
        /*
        document.getElementById('wordAddForm').submit(); */
    }

function handleClick(word, sentence, event) {
        

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

function closeModal() {
    document.getElementById('translationModal').style.display = 'none';
}
document.getElementById('translationModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});


</script>
@endsection
