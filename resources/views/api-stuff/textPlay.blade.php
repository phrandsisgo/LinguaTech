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
            const text = "Кирилл работает веб-разработчиком. Он создает веб-сайты и приложения для интернета. Кирилл очень умный и талантливый человек. Он знает много языков программирования, таких как HTML, CSS и JavaScript. Он также умеет работать с базами данных и серверами.Когда Кирилл создает веб-сайт, он уделяет особое внимание дизайну и удобству использования. Он старается сделать сайты красивыми и функциональными, чтобы пользователи могли легко находить необходимую информацию и выполнять разные задачи.Кирилл работает в офисе, но иногда он также работает из дома. Ему нравится свобода, которую ему дает его профессия. Он всегда следит за последними тенденциями в веб-разработке и учится новым технологиям.";
            //В свободное время Кирилл также занимается программированием. Он создает собственные проекты и участвует в хакатонах. Ему нравится решать сложные задачи и находить новые способы улучшить веб-сайты.Кирилл любит свою работу и гордится тем, что он веб-разработчик. Он знает, что его работа помогает людям делать интернет лучше и более интересным местом.
            
            
            // Teile den Text in Sätze
            const sentences = text.split(/(?<=[.\?!]) /);


            sentences.forEach(sentence => {
                sentence.split(/([\p{L}]+)/gu).forEach(part => {
                    const span = document.createElement('span');
                    span.textContent = part;
                    span.className = 'word';

                    if (/\p{L}/u.test(part)) {
                        span.addEventListener('mouseover', () => span.classList.add('highlighted'));
                        span.addEventListener('mouseout', () => span.classList.remove('highlighted'));
                        span.addEventListener('click', () => handleClick(part, sentence, event));
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
@endsection
@section('content')
<form id="wordTranslateForm" method="POST" action="{{ route('translate') }}" style="display: none;">
    @csrf
    <input type="hidden" name="word" id="wordInput">
</form>

<p>Titel wierd hier hin gesetzt.</p>
<p id="textContainer"></p>
<br><br><br>


<!-- Modal-Struktur -->
<div id="translationModal">
    <div class="modal-content">
        <p>Das Wort übersetzt bedeutet: </p>
        <p id="translationText"></p>
        <br>
        <p>Das Wort nach dem Sie gefragt haben: </p>
        <p id="originalWord"></p>
        <br>
        
        <br>
        <form action="/list_add_word"method="post" id="wordAddForm">
            @csrf
            <!-- muss zu einem späteren Zeitpunkt noch angeben, welche Sprache die base und targetLang ist. -->
            <div class="dropdown">
            <p>Wollen sie dies einer Liste hinzufügen?</p>
                <select name="list" id="list">
                    @foreach ($ownLibraryList as $ownLibraryList)
                    <option value="{{$ownLibraryList->id}}">{{$ownLibraryList->name}}</option>
                    @endforeach
                    <input type="hidden" id="baseWordForm" name="baseWord" value="#">
                    <input type="hidden" id="targetWordForm" name="targetWord" value="#">
                </select>
            </div>
            <br>
            <button type="submit" onclick="prevDef(event)">Einfügen</button>
        </form>
        <button onclick="closeModal()">Schließen</button>
    </div>
</div>
<script>
    function prevDef(event){/* 
        event.preventDefault();
        document.getElementById('wordAddForm').submit(); */
    }
let anfrageWort=' ';
document.getElementById('wordTranslateForm').addEventListener('submit', function(event) {
    event.preventDefault();

  
    const word = document.getElementById('wordInput').value;
    anfrageWort = word;
    const formData = new FormData(this);
    let translatedWord='';
  
    //alert('Wort: ' );

    fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            res = response.json()
            
            res.then(data => {
                //alert(data.translation);
                translatedWord = data.translation;
                originalWord =data.request;
                //alert(data.request));
                openModal(translatedWord);

                return console.log(data.translation);
            })
        })
        .catch(error => console.error('Error:', error));

    });
    function handleClick(word, sentence, event) {
            event.preventDefault();
            document.getElementById('wordInput').value = word;
            document.getElementById('wordTranslateForm').dispatchEvent(new Event('submit'));
          
    }

    function openModal(translation, originalWord) {
        document.getElementById('translationText').textContent = translation;
        document.getElementById('translationModal').style.display = 'block';
        document.getElementById('originalWord').textContent = anfrageWort;
        document.getElementById('baseWordForm').value = anfrageWort;
        document.getElementById('targetWordForm').value = translation;
    }

    function closeModal() {
        document.getElementById('translationModal').style.display = 'none';
    }

</script>
@endsection
