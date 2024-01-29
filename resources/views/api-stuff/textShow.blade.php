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
            // Russischer Text mit deutscher Übersetzung in Klammern
            const text = {!! json_encode($text->text) !!};
            //alert("text");
        
            
            //В свободное время Кирилл также занимается программированием. Он создает собственные проекты и участвует в хакатонах. Ему нравится решать сложные задачи и находить новые способы улучшить веб-сайты.Кирилл любит свою работу и гордится тем, что он веб-разработчик. Он знает, что его работа помогает людям делать интернет лучше и более интересным местом.
            
            
            // Teile den Text in Sätze
            const sentences = text.split(/(?<=[.\?!]) /);


            sentences.forEach(sentence => {
                sentence.split(/([\p{L}'’]+)/gu).forEach(part => {
                    const span = document.createElement('span');
                    span.textContent = part;
                    span.className = 'word';

                    if (/\p{L}|['’]/u.test(part)) {
                        span.addEventListener('mouseover', () => span.classList.add('highlighted'));
                        span.addEventListener('mouseout', () => span.classList.remove('highlighted'));
                        span.addEventListener('click', (e) => handleClick(part, sentence, e));
                    }

                    textContainer.appendChild(span);
                });
            });
        });

       
       /*  function handleClick(word, sentence) {
            document.getElementById('wordInput').value = word;
            document.getElementById('wordTranslateForm').submit();
        } */

    </script>
    <meta name="_token" content="{{ csrf_token() }}">

@endsection
@section('content')

<a href="/displayAllTexts">
    <button class="standartButton">Alle Texte</button>
</a>
<p class="pagetitle ">{{$text->title}}</p>
<p id="textContainer" class="section-content"> </p>
<br><br><br>



<!-- Modal-Struktur -->
<div id="translationModal">
    <div class="modal-content">
        <p>Das Wort übersetzt bedeutet: </p>
        <p id="translationText" class="sectiontitle"></p>
        <br>
        <p >Das Wort nach dem Sie gefragt haben: </p>
        <p id="originalWord" class="sectiontitle"></p>
        <br>
        
        <br>
        <form action="/list_add_word"method="post" id="wordAddForm">
            @csrf
            <!-- muss zu einem späteren Zeitpunkt noch angeben, welche Sprache die base und targetLang ist. -->
            <p >Wollen sie dies einer Liste hinzufügen?</p>
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
            <button type="submit" onclick="prevDef(event)" class="standartButton">Einfügen</button>
            <button type="button" onclick="closeModal()"class="standartDangerButton standartButton">Schliessen</button>
        </form>
    </div>
</div>
<script>
    function prevDef(event){
        event.preventDefault();
        /*
        document.getElementById('wordAddForm').submit(); */
    }
let anfrageWort=' ';

function handleClick(word, sentence, event) {
        event.preventDefault();
        const translateWord = {
            word: word
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

</script>
@endsection
