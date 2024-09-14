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
        border: 1px solid #ddd;
        padding: 5px;
        display: none;
        z-index: 1000;
    }
</style>
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        const textContainer = document.getElementById('textContainer');
        const text = {!! json_encode($text->text) !!};

        let sentences = text.split(/(?<=[.\?!])/);

        sentences.forEach(sentence => {
            const parts = sentence.replace(/\r?\n/g, '<br>').split(/(<br>|[\p{L}'']+)/gu);

            parts.forEach(part => {
                if (part === '<br>') {
                    const br = document.createElement('br');
                    textContainer.appendChild(br);
                } else {
                    const span = document.createElement('span');
                    span.innerHTML = part;
                    span.className = 'word';
                    if (/\p{L}|['']/u.test(part)) {
                        span.addEventListener('mouseover', () => span.classList.add('highlighted'));
                        span.addEventListener('mouseout', () => span.classList.remove('highlighted'));
                        
                        span.addEventListener('click', (e) => handleClick(part, e));
                    }
                    textContainer.appendChild(span);
                }
            });
        });

        // New functionality for text selection
        document.addEventListener('mouseup', handleSelection);
    });

    function handleSelection(event) {
        const selection = window.getSelection();
        const selectedText = selection.toString().trim();

        if (selectedText.length > 0 && !event.target.classList.contains('word')) {
            const range = selection.getRangeAt(0);
            const rect = range.getBoundingClientRect();

            const dropdown = document.getElementById('selectionDropdown');
            dropdown.style.left = `${rect.left}px`;
            dropdown.style.top = `${rect.bottom + window.scrollY}px`;
            dropdown.style.display = 'block';
        } else {
            document.getElementById('selectionDropdown').style.display = 'none';
        }
    }

    function translateSelection() {
        const selectedText = window.getSelection().toString().trim();
        if (selectedText) {
            handleTranslation(selectedText);
        }
        document.getElementById('selectionDropdown').style.display = 'none';
    }

    function handleClick(word, event) {
        event.preventDefault();
        handleTranslation(word);
    }

    function handleTranslation(text) {
        const localLanguage = document.getElementById('currentLocalLanuguage').innerText;
        const translateWord = {
            word: text,
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

    // Other functions (openDeleteModal, closeDeleteModal) remain unchanged
</script>
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="text-learn-wrapper">
    <!-- Existing content remains unchanged -->
    <p id="textContainer" class="section-content"></p>

    <!-- New dropdown menu for text selection -->
    <div id="selectionDropdown">
        <button onclick="translateSelection()" class="standartButton">Übersetzen</button>
    </div>

    <!-- Existing modals remain unchanged -->
</div>
@endsection